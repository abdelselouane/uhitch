<div id="page_content">
    <div id="page">
        <section id="members">
            <div id="ride_message">
                <h2 class="alt">Register Vehicle</h2>
                <p class="msg">
                    We've noticed you haven't Registered your Vehicle <br/>
                    If you wish to Post Rides, please Register Below
                </p> 
            </div>
            <?php
                $form_attr = array(
                    'name' => 'vehicleform',
                    'id'   => 'vehicle_form',
                    'novalidate' => ''
                );
                echo form_open('main/registerVehicle', $form_attr);
            ?>
            <div id="vehicle_container" ng-controller="vehicleSelection">
                <select id="vehicle" name="vehicle_year" ng-model="year" 
                        size="1" required>
                    <option value="">Select Model Year</option>
                    <?php 
                        for($i = date("Y") + 1; $i >= 1980; $i--)
                            { echo '<option value="'.$i.'">'.$i.'</option>'; }                      
                    ?>
                </select> 

                <select name="vehicle_make" id='vehicle' 
                        ng-class="{ 'disable' : !year }"
                        ng-model="make" ng-disabled="!year" size="1"
                        ng-options="vehicle for (vehicle, make) in vehicles"
                        required>
                    <option value="">Select Make</option>
                </select> 

                <select name="vehicle_model" id="types" 
                        ng-class="{ 'disable' : !make }"
                        ng-model="model" ng-disabled="!make" size="1"
                        ng-options="model for (types, model) in make"
                        required>
                    <option value="">Select Model</option>
                </select> 

                <select name="vehicle_color" 
                        ng-class="{ 'disable' : !year }"
                        ng-disabled="!model" ng-model="color" size="1"
                        required>
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
            <span id='btn'>
                <button class="button" type="submit" 
                        ng-disabled="vehicleform.$invalid && vehicleform.$error"
                        ng-class="{'btnoff' : vehicleform.$invalid && vehicleform.$error}">
                    Save
                </button>
                <a class="button" href="<?=site_url('main/')?>">Skip</a>
            </span>
            <?php echo form_close(); ?>
        </section>
        <script src="<?=base_url()?>assets/js/registration.js"></script>
    </div>
</div>