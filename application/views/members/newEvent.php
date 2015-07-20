<div id="page_content">
    <div id="page">
        <section id="members">
            <?php 
                // Form Settings
                $form_attr = array(
                    'name' => 'submitevent',
                    'id'=>'submit_event'
                );   
                echo form_open_multipart('main/eventsubmission', $form_attr); 
            ?>
            <div id="events">
                <input type="hidden" id="eventLat" value="" name="eventLat"/>
                <input type="hidden" id="eventLon" value="" name="eventLon"/>
                <h3 class="title" >Submit New Event</h2>
                
                <div class="form-group">
                    <label for="name">Event Name <span class="asterisk">*</span></label>
                    <input type="text" class="form-control" id="name" name="Name" placeholder="Event Name" required/>
                </div>
                <div class="form-group">
                    <label for="autocomplete">Event Location <span class="asterisk">*</span></label>
                    <input type="text" id="autocomplete" class="eventAddress form-control" name="event_address" placeholder="Event Address" required/><!--this is a class eventAddress-->
                </div>
                
                <div id="event-location">
                    <input type="text" class="eventCity form-control" id="locality" name="event_city" placeholder="City" required/>
                    <input type="text" class="eventState form-control" id="administrative_area_level_1" name="event_state" placeholder="State" maxlength="2" required/>
                    <input type="text" id="postal_code" class="eventZip form-control" name="event_zip" placeholder="Zip" required/>
                </div>
                
                <div class="form-group">
                    <label>Event Date <span class="asterisk">*</span></label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input id="event-date" name="event_date" type='text' class="form-control" value="" required/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Event Time <span class="asterisk">*</span></label>
                    <div class='input-group date' id='datetimepicker2'>
                        <input type='text' id="event-time"  name="event_time" class="form-control" value="" required/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="add_file">Upload Event Photo <span class="asterisk">*</span></label>
                    <input id="add_file" type="file" class="form-control" name="userfile" required/>
                </div>
                
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea id="comments" cols="" rows="5" class="form-control" name="Comments">&nbsp;</textarea>
                </div>
                
                <div class="form-group">
                    <p class="alert alert-danger" style="width:55%; margin: 0 auto;"> All fields marked by (*) are required.</p>
                </div>
                
                <div class="form-group">
                    <button id="submit-btn" class="button" type="submit">Save Event</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </section>
    </div>
</div>   
