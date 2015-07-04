<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages_Model extends User_Model {
    public $db;
    public $message;
    public $to_UserName;
    public $from_UserName;
    public $to_UserID;
    public $current_UserID;
    public $messageID;
    protected $id;
    public $user;
    
    
    
    function __construct() {
      parent::__construct();
      $this->load->library('session');
      $this->db = new database;
      $this->current_UserID = $this->findUserID();
      $this->user = $this->findUser();
    }

    public function trySend() {
        $this->mapSendMessageData();
        $this->getUserSpec();
        return $this->send_message();
    }
    
    public function tryGetMessages()
    {
        $this->get_messages();
        return get_messages();
    }
    
    public function getMsgByUserId($userId){
        $query =  "SELECT * FROM messages WHERE deleted = 0 AND to_userId = '".$userId."'"; 
        //echo $query;
        $msgData = $this->db->retrieveRows($query);
        return $msgData;
    }
    
    public function getUserById($id){
        $query =  "SELECT * FROM user WHERE UserId = '".$id."' "; 
        //echo $query;
        //exit;
        $msgData = $this->db->retrieveRows($query);
        return $msgData;
    }    
    
    public function getUsername($value){
        $query =  "SELECT Full_Name, UserId FROM user WHERE Full_Name like '".$value."%' "; 
        //echo $query;
        //exit;
        $msgData = $this->db->retrieveRows($query);
        return $msgData;
    }
    
    public function getSentByUserId($userId){
        $query =  "SELECT * FROM messages WHERE deleted = 0 AND sent = 1 AND from_userId = '".$userId."'"; 
        //echo $query;
        $msgData = $this->db->retrieveRows($query);
        return $msgData;
    }
    
    public function setMessage($post) {
        $query =  "INSERT INTO messages (to_userName, to_userId, from_userName, from_userId, sent, subject, message) VALUES ('".$post['username']."', '".$post['to_userid']."', '".$post['from_fullname']."', '".$post['from_userid']."', 1, '".$post['subject']."', '".$post['message']."' );";
        
        $this->db->execute($query);
    }
    
    public function getImportantByUserId($userId){
        $query =  "SELECT * FROM messages WHERE important = 1 AND deleted = 0 AND ( to_userId = '".$userId."' OR from_userId = '".$userId."')"; 
        //echo $query; exit;
        $msgData = $this->db->retrieveRows($query);
        return $msgData;
    }
    
    public function getDeletedByUserId($userId){
        $query =  "SELECT * FROM messages WHERE deleted = 1 AND ( to_userId = '".$userId."' OR from_userId = '".$userId."') "; 
        //echo $query;
        $msgData = $this->db->retrieveRows($query);
        return $msgData;
    }
    
     public function readMessage($id) {
        $query =  "UPDATE `messages` SET `read`= 1 WHERE id = ".$id;
        //echo $query; exit;
        $this->db->execute($query);
    }
    
     public function enableImportant($id) {
        $query =  "UPDATE `messages` SET `important`= 1 WHERE id = ".$id;
        //echo $query; exit;
        $this->db->execute($query);
    }
    
     public function disableImportant($id) {
        $query =  "UPDATE `messages` SET `important`= 0 WHERE id = ".$id;
        //echo $query; exit;
        $this->db->execute($query);
    }
    
     public function enableDelete($id) {
        $query =  "UPDATE `messages` SET `deleted`= 1 WHERE id = ".$id;
        //echo $query; exit;
        $this->db->execute($query);
    }
    
    public function disableDelete($id) {
        $query =  "UPDATE `messages` SET `deleted`= 0 WHERE id = ".$id;
        //echo $query; exit;
        $this->db->execute($query);
    }
    
     public function enableAllDelete($ids) {
        $query =  "UPDATE `messages` SET `deleted`= 1 WHERE id IN (".$ids.") ";
        //echo $query; //exit;
        $this->db->execute($query);
    }
    
    public function completeDelete($id) {
        $query =  "DELETE FROM `messages` WHERE id = ".$id;
        //echo $query; exit;
        $this->db->execute($query);
    }
    
    public function completeAllDelete($ids) {
        $query =  "DELETE FROM `messages` WHERE id IN (".$ids.") ";
        //echo $query; exit;
        $this->db->execute($query);
    }
    
    public function sentDelete($id) {
        $query =  "UPDATE `messages` SET `sent`= 0 WHERE id = ".$id;
        //echo $query; exit;
        $this->db->execute($query);
    }
    
    public function sentAllDelete($ids) {
        $query =  "UPDATE `messages` SET `sent`= 0 WHERE id IN (".$ids.") ";
        //echo $query; exit;
        $this->db->execute($query);
    }
    
    public function get_messages() { 
       
        $get_messages_query =  "SELECT id, to_userid, from_userid, message, timestamp, from_userName "
                             . "FROM messages "
                             . "WHERE to_userId = '$this->user' ";        
        
        $message_data = $this->db->retrieveRows($get_messages_query);         
       
        return $message_data;
    }
    
    public function get_users_forMessages()
    {
        $get_user_query = "SELECT email_address "
                         ."FROM user ";
        
        $user_data = $this->db->retrieveRows($get_user_query);
        
        return $user_data;
    }
    
    public function verifyUser()
    { 
        $verify_user_query = "SELECT id "
                            ."FROM user "
                            ."WHERE email_address = '$this->to_UserName' ";
        
        $is_user_valid = $this->db->retrieveData($verify_user_query);
        
        return $is_user_valid;
    }
    
    private function send_message() {
        $new_message_query =  "INSERT INTO messages (id, to_userid, to_userName, from_userName, from_userid, message)"
                             . "VALUES('$this->messageID', '$this->to_UserID', '$this->to_UserName', '$this->user', '$this->current_UserID', '$this->message') "; 
        $this->db->execute($new_message_query); 
    }

    
    function delete_message() {
        //todo: update query for deleting message by id value
    }
    
    protected function mapSendMessageData()
    {
      $this->message = $this->input->post('message_to_be_sent');
      $this->to_UserName = $this->input->post('to_user_name');
      $this->messageID = mt_rand(10000000, 99999999);
    }  
    
    protected function getUserSpec() {
        $user_bs = $this->verifyUser();
        $this->to_UserID = $user_bs['id'];
    }
    
    protected function getUsers ()
    {
        $get_users_query = "SELECT id, Email_Address" 
                          ."FROM users";
        return $this->db->retrieveRows($get_users_query);
    }
    
    protected function generateMessageID(){
      // TODO:  change the dtaabse tu use a 20 char string for message ID
    }

}

