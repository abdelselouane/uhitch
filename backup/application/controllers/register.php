<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Controller
class Register extends My_BaseController {
    protected $photo;
    
    function __construct() {
        parent::__construct();
       
        $this->photo = NULL;
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->title = "Registration | Uhitch";
         
        $this->hasAlreadyRegistered();
    }
    
    function index() {
        $this->personal();
    }
  
    function schoolinfo() {
        $this->setScripts('register');
        $this->data = NULL;
        $this->display('schoolchoice');
    }
            
    function personal() {
        $this->setScripts('register');
        $this->data = 'vehicle';
        $this->msg = $this->session->userdata('car');
        $this->display('vehicle');
    }
    
    function uploadpic() {
        $this->setScripts('register');
        $this->data = 'photo';
        $this->display('uploadphoto');
    }
    
    // Submit Personal Data
    function submitUserData() {
        $this->load->model('registeruser_model');      
        $this->registeruser_model->registerUserInfo();

        redirect('register/schoolinfo');
    }
    
    // School Information Submitted
    function submitSchoolData() 
    {
        $this->load->model('registeruser_model');      
        $this->registeruser_model->registerSchoolInfo();
        
        // Next Page
        redirect('/register/uploadpic');
    } 
    
    function savelater() {
        $this->load->model('registeruser_model');
        $this->registeruser_model->changeStatus();
        redirect('/main');
    }
    
    function profilepic()
    {   
        $this->load->model('registeruser_model');
    
        $config['file_name'] = $this->session->userdata('userid');
        //$config['upload_path'] = 'uploads/';
        $config['upload_path'] = 'assets/photos/users/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']	= '5000';
        $config['max_width']  = '1600';
        $config['max_height']  = '1200';
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config); 

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());

            $this->error = TRUE;
            $this->photo = $error['error'];
            redirect('register/uploadpic?attempt=fail');
        }
        else {
            $data = array('upload_data' => $this->upload->data());
            
            $profileImg = $data["upload_data"]["file_name"];
            
            $this->registeruser_model->uploadphotos($profileImg);
            redirect('/main');
        }
    }

    private function display($view){  
        $this->view('register/', $view, 'register');
    } 
}