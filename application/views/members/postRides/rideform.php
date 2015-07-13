<?php //echo '<pre>'; print_r($data->ride); echo '</pre>';?>
<div id='rideInfo'>
    <?php 
        $today = date("Y-m-d");
        $form_rides = array (
            'name' => 'rideform',
            'id'   => 'ride_form'
        );
        if(!isset($data->ride)){
            echo form_open('main/submitRides', $form_rides);
        } else {
            echo form_open('main/updateRide', $form_rides);
        }
    ?>
    <div class="form-group destination">
        <label>Ride Name:</label>
        <input placeholder="Destination Name" name="destination" type="text" required value="<?= isset($data->ride) ? $data->ride['Name'] : ''?>"/>   
    </div>
    <div class="form-group">
        <label>Departure Date:</label>
        <div class='input-group date' id='datetimepicker1'>
            <input id="input-date" name="date" type='text' class="form-control" value="<?= isset($data->ride) ? date('m/d/Y', strtotime($data->ride['DepartDate'])) : ''?>" required/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label>Departure Time:</label>
        <div class='input-group date' id='datetimepicker2'>
            <input type='text' id="input-time"  name="time" class="form-control" value="<?= isset($data->ride) ? $data->ride['DepartTime'] : ''?>" required/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
        </div>
    </div>
    <div class="form-group ride_input">
        <label>Departure:</label>
        <input placeholder="Departure Address" name="departure" type="text" 
               class="form-control ride_location" id="start" value="<?= isset($data->ride) ? $data->ride['Departs'] : $data->school;?>" required />
    </div>
    <div class="form-group ride_input">
        <label>Arrival:</label>
        <input placeholder="Arrival Address" name="arrival" 
               class="form-control ride_location" id="end" type="text" value="<?= isset($data->ride) ? $data->ride['Arrival'] : ''?>" required />
    </div>
    <div class="form-group">
        <label>Passengers:</label>
        <input id="passengers_disabled" maxlength="1" name="passengers_disabled" value="<?= isset($data->ride) ? $data->ride['Passengers'] : 0 ?>" type="text" class="psn-input" required="required" disabled/>
        <a id="passenger-plus" class="prm-btn"><i class="fa fa-plus"></i></a> 
        <a id="passenger-minus" class="prm-btn"><i class="fa fa-minus"></i></a>
        <div class="passenger-ui">
            <span class="psn-box">YOU</span>
            <?php if(isset($data->ride)){ 
                for( $i = 1; $i <= $data->ride['Passengers']; $i++){
                    echo '<span class="psn-box">'.$i.'</span>';
                }
            } ?>
        </div>
    </div>
    <div class="form-group alert alert-danger">
        <label class="pricing">Price / Seat</label>
        <input id="price_disabled" class="pricing-input" value="<?= isset($data->ride) ? '$'.$data->ride['Price'] : '$0' ?>" maxlength="6" name="price_disabled" type="text" disabled/>
        <hr>
        <label class="pricing">Ride Cost</label>
        <input id="ridecost_disabled" class="pricing-input" value="<?= isset($data->ride) ? '$'.$data->ride['Ride_Cost'] : '$0' ?>" maxlength="6" name="ridecost_disabled" type="text" disabled/>
    </div>
    <div class="form-group">
        <label>Charge Method:</label>
        <select id="charge" name="charge" class="form-control" required>
            <option value="">Select Charge Method</option>
            <option value="seat" <?= isset($data->ride) && $data->ride['Charge'] == 'seat' ? 'selected' : '' ?>>Charge Per Seat</option>
            <option value="trip" <?= isset($data->ride) && $data->ride['Charge'] == 'trip' ? 'selected' : '' ?>>Charge Per Trip</option>
        </select>
    </div>
     <div class="form-group">
        <label>If Event Ride:</label>
        <select id="event_id" name="event_id" class="form-control" required>
            <option value="">Select Event</option>
            <?php 
            if(is_array($data->events) && count($data->events)>0){ 
                foreach($data->events as $key => $value){ ?>
                    <option value="<?= $value['EventId']?>" <?= isset($data->ride) && $data->ride['Event_ID'] == $value['EventId'] ? 'selected' : '' ?>><?= $value['Name']?></option>
            <?php } 
             }
            ?>
        </select>
    </div>
    <div class="form-group ride_notes">
        <label>Ride Notes:</label>
        <textarea rows="2" cols="10" class="form-control" name="ridenotes"><?= isset($data->ride) ? $data->ride['Notes'] : '' ?></textarea>
    </div>
    <?php if(isset($data->ride)) { ?>
    <input type="hidden" id="ride_id" name="ride_id" value="<?= isset($data->ride) ? $data->ride['Ride_ID'] : '' ?>" />
    <?php } ?>
    <input type="hidden" id="price" name="price" value="<?= isset($data->ride) ? '$'.$data->ride['Price'] : '' ?>" />
    <input type="hidden" id="ride_cost" name="ride_cost" value="<?= isset($data->ride) ? '$'.$data->ride['Ride_Cost'] : '' ?>" />
    <input type="hidden" id="passengers" name="passengers" value="<?= isset($data->ride) ? $data->ride['Passengers'] : '' ?>"/>
    <input type="hidden" id="mileage" name="mileage" value="<?= isset($data->ride) ? $data->ride['Distance'] : '' ?>"/>
    <input type="hidden" id="departShort" name="departShort" value="<?= isset($data->ride) ? $data->ride['DepartShort'] : '' ?>"/>
    <input type="hidden" id="departLat" name="departLat" value="<?= isset($data->ride) ? $data->ride['Lat_Dep'] : '' ?>"/>
    <input type="hidden" id="departLon" name="departLon" value="<?= isset($data->ride) ? $data->ride['Lon_Dep'] : '' ?>"/>
    <input type="hidden" id="arriveShort" name="arriveShort" value="<?= isset($data->ride) ? $data->ride['ArriveShort'] : '' ?>"/>
    <input type="hidden" id="arriveLat" name="arriveLat" value="<?= isset($data->ride) ? $data->ride['Lat_Arr'] : '' ?>"/>
    <input type="hidden" id="arriveLon" name="arriveLon" value="<?= isset($data->ride) ? $data->ride['Lon_Arr'] : '' ?>"/>
    <button id="post-btn" class="button"><?= isset($data->ride) ? 'Save Changes' : 'Post Ride' ?></button>
    <?php form_close(); ?>
</div>