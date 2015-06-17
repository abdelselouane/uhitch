<div id='rideInfo'>
    <h1>Post Ride</h1>
    <?php 
        $today = date("Y-m-d");
        $form_rides = array (
            'name' => 'rideform',
            'id'   => 'ride_form'
        );
        echo form_open('main/submitRides');
    ?>
    <div class="destination">
        <input placeholder="Destination Name" name="destination" type="text" required />   
    </div>
    <div class="left">
        <h3>Departure Date</h3>
        <input id="input-date" type="date" name="date" required>
    </div>
    <div class="right">
        <h3>Departure Time</h3>
        <input id="input-time" type="time" name="time" required>
    </div>
    <div class="ride_input">
        <h3>Departure</h3>
        <input placeholder="Departure Address" name="departure" type="text" 
               class="ride_location" id="start" value="<?php echo $data->school;?>" required />
    </div>
    <div class="ride_input">
        <h3>Arrival</h3>
        <input placeholder="Arrival Address" name="arrival" 
               class="ride_location" id="end" type="text" required />
    </div>
    <div class="left">
        <h3>Passengers</h3>
        <input id="price" maxlength="2" name="passengers" type="text" required/>
    </div>
    <div class="right">
        <h3>Price</h3>
        <input id="price" class="priceValue" value="$0" maxlength="6" name="price" type="text" />
    </div>
    <div class="ride_notes">
        <label>Ride Notes:</label>
        <textarea rows="2" cols="10" name="ridenotes"></textarea>
    </div>
    <input type="hidden" id="mileage" name="mileage" />
    <input type="hidden" id="departShort" name="departShort" />
    <input type="hidden" id="departLat" name="departLat" />
    <input type="hidden" id="departLon" name="departLon" />
    <input type="hidden" id="arriveShort" name="arriveShort" />
    <input type="hidden" id="arriveLat" name="arriveLat" />
    <input type="hidden" id="arriveLon" name="arriveLon" />
    <button type="submit" id="post" class="button">Post Ride</button>
    <?php form_close(); ?>
</div>