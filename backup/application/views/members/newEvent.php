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
                <h2>Submit New Event</h2>
                <span>Event Name</span>
                
                <input type="text" id="name" name="Name" placeholder="Event Name"
                       required/>
                
                <span>Event Location</span>
                <input type="text" id="autocomplete" class="eventAddress" required
                       name="event-address" placeholder="Event Address" />
                <div id="event-location">
                    <input type="text" class="eventCity" id="locality" required
                       name="event-city" placeholder="City"/>
                    <input type="text" class="eventState" id="administrative_area_level_1"
                           name="event-state" placeholder="State" maxlength="2" required/>
                    <input type="text" id="postal_code" class="eventZip"
                           name="event-zip" placeholder="Zip"/> 
                </div>
                <span>Event Time &#38; Date</span>
                <div id="event-time">
                    <input type="date" class="eventDate"
                           name="event-date" required/>
                    <input type="time" class="eventTime"
                            name="event-time" required/>
                </div>
                
                <span>Upload Event Photo</span>
                <input id="add_file" 
                       type="file" name="userfile" />
                
                <br/>
                <span>Comments</span>
                <textarea name="Comments"></textarea>
                <button class="button" type="submit">Save Event</button>
            </div>
            
            <input hidden id="eventLat" value="" name="eventLat"/>
            <input hidden id="eventLon" value="" name="eventLon"/>
            <?php echo form_close(); ?>
        </section>
    </div>
</div>   
