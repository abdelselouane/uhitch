<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends My_BaseController {
    protected $result; 
    public $temp;
    public $signupError;
            
    function __construct() {
        parent::__construct();

        $this->validateUser();
    }
    
    /** Landing page for New Users */
    function index() { 
        $this->title = 'Welcome to Uhitch | Find & Share Rides';
        $this->load->view('welcome/splash');
    }
            
    /** Sign Up Page for New Users*/
    function join() {
        $this->title = 'Uhitch | Sign Up';
        $this->setScripts('signup');
        $this->display('home', 'signIn');
    }
    
    /** When called, intiates the SignUp Model and calls function*/
    function signUpUser() {
        $this->load->model('signup_model');

        $data = $this->signup_model->sign_up();
        $this->attemptSignUp($data);    
    }
    
    /**
     * Captures the Validation Sucess or Errors and 
     * response based on the validation
     * @param type $valid
     */
    function attemptSignUp($valid) {
        switch ($valid) {
            // Success
            case 0:
                redirect('/register');
                break;
            case 1: 
                $this->signupError = TRUE;
                $this->signUpError();
                redirect('/welcome/login?q=userexistence');
                break;
            case 2:
                $this->error = TRUE;
                redirect('/welcome/join');
                break;
        }
    }

    /** Displays the Log In Page */
    function login() {
        $this->title = 'Uhitch | Log In';
        $this->setScripts('login');
        $this->error = FALSE;
        
        if( isset($_GET['error']) ) {
            $this->error = TRUE;
            $this->logInError();
        } 
        
        if( isset($_GET['q']) ) {
            $this->error = TRUE;
            $this->signupError();
        }
        
        $this->display('login', 'logIn');
    }
           
    /** 
     * Attempts to Log In, depending on the result, the 
     * user is redirected to another page
     */
    function logInAttempt() {
        $this->load->model('login_model');
        $this->error = FALSE;
        
        $this->result = $this->login_model->log_in();

        if( !$this->result ) {
            $this->error = TRUE;
            redirect('welcome/login?error=TRUE');
        }

        redirect('main');
    }
    
    function signUpError() {
        $this->msg = 'You have Already Signed Up for Please '
                . 'Login or click the Forgot your Password Link';
    }

    // Handles the Log In Error Message 
    function logInError() {       
        $this->msg = 'The Password does not Match the'
                . ' User account or the Account does not exist.'
                . ' Verify both the Email and Password';
    }
    
    /** Displays the Forgot Password page*/
    function forgotPassword() {
        $this->title = "Uhitch | Forgot Your Password?";
        $this->setScripts('forgot');
        $this->display('forgot_password', 'signup');  
    }
    
    function sendResetPassword() {
        $valid = FALSE;
        
        $email = isset($_POST['email']) ? $_POST['email'] : NULL;
        
        if(!is_null($email)) {
            $this->load->model('retrievedata_model');  
            $valid = $this->retrievedata_model->emailExistWithAccount($email);
        } 
        
        // Email Found & Send New Password
        if($valid) {
            $this->load->model('forgot_password');
            $this->forgot_password->sendUserResetPassword($email);
            echo 200;
        } 
        // Email Not Found in Database
        else { echo 404; }
    }
    
    function retrievepassword() {
        $link = isset($_GET['q']) ? $_GET['q'] : NULL;
        
        if( isset($link) ) {
            $this->load->model('forgot_password');
            $result = $this->forgot_password->retrievePasswordLink($link);
        
            if($result) {
                $this->createnew($result);
            } else {
                // Error Message
                echo 'token already used';
            }
        } 
        
        else {
            show_404();
        }
    }
            
    function createnew($email = NULL) {
        if(is_null($email)) {
            show_404();
        }
        $this->temp = $email;
        $this->setScripts('new');
        $this->title = 'Uhitch | Change Your Password';
        $this->display('createnew_password');
    }
    
    function changepassword() {
       $this->load->model('forgot_password');
       $result = $this->forgot_password->updatePassword($this->temp);
        
        // Return True or False
        if($result) {
            $this->display('password/success', 'signIn2');
        }
        
        else {
            $this->error = TRUE;
            $this->logInError('password');
            $this->display('createnew_password');
        }
    }
    
    function validateUser() {
        $this->checkIfLoggedIn();
        
        if($this->cookieExist()) {
            $this->load->model('login_model');
            
            $cookie = $this->retrieveCookie();
            
            $this->login_model->log_in_cookie($cookie[0], $cookie[1]);
            redirect('/main');
        }
    }
    
    private function display($view, $header = 'normal') {  
        $this->view('welcome/', $view, $header);
    }
    
}