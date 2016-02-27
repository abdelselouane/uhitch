<?
    //echo '<pre>'; print_r($ticker); echo '</pre>';
?>
<div class="row">
    <div class="col-md-10">
            <h3 class="title green title-box text-center">Surrounding Rides</h3>
            <table id="surroundingRideListing" class="display">
                <thead>
                    <tr>
                        <th class="center">&nbsp;</th>
                        <th class="left">Departure</th>
                        <th class="left">Arrival</th>
                        <th class="left">Driver</th>
                        <th class="center">Seats Left</th>
                        <th class="center">Per Seat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($ticker) && count($ticker)>0) {
                        for($i = 0; $i < count($ticker); $i++) {
                            $class = ($i%2==0) ? 'odd' : 'even';
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
                            <tr class="green-odd ride_ticker" value="<?=$id?>">
                                <td class="center"><a class="green" href="<?=base_url().'index.php/main/hitchARide?q='.$id?>"><i class="fa fa-road"></i>&nbsp;</a></td>
                                <td><?=$start;?></td>
                                <td><?=$finish;?></td>
                                <td><?=$driver?></td>
                                <td class="center"><?=$passengers?></td>
                                <td class="center"><?='$'.$price ?>&nbsp;</td>
                            </tr>
                        <?php 
                                }
                            }
                        ?>
                </tbody>
            </table>
            <input type="hidden" id="url" value="<?=base_url()?>"><br><br>
        <a href="<?=site_url('main/postride');?>" class="btn btn-primary text-uppercase" style="width: 100%;"><i class="fa fa-road"></i>&nbsp;Post Your Ride</a>
            <br><br>
        </div>
    </div>
</div>