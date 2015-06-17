<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of update_password_model
 *
 * @author kyle
 */
class Update_password_model extends CI_Model {
    //put your code here
    function __construct()
    {
        parent::__construct();
    }
    
    function change_password($email){
        
        $password = $_POST['new_password'];
        $salt = substr(str_shuffle(MD5(microtime())),0,30);
        
        $hash = hash("sha512",$password.$salt);
        
        session_start();
        
        $connect = mysql_connect("localhost", "root","password") or die(mysql_error());         
        if(!$connect)
        {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                return;
        }
        mysql_select_db("uhitch",$connect); 
        $update = "UPDATE 'user' SET Salt='$salt', Hashed_Password='$hash' where Email_Address='$email'";
        
        mysql_query($update);
        
        mysql_close($connect);
        
    }
}

?>
