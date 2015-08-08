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
                <h3 class="title" >Submit New Event</h2>
                
                <div class="form-group">
                    <label for="name">Event Name <span class="asterisk">*</span></label>
                    <input type="text" class="form-control" id="name" name="Name" value="<?=(isset($this->event['Name'])) ? $this->event['Name'] : '';?>" placeholder="Event Name" required/>
                </div>
                <div class="form-group">
                    <label for="autocomplete">Event Location <span class="asterisk">*</span></label>
                    <input type="text" id="autocomplete" class="eventAddress form-control" name="event_address" value="<?=(isset($this->event['Location'])) ? $this->event['Location'] : '';?>" placeholder="Event Address" required/><!--this is a class eventAddress-->
                </div>
                
                <div id="event-location">
                    <input type="text" class="eventCity form-control" id="locality" name="event_city" value="<?=(isset($this->event['City'])) ? $this->event['City'] : '';?>" placeholder="City" required/>
                    <input type="text" class="eventState form-control" id="administrative_area_level_1" name="event_state" value="<?=(isset($this->event['State'])) ? $this->event['State'] : '';?>" placeholder="State" maxlength="2" required/>
                    <input type="text" id="postal_code" class="eventZip form-control" name="event_zip" value="<?=(isset($this->event['Zip'])) ? $this->event['Zip'] : '';?>" placeholder="Zip" required/>
                </div>
                
                <div class="form-group">
                    <label>Event Date <span class="asterisk">*</span></label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input id="event-date" name="event_date" type='text' class="form-control" value="<?=(isset($this->event['EventDate'])) ? date('m/d/Y', strtotime($this->event['EventDate'])) : '';?>" required/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Event Time <span class="asterisk">*</span></label>
                    <div class='input-group date' id='datetimepicker2'>
                        <input type='text' id="event-time"  name="event_time" class="form-control" value="<?=(isset($this->event['EventTime'])) ? $this->event['EventTime'] : '';?>" required/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="add_file">Upload Event Photo <span class="asterisk">*</span></label>
                    <?php if(isset($this->event['Photo'])){ 
                        $imagepath = file_exists("assets/photos/events/".$this->event['Photo']) ? "assets/photos/events/".$this->event['Photo'] : "assets/photos/events/default.png";
                        $imageUrl = base_url($imagepath);
                    ?>
                    <div class="imgFileContainer">
                        <img src="<?= $imageUrl ?>" class="img-center" width="200px" height="auto" >
                        <input type="hidden" id="updatefile" name="updatefile" value="<?= $this->event['Photo'] ?>"/>
                    </div>
                    <?php } ?>
                    <div class="fileContainer" <?= (isset($this->event['EventId'])) ? 'style="display:none;"' : ''  ?>>
                        <input id="add_file" type="file" class="form-control" name="userfile" required/>
                    </div>
                    <?php if(isset($this->event['Photo'])){ ?>
                        <button id="updatePhoto" class="btn btn-primary">Update Photo</button>
                    <?php } ?>
                </div>
                
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea id="comments" cols="" rows="5" class="form-control" name="Comments"><?=(isset($this->event['Comments'])) ? $this->event['Comments'] : '';?></textarea>
                </div>
                
                <div class="form-group">
                    <p class="alert alert-danger" style="width:55%; margin: 0 auto;"> All fields marked by (*) are required.</p>
                </div>
                
                <div class="form-group">
                    <input type="hidden" id="EventId" name="EventId" value="<?= (isset($this->event['EventId'])) ? $this->event['EventId'] : ''  ?>"/>
                    <button id="submit-btn" class="btn btn-primary" style="width:200px" type="submit"><?= (isset($this->event['EventId'])) ? 'Update Event' : 'Save Event' ?></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </section>
    </div>
</div>   
