<?php 
    //$img = base_url().'assets/photos/users/'.$ride['Driver_ID'].'.png';

//echo '<pre>'; print_r($ride); echo '</pre>';

    $imagepath = file_exists("assets/photos/users/".$ride['Photo']) ? "assets/photos/users/".$ride['Photo'] : "assets/photos/default.png";
     $imageUrl = base_url($imagepath);
?>

<div class="travelInformation">
    <h2><?php echo $ride['Driver_Name']; ?></h2>
    <div class="driverInfo">
        <figure>
            <img src="<?php echo $imageUrl;?>" alt="<?php echo $ride['Driver_Name'];?>" />
        </figure>
    </div>
    <div class="driverInfo">
        <span><?php echo $ride['School_Name']; ?></span>
        <?php if(intval($ride['Driver_Rating']) !== 0): ?>
            <span>Rating: <?php echo $ride['Driver_Rating']; ?>/5</span>
        <?php endif; ?>
        <span>Total Rides: <?php echo $ride['Driver_Count']; ?></span>
        <span>
            <a href="<?php echo site_url('main/userProfile?q='.$ride['Driver_ID']) ?>">
                See Driver's Profile
            </a>
        </span>
        <div id="hitchBtn-container">
            <a class="button" href="#">Request Ride</a>
            <a class="button" href="<?=site_url('main/messages');?>">Send Message</a>
        </div>
    </div>
</div> 