<?php

class CheckRides extends User_Model {
    public $db;
    
    function __construct() {
        parent::__construct();  
        $this->db = new database;
    }

    function find_completed_rides(){
        
        $time = date('Y-m-d H:i:s');
        
        //find rides that have not been processed
        
        $query = "SELECT PickUp_Location, PickUp_Time, Destination_Location, Passenger_IDs FROM ride WHERE PickUp_Time < '$time' AND Notified = '0' ";        
        
        $result = $this->db->retreiveRows($query);
        
        if(!empty($result)){
        
            $pickup = $result['PickUp_Location'];
            $pickuptime = $result['PickUp_Time'];
            $destination = $result['Destination_Location'];
            $passengers = $result['Passenger_IDs'];
            
            //parse passengers
            $parsed_passengers = explode(",", $passengers);
            
        foreach($parsed_passengers as $person) {
        
         //find that user's email address
           
         //create temp record in ratings database   
            
         //send email to a ratings page with link
            
         //
            
            
            
        }
        
        }
        
        
    }
    

}
?>
