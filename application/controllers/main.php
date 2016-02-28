<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Main extends My_BaseController {
    protected $user, $update; 
    public $flashData;
    
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
        $this->setScripts('profile');
        
        $profile = $this->retrievedata_model->retrieveProfile();
        $ride    = $this->retrievedata_model->retrieveRides();
       
        if(!isset($this->user->make)) {
            $vehicle = $this->retrievedata_model->retrieveVehicle();
            $this->vehicleData($vehicle);
        }
        
        $this->rideHistory($ride);
        $this->profileData($profile);
        $this->bg = "body12";
        $this->display('profile');
    }
    
    function userProfile() {
        $userid = $this->input->get('q');
        
        if(!empty($userid)) {
            $this->load->model('retrievedata_model');
            $this->load->model('myuser_model');
            $this->setScripts('profile');
           // $this->page = $this->retrievedata_model->retrieveUserInfo($userid);
            $this->page = $this->myuser_model->getUserByUserID($userid);
            
           // echo '<pre>'; print_r($this->page); echo '</pre>'; exit;
            
            $ride = $this->retrievedata_model->retrieveRides(50, $userid);
            
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
        
        if(isset($get) && !empty($get)){
            $rideId = $this->input->get('q');
            if(isset($rideId) && !empty($rideId)){
                $info = $this->retrievedata_model->retrieveRideInformation($rideId);
                $this->data->ride = $info;
            }
            
            $eventId = $this->input->get('e');
            if(isset($eventId) && !empty($eventId)){
                $info = $this->retrievedata_model->getEventById($eventId);
                $this->data->myevent = $info;
            }
            
            //echo '<pre>'; print_r($info); echo '</pre>'; exit;
        }
        
        $events = $this->retrievedata_model->retrieveAllEvents();
        $this->data->events = $events;
        $this->bg = "body3";
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
    
    function newevent($plan='') {
        $eventId = $this->input->get('q');
        if( !empty($eventId) ) {
            
            $this->load->model('retrievedata_model');
            $info = $this->retrievedata_model->getEventById($eventId);
            $admin = ($this->input->get('admin')) ? $this->input->get('admin') : '' ;
            if(!empty($info) && !empty($admin)) 
                $info['admin'] = 1;
            //echo '<pre>'; print_r($info); echo '</pre>';exit;
            $this->event = !empty($info) ? $info : '';
        }
        
        $this->event['plan'] = 'professional';
        if(isset($plan) && !empty($plan)){
            $this->event['plan'] = $plan;
        }
        $this->title = 'Uhitch | Create New Event';
        $this->bg = 'body9';
        $this->setScripts('event');
        $this->display('newEvent');
    }
    
    function eventpricing() {
        $this->title = 'Uhitch | Create New Event';
        $this->bg = 'body5';
        $this->display('eventpricing');
    }
    
    function allevent() {
        $this->title = 'Uhitch | Admin All Event';
        $this->setScripts('adminEvents');
        $this->load->model('eventservices_model');
        $this->load->model('retrievedata_model');

        $config = array();
        $post = $this->input->post();
       // echo '<pre>'; print_r($post); echo '</pre>';exit;
        if(isset($post) && !empty($post)){
           // echo '<pre>'; print_r($post); echo '</pre>'; //exit;
            
            $query = array();
            $empty = 'FALSE';
            
            if($post['Name'] != ''){
                $query[]= " Name LIKE '%".$post['Name']."%'";
            }
            if($post['Location'] != ''){
                $query[]= " Location LIKE '%".$post['Location']."%'";
            }
            if($post['City'] != ''){
                $query[]= " City LIKE '%".$post['City']."%'";
            }
            if($post['State'] != ''){
                $query[]= " State = '".$post['State']."'";
            }
            if($post['Zip'] != ''){
                $query[]= " Zip = ".$post['Zip'];
            }
            if($post['Approve'] != ''){
                $query[]= " Reviewed = '".$post['Approve']."'";
            }
            
            $config = $this->eventservices_model->searchForEventsByAdmin($query);
            $this->events['events'] = $config;
        }else{
            $this->events['events'] = $this->eventservices_model->retrieveEventAdmin();
        }
    
       // echo '<pre>'; print_r($this->events); echo '</pre>';exit;
        $eventbyrides = array();
        if(isset($this->events['events']) && !empty($this->events['events'])){
            foreach($this->events['events'] as $key => $value){
                $hasride = $this->retrievedata_model->getRidesByEventId($value['EventId']);
                $totalrides = 0;
                if(isset($hasride) && !empty($hasride)){
                    $totalrides = count($hasride);
                }
                $value['hasrides'] = $totalrides;
                $eventbyrides[] = $value;
            }
        }
        
        $this->events['events'] = $eventbyrides;
        $this->events['states'] = getStates();
        
        //echo '<pre>'; print_r($this->events); echo '</pre>';exit;
        //exit;
        $this->bg = 'body10';
        $this->display('admin/events');
    }
    
    function approveEvent($id) { 
        $this->load->model('eventservices_model');
        $this->eventservices_model->approveEventAdmin($id);
        $msg['error'] = false;
        $msg['msg'] = 'This Event was Approved, Loading Please Wait ...';
        print_r(json_encode($msg));
    }
    
    function disapproveEvent($id) { 
        $this->load->model('eventservices_model');
        $this->eventservices_model->disapproveEventAdmin($id);
        $msg['error'] = true;
        $msg['msg'] = 'This Event was Disapproved, Loading Please Wait ...';
        print_r(json_encode($msg));
    }
    
    function upcoming() {
        $this->title = 'Uhitch | Upcoming Events';
        $this->setScripts('upcomingEvents');
       // $this->load->helper(array("url", "My_helper"));
        $this->load->model('eventservices_model');

        $config = array();
        $post = $this->input->post();
        
        if(isset($post) && !empty($post)){
            //echo '<pre>'; print_r($post); echo '</pre>'; //exit;
            
            $query = array();
            $empty = 'FALSE';
            
            if($post['Name'] != ''){
                $query[]= " Name LIKE '%".$post['Name']."%'";
            }
            if($post['Location'] != ''){
                $query[]= " Location LIKE '%".$post['Location']."%'";
            }
            if($post['City'] != ''){
                $query[]= " City LIKE '%".$post['City']."%'";
            }
            if($post['State'] != ''){
                $query[]= " State = '".$post['State']."'";
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
        $this->bg = 'body10';
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
    
    function getRidesByEventId($id){
        
        if($id != ''){
            
           // echo $id; exit;
            
            $this->load->model('retrievedata_model');
            $info = $this->retrievedata_model->getRidesByEventId($id);
            //echo '<pre>'; print_r($info); echo '</pre>'; exit;
            print_r(json_encode($info));
            //exit;
        } else {
            $this->eventpanel();
        }
    }
    
    function removeEvent($id){
                              
        if($id != ''){
            $this->load->model('retrievedata_model');
            $info = $this->retrievedata_model->getEventById($id);
            
            if(is_array($info) && !empty($info)){
                
                $this->load->model('eventservices_model');
                $this->eventservices_model->deleteEventById($id);
                
                $fileRoot = 'assets/photos/events/'.$info['Photo'];
                $url = base_url($fileRoot);

                if( isUrlExists( $url ) ){
                    unlink($fileRoot);
                }

                $this->flashData['error'] = false;
                $this->flashData['msg'] = 'The Event was deleted successfuly.';
                
            }else{
                $this->flashData['error'] = true;
                $this->flashData['msg'] = 'The Event can not be deleted, no records are matching the provided information, please try again.';
            }
        }else{
          $this->flashData['error'] = true;
          $this->flashData['msg'] = 'The Event can not be deleted, a missing ID was detected, please try again.';
        }
        
        $this->setFlashData();
        $this->eventpanel();
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
        $this->bg = 'body1';
        $this->display('ridepanel');
    }
    
    function trippanel() {
        $this->title = 'Uhitch | Trips Panel';
        $this->setScripts('ridepanel');
        $this->load->model('retrievedata_model');
        $tripData = $this->retrievedata_model->getAllTripsByUserId($this->user->userid);
        $this->setRideData($tripData);
         //echo '<pre>'; print_r($tripData); echo '</pre>'; exit;
        $this->bg = "body3";
        $this->display('trippanel');
    }
    
    function eventpanel() {
        $this->title = 'Uhitch | Events Panel';
        $this->setScripts('eventpanel');
        $this->load->model('retrievedata_model');
        $eventData = $this->retrievedata_model->getAllEventsByUserId($this->user->userid);
        $this->setEventData($eventData);
        
        $this->page['results']['states'] = getStates();
        
        //echo '<pre>'; print_r($eventData); echo '</pre>'; exit;
        $this->bg = "body5";
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
        $this->bg = 'body7';
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
    
    function setFlashData()
    {
        $this->user->flash_data = $this->flashData;
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
    
    function deleteevent($id) {
        if(isset($id) && !empty($id)){
            $this->load->model('retrievedata_model');
            $eventrides = $this->retrievedata_model->getRidesByEventId($id);
            //echo '<pre>'; print_r($eventrides); echo '</pre>'; 
            $eventinfo = $this->retrievedata_model->getEventById($id);
            
            if(isset($eventrides) && !empty($eventrides)){
                $msg['error'] = true;
                $msg['msg'] = 'The Event has Rides and can not be removed from the site.';
            }else{
                //echo '<pre>'; print_r($eventinfo); echo '</pre>';
                $eventdate = date('m/d/Y', strtotime($eventinfo['EventDate']));
                //send message to user the event was deleted;
                
                $this->load->model('messages_model');
                $userinfo = $this->messages_model->getUserById($eventinfo['UserId']);
                
                $adminid = $this->session->userdata('userid');
                $admininfo = $this->messages_model->getUserById($adminid);
                
                $messageinfo['username'] = $userinfo[0]['Full_Name'];
                $messageinfo['to_userid'] = $userinfo[0]['UserID'];
                $messageinfo['from_fullname'] = $admininfo[0]['Full_Name'];
                $messageinfo['from_userid'] = $admininfo[0]['UserID'];
                $messageinfo['subject'] = 'Event Removal - Admin Action - ';
                
                $messageinfo['message'] = 'The event '.$eventinfo['Name'].', '.$eventinfo['Location'].', '.$eventinfo['City'].', '.$eventinfo['State'].', '.$eventinfo['Zip'].', on '.date('m/d/Y', strtotime($eventinfo['EventDate'])).' at '.$eventinfo['EventTime'].' was removed - please contact admin to get more details about this action or reply to this message.';
                
                if($eventinfo['Reviewed'] != 2){
                    $this->messages_model->setMessage($messageinfo);
                    $this->eventarchive($eventinfo['EventId']);
                    $msg['error'] = false;
                    $msg['msg'] = 'The Event is temporarly removed from the site, Loading Please Wait ...';
                }else{
                    $msg['error'] = true;
                    $msg['msg'] = 'This Event was already set as temporary removed from the site, Loading Please Wait ...';
                }
            }
            print_r(json_encode($msg));
        }
        
    }
    
    function eventarchive($id){
        if($id){
            $this->load->model('retrievedata_model');
            $this->retrievedata_model->archiveevent($id);
            return true;
        }
        return false;
    }
    
    function eventrevert($id){
        if($id){
            //echo $id; exit;
            $this->load->model('retrievedata_model');
            $this->load->model('messages_model');
            /** Event info **/
            $eventinfo = $this->retrievedata_model->getEventById($id);
            $eventdate = date('m/d/Y', strtotime($eventinfo['EventDate']));
            /** User info **/
            $userinfo = $this->messages_model->getUserById($eventinfo['UserId']);
            /** Admin info **/
            $adminid = $this->session->userdata('userid');
            $admininfo = $this->messages_model->getUserById($adminid);
            /** Set Message info **/
            $messageinfo['username'] = $userinfo[0]['Full_Name'];
            $messageinfo['to_userid'] = $userinfo[0]['UserID'];
            $messageinfo['from_fullname'] = $admininfo[0]['Full_Name'];
            $messageinfo['from_userid'] = $admininfo[0]['UserID'];
            $messageinfo['subject'] = 'Event Removal - Admin Action - ';
            $messageinfo['message'] = 'The event '.$eventinfo['Name'].', '.$eventinfo['Location'].', '.$eventinfo['City'].', '.$eventinfo['State'].', '.$eventinfo['Zip'].', on '.date('m/d/Y', strtotime($eventinfo['EventDate'])).' at '.$eventinfo['EventTime'].' was reverted back to the site - please contact admin to get more details about this action or reply to this message.';
            /** Send Message **/
            $this->messages_model->setMessage($messageinfo);
            /** Revert Event Back  **/
            $this->retrievedata_model->revertevent($id);
            //$this->allevent();
            //echo site_url().'/main/allevent';exit;
            $msg['error'] = false;
            $msg['msg'] = 'The Event is reverted back to the site, Loading Please Wait ...';
            print_r(json_encode($msg));
        }
        return false;
    }
    
    function trashevent($id){
        if($id){
            $this->load->model('retrievedata_model');
            $this->retrievedata_model->trashevent($id);
            $msg['error'] = false;
            $msg['msg'] = 'The Event is completely removed from the site, Loading Please Wait ...';
            print_r(json_encode($msg));
        }
        return false;
    }

    function eventsubmission() {
        $this->load->model('eventservices_model');
        
        $post = $this->input->post(); 
        echo '<pre>'; print_r($post); echo '</pre>'; exit;
        if(isset($post['admin']) &&  $post['admin'] == 1){
            $this->admin = 1;
        }
        if(isset($post['EventId']) && empty($post['EventId'])){
            
            $config['file_name'] = substr(str_shuffle(MD5(microtime())), 0, 45);

            // Direct Upload path on server
            $config['upload_path']      = 'assets/photos/events/';
            $config['allowed_types']    = 'jpg|png|jpeg';
            $config['max_size']         = '10000';
            $config['max_width']        = '2400';
            $config['max_height']       = '1600';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload()) {
                //$error = array('error' => $this->upload->display_errors());
                $this->error['Message'] = $this->upload->display_errors();
                $this->display('events/error');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $img = $data["upload_data"]["file_name"];
                $this->eventservices_model->registerEvent($img);
                $this->success['Message'] = 'Your event is successfuly updated.';
                $this->display('events/success');
            } 
        }else{
            
            //echo '<pre>'; print_r($post); echo '</pre>';exit;
            //echo '<pre>'; print_r($_FILES); echo '</pre>';exit;
            $eventId = $post['EventId'];
            if(isset($_FILES['userfile']) && !empty($_FILES['userfile']['name'])){
                //echo '<pre>'; print_r($_FILES); echo '</pre>';
                
                $fileRoot = 'assets/photos/events/'.$post['updatefile'];
                $url = base_url($fileRoot);
                
                if( isUrlExists( $url ) ){
                    unlink($fileRoot);
                }
                
                //echo '<pre>'; print_r($url); echo '</pre>';
                //exit;
                
                $config['file_name'] = substr(str_shuffle(MD5(microtime())), 0, 45);

                // Direct Upload path on server
                $config['upload_path']      = 'assets/photos/events/';
                $config['allowed_types']    = 'jpg|png|jpeg';
                $config['max_size']         = '10000';
                $config['max_width']        = '2400';
                $config['max_height']       = '1800';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if( !$this->upload->do_upload() ){

                    $this->error['Message'] = $this->upload->display_errors();
                    $this->display('events/error');
                    
                }else{ 
                    
                     
                    $data = array('upload_data' => $this->upload->data());
                    $img = $data["upload_data"]["file_name"];
                    //echo '<pre>'; print_r($data); echo '</pre>'; 
                   
                    $post = $this->input->post();
                    $post['updatefile'] = $img;
                    
                    $this->eventservices_model->updateEventById($post);
                    $this->success['Message'] = 'Your event is successfuly updated.';
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
    
    function getSurroundingRides() {
        $this->load->model('retrievedata_model');
        $rides = $this->retrievedata_model->applyRideTicker();
        
        
        
        foreach($rides as $key=>$value){
            echo '<pre>'; print_r($value); echo '</pre>';
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
        $this->bg = 'body2';
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
