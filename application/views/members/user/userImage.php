<?php 
    $imagepath = file_exists("assets/photos/users/".$data->photo) ? "assets/photos/users/".$data->photo : "assets/photos/default.png";
    $imageUrl = base_url($imagepath);
    
    $userName   = (trim($data->name))   ? $data->name   : 'N/A';
    $location   = (trim($data->city))    ? $data->city   : 'N/A';
    $login      = (trim($data->login))   ? $data->login  : 'N/A';  
    $member     = (trim($data->members)) ? $data->members: 'N/A';
?>

<div id='profile_img'>
    <figure>
        <img src="<?php echo $imageUrl;?>" alt="<?php echo $userName;?>" />
    </figure>
    <span>Location: <?php echo $location;?></span>
    <span>Last Login: <?php echo $login;?></span>
    <span>Member Since: <?php echo $member;?></span>
</div>
