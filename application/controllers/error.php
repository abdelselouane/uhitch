<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends My_BaseController {
    public function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->display404();
    }
    
    function outofdate() {
        $this->load->view('errors/oldBrowser');
    }
            
    function display404() {
        $this->view('errors/', 'page_missing');
    }
}