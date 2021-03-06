<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class retrievedata_model extends User_Model {
    public $db;
    protected $userid;
    protected $vehicleid;
    protected $school;
    private $coords;
    protected $date;
            
    function __construct() {
        parent::__construct();
        $this->db = new database;
        $this->date = date('Y-m-d H:i:s');
        $this->userid = $this->findUserID();
    }
     
     /**
      * Retrieves the School's Coordinates, applies them
      * to the query, to search based on certain radius 
      * from the school
      */
    function applyRideTicker() {
        $this->school = $this->findUserSchool();
        
       
        
        if(!isset($this->coords)) {
            $this->coords = $this->getSchooLatLng();

            if(!$this->coords[0] || !$this->coords[1]) {
                $this->retrieveSchoolInfo();
                $this->coords = $this->getSchooLatLng();
            }
        } 
        
         //echo '<pre>'; print_r($this->getRidesNearby($this->coords[0], $this->coords[1], 100, 50)); echo '</pre>'; exit;
        return $this->rideTickerQuery();
       //return  $this->getRidesNearby($this->coords[0], $this->coords[1], 100, 50);
    }
    
    function retrieveSchoolInfo() {
        $query = "SELECT Latitude, Longitude "
                . "FROM school "
                . "WHERE Name='$this->school' "
                . "LIMIT 1";
        
        $coord = $this->db->retrieveData($query);

        if(isset($coord)) {
            $lat = $coord['Latitude'];
            $lon = $coord['Longitude'];

            $this->setSchooLatLng($lat, $lon);
        }
    }
     
    function rideTickerQuery($radius = 50) {
        //$query = $this->searchRideByRadiusQuery($this->coords, $radius, 5);
        $query = $this->getRidesNearby($this->coords[0], $this->coords[1], 100, 50);

        return $this->db->retrieveRows($query);
    }
    
    function returnRides($lat, $lon, $radius = 50, $limit = 100) {
        $coord = array($lat, $lon);
        
        $query = $this->searchRideByRadiusQuery($coord, $radius, $limit);
        
        return $this->db->retrieveRows($query);
    }
     
     /**
      * Retreieve's school's coordinates
      * @return Coordinates
      */
     function getSchoolCoords() {
         $this->coords = $this->getSchooLatLng();
         return $this->coords;
     }
             
     function retrieveProfile() {
         $userEmail = $this->findUser();
         
         $query = "SELECT Rider_Count, Rider_Rating, Driver_Count, Major, "
                 . "Classification, Living, Major, Sports, Music, Organizations, Driver_Rating, "
                 . "Greek, UserID, Email_Address, Activities "
                 . "FROM user "
                 . "WHERE Email_Address='$userEmail'";
         
         $userdata = $this->db->retrieveData($query);
         
         $this->userid = $userdata['UserID'];
         
         return $userdata;
     }
     
     function retrieveVehicle() {
         
         $query = "SELECT VehicleId, Make, Model, Year, Color "
                 . "FROM vehicle "
                 . "WHERE DriverId = '$this->userid'";
         
         $vehicledata = $this->db->retrieveData($query);
         $this->vehicleid = $vehicledata['VehicleId'];

         return $vehicledata;
     }
     
     function retrieveRides($limit = 12, $id = NULL) {
        if(!isset($id)) {
            $id = $this->userid;
        }
        $query = "SELECT Name, Departs, Arrival, DepartShort, "
                ."Driver_Name, DepartTime, ArriveShort, Price, "
                ."Driver_ID, Ride_ID, DepartDate, Passengers "
                ."FROM ride "
                ."WHERE "
                    ."Driver_ID='$id' OR "
                    ."Passenger1_ID='$id' OR "
                    ."Passenger2_ID='$id' OR "
                    ."Passenger3_ID='$id' OR "
                    ."Passenger4_ID='$id' OR "
                    ."Passenger5_ID='$id' "
                ."LIMIT $limit ";
                     
         $result = $this->db->retrieveRows($query);

         return $result;
     }
     
     function emailExistWithAccount($email) {
         return $this->db->userExist($email);
     }
     
     function retrieveAdditionalData() {
         $query =  "SELECT *"
                 /*. "u.Middle_Name, u.Phone_Number, u.Address, "
                 . "u.City, u.State, u.Zip_Code, u.Bio, u.Major, "
                 . "u.Classification, u.Greek, u.Living, u.Activities, "
                 . "u.Sports, u.Organizations, u.Music, u.Driver, "
                 . "v.Make, v.Model, v.Year, v.Color "*/
                 . "FROM user as u "
                 . "JOIN vehicle as v "
                 . "ON u.UserID=v.DriverId "
                 . "WHERE u.UserID='$this->userid' ";
         
         return $this->db->retrieveData($query);
     }
             
     function changePersonalData() {
        $fname = $this->input->post('fname');
        $mname = $this->input->post('mname');
        $lname = $this->input->post('lname');
        $gender = $this->input->post('gender');
        $phone = $this->input->post('phone');
        $address  = $this->input->post('address');
        $address2 = $this->input->post('address2');
        $city  = $this->input->post('city');
        $state = $this->input->post('state');
        $zipcode = $this->input->post('zipcode');

        $fullname = $fname.' '.$lname;
        
        $location = isset($address2) ? $address.' '.$address2 : $address;

        $query = "UPDATE `user` SET "
                    ."Full_Name='$fullname', "
                    ."First_Name='$fname', "
                    ."Middle_Name='$mname', "
                    ."Last_Name='$lname', "
                    ."Gender='$gender', "
                    ."Phone_Number='$phone', "
                    ."Address='$location', "
                    ."City='$city', "
                    ."State='$state', "
                    ."Zip_Code='$zipcode' "
                ."WHERE UserID='$this->userid' ";
        
        $this->db->execute($query);
        
        session_start();
        $_SESSION['First_Name'] == $fname;
        $_SESSION['Last_Name'] == $lname;
        
        redirect('main');
        
        return TRUE;
     }
     
     function changeVehicleData() {
         
         // echo '<pre>'; print_r($this->input->post()); echo '</pre>'; exit;
        $year  = $this->input->post('year');
        $make  = $this->input->post('make');
        $model = $this->input->post('model');
        $color = $this->input->post('color');
         
        $query = "UPDATE `vehicle` SET "
                    . "Model='$model', "
                    . "Year='$year', "
                    . "Color='$color', "
                    . "Make='$make' "
                . "WHERE DriverId='$this->userid'";
        
        $this->db->execute($query);
        
        return TRUE;
     }
     
     function changeSchoolData() {
         
        // echo '<pre>'; print_r($this->input->post()); echo '</pre>'; exit;
         
         $school = $this->input->post('school');
         $class = $this->input->post('classification');
         $major = $this->input->post('major');
         $greek = $this->input->post('greek');
         
         $query = "UPDATE `user` SET "
                    . "School_Name='$school', "
                    . "Classification='$class', "
                    . "Major='$major', "
                    . "Greek='$greek' "
                . "WHERE UserID='$this->userid'";
        
        $this->db->execute($query);
        
        return TRUE;
     }
    
    function retrieveAllEvents() {
         $query =  "SELECT * FROM `events` WHERE `Reviewed` = 1 AND `EventDate` >= '".date('Y-m-d')."' ";
         //echo $query; exit;
         //echo '<pre>'; print_r($this->db->retrieveData($query)); echo '</pre>';exit;
         return $this->db->retrieveRows($query);
     }
     
     function retrieveEventInformation($id) {
         $query =  "SELECT "
                    . "e.Name, e.Location, e.City, e.State, e.Zip, "
                    . "e.Lat, e.Lon, e.Photo, e.Photo1, e.Photo2, e.Photo3, e.Photo4, e.Video, e.Video1, e.Video2,e.Website, e.Facebook, e.Twitter, e.Instagram, e.Googleplus, e.Pinterest, e.Description, "
                    . "e.Comments, e.EventDate, "
                    . "e.EventTime, e.Plan, e.CreatedByName, e.CreatedById, e.EventId, u.Photo as UserPhoto, "
                    . "r.Ride_ID as RideId "
                 . "FROM events e "
                 . "INNER JOIN user u "
                 . "ON e.CreatedById = u.UserID "
                 . "LEFT JOIN ride r "
                 . "ON e.EventId = r.Event_ID "
                 . "WHERE e.EventId = '$id' ";
         
         return $this->db->retrieveData($query);
     }
    
    function getEventById($id) {
         $query =  "SELECT "
                    . "e.Name, e.Location, e.City, e.State, e.Zip, "
                    . "e.Lat, e.Lon, e.Photo, e.Photo1, e.Photo2, e.Photo3, e.Photo4, e.Video, e.Video1, e.Video2, e.Website, e.Facebook, e.Twitter, e.Instagram, e.Googleplus, e.Pinterest, e.Description, "
                    . "e.Comments, e.EventDate, e.Reviewed, "
                    . "e.EventTime, e.Plan, e.EventId, e.CreatedByName as UserName, e.CreatedById as UserId, u.Photo as UserPhoto, "
                    . "r.Ride_ID as RideId "
                 . "FROM events e "
                 . "INNER JOIN user u "
                 . "ON e.CreatedById = u.UserID "
                 . "LEFT JOIN ride r "
                 . "ON e.EventId = r.Event_ID "
                 . "WHERE e.EventId = '$id' ";
         
         //echo $query; 
         //exit;
         
         return $this->db->retrieveData($query);
     }
    
    function getAllEventsByUserId($id){
        $query =  "SELECT "
                    . "e.Name, e.Location, e.City, e.State, e.Zip, "
                    . "e.Lat, e.Lon, e.Comments, e.Photo, e.Photo1, e.Photo2, e.Photo3, e.Photo4, e.Video, e.Video1, e.Video2, e.Website, e.Facebook, e.Twitter, e.Instagram, e.Googleplus, e.Pinterest, e.Description, e.EventDate, "
                    . "e.EventTime, e.Plan, e.CreatedByName, e.CreatedById, e.EventId, e.Reviewed, "
                    . "r.Ride_ID as RideId "
                 . "FROM events e "
                 . "INNER JOIN user u "
                 . "ON e.CreatedById = u.UserID "
                 . "LEFT JOIN ride r "
                 . "ON e.EventId = r.Event_ID "
                 . "WHERE u.UserID = '$id' GROUP BY EventId";
        
       // echo $query; exit;
         
         return $this->db->retrieveRows($query);
    }
    
    public function archiveevent($id){
        $query =  "UPDATE `events` SET `Reviewed`= 2 WHERE EventId = '".$id."' ";
        //echo $query; exit;
        $this->db->execute($query);
    }
    
    function revertevent($id){
         $query =  "UPDATE `events` SET `Reviewed`= 1 WHERE EventId = '".$id."' ";
         //echo $query; exit;
         $this->db->execute($query);
    }
    
    function trashevent($id){
         $query =  "DELETE FROM `events` WHERE id = ".$id." ";
         //echo $query; exit;
         $this->db->execute($query);
    }
    
    function getRidesByEventId($id){
         $query =  "SELECT * FROM ride WHERE Event_ID='$id' ";
        // echo $query; exit;
         return $this->db->retrieveRows($query);
    }
    
    function getAllRidesByUserId($id){
        
        $query =  "SELECT * FROM ride WHERE Driver_ID='$id' ";
        // echo $query; exit;
         return $this->db->retrieveRows($query);
    
    }
    
    function getAllTripsByUserId($id){
         $query =  "SELECT * FROM ride WHERE Passenger1_ID='$id' OR Passenger2_ID='$id' OR Passenger3_ID='$id' OR Passenger4_ID='$id' OR Passenger5_ID='$id'";
         //echo $query; exit;
        return $this->db->retrieveRows($query);
    }
    
    function getRideById($id){
        $query =  "SELECT * FROM ride WHERE id=".$id;
        // echo $query; exit;
        return $this->db->retrieveData($query);
    }
     
     function retrieveRideInformation($id) {
         $query =  "SELECT "
                    . "r.Ride_ID, r.Name, r.Departs, r.DepartShort, r.Lat_Dep, "
                    . "r.Lon_Dep, r.DepartTime, r.DepartDate, r.Arrival, r.ArriveShort, "
                    . "r.Lat_Arr, r.Lon_Arr, r.Distance, r.Driver_Name, "
                    . "r.Passengers, r.Driver_ID, r.Price, r.Ride_Cost, r.Charge, r.Notes, "
                    . "r.Passenger1_ID, r.Passenger2_ID, r.Passenger3_ID, r.Passenger4_ID, r.Passenger5_ID, r.Event_ID, r.Notes,"
                    . "u.Full_Name, u.Email_Address, u.School_Name, "
                    . "u.Driver_Count, u.Driver_Rating, u.Photo, "
                    . "d.Make, d.Model, d.Year, d.Color "
                 . "FROM ride as r "
                 . "JOIN user as u "
                    . "ON r.Driver_ID=u.UserID "
                 . "JOIN vehicle as d "
                    . "ON r.Driver_ID=d.DriverId "
                 . "WHERE r.Ride_ID='$id' ";
         
         return $this->db->retrieveData($query);
     }
     
     function retrieveUserInfo($id) {
         $query = "SELECT "
                    . "Full_Name, Classification, Major, "
                    . "Greek, Music, Activities, Organizations, "
                    . "LastLogin, AccountCreated, Photo, Bio, "
                    . "School_Name, City, State "
                 . "FROM user " 
                 . "WHERE UserID='$id' AND Active='1'";
         
         return $this->db->retrieveData($query);
     }
     
     function deActivate() {
         $query = "UPDATE `user` SET "
                    . "Active='0' "
                 . "WHERE UserID='$this->userid' ";
         
         //echo $query;exit;
         $this->db->execute($query);
     }
}
