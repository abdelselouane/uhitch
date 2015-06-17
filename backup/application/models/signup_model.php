<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class signup_model extends User_Model {
    public $db;
    public $fullname;
    public $firstName;
    public $lastName;
    public $email;
    public $password; 
    public $school;
    public $bmonth;
    public $bday; 
    public $byear;
    public $gender;
    public $vehicle; 
    public $userId;
    public $currentTimeStamp;
    public $photo;
    public $salt;
    public $hash; 
    public $age;

    // Constructor
    function __construct() {
        parent::__construct();
        $this->db = new database;
        $this->currentTimeStamp = date('Y-m-d H:i:s');
    }

    /** Maps the User's Data and Validates the Information*/
    function sign_up() {       
        $this->mapUserData();
        
        return $this->validateUser();
    }
    
    /**
     * Calls functions that require validation regarding Posted Data, 
     * finds whether Email has already been used and Executes the Insertion 
     * of New User 
     * @return int
     */
    function validateUser() { 
        // Form Input Invalid
        if(!$this->validateInput()) 
            { return 2; }

        // Email Already Exist 
        if($this->db->userExist($this->email)) 
            { return 1; } 
            
        // Signs Up User
        $this->userSettings();
        $this->executeInsertion();
        return 0;
    }
    
    /**
     * Server Side Validation
     * Stores the Posted Data into an array and verifies whether 
     * any values in the array are empty
     * @return Boolean Whether Input is valid
     */
    function validateInput() {
        $form = array($this->firstName, $this->lastName, $this->email,
            $this->school, $this->password, $this->bmonth,
            $this->bmonth, $this->bday, $this->byear,
            $this->gender, $this->vehicle);
        
        return $this->verifyFormData($form);
    }

    /** Creates the Salt, Hash, UserId & Calculates Age*/
    function userSettings() {
        $this->salt = substr(str_shuffle(MD5(microtime())), 0, 30);
        $this->hash = hash("sha512", $this->password.$this->salt); 
        $this->userId = md5($this->email);
        $this->age = $this->calculateAge($this->byear.'-'.$this->bmonth.'-'.$this->bday);
    }
    
    /** Executes Insetions Into the Database */
    private function executeInsertion() {
        $query = "INSERT INTO user (First_Name, Last_Name, Full_Name, School_Name, Month, Day, Year, Gender, Hashed_Password, Email_Address,"
                . "Salt, Driver, UserID, LastLogin) "
                . "VALUES('$this->firstName', '$this->lastName', '$this->fullname', '$this->school', '$this->bmonth', '$this->bday',"
                . "'$this->byear','$this->gender', '$this->hash', '$this->email', '$this->salt', "
                . "'$this->vehicle', '$this->userId', '$this->currentTimeStamp')"; 
    
        // Executes Query
        $this->db->execute($query);
        $this->validateSession();
        $this->sendEmailtoUser($this->email);
    }
    
    /**
     * Creates the User's information and adds their data to the
     * session
     */
    protected function validateSession() {
        $this->createSession($this->userId, 
                             $this->firstName, 
                             $this->lastName, 
                             $this->school, 
                             $this->email, 
                             $this->age, 
                             0, 
                             $this->vehicle, 
                             $this->currentTimeStamp,
                             $this->currentTimeStamp, 
                             $this->photo
        );
    }

    function sendEmailtoUser($email) {
        // Send Email
    }
    
    /** Maps the Posted Data with the Classes Variables */
    protected function mapUserData() {
        $this->firstName = ucfirst($this->input->post('firstName'));
        $this->lastName  = ucfirst($this->input->post('lastName'));
        $this->email     = $this->input->post('emailAdd');
        $this->school    = $this->input->post('schoolName');
        $this->password  = $this->input->post('passWord');
        $this->bmonth    = $this->input->post('bMonth');
        $this->bday      = $this->input->post('bDay');
        $this->byear     = $this->input->post('bYear');
        $this->gender    = $this->input->post('sex');
        $this->vehicle   = $this->input->post('car');
        $this->fullname  = $this->firstName." ".$this->lastName;
        $this->photo = "assets/photos/default.png";      
    }
}