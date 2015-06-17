<?php 
    
    //$my_session = $this->session->all_userdata();

    //echo '<pre>'; print_r($ride['creator']); echo '</pre>';

    $imagepath = file_exists("assets/photos/users/".$ride['creator']['Photo']) ? "assets/photos/users/".$ride['creator']['Photo'] :   "assets/photos/default.png";
     
    $imageUrl = base_url($imagepath);
?>

<div class="travelInformation">
    <h3 class="no-shadow">
        Creator: <?php echo $ride['CreatedByName']; ?>
    </h3>
    <div class="driverInfo">
        <figure>
            <img src="<?php echo $imageUrl ;?>" alt="<?php echo $ride['CreatedByName'];?>" />
        </figure>
    </div>
    <div class="driverInfo">
        <span>
            <a href="userProfile?q=<?php echo $ride['CreatedById'];?>">
                See Profile
            </a>
        </span>
        <div id="hitchBtn-container">
            <a class="button" href="#">Request Ride</a>
            <a class="button" href="<?= site_url('/main/messages')?>">Send Message</a>
        </div>
    </div>
</div>