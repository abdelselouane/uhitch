<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search_model extends User_Model {
    public $db;
    protected $userid;
    protected $vehicleid;
    public $endpoint;
            
    function __construct() {
        parent::__construct();
        $this->db = new Database;
        $this->userName = $this->getFullName();
        $this->userId   = $this->findUserID();
    }
     
    function searchingCriteria($endpoint, $item) {
        if( empty($endpoint) || empty($item) ) {
            return FALSE;
        }
        
        switch ($endpoint) {
            case 'user':
            case 'users':
                return $this->countUsers($item);
            case 'event':
            case 'events':
                return $this->countEvents($item);
            case 'ride': 
            case 'rides':
                return $this->countRides($item);
            default:
                return FALSE;
        }
    }
    
    function retrieveResults($endpoint, $search, $limit, $start) {
        switch ($endpoint) {
            case 'user':
            case 'users':
                return $this->find_user($search, $limit, $start);
            case 'event':
            case 'events':
                return $this->find_event($search, $limit, $start);
            case 'ride': 
            case 'rides':
                return $this->find_rides($search, $limit, $start);
        }
    }
     
    function countUsers($user) {
        $query =  "SELECT COUNT(Active) ";
        $query .= $this->userQuery($user);

        $count = $this->db->retrieveArray($query);
        return (int)$count[0];
    }
    
    function countEvents($event) {
        $query =  "SELECT COUNT(Reviewed) ";
        $query .= $this->eventQuery($event);
        $count = $this->db->retrieveArray($query);
        
        return (int)$count[0];
    }
    
    function countRides($ride) {
        $coord = $this->getSchooLatLng();
       
        if(!$coord[0] || !$coord[1]) {
            $school = $this->session->userdata('school');
            $this->findSchool($school);
        }
        
        $query = "SELECT COUNT(Status) ";
        $query .= $this->rideQuery($ride);

        $count = $this->db->retrieveArray($query);
        return (int)$count[0];
    }
    
    function findSchool($school) {
        $query = $this->findSchoolQuery($school);
        
        $info = $this->db->retrieveData($query);
        
        if(isset($info)) {
            $this->setSchooLatLng($info['Latitude'], $info['Longitude']);
        } 
//        else {
//            $coord = $this->grabCoordinates($school);
//        }
    }
            
    function find_user($user, $limit, $start){
        $query = "SELECT Full_Name, Classification, School_Name, Photo, UserID ";
        $query .= $this->userQuery($user, $limit, $start);
        
        return $this->retrieveSearchResult($query, $limit, $start);
    }
    
    function find_event($event, $limit, $start) {
        $query = "SELECT Name, City, State, Photo, EventTime, EventDate, EventId ";
        $query .= $this->eventQuery($event, $limit, $start);

        return $this->retrieveSearchResult($query);
    } 
    
    function find_rides($ride, $limit, $start) {
        $query = "SELECT DepartShort, DepartTime, DepartDate, ArriveShort, Distance, Driver_Name, Passengers, "
                . "Price, Ride_ID, ";
        $query .= $this->rideQuery($ride, $limit, $start);
        
        return $this->retrieveSearchResult($query);
    }
     
    function userQuery($user, $limit = NULL, $start = NULL) {
        $searchitem = $this->applyMatchCriteria($user);
        
        $query = "FROM user "
                . "WHERE "
                . "Email_Address LIKE '%$searchitem%' OR "
                . "Full_Name LIKE '%$searchitem%' OR "
                . "First_Name LIKE '%$searchitem%' OR "
                . "Last_Name LIKE '%$searchitem%' OR "
                . "Middle_Name LIKE '%$searchitem%' AND "
                . "Active='1' AND "
                . "Admin='0' AND "
                . "Account_Status='1' ";
         
        if(isset($limit)) {
            $query .= "LIMIT $start, $limit";
        }
         
        return $query;
    }
    
    function eventQuery($event, $limit = NULL, $start = NULL) {
        $searchitem = $this->applyMatchCriteria($event);
        $today = date("Y-m-d");
        
        $query = "FROM events "
                ."WHERE "
                . "Reviewed='1' AND "
                . "EventDate >= '$today' AND "
                . "Name LIKE '%$searchitem%' ";
        
        if(isset($limit)) {
            $query .= "LIMIT $start, $limit";
        }
        
        return $query;
    }
    
    function rideQuery($ride, $limit = NULL, $start = NULL) {
        $coord = $this->getSchooLatLng();
        $searchitem = $this->applyMatchCriteria($ride);
        
        $query =  "";
        
        if(isset($limit) && isset($start)) {
            $query .= "(3959 * acos( cos( radians($coord[0]) ) "
                . "* cos( radians( Lat_Arr ) ) "
                . "* cos( radians( Lon_Arr ) "
                . "- radians( $coord[1] ) ) "
                . "+ sin( radians( $coord[0] ) ) "
                . "* sin( radians( Lat_Arr ) ) ) ) "
                . "AS distance ";
        }
        
        $query .= "FROM ride "
                . "WHERE "
                    . "Name LIKE '%$searchitem%' OR "
                    . "Departs LIKE '%$searchitem%' OR "
                    . "DepartShort LIKE '%$searchitem%' OR "
                    . "Arrival LIKE '%$searchitem%' OR "
                    . "ArriveShort LIKE '%$searchitem%' AND " 
                    . "Passengers > 0 ";
                
        if(isset($limit)) {
            $query .= "ORDER BY distance ";
            $query .= "LIMIT $start, $limit";
        }
        
        return $query;
    }
                
    function retrieveSearchResult($query) {
        $data = $this->db->retrieveRows($query);
       
        if(isset($data) && count($data) > 0 ) {
            return $data;
        }
    }
    
    function applyMatchCriteria($item, $strength = .3) {
        $inputlength = strlen($item);
        
        $match_strength = floor($inputlength * $strength);
        
        return substr(strtolower($item),0,($inputlength - $match_strength)); 
    }
}