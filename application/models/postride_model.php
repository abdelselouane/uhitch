<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class postride_model extends User_Model {
    public $db;
    public $userId;
    public $rideId;
    
    public $destination;
    public $notes;
    public $price;
    public $rideCost;
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
        //echo '<pre>'; print_r($post); echo '</pre>'; exit;
        
        $this->rideInformation();
        $this->rideSettings();
        $this->rideLocation();
        $this->generateRideId();

        $status = $this->insertRides();
        
        return $status;
    }
    
    function updateRide() {
//        if( !$this->validDriver() )
//            { return FALSE; }
        $post = $this->input->post();
        //echo '<pre>'; print_r($post); echo '</pre>'; 
        
         $query = "UPDATE `ride` SET `Name`='".$post['destination']."',
                                `Departs`='".$post['departure']."',
                                `DepartShort`='".$post['departShort']."',
                                `Lat_Dep`='".$post['departLat']."',
                                `Lon_Dep`='".$post['departLon']."',
                                `DepartTime`='".$post['time']."',
                                `DepartDate`='".date('Y-m-d', strtotime($post['date']))."',
                                `Arrival`='".$post['arrival']."',
                                `ArriveShort`='".$post['arriveShort']."',
                                `Lat_Arr`='".$post['arriveLat']."',
                                `Lon_Arr`='".$post['arriveLon']."',
                                `Distance`='".$post['mileage']."',
                                `Notes`='".$post['ridenotes']."',
                                `Passengers`='".$post['passengers']."',
                                `Price`='".str_replace('$', '', $post['price'])."',
                                `Ride_Cost`='".str_replace('$', '', $post['ride_cost'])."',
                                `Charge`='".$post['charge']."',
                                `Event_ID`='".$post['event_id']."',
                                `Updated`='".date('Y-m-d H:i:s')."'
                                WHERE `Ride_ID`='".$post['ride_id']."'";
        //echo $query;exit;
        $this->db->execute($query);
        return TRUE;

    }
    
    protected function rideInformation() {
        $this->destination  =   $this->input->post('destination');
        $this->notes        =   $this->input->post('ridenotes');
        $this->passengers   =   $this->input->post('passengers');
        $this->price        =   str_replace('$', '', $this->input->post('price'));
        $this->rideCost     =   str_replace('$', '', $this->input->post('ride_cost'));
        $this->mileage      =   $this->input->post('mileage');
        $this->distance     =   $this->input->post('mileage');
        $this->charge       =   $this->input->post('charge');
        $this->eventid      =   $this->input->post('event_id');
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
                        . "Passengers, Price, Ride_Cost, Charge, Vehicle_ID, DepartTime, Event_ID,"
                        . "Driver_Name, Ride_ID, DepartDate, DepartShort, "
                        . "ArriveShort) "
                . "VALUES('$this->destination', '$this->departure', "
                        . "'$this->departLat', '$this->departLon', "
                        . "'$this->arrival', '$this->arriveLat', "
                        . "'$this->arriveLon', '$this->mileage', "
                        . "'$this->userId', '$this->notes', "
                        . "'$this->passengers', '$this->price', "
                        . "'$this->rideCost', "
                        . "'$this->charge', "
                        . "'$this->vehicleId', '$this->time', "
                        . "'$this->eventid', "
                        . "'$this->driver', '$this->rideId', '$this->date', "
                        . "'$this->departShort', '$this->arrivalShort' "
                . ")";
        //echo $query; exit;
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
