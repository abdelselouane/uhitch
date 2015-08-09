<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getStates'))
{
    function getStates()
    { 
        
        $states = array('Alabama'=>'AL', 
                       'Alaska'=>'AK', 
                       'Arizona'=>'AZ', 
                       'Arkansas'=>'AR',
                       'California'=>'CA',
                       'Colorado'=>'CO',
                       'Connecticut'=>'CT',
                       'Delaware'=>'DE',
                       'District of Columbia'=>'DC',
                       'Florida'=>'FL',
                       'Georgia'=>'GA',
                       'Hawaii'=>'HI',
                       'Idaho'=>'ID',
                       'Illinois'=>'IL',
                       'Indiana'=>'IN',
                       'Iowa'=>'IA',
                       'Kansas'=>'KS',
                       'Kentucky'=>'KY',
                       'Louisiana'=>'LA',
                       'Maine'=>'ME',
                       'Maryland'=>'MD',
                       'Massachusetts'=>'MA',
                       'Michigan'=>'MI',
                       'Minnesota'=>'MN',
                       'Mississippi'=>'MS',
                       'Missouri'=>'MO',
                       'Montana'=>'MT',
                       'Nebraska'=>'NE',
                       'Nevada'=>'NV',
                       'New Hampshire'=>'NH',
                       'New Jersey'=>'NJ',
                       'New Mexico'=>'NM',
                       'New York'=>'NY',
                       'North Carolina'=>'NC',
                       'North Dakota'=>'ND',
                       'Ohio'=>'OH',
                       'Oklahoma'=>'OK',
                       'Oregon'=>'OR',
                       'Pennsylvania'=>'PA',
                       'Rhode Island'=>'RI',
                       'South Carolina'=>'SC',
                       'South Dakota'=>'SD',
                       'Tennessee'=>'TN',
                       'Texas'=>'TX',
                       'Utah'=>'UT',
                       'Vermont'=>'VT',
                       'Virginia'=>'VA',
                       'Washington'=>'WA',
                       'West Virginia'=>'WV',
                       'Wisconsin'=>'WI',
                       'Wyoming'=>'WY');
        return $states;
    }
    
    function isUrlExists($url=''){
        
        if( !empty($url) ){
            $ch = curl_init($url);    
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return $status = ($code == 200) ? true : false ;
        }
        
       // return false;
    }
}



?>