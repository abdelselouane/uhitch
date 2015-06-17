<div id="ride_feeds-container">
    <h3>Surrounding Rides</h3>
    
    <div id="ride_feeds">
        <?php if(!$ticker || count($ticker) < 1) { ?>
            <div class="no_ticker">
                <span>
                    <br/>
                    There Currently aren&#39;t any 
                    Rides Near Your Location
                </span>
            </div>
        <?php
            } else {
                for($i = 0; $i < count($ticker); $i++) {
                    $start = $ticker[$i]["DepartShort"];
                    $finish = $ticker[$i]["ArriveShort"];
                    $price = $ticker[$i]["Price"];
                    $passengers = $ticker[$i]["Passengers"];
                    $id = $ticker[$i]["Ride_ID"];
                    $driver = $ticker[$i]["Driver_Name"];
                   
                    if($price === NULL) 
                        { $price = 'N/A'; }
                        
                    if($passengers === NULL ||
                            $passengers === '') {
                        $passengers = 'N/A';
                    }
        ?>
            <div class="ride_ticker" value="<?=$id?>">
                <!--<figure></figure>-->
                <div class="ride_information">
                    <span class="ride_found">
                        <?=$start;?> &#x21c6; <?=$finish;?> 
                    </span>
                    <span class="ride_details">
                        <?=$driver?><br/> 
                        <?=$passengers?> Seats Left
                    </span>
                </div>
                <div class="ride_price">
                    <?='$'.$price?>
                    <span class="per_seat">Per Seat</span>
                </div>
            </div>

        <?php 
                }
            }
        ?>

    </div>
    <a href="<?=site_url('main/postride');?>">Post Your Ride</a>
</div>