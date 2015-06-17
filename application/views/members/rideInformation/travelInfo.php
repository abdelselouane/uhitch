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
?>

<div class="travelInformation">
    <h2><?php echo $ride['DepartShort']; ?> &#x21c6; <?php echo $ride['ArriveShort']; ?></h2>
    
    <h4>Departs:<span class="<?php echo $class;?>"> <?php echo $departs;?></span></h4>
    <h4>Time: <?php echo $time; ?></h4>
</div>

<div class="travelInformation">
    <input hidden id="departLatLng" value="<?php echo $ride['Lat_Dep'].','.$ride['Lon_Dep'];?>" />
    <input hidden id="arriveLatLng" value="<?php echo $ride['Lat_Arr'].','.$ride['Lon_Arr'];?>" />
    <div id="direction-info">
        <p>
            <span>Distance:</span>
            <span class="map-info"><?php echo $ride['Distance'];?> Mi</span>
        </p>
        <p>
            <span>Price:</span>
            <span class="map-info">$<?php echo $ride['Price'];?>/Seat</span>
        </p>
        <p>
            <span>Passengers <br/> Remaining</span>
            <span class="map-info"><?php echo $ride['Passengers'];?></span>
        </p>
    </div>
    <div id="direction-map"></div>
</div>

<div class="travelInformation">
    <h2>Vehicle Information</h2><br/>
    <div class="inline">
        <span style="text-decoration: underline;">Make</span>
        <h4><?php echo $ride['Make'];?></h4>
    </div>
    <div class="inline">
        <span style="text-decoration: underline;">Model</span>
        <h4><?php echo $ride['Model'];?></h4>
    </div>
    <div class="inline">
        <span style="text-decoration: underline;">Year</span>
        <h4><?php echo $ride['Year'];?></h4>
    </div>
    <div class="inline">
        <span style="text-decoration: underline;">Color</span>
        <h4><?php echo $ride['Color'];?></h4>
    </div>
</div>

<div class="travelInformation">
    <?php 
        $comments = trim($ride['Notes']);
        if(empty($comments) || is_null($comments)):
    ?>
        <h2 id="no-comment">No Comment</h2>
    <?php else: ?>
        <h2 style="margin-bottom:0.5em;">Comments</h2>
        <p id="comment"><?php echo $ride['Notes'];?></p>
    <?php endif; ?>
</div>