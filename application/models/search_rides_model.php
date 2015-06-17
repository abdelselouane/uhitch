
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class search_rides_model extends User_Model {
    public $db;
    protected $userid;
    protected $vehicleid;
            
    function __construct() {
        parent::__construct();
        $this->db = new database;
     }
     
     function find_user(){
         //grab input and calculate criteria strength
         $find_user = $this->input->post();
         
         $inputlength = strlen($find_user);
         
         $match_criteria = floor(inputlength * .5);
         
         $find_user = substr(strtolower(find_user),$match_criteria);
         //sql statement
         
         $query = "SELECT * FROM user"
                 ."WHERE email LIKE '$find_user'%";
         
          $start = microtime();
         
        $result = $this->db->retreiveRows($query);;
        
        $end = microtime();
        
        $duration = ($end - $start);
        
        $user = $this->findUser();
        
        $internal = "Insert INTO Internal (User,File,Method,Query,Duration) VALUES ('$user','search_rides_model.php','search_user_input','$query',$duration)";
        
        $this->db->runQuery($internal);
        
         //return results like rick did
        
        $matches = array();
        
        if(!empty($result)){
        
        foreach($result as $data) {
        
        //Update with needed results
        $array = array(  );
        
        array_push($matches, $array);
        
        }
        
        }
     }

     function find_ride() {
        
        //Date = now
        $date = date('Y-m-d H:i:s');
        
        //modify based on new layout
        //grab locations from page
        //Starting location Lat & Long
        $from = $this->input->post('from');
        $to = $this->input->post('destination');
        //Radius in miles
        $radius = $this->input->post('radius');
        
        //geolocate        
        $fp = fopen('assets/rides.json', 'w');

        $dtemp  = trim($from, ',');
        $dplace = str_replace(' ', '+', urlencode($dtemp));

        $atemp = trim($to, ',');
        $aplace = str_replace(' ', '+', urlencode($atemp));
        
        //Find starting location
        $durl = "http://maps.googleapis.com/maps/api/geocode/json?address=".$dplace."&sensor=false";

        $dcurl = curl_init();
        curl_setopt($dcurl, CURLOPT_URL, $durl);
        curl_setopt($dcurl, CURLOPT_RETURNTRANSFER, 1);

        $dresponse = json_decode(curl_exec($dcurl), true);

        $dgeometry = $dresponse['results'][0]['geometry'];

        $starting_lat = $dgeometry['location']['lat'];
        $starting_long = $dgeometry['location']['lng'];

        //Find destination location
        $aurl = "http://maps.googleapis.com/maps/api/geocode/json?address=".$aplace."&sensor=false";

        $acurl = curl_init();
        curl_setopt($acurl, CURLOPT_URL, $aurl);
        curl_setopt($acurl, CURLOPT_RETURNTRANSFER, 1);

        $aresponse = json_decode(curl_exec($acurl), true);

        $ageometry = $aresponse['results'][0]['geometry'];

        $ending_long = $ageometry['location']['lng'];
        $ending_lat = $ageometry['location']['lat'];

        //Database Query
        $query = "SELECT Ride_ID,PickUp_Location,PickUp_Time,Destination_Location,Lat_D,Long_D,Driver_ID,Price,Ride_Notes "
                //Find rides whose destination is within the destination radius
                ."( 3959 * acos( cos( radians('$ending_lat') ) * cos( radians( Lat_D ) ) * cos( radians( $ending_long ) - radians(Long_D) )"
                ."+ sin( radians('$ending_lat') ) * sin( radians( Lat_D ) ) ) ) AS Destination_Distance,"
                //Find rides whose destination is within the starting radiua
                ."( 3959 * acos( cos( radians('$starting_lat') ) * cos( radians( Lat_PU ) ) * cos( radians( $starting_long ) - radians(Long_PU) )"
                ."+ sin( radians('$starting_lat') ) * sin( radians( Lat_PU ) ) ) ) AS Starting_Distance"
                
                ." FROM ride"
                ." HAVING Destination_Distance <= '$radius'"
                ." AND Starting_Distance <= '$radius'"
                ." AND '$date' >= PickUP_Time ORDER BY Destination_Distance;";
        
        
        //Probably will add compatibility stuff
        //Pull User's preferences and compare them to preferences of every driver returned
        //then sort array by match score
        
        $start = microtime();
         
        $result = $this->db->retreiveRows($query);;
        
        $end = microtime();
        
        $duration = ($end - $start);
        
        $user = $this->findUser();
        
        $internal = "Insert INTO Internal (User,File,Method,Query,Duration) VALUES ('$user','search_rides_model.php','search_user_input','$query',$duration)";
        
        $this->db->runQuery($internal);
        
         //return results like rick did
        
        $matches = array();
        
        if(!empty($result)){
        
        foreach($result as $data) {
        
        
        $array = array(        'Notes'          => $data['Ride_Notes'],
                               'ArrivalLocation'=> $data['Destination_Location'],
                               'DriverID'       => $data['DriverID'],
                               'Longitude'      => $data['$Long_D'],
                               'Latitude'       => $data['Lat_D'],
                               'Price'          => $data['Price']);
        
        array_push($matches, $array);
        
        }
        
        fwrite($fp, json_encode($matches));
        fclose($fp);
        
    }
     
     }
     
     
}
     
?>
