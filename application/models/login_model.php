<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require(base_url('application/core/Database.php'));

class Login_model extends User_Model {
    public $db;
    public $email;
    public $password;
    public $remember;
    public $data;
    public $currentTime;
    public $query;
            
    function __construct() {
        parent::__construct(); 
        
        $this->db = new database;
        $this->currentTime = date('Y-m-d H:i:s');
    }
                       
    function log_in() {
        $this->email    = $this->input->post('login_userName');
        $this->password = $this->input->post('login_password');
        $this->remember = $this->input->post('remember');
        
        if(!$this->verifyInfo($this->email, $this->password)) 
            { return FALSE; } 
         
        $this->executeLogin();
        
        if(!isset($this->data)) {
            return FALSE;
        }
        
        return $this->attemptLogin($this->data);
    }
        
        
    
    function executeLogin() {       
        $this->query = "SELECT Salt, Hashed_Password, UserID, First_Name, "
                    . "Last_Name, School_Name, Month, Day, Year, Account_Status, "
                    . "Driver, LastLogin, AccountCreated, Photo, City, State, "
                    . "CurrentCity, CurrentState "
                    . "FROM user "
                    . "WHERE Email_Address = '$this->email' AND Active = '1'";

        $this->data = $this->db->retrieveData($this->query);
    }
    
    function log_in_cookie($user_email, $user_password) {
        $start = microtime();
        $this->executeLogin($user_email, $user_password);
        $end = microtime();
        
        $duration = $start - $end;
        $this->db_logs($duration);
        $this->attemptLogin($this->data);
    }
    
    private function db_logs($duration) {
        $internal = "Insert INTO internal (User,File,Method,Query,Duration) "
                   ."VALUES ('$this->email','login_model.php','log_in_cookie','$this->query',$duration)";
    
        $this->db->execute($internal);
    }
    
    function attemptLogin($result) {
        $salt = $result['Salt'];

        $temp = hash("sha512", $this->password.$salt);
        $hash = substr($temp, 0, 50);
        
        
        if($hash === $result['Hashed_Password']) { 
            $date = $result['Month'].'-'.$result['Day'].'-'.$result['Year'];
            
            $this->updateLogIn();
            $this->checkRememberValid($hash);
            
            $age = $this->calculateAge($date);

            $this->createSession(
                                $result['UserID'],          // User's Id
                                $result['First_Name'],      // First Name
                                $result['Last_Name'],       // Last Name
                                $result['School_Name'],     // School
                                $this->email,               // Email Address
                                $age,                       // Date of Birth
                                $result['Account_Status'],  // Account Status
                                $result['Driver'],          // Drive?
                                $this->currentTime,         // Last Login
                                $result['AccountCreated'],  // Account Creation Date
                                $result['Photo']);          // Url Thumbnail
        
            $city  = isset($result['CurrentCity'])  ? $result['CurrentCity']    : $result['City'];
            $state = isset($result['CurrentState']) ? $result['CurrentState']   : $result['State'];
            
            $this->setUserLocation($city, $state);
            
            return TRUE;
        }   
        
        return FALSE; 
    }
    
    function updateLogIn() {
        $update = "UPDATE user SET "
                . "LastLogin='$this->currentTime' "
                . "WHERE Email_Address = '$this->email'";
        
        $this->db->execute($update);
    }   

    function checkRememberValid($hash) {
        if($this->remember === '1') 
            { $this->startCookie($this->email, $hash); } 
    }
    
    function verifyInfo($email, $password) {
        if(!$email || !$password) {
             return FALSE;
        }
        
        return TRUE;
    }
    
} 
