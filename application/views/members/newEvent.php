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
                <h2>Submit New Event</h2>
                <span>Event Name</span>
                
                <input type="text" id="name" name="Name" placeholder="Event Name" required/>
                
                <span>Event Location</span>
                <input type="text" id="autocomplete" class="eventAddress"  
                       name="event-address" placeholder="Event Address" required/>
                <div id="event-location">
                    <input type="text" class="eventCity" id="locality" name="event-city" placeholder="City" required/>
                    <input type="text" class="eventState" id="administrative_area_level_1" name="event-state" placeholder="State" maxlength="2" required/>
                    <input type="text" id="postal_code" class="eventZip" name="event-zip" placeholder="Zip" required/> 
                </div>
                <span>Event Time &#38; Date</span>
                <div id="event-time">
                    <input type="date" class="eventDate"
                           name="event-date" required />
                    <input type="time" class="eventTime"
                            name="event-time" required />
                </div>
                
                <span>Upload Event Photo</span>
                <input id="add_file" type="file" name="userfile" required/>
                <br/>
                <span>Comments</span>
                <textarea name="Comments">&nbsp;</textarea>
                <button id="submit-btn" class="button" type="submit">Save Event</button>
            </div>
            <?php echo form_close(); ?>
        </section>
    </div>
</div>   
