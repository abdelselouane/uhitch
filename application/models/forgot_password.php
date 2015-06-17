<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_password extends User_Model {
    public $db;
    public $password;
    public $confirm;
    public $salt;
    public $hash;
            
    function __construct() {
        parent::__construct();
        
        $this->db = new database;
    }

    function sendUserResetPassword($email) {
        $pwdLink = $this->createPasswordLink($email);

        // Send Email
    }
    
    function createPasswordLink($email) {
        $link = substr(str_shuffle(MD5(microtime())), 0, 30);
        $expire = mktime();

        $query = "INSERT INTO retrieval (UserEmail, Expiration, Value) "
                . "VALUES('$email', '$expire', '$link')";

        $this->db->execute($query);

        return $link;
    }

    function retrievePasswordLink($link) {
        $query = "SELECT Value, Expiration, UserEmail "
                ."FROM retrieval "
                ."WHERE Value = '$link' "
                ."LIMIT 1";

        $data = $this->db->retrieveData($query);

        if(is_null($data)) 
            { return FALSE; } 

        else {
             // Check whether EXPIRED 
             //$this->removePasswordKey($link);       
        }

        return $data['UserEmail'];
    }
     
    function updatePassword($email) {
        $this->retrieveData();
        
        $query = "UPDATE user SET "
                ."Salt='$this->salt' "
                ."Hashed_Password='$this->hash'"
                ."WHERE Email_Address='$email'";
        
        $this->db->execute($query);
    }
    
    function retrieveData() {
        $this->password = $this->input->post('password');
        $this->confirm  = $this->input->post('passWordConfirm');
    
        if( $this->pwdMatch() ) {
            $this->salt = substr(str_shuffle(MD5(microtime())), 0, 30);
            $this->hash = hash("sha512", $this->password.$salt);
        } 
        else {
            // Error
        }
    }
                 
    function removePasswordKey($value) {
        $query = "DELETE FROM retrieval "
                 ."WHERE Value = '$value' ";

        $this->db->execute($query);
    }
    
    function pwdMatch() {
        if(!$this->password || !$this->confirm) 
            { return FALSE; }
        
        if($this->password !== $this->confirm) 
            { return FALSE; }
            
        return TRUE;
    }
}