<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Main extends My_BaseController {
    protected $user, $update;
    
    function __construct() {
        parent::__construct();      
        $this->checkSession();
        
        $this->load->library('session');
        $this->title = 'Uhitch | Home';
        $this->setUserInfo();
    }
            
    function index() {
        $this->setRideTicker();
        $this->landingPage();
    }
    
    function landingPage() {
        $this->map = TRUE;
        $this->setScripts('landing');
        $this->display('main');
    }
    
    function profile() { 
        $this->load->model('retrievedata_model');
        
        $profile = $this->retrievedata_model->retrieveProfile();
        $ride    = $this->retrievedata_model->retrieveRides();
       
        if(!isset($this->user->make)) {
            $vehicle = $this->retrievedata_model->retrieveVehicle();
            $this->vehicleData($vehicle);
        }
        $this->rideHistory($ride);
        $this->profileData($profile);
  
        $this->display('profile');
    }
    
    function userProfile() {
        $userid = $this->input->get('q');
        
        if(!empty($userid)) {
            $this->load->model('retrievedata_model');
            $this->page = $this->retrievedata_model->retrieveUserInfo($userid);
            
            $ride = $this->retrievedata_model->retrieveRides(7, $userid);
            
            if(isset($this->page)) { 
                $rideArray = array('rides' => $ride);
            
                array_push($this->page, $rideArray);
                $this->display('userprofile'); 
            }
            else { $this->issue404Error(); }
        }
        else { $this->issue404Error(); }
    }
    
    private function issue404Error() {
        header("HTTP/1.0 404 Not Found");
        $this->view('errors/', 'page_missing');
    }
            
    function postride() {
        $this->map = TRUE;
        $this->setScripts('postride');
        $this->display('postride');
    }
    
    function newevent() {
        $this->title = 'Uhitch | Create New Event';
        $this->setScripts('event');
        $this->display('newEvent');
    }
    
    function upcoming() {
        $this->title = 'Uhitch | Upcoming Events';
      
        $this->load->helper("url");
        $this->load->model('EventServices_model');
        $this->load->library('pagination');

        $school = $this->user->school;
        $coord  = $this->EventServices_model->retrieveSchoolCoord($school);
        
        $config = array();
        $config['base_url'] = site_url().'/main/upcoming';
        $config['total_rows'] = $this->EventServices_model->eventRecordsCount($coord);
        
        if($config['total_rows'] > 0) {
            $config['per_page'] = 10; 
            $config["uri_segment"] = 3;

            $config['cur_tag_open'] = '<b>';
            $config['cur_tag_close'] = '</b>';

            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = round($choice);

            $this->pagination->initialize($config);

            $pages = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $this->page['results'] = $this->EventServices_model
                    ->retrieveAllEvents($config["per_page"], $pages);

            $this->page['links'] = $this->pagination->create_links();

            $this->map = TRUE;
            //$this->setScripts('upcoming');
        }
        $this->display('upcomingEvents');
    } 
        
    function hitchARide() {
        $rideId = $this->input->get('q');

        if( !empty($rideId) ) {
            $this->load->model('retrievedata_model');
            $info = $this->retrievedata_model->retrieveRideInformation($rideId);
            
            if( !empty($info) && isset($info) ) {
                $this->ride = $info;
                $this->map = TRUE;
                $this->setScripts('hitch');
                $this->display('displayRideInfo'); 
            }
            else { $this->issue404Error(); }
        }    
        
        else { $this->issue404Error(); }
    }
    
    function eventinfo() {
        $eventId = $this->input->get('q');
        $this->load->model('retrievedata_model');
        $info = $this->retrievedata_model->retrieveEventInformation($eventId);
        
        if($info && isset($info)) {
            $this->map  = TRUE;
            $this->setScripts('eventDetails');
            $this->ride = $info;
            $this->display('eventinfo'); 
        } 
        else { $this->issue404Error(); }     
    }
            
    function rating() {
        $this->display('rateRides');
    }
    
    function populateRideData(){
        $this->load->model('retrievedata_model');
        
        $this->retrievedata_model->populateRides();
    }
    
    function search() {
        $this->load->model('search_model');
        $this->load->library('pagination');
        
        $search = $this->input->get('searchBy', TRUE);
        $item = $this->input->get('destination', TRUE);
        
        $config = array();
        $config['total_rows'] = $this->search_model->searchingCriteria($search, $item);
        
        if(is_int($config['total_rows'])) {
            $this->setScripts('search');
            if($config['total_rows'] > 0) {
                $config['per_page'] = 10; 
                $config["uri_segment"] = 5;
                
                $config['base_url'] = site_url().'/main/search?';
                $config['base_url'] .= 'destination='.$this->input->get('destination', TRUE).'&';
                $config['base_url'] .= 'searchBy='.$this->input->get('searchBy', TRUE);
                
                $config['page_query_string'] = TRUE;
                
                $config['first_tag_open'] = '<div>';
                $config['first_tag_close'] = '</div>';
                
                $config['cur_tag_open'] = '<b>';
                $config['cur_tag_close'] = '</b>';
                
                $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = round($choice);

                $this->pagination->initialize($config);

                $pages = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

                $this->page['results'] = $this->search_model
                        ->retrieveResults($search, $item, $config["per_page"], $pages);
                $this->page['links'] = $this->pagination->create_links();
            }
            $this->display('searchresult');
        } 
        
        else { $this->issue404Error(); }
    }

    function settings() {
        // Add Deactivate Link
        $this->setAdditionalData();
        $this->title = 'Uhitch | Account Settings';
        $this->setScripts('settings');
        $this->display('settings');
    }
            
    function messages() {
        $this->setScripts('sendmessage');
        $this->load->model('messages_model');
        $user_messages = $this->messages_model->get_messages();
        $this->MessageData($user_messages);
        $this->display('message');
    }

    
    function MessageData($data)
    {
        $this->user->message_inbox  = $data;
    }
    
    function UserData($data)
    {
        $this->user->users_send = $data;
    }
    
    function sendUserMessages() {
        $this->load->model('messages_model');
        $this->messages_model->trySend();
       redirect('main/messages');
    }
    
    function getUsersForMessageSending()
    {
        $this->load->model('messages_model');
        $recipients = $this->messages_model->get_users_forMessages();
        $user_datastruct = array();
        
        foreach($recipients as $user_value)
        {
            array_push($user_datastruct, $user_value['email_address']);
        }
            echo json_encode($user_datastruct);
//        $json_users = json_encode($user_datastruct);
       return json_encode($user_datastruct);
    }
    
    function submitRides() {
        $this->load->model('postride_model');
        $result = $this->postride_model->post_ride();
        
        $redirect = isset($result) ? $result : FALSE;
        
        redirect('/main/ridesubmitted?sent='.$redirect);
    }
    
    function ridesubmitted() {
        $result = $_GET['sent'];
        
        if($result) 
            { $this->display('postRides/success'); }           
        
        else {
            if($this->session->userdata('car') !== 'yes') 
                { $this->display('postRides/registerVehicle'); }
            else 
                { $this->display('postRides/error'); } 
        }
    }
    
    function registerVehicle() {       
        $this->load->model('registeruser_model');
        
        $this->registeruser_model->registerVehicle();     
    }

    function eventsubmission() {
        $this->load->model('EventServices_model');

        $config['file_name'] = substr(str_shuffle(MD5(microtime())), 0, 45);
        
        // Direct Upload path on server
        $config['upload_path'] = 'assets/photos/events/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']	= '5000';
        $config['max_width']  = '1600';
        $config['max_height']  = '1200';
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        
        if (!$this->upload->do_upload()) {
            $this->display('events/error');
        } else {
            $data = array('upload_data' => $this->upload->data());
            
            $img = $data["upload_data"]["file_name"];
            
            $this->EventServices_model->registerEvent($img);
            $this->display('events/success');
        } 
    }
          
    function logout() {
        $this->destroySession();
        redirect('/welcome');
    } 
    
    function setRideTicker() {
        if(!isset($this->ticker)) {
            $this->load->model('retrievedata_model');
            $this->ticker = $this->retrievedata_model->applyRideTicker();
        }   
    }
            
    function calculateLogIn() {
        $login =  getdate(strtotime($this->session->userdata('last_login')));
        $members = getdate(strtotime($this->session->userdata('member_since')));
                
        $this->user->login = $login['month'] . ' ' . $login['mday'] . ', ' . $login['year'];
        $this->user->members = $members['month'] . ' ' . $members['mday'] . ', ' . $members['year'];
    }
    
    function setUserInfo() {
        $this->user = new stdClass();
        
        $this->setPersonalInfo();
        
        $this->user->school = $this->session->userdata('school');
        $this->user->city   = $this->session->userdata('location');
        $this->user->photo  = $this->session->userdata('photo');
        
        $this->calculateLogIn();
        
        $this->title = 'Uhitch | '.  $this->user->name;
        $this->data  = $this->user;
    }
    
    function setPersonalInfo() {
        $fname = $this->session->userdata('firstname');
        $lname = $this->session->userdata('lastname');
        $email = $this->session->userdata('emailAddress');
        
        $this->user->age    = $this->session->userdata('age');
        $this->user->name   = $fname.' '.$lname;
        $this->user->fname  = $fname;
        $this->user->lname  = $lname;
        $this->user->email  = $email;
    }

    function rideHistory($data) {
        $this->user->rideHistory = $data;
    }
       
    function retrieveAdditionalData() {
        $this->load->model('retrievedata_model');
        
        return $this->retrievedata_model->retrieveAdditionalData();
    }
            
    function setAdditionalData() {
        $data = $this->retrieveAdditionalData();

        $this->vehicleData($data);
        
        $this->user->middleName = $data['Middle_Name'];
        $this->user->phone      = $data['Phone_Number'];
        $this->user->address    = $data['Address'];
        $this->user->city       = $data['City'];
        $this->user->state      = $data['State'];
        $this->user->zip        = $data['Zip_Code'];
        $this->user->bio        = $data['Bio'];
        
        $this->profileData($data);
    }   
    
    function rideData($data) {
        $this->user->rating = $data['Driver_Rating'];
        $this->user->count  = $data['Rider_Count'];
    }
     
    function profileData($data) {
        $this->user->class  = $data['Classification'];
        $this->user->living = $data['Living'];
        $this->user->greek  = $data['Greek'];
        $this->user->org    = $data['Organizations'];
        $this->user->major  = $data['Major'];
        $this->user->music  = $data['Music'];
        $this->user->sports = $data['Sports'];
        $this->user->activ  = $data['Activities'];
        
        $this->data = $this->user;
    }    
    
    function vehicleData($data) {
        $this->user->make  = $data['Make'];
        $this->user->model = $data['Model'];
        $this->user->year  = $data['Year'];
        $this->user->color = $data['Color'];
    }
    
    private function display($view) {  
        $this->view('members/', $view, 'member');
    }        
} 
