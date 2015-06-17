<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends My_BaseController {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
        redirect('/welcome');
    }
            
    function uhitch($page) {    
        $title = $this->retrieveName($page);
        
        if(strtolower($title) === 'contact') {
            $this->map = TRUE;
            $this->setScripts('contact');
        }
        
        $this->title = "Uhitch | $title";
        $this->display($page);
    }
    
    private function display($view) {  
        $this->view('welcome/about/', $view, 'back');
    }
    
    function retrieveName($name) {
        $title = str_replace('_', ' ', $name);
        
        return ucfirst($title);
    }
    
    function contactUhitch() {       
        $name   = isset($_POST['name'])     ? $_POST['name']    : NULL;
        $email  = isset($_POST['email'])    ? $_POST['email']   : NULL;
        $msg    = isset($_POST['message'])  ? $_POST['message'] : NULL;
    
        echo 'word';
    }
}
