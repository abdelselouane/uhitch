<?php 
    $img = base_url().'assets/photos/users/'.$ride['Photo'].'.png';
    if(!file_exists($img)) {
        $img = base_url().'assets/imgs/user_profile.png';
    }
?>

<div class="travelInformation">
    <h3 class="no-shadow">
        Creator: <?php echo $ride['CreatedByName']; ?>
    </h3>
    <div class="driverInfo">
        <figure>
            <img src="<?php echo $img;?>" alt="<?php echo $ride['CreatedByName'];?>" />
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
            <a class="button" href="#">Send Message</a>
        </div>
    </div>
</div>