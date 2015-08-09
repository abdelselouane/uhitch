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
    <h3 class="no-shadow header-line text-center green"><?php echo $ride['Name']; ?></h3>
    <?php 
        //echo '<pre>'; print_r($ride); echo '</pre>';
        
        $imagepath = file_exists("assets/photos/events/".$ride['Photo']) ? "assets/photos/events/".$ride['Photo']:   "assets/photos/events/default.png";
        $imageUrl = base_url($imagepath);
    ?>
    <div class="eventProfile">
        <img src="<?=$imageUrl?>" class="" width="100%" height="auto;">
    </div>
    <hr>
    <div class="split">
        <h3 class="no-shadow header-line green">Date Time</h3>
        <p class="text-left alert alert-warning" style="min-height: 0;">
            Date: <?= date('m/d/Y', strtotime($ride['EventDate'])); ?><br>
            Time: <?= $ride['EventTime']; ?>
        </p>
    </div>
    <div class="split">
        <h3 class="no-shadow header-line green">Time Left</h3>
        <p class="text-left alert alert-warning" style="min-height: 0;">
            Date:<span class="<?php echo $class;?>"> <?php echo $departs;?></span><br>
            Time: <?php echo $time; ?>
        </p>
    </div>
    <hr>
    <div class="split">
        <h3 class="no-shadow header-line green">Location</h3>
        <p class="text-left alert alert-warning" style="min-height: 0;">
            <?php echo $ride['Location']; ?><br>
            <?php echo $ride['City'].', '.$ride['State'].', '.$ride['Zip']; ?>
        </p>
    </div>
    <div class="split">
        <h3 class="no-shadow header-line green">Has Rides</h3>
        <p class="text-left alert <?= ($ride['RideId']!='') ? 'alert-success' : 'alert-danger'?>">
            <i class="fa fa-car"></i>&nbsp;<?= ($ride['RideId']!='') ? 'YES' : 'NO'?>
            <br><br>
            <a class="btn btn-primary" style="display:block" href="<?= base_url('index.php/main/postride?e='.$ride['EventId']);?>">Post a Ride</a>
        </p>
    </div>
    <hr>
    <div class="clear"></div>
    <div style="margin-bottom: 20px" >
        <h3 class="no-shadow header-line green">Website / Social Media</h3>
        <div class="text-left" style="margin-left: 20px">
            <?php if(isset($ride['Website']) && !empty($ride['Website'])){ ?>
                <a href="<?=$ride['Website']?>" class="social-link" ><i class="fa fa-globe" ></i>&nbsp;<?=$ride['Website']?></a>
            <?php } ?>
            <?php if(isset($ride['Facebook']) && !empty($ride['Facebook'])){ ?>
                <a href="<?=$ride['Facebook']?>" class="social-link" ><i class="fa fa-facebook" ></i>&nbsp;<?=$ride['Facebook']?></a>
            <?php } ?>
            <?php if(isset($ride['Twitter']) && !empty($ride['Twitter'])){ ?>
                <a href="<?=$ride['Twitter']?>" class="social-link" ><i class="fa fa-twitter" ></i>&nbsp;<?=$ride['Twitter']?></a>
            <?php } ?>
            <?php if(isset($ride['Instagram']) && !empty($ride['Instagram'])){ ?>
                <a href="<?=$ride['Instagram']?>" class="social-link" ><i class="fa fa-google-plus" ></i>&nbsp;<?=$ride['Instagram']?></a>
            <?php } ?>
            <?php if(isset($ride['Googleplus']) && !empty($ride['Googleplus'])){ ?>
                <a href="<?=$ride['Googleplus']?>" class="social-link" ><i class="fa fa-instagram" ></i>&nbsp;<?=$ride['Googleplus']?></a>
            <?php } ?>
        </div>
    </div>
    <hr>
    <div style="margin-bottom: 20px" >
        <h3 class="no-shadow header-line green">Description</h3>
        <?php if(isset($ride['Googleplus']) && !empty($ride['Googleplus'])){ ?>
        <p class="text-left" style="margin-left: 20px;">
            <?=$ride['Description']?>
        </p>
        <?php }else{ echo 'No description has been entered...'; }?>
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
    <hr>
    <h3 class="no-shadow">No Comment</h3>
    <?php else: ?>
        <h3 class="no-shadow header-line green" style="margin-bottom:0.5em;">Comments</h3>
        <p id="comment" class="" style="margin-left: 20px;"><?php echo $comments;?></p>
    <?php endif; ?>
</div>
<input hidden id="lat" value="<?php echo $ride['Lat'];?>" />
<input hidden id="lon" value="<?php echo $ride['Lon'];?>" />