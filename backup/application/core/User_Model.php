<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model {
    protected $code;
            
    function __construct() {
        parent::__construct();
        
        $this->load->library('session');
    }
    
    /** Verifies Whether the Email is Valid*/
    function verifyEmail($email) {
        $regex = "/([\w\-]+\@[\w\-]+\.[\w\-]+)/";
 
        if(!empty($email) || !preg_match($regex, $email)) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    function verifyFormData($array) {
        $valid = TRUE;
        foreach ($array as $value) {
            if( empty($value) ){
                $valid = FALSE;
                break;
            }
        } return $valid;
    }
    
    /** Calculates the Age of User*/
    function calculateAge($date) {    
        return floor((time() - strtotime($date))/31556926);
    }
      
    // Creates the Session
    function createSession($userid, $fname, $lname, $school, 
            $email, $age, $status, $vehicle, $login, $signUp,
            $photo) {
        $session = array (
                        'user'          => TRUE,
                        'session_id'    => uniqid(),
                        'firstname'     => $fname,
                        'lastname'      => $lname,
                        'school'        => $school,
                        'emailAddress'  => $email,
                        'age'           => $age,
                        'status'        => $status,
                        'userid'        => $userid,
                        'car'           => $vehicle,
                        'last_login'    => $login,
                        'member_since'  => $signUp,
                        'photo'         => $photo
                    );
        $this->session->set_userdata($session);
    }
    
    // Return User's Email from session
    function findUser() {
        return $this->session->userdata('emailAddress');
    }
    
    function findUserID() {
        return $this->session->userdata('userid');
    }
    
    function findUserSchool() {
        return $this->session->userdata('school');
    }
    
    function getFullName() {
        $fname = $this->session->userdata('firstname');
        $lname = $this->session->userdata('lastname');
        
        $fullName = $fname." ".$lname;
        
        return $fullName;
    }
    
    function isUserDriver() {
        $driver = $this->session->userdata('car');
        
        return $driver === 'yes';
    }
    
    // Enables Cookies
    function startCookie($email, $hash) {
        $expire = time()+60*60*24*30;
        
        $encryptedpw = $email."@".$hash;
        setcookie("uhitchcache", $encryptedpw,$expire);
    }
    
    function updateAccountStatus() {
        $this->session->set_userdata('status', 1);
    }
    
    function grabCoordinates($place) {
        $url = $this->prepareToGrabCoordinates($place);
        
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $response = json_decode(curl_exec($curl), true);
        $geometry = $response['results'][0]['geometry'];
        
        $longitude = $geometry['location']['lng'];
        $latitude = $geometry['location']['lat'];
        
        return array($latitude, $longitude);
    }
    
    function prepareToGrabCoordinates($location) {
        $temp = str_replace(",", "", $location);
        
        $place = str_replace(" ", '+', 
                urlencode($temp));
        
        return "http://maps.googleapis.com/maps/api/"
        . "geocode/json?address=".$place."&sensor=false";
    }
    
    function setUserLocation($city, $state) {
        $this->session->set_userdata('location', $city.', '.$state);
    }
    
    function setUserPhoto($imgUrl) {
        $this->session->set_userdata('photo', $imgUrl);
    }
    
    function setSchooLatLng($lat, $lon) {
        $this->session->set_userdata('school_lat', $lat);
        $this->session->set_userdata('school_lon', $lon);
    }
            
    function getSchooLatLng() {
        $coord = array();

        array_push($coord, 
                $this->session->userdata('school_lat'));
        array_push($coord, 
                $this->session->userdata('school_lon'));
    
        return $coord;
    }
    
    function findSchoolQuery($school) {
        $query = "SELECT Name, Latitude, Longitude "
                . "FROM school "
                . "WHERE Name='$school' "
                . "LIMIT 1";
        
        return $query; 
    }
    
    function searchEventByRadiusQuery($lat, $lon, $radius = 20, $review = 1) {
        $today = date("Y-m-d");
        
        $query = "SELECT "
                    . "Count(Reviewed), "
                    . "(3959 * acos( cos( radians($lat) ) * cos( radians( Lat ) ) "
                    . "* cos( radians( Lon ) - radians( $lon ) ) "
                    . "+ sin( radians( $lat ) ) * sin( radians( Lat ) ) ) ) "
                . "AS distance "
                . "FROM events "
                . "WHERE Reviewed='$review' AND EventDate < $today "
                . "HAVING distance < $radius ";
    
        return $query;
    }
    
    function searchRideByRadiusQuery($coords, $radius = 20, $limit = 100) {
        $today = date("Y-m-d");
        
        $query = "SELECT Name, DepartShort, Ride_ID, Price, Lat_Arr, Lon_Arr, "
                . "Passengers, ArriveShort, DepartDate, Driver_Name, Price, " 
                    . "(3959 * acos( cos( radians($coords[0]) ) * cos( radians( Lat_Arr ) ) "
                    . "* cos( radians( Lon_Arr ) - radians( $coords[1] ) ) "
                    . "+ sin( radians( $coords[0] ) ) * sin( radians( Lat_Arr ) ) ) ) "
                . "AS distance "
                . "FROM ride "
                . "WHERE DepartDate < $today "
                . "HAVING distance < $radius "
                . "ORDER BY distance "
                . "LIMIT $limit";
        
        return $query;
    }
}