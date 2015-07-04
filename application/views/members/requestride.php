<div style="margin-top: 120px"></div>

<?php 

//echo '<pre>'; print_r($ride); echo '</pre>'; 

$i = 1;
$empty_seats = 0;
$occupied_seats = 0;
foreach($ride as $key => $value){
    if( $key == 'Passenger'.$i.'_ID'){
        if( $value == '' ){
            $empty_seats += 1;
        }else{
            $occupied_seats += 1;
        }
        $i += 1;
    }
}

//echo 'Occupied: '.$occupied_seats.'<br>';
//echo 'Empty: '.$empty_seats;

 $imagepath = file_exists("assets/photos/users/".$ride['Photo']) ? "assets/photos/users/".$ride['Photo'] : "assets/photos/default.png";
     $imageUrl = base_url($imagepath);
?>
<div id="requestride">
    <h2>Ride Information</h2>
    <hr>
    <div class="driver-info">
        <h3>Driver Information</h3>
        <figure>
            <img src="<?= $imageUrl ?>" alt="<?= $ride['Full_Name'];?>">
        </figure>
        <div class="form-group right">
            <label>Driver Name:</label>
            <p><?= isset($ride['Full_Name']) ? $ride['Full_Name'] : 'Driver Full Name ?';?></p>
            <label>Email Address:</label>
            <p><?= isset($ride['Email_Address']) ? $ride['Email_Address'] : 'Driver Email Address ?';?></p>
            <label>School Name:</label>
            <p><?= isset($ride['School_Name']) ? $ride['School_Name'] : 'Driver School Name ?';?></p>
        </div>
    </div>
    <div class="clear"></div>
    <div class="ride-info">
        <h3>Ride Information</h3>
        <div class="form-group left">
            <label>Ride Name:</label>
            <p><?= isset($ride['Name']) ? $ride['Name'] : 'Ride Name ?';?></p>
            <label>Depart From:</label>
            <p><?= isset($ride['DepartShort']) ? $ride['DepartShort'] : 'Driver Depart Address ?';?></p>
            <label>Arrive To:</label>
            <p><?= isset($ride['ArriveShort']) ? $ride['ArriveShort'] : 'Driver Arrive Name ?';?></p>
        </div>
        <div class="form-group right">
            <label>Distance:</label>
            <p><?= isset($ride['Distance']) ? $ride['Distance'].' Miles' : 'Driver Full Name ?';?></p>
            <label>Depart At:</label>
            <p><?= ( isset($ride['DepartDate']) && isset($ride['DepartTime']) ) ? date('M d, Y g:i a', strtotime($ride['DepartDate']. $ride['DepartTime'])) : 'Depart Date Time ?';?></p>
            <label>Total expected passengers:</label>
            <p><?= isset($ride['Passengers']) ? $ride['Passengers'] : 'Passengers ?';?></p>
        </div>
        <div class="clear"></div>
        <p class="alert alert-danger">
            <strong>NOTE:</strong> The total of the expected passengers is not confirmed yet, please click the link to contact the driver <a href="<?=site_url('main/messages?q='.$ride['Driver_ID']);?>">Click Here <i class="fa fa-long-arrow-right"></i></a>
        </p>
    </div>
    <div class="clear"></div>
    <div class="Vehicle-info">
        <h3>Vehicle Information</h3>
        <div class="form-group left">
            <label>Vehicle Color:</label>
            <p class="text-uppercase"><?= isset($ride['Make']) ? $ride['Make'] : 'Vehicle Make Name ?';?></p>
            <label>Vehicle Model:</label>
            <p class="text-uppercase"><?= ( isset($ride['Year']) && isset($ride['Model']) ) ? $ride['Model'].' - '.$ride['Year'] : 'Vehicle Model/Year ?';?></p>
            <label>Vehicle Color:</label>
            <p class="text-uppercase"><span class="v-color" style="background-color:<?= isset($ride['Color']) ? $ride['Color'] : '#fff';?>"></span><?= isset($ride['Color']) ? $ride['Color'] : 'NA';?></p>
        </div>
        <div class="form-group right">
            <label>Total Seats:</label>
            <p><?= isset($ride['Passengers']) ? $ride['Passengers'] : 'Vehicle Seats ?';?></p>
            <label>Occupied Seats:</label>
            <p><?php echo $occupied_seats;?></p>
            <label>Available Seats:</label>
            <p><?php echo $empty_seats = $ride['Passengers'] - $occupied_seats;?></p>
        </div>
        <div class="clear"></div>
        <?php if($empty_seats != 0){ ?>
        <p class="alert alert-success">
            <i class="fa fa-check"></i> <strong>Congrats</strong>, there are <?= ($empty_seats == 1) ? $empty_seats.' seat' : $empty_seats.' seats'?> available, please place your reservation <strong>NOW <i class="fa fa-arrow-down"></i></strong>
        </p>
        <?}else{?>
        <p class="alert alert-danger">
            <strong>SORRY:</strong> The seats are all occupied, please check out other rides to your destination <a href="<?=site_url();?>">Click Here <i class="fa fa-long-arrow-right"></i></a>
        </p>
        <?}?>
    </div>
    <div class="clear"></div>
    <div class="cost-info">
        <?php if( $ride['Charge'] == 'seat' || $ride['Charge'] == 'both' ){?>
        <div class="form-group alert <?= ($empty_seats != 0) ? 'alert-success' : 'alert-danger' ?>">
            <h5>How many seats you would like to reserve?</h5>
            <p class="<?= ($empty_seats != 0) ? 'active' : 'occupied' ?>"><?= isset($ride['Price']) ? '$'.$ride['Price'].' / Seat' : ''?></p>
            <form id="select_form" name="select_form" >
                <div class="form-group left">
                    <select class="form-control" id="select_seats" name="select_seats">
                        <option value="">How many Seats?</option>
                        <?php
                            for($i=1; $i <= $empty_seats; $i++){
                        ?>
                            <option value="<?=$i?>"><?= ($i == 1) ? $i.' Seat' : $i.' Seats'?></option>
                        <?
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group right">
                    <p class="result-text"></p>
                    <input type="hidden" id="price" name="price" value="<?= isset($ride['Price']) ? $ride['Price'] : ''?>">
                    <input type="hidden" id="result" name="result">
                </div>
                <button type="submit" class="btn btn-default <?= ($empty_seats != 0) ? 'active' : 'occupied' ?>" <?= ($empty_seats != 0) ? '' : 'disabled' ?>>
                    <?= ($empty_seats != 0) ? 'RESERVE NOW' : '<i class="fa fa-minus-circle"></i> OPTION NOT AVAILABLE' ?></button>
            </form>
        </div>
        <?php } ?>
        <div class="clear"></div>
        <div style="margin-left: 20px;" class="form-group left alert <?=  ($empty_seats != 0) ? ( ($ride['Charge'] == 'seat' || $ride['Charge'] == 'both') ? 'alert-success' : 'alert-danger') : 'alert-danger' ?>">
            <h5>Reserve One Only</h5>
            <p class="<?= ($empty_seats != 0) ? ( ($ride['Charge'] == 'both' || $ride['Charge'] == 'seat')  ? 'active' : 'occupied' ) : 'occupied' ?>"><?= isset($ride['Price']) ? '$'.$ride['Price'] : ''?></p>
            <form>
                <button type="submit" class="btn btn-default <?= ($empty_seats != 0) ? ( ($ride['Charge'] == 'both' || $ride['Charge'] == 'seat')  ? 'active' : 'occupied' ) : 'occupied'?>" <?= ($empty_seats != 0) ? ( ($ride['Charge'] == 'both' || $ride['Charge'] == 'seat') ? '' : 'disabled') : 'disabled' ?>>
                <?= ($empty_seats != 0) ? ( ($ride['Charge'] == 'both' || $ride['Charge'] == 'seat') ? 'Reserve All Available Seats' : '<i class="fa fa-minus-circle"></i> OPTION NOT AVAILABLE' ) : '<i class="fa fa-minus-circle"></i> OPTION NOT AVAILABLE'?></button>
            </form>
        </div>
        <div class="form-group right alert <?=  ($empty_seats != 0) ? ( ($ride['Charge'] == 'trip' || $ride['Charge'] == 'both') ? 'alert-success' : 'alert-danger') : 'alert-danger' ?>">
            <h5>Reserve All Available</h5>
            <p class="<?= ($empty_seats != 0) ? ( ($ride['Charge'] == 'both' || $ride['Charge'] == 'trip')  ? 'active' : 'occupied' ) : 'occupied' ?>"><?= isset($ride['Ride_Cost']) ? '$'.$ride['Ride_Cost'] : ''?></p>
            <form>
                <button type="submit" class="btn btn-default <?= ($empty_seats != 0) ? ( ($ride['Charge'] == 'both' || $ride['Charge'] == 'trip')  ? 'active' : 'occupied' ) : 'occupied'?>" <?= ($empty_seats != 0) ? ( ($ride['Charge'] == 'both' || $ride['Charge'] == 'trip') ? '' : 'disabled') : 'disabled' ?>><?= ($empty_seats != 0) ? ( ($ride['Charge'] == 'both' || $ride['Charge'] == 'trip') ? 'Reserve All Available Seats' : '<i class="fa fa-minus-circle"></i> OPTION NOT AVAILABLE' ) : '<i class="fa fa-minus-circle"></i> OPTION NOT AVAILABLE'?></button>
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>