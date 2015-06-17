<?php 
    $imagepath = file_exists($page['Photo']) ? "assets/photos/users/".$page['Photo'] : "assets/photos/default.png";
    $imageUrl = base_url($imagepath);
    
    $userName   = isset($page['Full_Name'])         ? $page['Full_Name']   : 'N/A';
    $login      = isset($page['LastLogin'])         ? date('F j, Y', strtotime($page['LastLogin']))  : 'N/A';  
    $member     = isset($page['AccountCreated'])    ? date('F j, Y', strtotime($page['AccountCreated'])) : 'N/A';

    $location   = $page['City'].', '.$page['State'];
?>

<div id='profile_img'>
    <figure>
        <img src="<?php echo $imageUrl;?>" alt="<?php echo $userName;?>" />
    </figure>
    <span>Location: <?php echo $location;?></span>
    <span>Last Login: <?php echo $login;?></span>
    <span>Member Since: <?php echo $member;?></span> 
    <a class="button" href="<?=site_url('main/messages');?>">Send Message</a>
</div>