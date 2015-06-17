<?php 
    $img = base_url().'assets/photos/users/'.$ride['Driver_ID'].'.png';
?>

<div class="travelInformation">
    <h2><?php echo $ride['Driver_Name']; ?></h2>
    <div class="driverInfo">
        <figure>
            <img src="<?php echo $img;?>" alt="<?php echo $ride['Driver_Name'];?>" />
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
            <a class="button" href="#">Send Message</a>
        </div>
    </div>
</div> 