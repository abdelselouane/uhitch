<?php 
    
    //$my_session = $this->session->all_userdata();

    $imagepath = file_exists("assets/photos/users/".$ride['creator']['Photo']) ? "assets/photos/users/".$ride['creator']['Photo'] :   "assets/photos/default.png";
     
    $imageUrl = base_url($imagepath);
?>

<div class="travelInformation">
    <h3 class="no-shadow header-line green">
        By: <?php echo $ride['CreatedByName']; ?>
    </h3>
    <div class="driverInfo">
        <figure>
            <img src="<?php echo $imageUrl ;?>" alt="<?php echo $ride['CreatedByName'];?>" />
        </figure>
    </div>
    <div class="driverInfo">
        <div id="hitchBtn-container">
            <a class="btn btn-primary" href="userProfile?q=<?php echo $ride['CreatedById'];?>">See Profile </a><br>
            <a class="btn btn-primary" href="<?=site_url('main/messages?q='.$ride['creator']['UserID']);?>">Send Message</a><br>
        </div>
    </div>
</div>