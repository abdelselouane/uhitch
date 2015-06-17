<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_BaseController extends CI_Controller {
    protected $code;
    protected $user;
    public $msg;
    public $page;
    public $ride;
    public $scripts;
    public $error;
    public $map;
            
    function __construct() {
        parent::__construct();
        
        $this->load->library('session');
        $data = array();

        $this->error = FALSE;
        $this->title = 'Uhitch';
        $this->data  = NULL;
        $this->ticker = NULL;
        $this->user  = $this->session->userdata('user');
        $this->status = $this->session->userdata('status');
    }
    
    function checkIfLoggedIn() {
        if( $this->isloggedin() ) 
            { redirect('/main'); }
    }
    
    function cookieExist() {
        if(isset($_COOKIE["uhitchcache"])) {
            $this->code = urldecode($_COOKIE["uhitchcache"]);
            
            return TRUE;
        }
    }
    
    function retrieveCookie() {
        $email = substr($this->code, 0, strrpos($this->code,"@"));
        $password = substr(strrchr($this->code,"@"),1);
    
        return array($email, $password);
    }
    
    function checkSession() {
        if(!$this->isloggedin())
            { redirect('/welcome'); } 
            
        if(!$this->checkStatus())
            { redirect('/register'); }
    }

    /**
     * Returns whether the User is logged in
     * @return User
     */
    function isloggedin() {
        return ($this->user);
    }
    
    function hasAlreadyRegistered() {
        if(!$this->isloggedin())
            { redirect('/welcome'); }
            
        if($this->checkStatus()) 
            { redirect('/main'); }
    }
    
    function checkStatus() {
        if($this->status === '1' || $this->status === 1) {
            return TRUE;
        }
        return FALSE;
    }
    
    function destroySession() {
        $this->session->sess_destroy();
    }
    
    function show_404()
    {
        $this->title = 'Page Not Found | Uhitch';
        
        $this->display_error('page_missing');
    }
    
    function view($folder, $page, $header = 'normal') {
        $data['map']    = $this->map;
        $data['title']  = $this->title;
        $data['ride']   = $this->ride;
        $data['error']  = $this->error;
        $data['page']   = $this->page;
        $data['data']   = $this->data;
        $data['msg']    = $this->msg;
        $data['ticker'] = $this->ticker;
        $data['scripts']= $this->scripts;
        
        if(!file_exists('application/views/'.$folder.$page.'.php'))
        {
            show_404();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('header/'.$header, $data);
        $this->load->view($folder.$page, $data);
        $this->load->view('templates/footer', $data);
    }
    
    /** 
     * Sets the JavaScripts to the page, the scripts 
     * are located below the footer of the page 
     * @param type $type Scripts 
     */
    protected function setScripts($type) {
        $scripts = array();
        
        $postRide   = base_url()."assets/js/PostRides.js";
        $jqueryUI   = "//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js";
        $signUp     = base_url()."assets/js/SignUpUser.js";
        $schoolList = base_url()."assets/js/SchoolList.js";
        $logIn      = base_url()."assets/js/LogInUser.js";
        $members    = base_url()."assets/js/LandingPage.js";
        $forgot     = base_url()."assets/js/ForgotPassword.js";
        $newPwd     = base_url()."assets/js/ChangePassword.js";
        $contact    = base_url()."assets/js/ContactUs.js";
        $register   = base_url()."assets/js/RegisterUser.js";
        $settings   = base_url()."assets/js/AccountSettings.js";
        $hitch      = base_url()."assets/js/HitchaRide.js";
        $event      = base_url()."assets/js/EventService.js";
        $upcoming   = base_url()."assets/js/UpcomingEvents.js";
        $search     = base_url()."assets/js/Search.js";
        $eventInfo  = base_url()."assets/js/EventInfo.js";
        $message    = base_url()."assets/js/Message.js";
        $sendmessage = base_url()."assets/js/SendMessages.js";
        
        switch($type) {
            case 'sendmessage':
                array_push($scripts, $jqueryUI, $sendmessage);
                break;
            case 'message':
                array_push($scripts, $message);
                break;
            case 'eventDetails':
                array_push($scripts, $eventInfo);
                break;
            case 'search':
                array_push($scripts, $search);
                break;
            case 'signup': 
                array_push($scripts, $jqueryUI, 
                        $signUp, $schoolList);
                break;
            case 'login':
                array_push($scripts, $logIn);
                break;
            case 'forgot':
                array_push($scripts, $forgot);
                break;
            case 'event':
                $library = "http://maps.googleapis.com/maps/api/js?libraries=places";
                array_push($scripts, $jqueryUI);
                array_push($scripts, $event);
                array_push($scripts, $library);
                break;
            case 'new':
                array_push($scripts, $newPwd);
                break;
            case 'contact':
                array_push($scripts, $contact);
                break;
            case 'register':
                array_push($scripts, $register);
                break;
            case 'settings':
                array_push($scripts, $settings);
                break;
            case 'landing':
                array_push($scripts, $members);
                break;
            case 'postride':
                array_push($scripts, $postRide, $jqueryUI);
                break;
            case 'hitch':
                array_push($scripts, $hitch);
                break;
            case 'upcoming':
                array_push($scripts, $upcoming);
                break;
            default :
                break;
        }
        
        $this->scripts = $scripts;
    }
}