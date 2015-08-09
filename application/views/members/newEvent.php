<div id="page_content">
    <div id="page">
        <section id="members">
            <?php //echo '<pre>'; print_r($this->event); echo '</pre>';
                // Form Settings
                $form_attr = array(
                    'name' => 'submitevent',
                    'id'=>'submit_event'
                );   
                echo form_open_multipart('main/eventsubmission', $form_attr); 
            ?>
            <div id="events">
                <input type="hidden" id="eventLat" value="<?=(isset($this->event['Lat'])) ? $this->event['Lat'] : '';?>" name="eventLat"/>
                <input type="hidden" id="eventLon" value="<?=(isset($this->event['Lon'])) ? $this->event['Lon'] : '';?>" name="eventLon"/>
                <h3 class="title green header-line" ><i class="fa fa-pencil"></i>&nbsp;Your Event Form</h3>
                <div class="form-group">
                    <p class="alert alert-warning" style="width:55%; margin: 0 auto;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Important!</strong><br>All fields marked by (*) are required.
                    </p>
                </div>
                <div class="form-group">
                    <label class="form-label-55" for="name"><i class="fa fa-glass"></i>&nbsp;Event Name <span class="asterisk">*</span></label>
                    <input type="text" class="form-control" id="name" name="Name" value="<?=(isset($this->event['Name'])) ? $this->event['Name'] : '';?>" placeholder="Event Name" required/>
                </div>
                <div class="form-group">
                    <label class="form-label-55" for="autocomplete"><i class="fa fa-map-marker"></i>&nbsp;Event Location <span class="asterisk">*</span></label>
                    <input type="text" id="autocomplete" class="eventAddress form-control" name="event_address" value="<?=(isset($this->event['Location'])) ? $this->event['Location'] : '';?>" placeholder="Event Address" required/><!--this is a class eventAddress-->
                </div>
                
                <div id="event-location">
                    <input type="text" class="eventCity form-control" id="locality" name="event_city" value="<?=(isset($this->event['City'])) ? $this->event['City'] : '';?>" placeholder="City" required/>
                    <input type="text" class="eventState form-control" id="administrative_area_level_1" name="event_state" value="<?=(isset($this->event['State'])) ? $this->event['State'] : '';?>" placeholder="State" maxlength="2" required/>
                    <input type="text" id="postal_code" class="eventZip form-control" name="event_zip" value="<?=(isset($this->event['Zip'])) ? $this->event['Zip'] : '';?>" placeholder="Zip" required/>
                </div>
                
                <div class="form-group">
                    <label class="form-label-55" for="event-date"><i class="fa fa-calendar"></i>&nbsp;Event Date <span class="asterisk">*</span></label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input id="event-date" name="event_date" type='text' class="form-control" value="<?=(isset($this->event['EventDate'])) ? date('m/d/Y', strtotime($this->event['EventDate'])) : '';?>" placeholder="Enter date" required/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label-55" for="event-time"><i class="fa fa-clock-o"></i>&nbsp;Event Time <span class="asterisk">*</span></label>
                    <div class='input-group date' id='datetimepicker2'>
                        <input type='text' id="event-time"  name="event_time" class="form-control" placeholder="Enter time" value="<?=(isset($this->event['EventTime'])) ? $this->event['EventTime'] : '';?>" required/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label-55" for="add_file"><i class="fa fa-folder-open"></i>&nbsp;Upload Event Photo <span class="asterisk">*</span></label>
                    <?php if(isset($this->event['Photo'])){ 
                        $imagepath = file_exists("assets/photos/events/".$this->event['Photo']) ? "assets/photos/events/".$this->event['Photo'] : "assets/photos/events/default.png";
                        $imageUrl = base_url($imagepath);
                    ?>
                    <div class="imgFileContainer">
                        <img src="<?= $imageUrl ?>" class="img-center" width="300px" height="auto" >
                        <input type="hidden" id="updatefile" name="updatefile" value="<?= $this->event['Photo'] ?>"/>
                    </div>
                    <?php } ?>
                    <div class="fileContainer" <?= (isset($this->event['EventId'])) ? 'style="display:none;"' : ''  ?>>
                        <input id="add_file" type="file" class="form-control" name="userfile" required/>
                        <span class="form-info-span">ONLY [PNG, JPG, JPEG] 4000MB 800x500</span>
                    </div>
                    <?php if(isset($this->event['Photo'])){ ?>
                        <button id="updatePhoto" class="btn btn-primary text-uppercase" style="width:200px"><i class="fa fa-upload"></i>&nbsp;Upload New Photo</button>
                    <?php } ?>
                </div>
                
                <div class="form-group">
                    <label class="form-label-55" for="website"><i class="fa fa-globe"></i>&nbsp;Website: </label>
                    <input type="url" class="form-control" id="website" name="Website" value="<?=(isset($this->event['Website'])) ? $this->event['Website'] : '';?>" placeholder="Enter event website"/>
                </div>
                
                <div class="form-group">
                    <label class="form-label-55" for="facebook"><i class="fa fa-facebook"></i>&nbsp;Facebook: </label>
                    <input type="url" class="form-control" id="facebook" name="Facebook" value="<?=(isset($this->event['Facebook'])) ? $this->event['Facebook'] : '';?>" placeholder="Enter facebook link"/>
                </div>
                
                <div class="form-group">
                    <label class="form-label-55" for="twitter"><i class="fa fa-twitter"></i>&nbsp;Twitter: </label>
                    <input type="url" class="form-control" id="twitter" name="Twitter" value="<?=(isset($this->event['Twitter'])) ? $this->event['Twitter'] : '';?>" placeholder="Enter twitter link"/>
                </div>
                
                <div class="form-group">
                    <label class="form-label-55" for="instagram"><i class="fa fa-instagram"></i>&nbsp;Instagram: </label>
                    <input type="url" class="form-control" id="instagram" name="Instagram" value="<?=(isset($this->event['Instagram'])) ? $this->event['Instagram'] : '';?>" placeholder="Enter instagram link"/>
                </div>
                
                <div class="form-group">
                    <label class="form-label-55" for="googleplus"><i class="fa fa-google-plus"></i>&nbsp;Google Plus: </label>
                    <input type="url" class="form-control" id="googleplus" name="Googleplus" value="<?=(isset($this->event['Googleplus'])) ? $this->event['Googleplus'] : '';?>" placeholder="Enter google plus link"/>
                </div>
                
                <div class="form-group">
                    <label class="form-label-55" for="description"><i class="fa fa-fax"></i>&nbsp;Description:</label>
                    <textarea id="description" cols="" rows="10" class="form-control" name="Description" placeholder="Enter event description"><?=(isset($this->event['Description'])) ? $this->event['Description'] : '';?></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label-55" for="comments"><i class="fa fa-list"></i>&nbsp;Comments</label>
                    <textarea id="comments" cols="" rows="10" class="form-control" name="Comments" placeholder="Enter your comment"><?=(isset($this->event['Comments'])) ? $this->event['Comments'] : '';?></textarea>
                </div>
                
                <div class="form-group">
                    <input type="hidden" id="EventId" name="EventId" value="<?= (isset($this->event['EventId'])) ? $this->event['EventId'] : ''  ?>"/>
                    <button id="submit-btn" class="btn btn-primary text-uppercase" style="width:200px" type="submit"><?= (isset($this->event['EventId'])) ? '<i class="fa fa-edit"></i>&nbsp;Update Event' : '<i class="fa fa-save"></i>&nbsp;Save Event' ?></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </section>
    </div>
</div>   
