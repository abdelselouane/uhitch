<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Handles Ajax Calls
class Rest extends My_BaseController {
    
    function __construct() {
        parent::__construct();  
    }
    
    function retrieveRideInfoCoords() {
        //var_dump($this->map) ;
    }
    
    function retrieveRidesMarkers() {
        $lat = $this->input->post('lat');
        $lon = $this->input->post('lon');
        
        $radius = 25;
        $limit = 40;

        $this->load->model('retrievedata_model');
        $ride = $this->retrievedata_model->returnRides($lat, $lon, $radius, $limit);

        echo json_encode($ride);
    }
    
    function retrieveEventsInfo() {
        $id = $this->input->post('id');
        $this->load->model('EventServices_model');
        
        echo $this->EventServices_model->retrieveEventInfo($id);
    }
    
    function contactUhitch() {
        echo 'works';
    }
    
    public function sendMessage() {
        
    }
    
    function handleAjax($command) {
        $this->load->model('retrievedata_model');
        
        switch ($command) {
            case 'personal':
                $status = $this->retrievedata_model->changePersonalData();
                break;
            case 'vehicle': 
                $status = $this->retrievedata_model->changeVehicleData();
                break;
            case 'school':
                $status = $this->retrievedata_model->changeSchoolData();
                break;
        }
        echo $status;
    }
    
    function removeAccount() {
        $this->load->model('retrievedata_model');
        $this->retrievedata_model->deActivate();
        $this->destroySession();
    }
}