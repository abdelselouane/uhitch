<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EventServices_model extends User_Model {
    public $db;
    public $userName;
    public $userId;
    
    public $eventName;    
    public $location;
    public $comments;
    public $city, $state, $zip;

    public $lat; 
    public $lon;
    public $eventId;
    public $eventTime;
    public $eventDate;
    public $eventFilename;
            
    function __construct() {
        parent::__construct();
        
        $this->db = new Database;
        $this->userName = $this->getFullName();
        $this->userId   = $this->findUserID();
    }
    
    function registerEvent($filename = NULL) {
        $this->mapElements($filename);
        $this->insertionToDb();
//        $this->sendEmailToAdmin();
    }
    
    function mapElements($file) {
        $this->eventName    = ucfirst($this->input->post('Name'));
        $this->location     = ucfirst($this->input->post('event-address')); 
        $this->eventId      = substr(str_shuffle(MD5(microtime())), 0, 45);
        $this->eventDate    = $this->input->post('event-date');
        $this->eventTime    = $this->input->post('event-time');
        $this->eventFilename = isset($file) ? $file : NULL;
        
        $this->city         = ucfirst($this->input->post('event-city')); 
        $this->state        = ucfirst($this->input->post('event-state'));
        $this->zip          = $this->input->post('event-zip');
        $this->lat          = empty($this->input->post('eventLat')) ? NULL : $this->input->post('eventLat');
        $this->lon          = empty($this->input->post('eventLon')) ? NULL : $this->input->post('eventLon'); 

        $this->comments     = $this->input->post('Comments');
    }

    function insertionToDb() {
        $query = "INSERT INTO events (Name, EventId, Address, City, "
                    . "State, CreatedByName, CreatedById, EventDate, EventTime,"
                    . "Comments, Lat, Lon, Zip, Photo ) "
                . "VALUES('$this->eventName', '$this->eventId', '$this->location', "
                    . "'$this->city', '$this->state', '$this->userName', '$this->userId', "
                    . "'$this->eventDate', '$this->eventTime', '$this->comments',"
                    . "'$this->lat', '$this->lon', '$this->zip', '$this->eventFilename' ) ";
        
        $this->db->execute($query);
    }
    
    function sendEmailToAdmin() {
        
    }
    
    function retrieveSchoolCoord($school) {
        $coords = $this->getSchooLatLng();
        
        if($coords[0] && $coords[1]) {
            $found = array(
                'Latitude'  => $coords[0],
                'Longitude' => $coords[1] 
            );
            return $found;
        } 
        $query = "SELECT Latitude, Longitude "
                . "FROM school "
                . "WHERE Name = '$school' ";
        
        $found = $this->db->retrieveData($query);
        
        if(!is_null($found)) {
            $this->setSchooLatLng(
                $found['Latitude'], $found['Longitude']
            );
            return $found;
        }
        
//        else {
//            $found = $this->grabCoordinates($place);
//            $this->setSchooLatLng($found[0], $found[1]);
//        }
        // Need Some Validation Here If not found
    }
    
    function eventRecordsCount($coord) {
        $lat    = $coord['Latitude'];
        $lon    = $coord['Longitude'];
        
        $query = $this->searchEventByRadiusQuery($lat, $lon);
        $found = $this->db->retrieveData($query);
        
        return (int)$found["Count(Reviewed)"];
    }
    
    function retrieveAllEvents($limit, $start, $radius = 20) {
        $school = $this->getSchooLatLng();
        
        $query = "SELECT "
                    . "Name, Address, City, State, Photo, EventDate, EventTime, EventId, "
                    . "(3959 * acos( cos( radians($school[0]) ) * cos( radians( Lat ) ) "
                    . "* cos( radians( Lon ) - radians( $$school[0] ) ) "
                    . "+ sin( radians( $school[1] ) ) * sin( radians( Lat ) ) ) ) "
                . "AS distance "
                . "FROM events "
                . "HAVING distance < $radius "
                . "WHERE Reviewed='1' AND EventDate > CURDATE() "
                . "LIMIT $limit, $start";
        
        $data = $this->db->retrieveRows($query);
        
        if(count($data) > 0) {
            return $data;
        }
        return FALSE;
    }
    
    function retrieveEventInfo($id) {
        $query = "SELECT "
                    . "Name, Address, City, State, Photo, Comments, "
                    . "EventDate, EventTime, Lat, Lon, CreatedByName,"
                    . "CreatedById "
                . "FROM events "
                . "WHERE EventId='$id' ";
        
        $data = $this->db->retrieveRows($query);
        
        return json_encode($data[0]);
    }
}
