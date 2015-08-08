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
            $this->load->model('myuser_model');
           // $this->page = $this->retrievedata_model->retrieveUserInfo($userid);
            $this->page = $this->myuser_model->getUserByUserID($userid);
            
           // echo '<pre>'; print_r($this->page); echo '</pre>'; exit;
            
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
        $this->load->model('retrievedata_model');
        
        $get = $this->input->get();
        
        if(isset($get)){
            $rideId = $this->input->get('q');
            $info = $this->retrievedata_model->retrieveRideInformation($rideId);
            $this->data->ride = $info;
            //echo '<pre>'; print_r($info); echo '</pre>'; exit;
        }
        
        $events = $this->retrievedata_model->retrieveAllEvents();
        $this->data->events = $events;
        $this->display('postride');
    }
    
    function requestride() {
        
        $rideId = $this->input->get('q');
        if( !empty($rideId) ) {
            
            $this->load->model('retrievedata_model');
            $info = $this->retrievedata_model->retrieveRideInformation($rideId);
            
            if( !empty($info) && isset($info) ) {
                
                $this->ride = $info;
                $this->map = FALSE;
                $this->setScripts('requestride');
                $this->display('requestride');
                
            } else { $this->issue404Error(); }
        } else { $this->issue404Error(); }
    }
    
    function newevent() {
        
        $eventId = $this->input->get('q');
        if( !empty($eventId) ) {
            
            $this->load->model('retrievedata_model');
            $info = $this->retrievedata_model->getEventById($eventId);
            //echo '<pre>'; print_r($info); echo '</pre>';
            $this->event = !empty($info) ? $info : '';
        }
        $this->title = 'Uhitch | Create New Event';
        $this->setScripts('event');
        $this->display('newEvent');
    }
    
    function allevent() {
        $this->title = 'Uhitch | Admin All Event';
        $this->setScripts('adminEvents');
        $this->load->model('eventservices_model');
        $this->events = $this->eventservices_model->retrieveEventAdmin();
        
        //echo '<pre>'; print_r($this->events); echo '</pre>'; exit;
        $this->display('admin/events');
    }
    
    function approveEvent($id) { 
        $this->load->model('eventservices_model');
        $this->eventservices_model->approveEventAdmin($id);
    }
    
    function disapproveEvent($id) { 
        $this->load->model('eventservices_model');
        $this->eventservices_model->disapproveEventAdmin($id);
    }
    
    function upcoming() {
        $this->title = 'Uhitch | Upcoming Events';
        $this->setScripts('upcomingEvents');
        $this->load->helper(array("url", "My_helper"));
        $this->load->model('eventservices_model');

        $config = array();
        $post = $this->input->post();
        
        if(isset($post) && $post != ''){
            //echo '<pre>'; print_r($post['Name']); echo '</pre>'; exit;
            
            $query = "";
            $empty = 'FALSE';
            
            if($post['Name'] != ''){
                $empty = 'TRUE';
                $query .= " Name LIKE '%".$post['Name']."%'";
            }
            if($post['City'] != ''){
                $empty = 'TRUE';
                $query .= " OR City LIKE '%".$post['City']."%'";
            }
            if($post['Location'] != ''){
                $empty = 'TRUE';
                $query .= " OR Location LIKE '%".$post['Location']."%'";
            }
            if($post['State'] != ''){
                $empty = 'TRUE';
                $query .= " OR State = '".$post['State']."'";
            }
            
            if($empty == 'TRUE'){
                $query .= " AND Reviewed = 1";
            }
            
            $config['events'] = $this->eventservices_model->searchForEvents($query);
        }else{
            $school = $this->user->school;
            $coord  = $this->eventservices_model->retrieveSchoolCoord($school);
            $config['events']   = $this->eventservices_model->eventRecordsCount($coord);
        }
        
       //echo '<pre>'; print_r($config); echo '</pre>';exit;

        $this->page['results'] = $config;
        $this->page['results']['states'] = getStates();
        //echo '<pre>'; print_r($config); echo '</pre>';//exit;
        
        $this->display('upcomingEvents');
    }
    
    function getEventById($id){
        
        if($id != ''){
            
           // echo $id; exit;
            
            $this->load->model('retrievedata_model');
            $info = $this->retrievedata_model->getEventById($id);
            //echo '<pre>'; print_r($info); echo '</pre>'; exit;
            print_r(json_encode($info));
            //exit;
        } else {
            $this->upcoming();
        }
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
        $this->load->model('myuser_model');
        $info = $this->retrievedata_model->retrieveEventInformation($eventId);
        
        //check if event has a ride
        /*if($info['EventId']){
                $this->retrievedata_model->EventHasRide($info['EventId'], $info['CreatedById']);
        }*/
        
        $user = $this->myuser_model->getUserByUserID($info['CreatedById']);
        
        $info['creator'] = $user;
        
       // echo '<pre>'; print_r($info); echo '</pre>'; exit;
        
        if($info && isset($info)) {
            $this->map  = TRUE;
            $this->setScripts('eventDetails');
            $this->ride = $info;
            $this->creator = $user;
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
    
     function ridepanel() {
        $this->title = 'Uhitch | Rides Panel';
        $this->setScripts('ridepanel');
        $this->load->model('retrievedata_model');
        $rideData = $this->retrievedata_model->getAllRidesByUserId($this->user->userid);
        $this->setRideData($rideData);
         //echo '<pre>'; print_r($rideData); echo '</pre>'; exit;
        $this->display('ridepanel');
    }
    
    function trippanel() {
        $this->title = 'Uhitch | Trips Panel';
        $this->setScripts('ridepanel');
        $this->load->model('retrievedata_model');
        $tripData = $this->retrievedata_model->getAllTripsByUserId($this->user->userid);
        $this->setRideData($tripData);
         //echo '<pre>'; print_r($tripData); echo '</pre>'; exit;
        $this->display('trippanel');
    }
    
    function eventpanel() {
        $this->title = 'Uhitch | Events Panel';
        $this->setScripts('eventpanel');
        $this->load->model('retrievedata_model');
        $eventData = $this->retrievedata_model->getAllEventsByUserId($this->user->userid);
        $this->setEventData($eventData);
        // echo '<pre>'; print_r($eventData); echo '</pre>'; exit;
        $this->display('eventpanel');
    }
    
    function getRideById($id){
        
        if($id != ''){
            $this->load->model('retrievedata_model');
            $rideData = $this->retrievedata_model->getRideById($id);
           // $out = array_values($rideData);
            print_r(json_encode($rideData));
            //print_r($rideData); 
            //exit;
        } else {
            $this->ridepanel();
        }
    }
        
    function messages($tab = '') {
        
        $get = $this->input->get();
        $this->user->get = (isset($get) && $get != '') ? $get['q'] : '';
        $to_userInfo = $this->getUserById($this->user->get);
        $this->user->to_username = (is_array($to_userInfo) && count($to_userInfo) > 0 ) ? $to_userInfo[0]['Full_Name'] : '';
        //echo '<pre>'; print_r($to_userInfo); echo '</pre>'; exit;
        
        $userId = $this->user->userid;
    
        switch ($tab) {
            case 'sent':
                $this->sent($userId);
                break;
            case 'important':
                $this->important($userId);
                break;
            case 'deleted':
                $this->deleted($userId);
                break;
            default:
                $this->inbox($userId);
                break;
        }
        
        $this->display('message');
    }
    
    function inbox($userId){
        $this->setScripts('sendmessage');
        $this->load->model('messages_model');
        $msgData = $this->messages_model->getMsgByUserId($userId);
        $this->MessageData($msgData);
        $this->user->tab = 'inbox';
    }
    
    function sent($userId){
        $this->setScripts('sendmessage');
        $this->load->model('messages_model');
        $msgData = $this->messages_model->getSentByUserId($userId);
        $this->MessageData($msgData);
        $this->user->tab = 'sent';
    }
    
    function important($userId){
        $this->setScripts('sendmessage');
        $this->load->model('messages_model');
        $msgData = $this->messages_model->getImportantByUserId($userId);
        $this->MessageData($msgData);
        $this->user->tab = 'important';
    }
    
    function deleted($userId){
        $this->setScripts('sendmessage');
        $this->load->model('messages_model');
        $msgData = $this->messages_model->getDeletedByUserId($userId);
        $this->MessageData($msgData);
        $this->user->tab = 'deleted';
    }
    
    function getMsgByUserId($tab = ''){
        redirect('main/messages/'.$tab, 'refresh');
    }
    
    function getUsername($value){
        $this->load->model('messages_model');
        $msgData = $this->messages_model->getUsername($value);
        $out = array_values($msgData);
        print_r(json_encode($out));
    }
    
    function getUserById($id){
        $this->load->model('messages_model');
        $msgData = $this->messages_model->getUserById($id);
        return $msgData;
    }
    
    
    function sendMessage(){
        $this->load->model('messages_model');
        $post = $this->input->post();
        if($post != ''){
            $this->messages_model->setMessage($post);
            $this->user->msg = 'Your message was sent to <strong>'.$post['username'].'</strong> successfuly.';
            $this->user->error = 'false';
            $post = '';
        }
        redirect('main/messages/'.$this->user->tab, 'refresh');
    }
    
    function readMessage($id){
        $this->load->model('messages_model');
        if(isset($id)){
            $this->messages_model->readMessage($id);
        }
    }
    
    function enableImportant($id){
        $this->load->model('messages_model');
        if(isset($id)){
            $this->messages_model->enableImportant($id);
        }
        $this->messages('important');
    }
    
    function disableImportant($id){
        $this->load->model('messages_model');
        if(isset($id)){
            $this->messages_model->disableImportant($id);
        }
    }
    
    function enableDelete($id){
        $this->load->model('messages_model');
        if(isset($id)){
            $this->messages_model->enableDelete($id);
        }
    }
    
    function disableDelete($id){
        $this->load->model('messages_model');
        if(isset($id)){
            $this->messages_model->disableDelete($id);
        }
    }
    
    function completeDelete($id){
        $this->load->model('messages_model');
        if(isset($id)){
            $this->messages_model->completeDelete($id);
        }
    }
    
    function completeAllDelete($ids){
        $this->load->model('messages_model');
        $ids = str_replace("_",",",$ids);
        if(isset($ids)){
            $this->messages_model->completeAllDelete($ids);
        }
    }
    
    function sentDelete($id){
        $this->load->model('messages_model');
        if(isset($id)){
            $this->messages_model->sentDelete($id);
        }
    }
    
    function sentAllDelete($ids){
        $this->load->model('messages_model');
        $ids = str_replace("_",",",$ids);
        if(isset($ids)){
            $this->messages_model->sentAllDelete($ids);
        }
    }
        
    function enableAllDelete($ids){
        $this->load->model('messages_model');
        $ids = str_replace("_",",",$ids);
        if(isset($ids)){
            $this->messages_model->enableAllDelete($ids);
        }
    }
    
    function setEventData($data)
    {
        $this->user->event_data  = $data;
    }
    
    function setRideData($data)
    {
        $this->user->ride_data  = $data;
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
    
    function updateRide() {
        $this->load->model('postride_model');
        
        $post = $this->input->post();
        //echo '<pre>'; print_r($post); echo '</pre>'; exit;
        
        $result = $this->postride_model->updateRide();
        
        $redirect = isset($result) ? $result : FALSE;
        
        redirect('/main/rideupdated?updated='.$redirect);
    }
    
    function rideupdated() {
        $result = $_GET['updated'];
        if($result) { 
            $this->display('postRides/updatesuccess'); 
        }
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
        $this->load->model('eventservices_model');
        
        $post = $this->input->post(); 
        
        if(!isset($post) || empty($post)){
            $config['file_name'] = substr(str_shuffle(MD5(microtime())), 0, 45);

            // Direct Upload path on server
            $config['upload_path']      = 'assets/photos/events/';
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['max_size']         = '5000';
            $config['max_width']        = '1600';
            $config['max_height']       = '1200';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                $this->display('events/error');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $img = $data["upload_data"]["file_name"];
                $this->eventservices_model->registerEvent($img);
                $this->display('events/success');
            } 
        }else{
            
            $eventId = $post['EventId'];
            if(isset($_FILES) && !empty($_FILES['name'])){
                echo '<pre>'; print_r($_FILES); echo '</pre>';exit;
                
                $info = $this->eventservices_model->getEventPhotoById($eventId);
                
                $url = base_url('assets/photos/events/'.$info[0]['Photo']);
             
                if(file_exists($url)){
                    unlink($url);
                }
                
                $config['file_name'] = substr(str_shuffle(MD5(microtime())), 0, 45);

                // Direct Upload path on server
                $config['upload_path']      = 'assets/photos/events/';
                $config['allowed_types']    = 'jpg|png|jpeg';
                $config['max_size']         = '5000';
                $config['max_width']        = '1600';
                $config['max_height']       = '1200';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if( !$this->upload->do_upload() ){
                    
                    //$error = array('error' => $this->upload->display_errors());
                    $this->error['EventId'] =  $post['EventId'];
                    $this->error['Error'] =  $this->upload->display_errors();
                    $this->display('events/error');
                    
                }else{ 
                    
                     
                    $data = array('upload_data' => $this->upload->data());
                    $img = $data["upload_data"]["file_name"];
                    //echo '<pre>'; print_r($data); echo '</pre>'; 
                   
                    $post = $this->input->post();
                    $post['updatefile'] = $img;
                    
                    $this->eventservices_model->updateEventById($post);
                    $this->display('events/success');
                   
                } 
                
                
                //echo '<pre>'; print_r($info); echo '</pre>'; exit;
                
            }else{
               
                $this->eventservices_model->updateEventById($post);
                $this->success['Message'] = 'Your event is successfuly updated.';
                $this->display('events/success');
            }
            //$this->display('events/success');
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
        
        $this->calculateLogIn();
        
        $this->title = 'Uhitch | '.  $this->user->name;
        $this->data  = $this->user;
    }
    
    function setPersonalInfo() {
        
        $this->load->model('myuser_model');
        $email = $this->session->userdata('emailAddress');
        $user_info = $this->myuser_model->getUserByEmail($email);
        
       // echo '<pre>'; print_r($user_info); echo '</pre>';
        
        $this->session->set_userdata('photo', $user_info['Photo']);
        $this->session->set_userdata('admin', $user_info['Admin']);
        $this->session->set_userdata('active', $user_info['Active']);
        
        $this->user->active = $this->session->userdata('active');
        $this->user->admin  = $this->session->userdata('admin');
        $this->user->photo  = $this->session->userdata('photo');
        $this->user->age    = $this->session->userdata('age');
        $this->user->name   = $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
        $this->user->fname  = $this->session->userdata('firstname');
        $this->user->lname  = $this->session->userdata('lastname');
        $this->user->email  = $this->session->userdata('emailAddress');
        $this->user->school = $this->session->userdata('school');
        $this->user->city   = $this->session->userdata('location');
        $this->user->userid = $this->session->userdata('userid');
        $this->user->tab    = 'inbox';
      //  echo '<pre>'; print_r($this->user); echo '</pre>';
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
        
        //echo '<pre>'; print_r( $data ); echo '</pre>';exit;

        $this->vehicleData($data);
        
        $this->user->fullName   = $data['Full_Name'];
        $this->user->firstName  = $data['First_Name'];
        $this->user->middleName = $data['Middle_Name'];
        $this->user->gender     = $data['Gender'];
        $this->user->lastName   = $data['Last_Name'];
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
