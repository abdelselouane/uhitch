<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registeruser_model extends User_Model {
    public $db;
    public $year;
    public $make;
    public $model;
    public $color;
    public $address;
    public $addressExtra;
    public $city;
    public $state;
    public $zip;
    public $phone;
    public $location;
    public $user;
    public $userID;
    public $vehicleID;
            
    function __construct() {
        parent::__construct();
        
        $this->db = new database;
        $this->user = $this->findUser();
        $this->userID = $this->findUserID();
        $this->vehicleID = md5($this->userID);
    }
    
    function capturePersonalData() {
        // Personal Data
        $this->address        = $this->input->post('address');
        $this->addressExtra   = $this->input->post('apt');
        $this->city           = ucfirst($this->input->post('city'));
        $this->state          = strtoupper($this->input->post('state'));
        $this->zip            = $this->input->post('zip');
        $this->phone          = $this->input->post('phone');
    
        $place = $this->address.' '.$this->addressExtra;
        $this->location = isset($this->addressExtra) ? $place : $this->address;
    }
    
    function captureVehicleData() {
        //Vehicle Info
        $this->year   = $this->input->post('vehicle_year');
        $this->make   = $this->input->post('vehicle_make');
        $this->model  = $this->input->post('vehicle_model');
        $this->color  = $this->input->post('vehicle_color');
    }
            
    function registerUserInfo() {
        
        //echo '<pre>'; print_r($this->input->post()); echo '</pre>'; exit;
        
        $this->capturePersonalData();
        $this->captureVehicleData();
        
        $this->updatePersonalInfo(); 
        $this->upsertVehicleInfo();
    }
    
    function updatePersonalInfo() {
        $query = "UPDATE user "
                . "SET "
                . "Phone_Number='$this->phone', "
                . "Address='$this->location', "
                . "City='$this->city', "
                . "CurrentCity='$this->city', "
                . "CurrentState='$this->state', "
                . "State='$this->state', "
                . "Zip_Code='$this->zip' "
                . "WHERE Email_Address='$this->user' ";
 
        $this->db->execute($query);
        $this->setUserLocation($this->city, $this->state);
    }
    
    function upsertVehicleInfo() {
        $exist = $this->db->vehicleExist($this->vehicleID);
        
        // If Vehicle Exist
        if($exist) 
            { $this->updateVehicleInfo($this->vehicleID); } 
        else 
            { $this->insertVehicleInfo(); }
            
        $this->session->set_userdata('car','yes');
    }
    
    function updateVehicleInfo($id) {
        $query = "UPDATE vehicle SET "
                . "Model='$this->model', "
                . "Year='$this->year', "
                . "Color='$this->color', "
                . "Make='$this->make' "
                . "WHERE VehicleId='$id'";
        
        $this->db->execute($query);
    }
            
    function insertVehicleInfo() {
        $name = $this->getFullName();

        $query = "INSERT INTO vehicle (DriverId, OwnerName, Model, Year, Color, Make, VehicleId) "
                . "VALUES('$this->userID', '$name', '$this->model', "
                . "'$this->year', '$this->color', '$this->make', '$this->vehicleID')";
        
        $this->db->execute($query);
    }
    
    function registerSchoolInfo() {
        $major      = $this->input->post('major');
        $class      = $this->input->post('classification');
        $living     = $this->input->post('living');
        $activity   = $this->input->post('activities');
        $sports     = $this->input->post('sports');
        $greek      = $this->input->post('greek');
        $music      = $this->input->post('music');
        $organizations = $this->input->post('student_org');
        
        if($activity === FALSE) { $activities = ''; }
        else { $activities = implode('-', $activity); }
        
        if($sports === FALSE) { $sports = ''; }
        else { $sports = implode('-', $sports); }
        
        if($music === FALSE) { $music = ''; }
        else { $music = implode('-', $music); }
        
        $query = "UPDATE user "
                . "SET Major='$major', "
                . "Classification='$class', "
                . "Living='$living',"
                . "Activities='$activities', "
                . "Sports='$sports', "
                . "Music='$music',"
                . "Organizations='$organizations', "
                . "Greek='$greek' "
                . "WHERE Email_Address='$this->user'";
        
        $this->db->execute($query);
    }  

    function uploadphotos($path) {
        $query = "UPDATE user "
                . "SET Photo='$path', "
                . "Account_Status='1' "
                . "WHERE Email_Address = '$this->user'";
        
        $this->db->execute($query);
        
        $this->setUserPhoto($path);
        $this->updateAccountStatus();
    }
}