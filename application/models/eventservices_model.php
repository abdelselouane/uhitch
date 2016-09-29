<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventservices_model extends User_Model {
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
        $this->sendEmailToAdmin();
    }
    
    function mapElements($file) { 
        
        //echo '<pre>'; print_r($this->input->post()); echo '</pre>';exit;
        
        $this->eventName    = ucfirst($this->input->post('Name'));
        $this->location     = ucfirst($this->input->post('event_address')); 
        $this->eventId      = substr(str_shuffle(MD5(microtime())), 0, 45);
        
        $this->eventDate    = date('Y-m-d', strtotime($this->input->post('event_date')));
        $this->eventTime    = $this->input->post('event_time');
        
        $this->eventFilename  = isset($file[0]) ? $file[0] : NULL;
        $this->eventFilename1 = isset($file[1]) ? $file[1] : NULL;
        $this->eventFilename2 = isset($file[2]) ? $file[2] : NULL;
        $this->eventFilename3 = isset($file[3]) ? $file[3] : NULL;
        $this->eventFilename4 = isset($file[4]) ? $file[4] : NULL;
        
        $video  = $this->input->post('uservideo');
        $video1 = $this->input->post('uservideo1');
        $video2 = $this->input->post('uservideo2');
        
        $this->video         = isset($video) ? $this->input->post('uservideo') : '';
        $this->video1        = isset($video1) ? $this->input->post('uservideo1') : '';
        $this->video2        = isset($video2) ? $this->input->post('uservideo2') : '';
        
        $this->city         = ucfirst($this->input->post('event_city')); 
        $this->state        = ucfirst($this->input->post('event_state'));
        $this->zip          = $this->input->post('event_zip');
        $this->lat          = ( $this->input->post('eventLat') == '' ) ? NULL : $this->input->post('eventLat');
        $this->lon          = ( $this->input->post('eventLon') == '' ) ? NULL : $this->input->post('eventLon'); 
        
        $this->website      = $this->input->post('Website');
        $this->facebook     = $this->input->post('Facebook');
        $this->twitter      = $this->input->post('Twitter');
        $this->instagram    = $this->input->post('Instagram');
        $this->googleplus   = $this->input->post('Googleplus');
        $this->pinterest    = $this->input->post('Pinterest');
        $this->description  = $this->input->post('Description');
        $this->comments     = $this->input->post('Comments');
        $this->plan         = $this->input->post('plan');
    }

    function insertionToDb() {
        $query = 'INSERT INTO events (Name, EventId, Location, City, '
                    . 'State, CreatedByName, CreatedById,'
                    . 'Comments, Lat, Lon, Zip, Photo, Photo1, Photo2, Photo3, Photo4, Video, Video1, Video2, Website, Facebook, Twitter, Instagram, Googleplus, Pinterest, Description, EventDate, EventTime, Plan ) '
                    . 'VALUES("'.$this->eventName.'", "'.$this->eventId.'", "'.$this->location.'", '
                    . ' "'.$this->city.'", "'.$this->state.'", "'.$this->userName.'", "'.$this->userId.'", '
                    . ' "'.$this->comments.'", '
                    . ' "'.$this->lat.'", "'.$this->lon.'", "'.$this->zip.'", "'.$this->eventFilename.'", "'.$this->eventFilename1.'", "'.$this->eventFilename2.'", "'.$this->eventFilename3.'", "'.$this->eventFilename4.'", "'.$this->video.'", "'.$this->video1.'", "'.$this->video2.'", '
                    . ' "'.$this->website.'", "'.$this->facebook.'", "'.$this->twitter.'", "'.$this->instagram.'", "'.$this->googleplus.'", "'.$this->pinterest.'", "'.$this->description.'", '
                    . ' "'.$this->eventDate.'", "'.$this->eventTime.'", "'.$this->plan.'" ) ';
        
        //echo $query; exit;
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
        
        //$query = $this->searchEventByRadiusQuery($lat, $lon);
        $query = $this->getEventsNearby($lat, $lon);
        //echo '<pre>'; print_r($query); echo '</pre>'; exit;
        
        $found = $this->db->retrieveRows($query);
        //echo '<pre>'; print_r($found); echo '</pre>';exit;
        return $found;
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
                    . "Name, Location, City, State, Photo, Comments, "
                    . "EventDate, EventTime, Lat, Lon, CreatedByName,"
                    . "CreatedById "
                . "FROM events "
                . "WHERE EventId='$id' ";
        
        $data = $this->db->retrieveRows($query);
        
        return json_encode($data[0]);
    }
    
    function getEventById($id) {
        $query = "SELECT "
                    . "Name, Location, City, State, Photo, Comments, "
                    . "EventDate, EventTime, Lat, Lon, CreatedByName,"
                    . "CreatedById "
                . "FROM events "
                . "WHERE EventId='$id' ";
        
        //echo $query; exit;
        
        return $this->db->retrieveRows($query);
    }
    
    function getEventPhotoById($id) {
        $query = "SELECT Photo "
                . "FROM events "
                . "WHERE EventId='$id' ";
        
        //echo $query; exit;
        
        return $this->db->retrieveRows($query);
    }
    
    function deleteEventPhoto($id, $photoId) {
        $query = 'UPDATE events 
                    SET Reviewed = 0, ';
        switch ($photoId)
        {
            case '1':
                $query .= 'Photo = null';
                break;
            case '2':
                $query .= 'Photo1 = null';
                break;
            case '3':
                $query .= 'Photo2 = null';
                break;
            case '4':
                $query .= 'Photo3 = null';
                break;
            case '5':
                $query .= 'Photo4 = null';
                break;
            case '6':
                $query .= 'Photo5 = null';
                break;
        }
        $query .= ' WHERE EventId="'.$id.'" ';
        //echo $query;
        $this->db->execute($query);
    }
    
    function updateEventById($post) {
        
        $post['Name'] = isset($post['Name']) ? $post['Name'] : '';
        $post['eventLat'] = isset($post['eventLat']) ? $post['eventLat'] : '';
        $post['eventLon'] = isset($post['eventLon']) ? $post['eventLon'] : '';
        $post['event_address'] = isset($post['event_address']) ? $post['event_address'] : '';
        $post['event_city'] = isset($post['event_city']) ? $post['event_city'] : '';
        $post['event_state'] = isset($post['event_state']) ? $post['event_state'] :'';
        $post['event_zip'] = isset($post['event_zip']) ? $post['event_zip'] : '';
        $post['updatefile'] = isset($post['updatefile']) ? $post['updatefile'] : '';
        $post['updatefile1'] = isset($post['updatefile1']) ? $post['updatefile1'] : '';
        $post['updatefile2'] = isset($post['updatefile2']) ? $post['updatefile2'] : '';
        $post['updatefile3'] = isset($post['updatefile3']) ? $post['updatefile3'] : '';
        $post['updatefile4'] = isset($post['updatefile4']) ? $post['updatefile4'] : '';
        $post['updatefile5'] = isset($post['updatefile5']) ? $post['updatefile5'] : '';
        $post['Website'] = isset($post['Website']) ? $post['Website'] : '';
        $post['Facebook'] = isset($post['Facebook']) ? $post['Facebook'] :'';
        $post['Twitter'] = isset($post['Twitter']) ? $post['Twitter'] : '';
        $post['Instagram'] = isset($post['Instagram']) ? $post['Instagram'] : '';
        $post['Pinterest'] = isset($post['Pinterest']) ? $post['Pinterest'] : '';
        $post['Googleplus'] = isset($post['Googleplus']) ? $post['Googleplus'] : '';
        $post['Description'] = isset($post['Description']) ? $post['Description'] : '';
        $post['event_date'] = isset($post['event_date']) ? $post['event_date'] : '';
        $post['event_time'] = isset($post['event_time']) ? $post['event_time'] : '';
        $post['Comments'] = isset($post['Comments']) ? $post['Comments'] :'';
        
        //echo '<pre>'; print_r($post); echo '</pre>'; 
        //exit;
        $query = 'UPDATE events 
                    SET Reviewed = 0,
                        Name = "'.$post['Name'].'",
                        Lat = '.$post['eventLat'].',
                        Lon = '.$post['eventLon'].',
                        Location = "'.$post['event_address'].'",
                        City = "'.$post['event_city'].'",
                        State = "'.$post['event_state'].'",
                        Zip = "'.$post['event_zip'].'",
                        Photo = "'.$post['updatefile'].'",
                        Photo1 = "'.$post['updatefile1'].'",
                        Photo2 = "'.$post['updatefile2'].'",
                        Photo3 = "'.$post['updatefile3'].'",
                        Photo4 = "'.$post['updatefile4'].'",
                        Photo5 = "'.$post['updatefile5'].'",
                        Website = "'.$post['Website'].'",
                        Facebook = "'.$post['Facebook'].'",
                        Twitter = "'.$post['Twitter'].'",
                        Instagram = "'.$post['Instagram'].'",
                        Pinterest = "'.$post['Pinterest'].'",
                        Googleplus = "'.$post['Googleplus'].'",
                        Description = "'.$post['Description'].'",
                        EventDate = "'.date('Y-m-d', strtotime($post['event_date'])).'",
                        EventTime = "'.$post['event_time'].'",
                        Comments = "'.$post['Comments'].'"
                    WHERE EventId="'.$post['EventId'].'" ';
        //echo $query; exit;
        $this->db->execute($query);
    }
    
    function deleteEventById($id) {
        $query = "DELETE FROM events WHERE EventId='".$id."' ";
        //echo $query; exit;
        $this->db->execute($query);
    }
    
    function searchForEvents($request) {
        //echo '<pre>'; print_r($request); echo '</pre>'; exit; 
        $query = "SELECT * FROM events WHERE Reviewed = 1 AND ( ";
        foreach($request as $key=>$value){
            if( ($key+1) != count($request))
                $query .= $value." OR";
            else 
                $query .= $value." ";
        }       
        $query .= ") ";
        //echo $query; exit;
        return $this->db->retrieveRows($query);
    }
    
    function searchForEventsByAdmin($request) {
        //echo '<pre>'; print_r($request); echo '</pre>'; exit; 
        $query = "SELECT * FROM events WHERE 1 AND ( ";
        foreach($request as $key=>$value){
            if( ($key+1) != count($request))
                $query .= $value." OR";
            else 
                $query .= $value." ";
        }       
        $query .= ") ";
        //echo $query; exit;
        return $this->db->retrieveRows($query);
    }
    
    function retrieveEventAdmin() {
        $query = "SELECT * FROM events WHERE 1";
        
        return $data = $this->db->retrieveRows($query);
    }
    
    function approveEventAdmin($id) {
        $query = "UPDATE events SET Reviewed = 1 WHERE id=".$id;
        //echo $query; exit;
        $this->db->execute($query);
    }
    
    function disapproveEventAdmin($id) {
        $query = "UPDATE events SET Reviewed = 0 WHERE id=".$id;
        //echo $query; exit;
        $this->db->execute($query);
    }
}
