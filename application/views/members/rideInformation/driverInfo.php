<?php 

 $future = strtotime($ride['DepartDate']);
    $now = time();
    $timeleft = $future-$now;
    $daysleft = round((($timeleft/24)/60)/60);

    switch (TRUE) {
        case ($daysleft > 3):
            $class = 'normal';
            $departs = "$daysleft Days Left";
            break;
        case ($daysleft === 3):
        case ($daysleft === 2):
            $class = 'red';
            $departs = "$daysleft Days Left";
            break;
        case ($daysleft === 1):
        case ($daysleft === 0):
            $departs = "$daysleft Day Left";
            $class = 'red';
            break;
        default:
            $departs = 'Expired';
            $class = 'red';
            break;
    }

    $time = date("g:i a", strtotime($ride['DepartTime']) );


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
            <?php if( $departs != 'Expired' ){?>
            <a class="button" href="<?=site_url('main/requestride?q='.$ride['Ride_ID']);?>">Request Ride</a>
            <?}?>
            <a class="button" href="<?=site_url('main/messages?q='.$ride['Driver_ID']);?>">Send Message</a>
        </div>
    </div>
</div> 