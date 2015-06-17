<?php
    
	
	ini_set('sendmail_from', "info@uhitch.me" );
    
	ini_set('SMTP', "smtp.uhitch.me" );
    
	ini_set('smtp_port',"25");
    

	   

	$message = "This is a test! From sandeep";
    
	$to = "redericyoung@gmail.com";
    
	$subject = "Test Email";
    
	$headers = "From: Uhitch\r\n";
    
    

	if(isset($_POST['email'])) {
        
		mail($to, $subject, $message, $headers);
    
	}
    

?>