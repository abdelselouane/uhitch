<div id='rideInfo'>
    <?php 
        $today = date("Y-m-d");
        $form_rides = array (
            'name' => 'rideform',
            'id'   => 'ride_form'
        );
        echo form_open('main/submitRides', $form_rides);
    ?>
    <div class="form-group destination">
        <label>Ride Name:</label>
        <input placeholder="Destination Name" name="destination" type="text" required />   
    </div>
    <div class="form-group">
        <label>Departure Date:</label>
        <div class='input-group date' id='datetimepicker1'>
            <input id="input-date" name="date" type='text' class="form-control" required/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label>Departure Time:</label>
        <div class='input-group date' id='datetimepicker2'>
            <input type='text' id="input-time"  name="time" class="form-control" required/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
        </div>
    </div>
    <div class="form-group ride_input">
        <label>Departure:</label>
        <input placeholder="Departure Address" name="departure" type="text" 
               class="form-control ride_location" id="start" value="<?php echo $data->school;?>" required />
    </div>
    <div class="form-group ride_input">
        <label>Arrival:</label>
        <input placeholder="Arrival Address" name="arrival" 
               class="form-control ride_location" id="end" type="text" required />
    </div>
    <div class="form-group">
        <label>Passengers:</label>
        <input id="passengers_disabled" maxlength="1" name="passengers_disabled" value="0" type="text" class="psn-input" required="required" disabled/>
        <a id="passenger-plus" class="prm-btn"><i class="fa fa-plus"></i></a> 
        <a id="passenger-minus" class="prm-btn"><i class="fa fa-minus"></i></a>
        <div class="passenger-ui">
            <span class="psn-box">YOU</span>
        </div>
    </div>
    <div class="form-group alert alert-danger">
        <label class="pricing">Price / Seat</label>
        <input id="price_disabled" class="pricing-input" value="$0" maxlength="6" name="price_disabled" type="text" disabled/>
        <hr>
        <label class="pricing">Ride Cost</label>
        <input id="ridecost_disabled" class="pricing-input" value="$0" maxlength="6" name="ridecost_disabled" type="text" disabled/>
    </div>
    <div class="form-group ride_notes">
        <label>Ride Notes:</label>
        <textarea rows="2" cols="10" class="form-control" name="ridenotes"></textarea>
    </div>
    <input type="hidden" id="price" name="price" />
    <input type="hidden" id="ride_cost" name="ride_cost" />
    <input type="hidden" id="passengers" name="passengers" />
    <input type="hidden" id="mileage" name="mileage" />
    <input type="hidden" id="departShort" name="departShort" />
    <input type="hidden" id="departLat" name="departLat" />
    <input type="hidden" id="departLon" name="departLon" />
    <input type="hidden" id="arriveShort" name="arriveShort" />
    <input type="hidden" id="arriveLat" name="arriveLat" />
    <input type="hidden" id="arriveLon" name="arriveLon" />
    <button id="post-btn" class="button">Post Ride</button>
    <?php form_close(); ?>
</div>