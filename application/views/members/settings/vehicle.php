<hr/>
<h3>Vehicle Information</h3>
<div class="section">
    <div id='selectInline' class="vehicle">
        <select id='vehicle_year' size="1">
            <option value="">Select Year</option>
            <?php for($i = date('Y'); $i >= 1990; $i--) : ?>
               <option value='<?php echo $i;?>'><?php echo $i;?></option>";        
            <?php endfor; ?>
        </select>
        <select id='vehicle_make' size="1">
            <option value="">Select Make</option>
        </select>
        <select id='vehicle_model' size="1">
            <option value="">Select Model</option>
        </select>
        <select id='vehicle_color' size="1">
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
    </div>
</div>
<button class="settings button" 
    value="vehicle">Update Vehicle</button>