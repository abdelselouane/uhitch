<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password_retrieval_link_model extends CI_Model {
    //model
    public $link_key="";
    public $response=false;
    public $html='';
    
     function __construct()
    {
        parent::__construct();
     
    }
    
    function checkkey($link_key){
         //see if key exists      
        session_start();
        
        $connect = mysql_connect("localhost", "root","password") or die(mysql_error());         
        if(!$connect)
        {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                return;
        }
        mysql_select_db("uhitch",$connect); 
        $check = "SELECT COUNT(*) AS total,email FROM retrevial where key_value='$link_key'";
        
        $result = mysql_query($check);
        $row = mysql_fetch_assoc($result);
        $total = $row['total'];
        mysql_close($connect);
        
        if($total>0){
            $response=true;
            $email=$row['email'];
            $data=array("response"=>$response,"email"=>$email);
            $_POST['recovered_email']=$email;
                                   
        }
        else{
            
            $response=false;
            $data=array("response"=>$response);
            
        }
        
             
     
     return $data;
                 
    }    
}

?>
