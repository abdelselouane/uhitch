<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class postride_model extends User_Model {
    public $db;
    public $userId;
    public $rideId;
    
    public $destination;
    public $notes;
    public $price;
    public $passengers;
    public $mileage;
    
    public $date;
    public $time;
    public $vehicleId;
    public $driver;
    
    public $departure;
    public $departShort;
    public $departLat;
    public $departLon;
    
    public $arrival;
    public $arrivalShort;
    public $arriveLat;
    public $arriveLon;
            
    function __construct() {
        parent::__construct();  
        $this->db = new database;
        $this->userId = $this->findUserID();
        $this->driver = $this->getFullName();
    }
    
    function post_ride() {
//        if( !$this->validDriver() )
//            { return FALSE; }
        $post = $this->input->post();
       // echo '<pre>'; print_r($post); echo '</pre>'; exit;
        
        $this->rideInformation();
        $this->rideSettings();
        $this->rideLocation();
        $this->generateRideId();

        $status = $this->insertRides();
        
        return $status;
    }
    
    protected function rideInformation() {
        $this->destination  =   $this->input->post('destination');
        $this->notes        =   $this->input->post('ridenotes');
        $this->passengers   =   $this->input->post('passengers');
        $this->price        =   str_replace('$', '', $this->input->post('price'));
        $this->mileage      =   $this->input->post('mileage');
        $this->distance     =   $this->input->post('mileage');
    }
    
    protected function rideSettings() {
        $this->date         =   date('Y-m-d', strtotime($this->input->post('date')));
        $this->time         =   $this->input->post('time');
        $this->vehicleId    =   $this->retrieveVehicleId();
    }
    
    protected function rideLocation() {
        $this->departure    =   $this->input->post('departure');
        $this->departShort  =   $this->input->post('departShort');
        
        $this->arrival      =   $this->input->post('arrival');
        $this->arrivalShort =   $this->input->post('arriveShort');

        $this->departLat    =   $this->input->post('departLat');
        $this->departLon    =   $this->input->post('departLon');
        
        $this->arriveLat    =   $this->input->post('arriveLat');
        $this->arriveLon    =   $this->input->post('arriveLon');
    }
    
    //Need to generate Ride Id
    // Server Side Validation 
    public function insertRides() {
        $query = "INSERT INTO ride (Name, Departs, Lat_Dep, Lon_Dep, Arrival, "
                        . "Lat_Arr, Lon_Arr, Distance, Driver_ID, Notes, "
                        . "Passengers, Price, Vehicle_ID, DepartTime, "
                        . "Driver_Name, Ride_ID, DepartDate, DepartShort, "
                        . "ArriveShort) "
                . "VALUES('$this->destination', '$this->departure', "
                        . "'$this->departLat', '$this->departLon', "
                        . "'$this->arrival', '$this->arriveLat', "
                        . "'$this->arriveLon', '$this->mileage', "
                        . "'$this->userId', '$this->notes', "
                        . "'$this->passengers', '$this->price', "
                        . "'$this->vehicleId', '$this->time', "
                        . "'$this->driver', '$this->rideId', '$this->date', "
                        . "'$this->departShort', '$this->arrivalShort' "
                . ")";
    
        $this->db->execute($query);
        return TRUE;
    }

    function retrieveLocation($location) {
        $temp = str_replace(",", "", $location);
        
        $place = str_replace(" ", '+', 
                urlencode($temp));
        
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$place."&sensor=false";
        
        return $this->retrieveLatLng($url);
    }
   
    function retrieveLatLng($url) {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $response = json_decode(curl_exec($curl), true);
        $geometry = $response['results'][0]['geometry'];
        
        $longitude = $geometry['location']['lng'];
        $latitude = $geometry['location']['lat'];
        
        return array($latitude, $longitude);
    }
    
    function validDriver() {
        $valid = $this->isUserDriver();
        
        if(!$valid) { return FALSE; }      
    }
    
    function retrieveVehicleId() {
        $find = "SELECT VehicleId "
                . "FROM vehicle "
                . "WHERE DriverId = '$this->userId'";
        
        $data = $this->db->retrieveData($find);

        return $data["VehicleId"];  
    }
    
    function generateRideId() {
        $this->rideId = substr(str_shuffle(MD5(microtime().$this->userId)), 0, 45);
    }
}
