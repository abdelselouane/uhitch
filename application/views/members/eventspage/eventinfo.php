<?php 
    $future = strtotime($ride['EventDate']);
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

    $time = date("g:i a", strtotime($ride['EventTime']) );
?>

<div class="travelInformation">
    <h2 class="no-shadow"><?php echo $ride['Name']; ?></h2>
    <br/>
    <div class="split">
        <h3 class="no-shadow margin-10">Location</h3>
        <p class="text-left" style="min-height: 0;"><?php echo $ride['Location']; ?></p>
        <p class="text-left" style="min-height: 0;"><?php echo $ride['City'].', '.$ride['State']; ?></p>
        <p class="text-left" style="min-height: 0;"><?php echo $ride['Zip']; ?></p>
    </div>
    <div class="split">
        <h3 class="no-shadow margin-10">Details</h3>
        <p class="text-left" style="min-height: 0;">
            Date:<span class="<?php echo $class;?>"> <?php echo $departs;?></span>
        </p>
        <p class="text-left" style="min-height: 0;">
            Time: <?php echo $time; ?>
        </p>
    </div>
    
</div>

<div class="travelInformation">
    <div id="direction-map"></div>
</div>

<div class="travelInformation">
    <?php 
        $comments = trim($ride['Comments']);
        if(empty($comments) || is_null($comments)):
    ?>
    <h2 class="no-shadow margin-10">No Comment</h2>
    <?php else: ?>
        <h2 class="no-shadow" style="margin-bottom:0.5em;">Comments</h2>
        <p id="comment"><?php echo $comments;?></p>
    <?php endif; ?>
</div>
<input hidden id="lat" value="<?php echo $ride['Lat'];?>" />
<input hidden id="lon" value="<?php echo $ride['Lon'];?>" />