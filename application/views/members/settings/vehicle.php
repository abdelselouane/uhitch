<!--?php echo '<pre>'; print_r($data); echo '</pre>';?-->
<hr/>
<h3>Vehicle Information</h3>
<div class="section">
    <div id='selectInline'>
        <select id='vehicle_year' class="vehicle" size="1">
            <option value="">Select Year</option>
            <?php for($i = date('Y'); $i >= 1990; $i--) : ?>
               <option value='<?php echo $i;?>' <?= ($data->year == $i) ? 'selected': '';?>><?php echo $i;?></option>";        
            <?php endfor; ?>
        </select>
        <select id='vehicle_make' class="vehicle" size="1">
            <option value="">Select Make</option>
            <?= ($data->make) ? '<option value="'.$data->make.'" selected>'.$data->make.'</option>': '';?>
        </select>
        <select id='vehicle_model' class="vehicle" size="1">
            <option value="">Select Model</option>
            <?= ($data->model) ? '<option value="'.$data->model.'" selected>'.$data->model.'</option>': '';?>
        </select>
        <select id='vehicle_color' class="vehicle" size="1">
            <option value="">Select Color</option>
            <option value="White" <?= ($data->color == 'White') ? 'selected': '';?>>White</option>
            <option value="Black" <?= ($data->color == 'Black') ? 'selected': '';?>>Black</option>
            <option value="Silver" <?= ($data->color == 'Silver') ? 'selected': '';?>>Silver</option>
            <option value="Grey" <?= ($data->color == 'Grey') ? 'selected': '';?>>Grey</option>
            <option value="Silver" <?= ($data->color == 'Silver') ? 'selected': '';?>>Silver</option>
            <option value="Red" <?= ($data->color == 'Red') ? 'selected': '';?>>Red</option>
            <option value="Blue" <?= ($data->color == 'Blue') ? 'selected': '';?>>Blue</option>
            <option value="Brown" <?= ($data->color == 'Brown') ? 'selected': '';?>>Brown/Beige</option>
            <option value="Yellow" <?= ($data->color == 'Yellow') ? 'selected': '';?>>Yellow</option>
            <option value="Gold" <?= ($data->color == 'Gold') ? 'selected': '';?>>Gold</option>
            <option value="Green" <?= ($data->color == 'Green') ? 'selected': '';?>>Green</option>
            <option value="Pink" <?= ($data->color == 'Pink') ? 'selected': '';?>>Pink</option>
            <option value="Purple" <?= ($data->color == 'Purple') ? 'selected': '';?>>Purple</option>
        </select>
    </div>
</div>
<button class="settings button" 
    value="vehicle">Update Vehicle</button>