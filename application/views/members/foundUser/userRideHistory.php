<?php 
    $rides      = $page[0]['rides'];
    $upcoming   = array();
    $history    = array();
    foreach ($rides as $value) {
        $departDate = new DateTime($value['DepartDate']);
        $date       = date_format($departDate, 'm/d/Y');
        if(strtotime($date) > strtotime(date("m/d/Y")) ) {
            array_push($upcoming, $value);
        } else {
            array_push($history, $value);
        }
    }
?>
<div class="panel-group" id="accordion" style="padding-left:15px;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
          <a class="accordion-toggle green" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
            Upcoming Rides<i class="indicator glyphicon glyphicon-chevron-left  pull-right"></i>
          </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
            <div class="rideHistory">
                <table id="upcominRidesListing" class="display">
                    <thead>
                        <tr>
                            <th class="center">&nbsp;</th>
                            <th class="left">Departure</th>
                            <th class="left">Arrival</th>
                            <th class="left">Date/Time</th>
                            <th class="left">Driver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($upcoming)): ?>
                            <?php $i=0; 
                                foreach ($upcoming as $ride): ?>
                                <?php 
                                    $class = ($i%2 ==0 ) ? 'odd' : 'even';
                                    $destination= substr($ride['DepartShort'], 0, 15);
                                    $arrival    = substr($ride['ArriveShort'], 0, 15);
                                    $driver     = $ride['Driver_Name'];

                                    $departDate = new DateTime($ride['DepartDate']);
                                    $departTime = new DateTime($ride['DepartTime']);

                                    $date       = date_format($departDate, 'm/d/Y');
                                    $time       = date_format($departTime, 'G:ia');
                                ?>
                                <tr class="green-odd <?= $class ?>">
                                    <td><a class="green" href="<?=base_url().'index.php/main/hitchARide?q='.$ride['Ride_ID']?>"><i class="fa fa-car"></i></a></td>
                                    <td><?= $destination; ?></td>
                                    <td><?= $ride['ArriveShort']; ?></td>
                                    <td><?= $date.' - '.$time; ?></td>
                                    <td><a href="<?=base_url().'index.php/main/userProfile?q='.$ride['Driver_ID']?>"><?= $driver; ?></a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
      </div>
    </div>
  </div><br>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle green" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
           Ride History<i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <div class="rideHistory">
            <table id="rideHistoryListing" class="display">
                <thead>
                    <tr>
                        <th class="center">&nbsp;</th>
                        <th class="left">Departure</th>
                        <th class="left">Arrival</th>
                        <th class="left">Date/Time</th>
                        <th class="left">Driver</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($history)): ?>
                        <?php $i=0;  
                            foreach ($history as $ride): ?>
                            <?php
                                $class = ($i%2 ==0 ) ? 'odd' : 'even';
                                $destination= substr($ride['DepartShort'], 0, 15);
                                $arrival    = substr($ride['ArriveShort'], 0, 15);
                                $driver     = $ride['Driver_Name'];

                                $departDate = new DateTime($ride['DepartDate']);
                                $departTime = new DateTime($ride['DepartTime']);

                                $date       = date_format($departDate, 'm/d/Y');
                                $time       = date_format($departTime, 'G:ia');
                            ?>
                            <tr class="green-odd <?= $class ?>">
                                <td><a class="green" href="<?=base_url().'index.php/main/hitchARide?q='.$ride['Ride_ID']?>"><i class="fa fa-road"></i></a></td>
                                <td><?= $destination; ?></td>
                                <td><?= $arrival; ?></td>
                                <td><?= $date ?></td>
                                <td><a href="<?=base_url().'index.php/main/userProfile?q='.$ride['Driver_ID']?>"><?= $driver ?></a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
