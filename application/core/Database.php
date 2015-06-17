<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends CI_Model{
    private $connect;
    protected $cacheAvailable;
            
    /**
     * The Database connection is established, if the 
     * connection is invalid the connection is closed
     */
    function connect() {
        /*$this->connect = new mysqli("localhost", "",
                "", "uhitch");*/
        $this->connect = new mysqli("localhost", "uhitch",
                "uhitch123", "uhitch");   
        
        if($this->connect->connect_errno) {
            $this->closeconnection();
        }
    }   
    
    /**
     * Executes the Standard SQL query 
     * @param type $query Query
     */
    function execute($query) {
        $this->connect();
        if(!$this->connect->query($query)) {
            echo $this->connect->error;   
            $this->closeconnection();
            exit;
        }
        $this->closeconnection();
    }
    
    function retrieveData($query) {
        $this->connect();
        $data = $this->connect->query($query);
        
        if(!$data) {
            echo $this->connect->error;
            $this->closeconnection();
            exit;
        }
        
        $select = $data->fetch_assoc();
        $this->closeconnection();

        return $select;
    }
    
    function retrieveArray($query) {
        $this->connect();
        $result = $this->connect->query($query);
        $this->closeconnection();
        
        return $result->fetch_array();
    }
    
    function closeconnection() {
        $this->connect->close();
    }
    
    function retrieveRows($query) {
        $this->connect();
        $resultArray = array();
        
        $data = $this->connect->query($query);
        
        if(!empty($data)) {
            while($row = $data->fetch_assoc()) {
                $resultArray[] = $row;
            }
        } 
        $this->closeconnection();
        
        return $resultArray;
    }
    
    function retrievalError() {
        
    }
    
    function userExist($email) {
        $this->connect();
        $query = "SELECT * FROM user WHERE Email_Address = '$email' LIMIT 1";
        
        $result = $this->connect->query($query);
        $this->closeconnection();
        
        return mysqli_num_rows($result) > 0 ? TRUE : FALSE;
    }
    
    function runQuery($query) {
        $this->connect->query($query);    
    }
    
    function selectQuery($query) {
        $result = $this->connect->query($query);
        
        return $result->fetch_array();
    }
            
    function connectionError() {
        echo "Failed To Connect to Database (" . 
        $this->connect->connect_errno . ") " . 
        $this->connect->connect_error;
    }
    
    function searchByLocation($lat, $lon) {
        $query = $this->searchByLocation($lat, $lon);
        $this->connect();
        
        $data = $this->db->retreiveRows($query);
        $this->closeconnection();
        
        return $data;
    }
    
    function searchQueryByRadius($lat, $lon) {
        
        
        
        return $query;
    }
    
    function vehicleExist($id) {
        $this->connect();
        
        $query = "SELECT id "
                . "FROM vehicle "
                . "WHERE VehicleId='$id'";
        
        $result = $this->connect->query($query);
          
        $this->closeconnection();
        
        return mysqli_num_rows($result) > 0;
    }
}

