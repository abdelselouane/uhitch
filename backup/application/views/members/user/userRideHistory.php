<?php 
    $rides      = $data->rideHistory;
    $upcoming   = array();
    $history    = array();
    
    foreach ($rides as $value) {
        $departDate = new DateTime($value['DepartDate']);
        $date       = date_format($departDate, 'm/d/Y');
        
        if($date > date("m/d/Y")) {
            array_push($upcoming, $value);
        } else {
            array_push($history, $value);
        }
    }
?>

<div class="rideHistory">
    <h2>Upcoming Rides</h2>
    <?php if(empty($upcoming)): ?>
            <div class='noItems'>
                <h3>No Upcoming Rides</h3>
            </div>
    <?php else: ?> 
        <?php foreach ($upcoming as $ride): ?>
            <?php 
            //var_dump($ride);
                $destination= substr($ride['DepartShort'], 0, 15);
                $arrival    = substr($ride['ArriveShort'], 0, 15);
                $driver     = $ride['Driver_Name'];
                
                $departDate = new DateTime($ride['DepartDate']);
                $departTime = new DateTime($ride['DepartTime']);
                        
                $date       = date_format($departDate, 'm/d/Y');
                $time       = date_format($departTime, 'G:ia');
            ?>
            <div class='upcomingItems'>
                <h3 class='forest'><?php echo $destination; ?> &#x2192; <?php echo $ride['ArriveShort']; ?></h3>
                <p>Date: <?php echo $date; ?> </p>
                <p>Time: <?php echo $time; ?> <span>Driver: <?php echo $driver; ?></span></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="rideHistory">
    <h2>Ride History</h2>
    <?php if(empty($history)): ?>
        <div class='noItems'>
            <h3>No History of Rides</h3>
        </div>
    <?php else: ?>
        <?php foreach ($history as $ride): ?>
            <?php
                //var_dump($ride);
                $destination= substr($ride['DepartShort'], 0, 15);
                $arrival    = substr($ride['ArriveShort'], 0, 15);
                $driver     = $ride['Driver_Name'];

                $departDate = new DateTime($ride['DepartDate']);
                $departTime = new DateTime($ride['DepartTime']);

                $date       = date_format($departDate, 'm/d/Y');
                $time       = date_format($departTime, 'G:ia');
            ?>
            <div class='upcomingItems'>
                <h3 class='forest'><?php echo $destination; ?>&#x2192;<?php echo $arrival; ?></h3>
                <p>Date: <?php echo $date; ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>