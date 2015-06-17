<link rel="stylesheet" type="text/css" href='<?php echo base_url();?>assets/css/layout.css'>
<link href='http://fonts.googleapis.com/css?family=Graduate' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url();?>assets/css/signin.css'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url();?>assets/css/page.css'>

<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />

<link rel="stylesheet" type="text/css" href='<?php echo base_url();?>assets/css/contentPages.css'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url();?>assets/css/header.css'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url();?>assets/css/members.css'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url();?>assets/css/registeruser.css'>

<?php 
    if(isset($map)) {
        if($map) {
            echo '<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.exp&sensor=true&libraries=places"></script>';
        }
    }
?>