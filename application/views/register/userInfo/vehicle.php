<?php if($msg === 'yes') { ?>
    <h2>Register Vehicle</h2>
    <p class="info">To add a vehicle, start by selecting the Model Year.</p>

    <div id="vehicle_container">
        <select id="vehicle_year" name="vehicle_year" size="1">
            <option value="">Select Model Year</option>
            <?php 
                for($i = date("Y"); $i >= 1990; $i--)
                { echo '<option value="'.$i.'">'.$i.'</option>'; }                      
            ?>
        </select> 

        <select name="vehicle_make" id='vehicle_make' size="1">
            <option value="">Select Make</option>
        </select> 

        <select name="vehicle_model" id="vehicle_model" size="1">
            <option value="">Select Model</option>
        </select> 

        <select name="vehicle_color" id="vehicle_color" size="1">
            <option value="">Select Color</option>
            <option value="White">White</option>
            <option value="Black">Black</option>
            <option value="Silver">Silver</option>
            <option value="Grey">Grey</option>
            <option value="Silver">Silver</option>
            <option value="Red">Red</option>
            <option value="Blue">Blue</option>
            <option value="Brown">Brown/Beige</option>
            <option value="Yellow">Yellow</option>
            <option value="Gold">Gold</option>
            <option value="Green">Green</option>
            <option value="Pink">Pink</option>
            <option value="Purple">Purple</option>
        </select>
        
        <input type="hidden" name="vehicle_flag" id="vehicle_flag" value="submitVehicle">
        
    </div>
<?php } ?>