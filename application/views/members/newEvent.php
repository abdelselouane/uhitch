<div id="page_content">
    <div id="page">
        <section id="members">
            <?php //echo '<pre>'; print_r($this->event); echo '</pre>';
                // Form Settings
                $form_attr = array(
                    'name' => 'submitevent',
                    'id'=>'submit_event',
                    'enctype'=>"multipart/form-data"
                );   
                echo form_open_multipart('main/eventsubmission', $form_attr); 
            ?>
            <div id="events">
                <?php if(isset($this->event['admin']) && $this->event['admin'] == 1 ){?>
                <input type="hidden" id="admin" name="admin" value="<?=(isset($this->event['admin'])) ? $this->event['admin'] : '';?>">
                <?php } ?>
                <?php if(isset($this->event['plan'])){?>
                <input type="hidden" id="plan" name="plan" value="<?=(isset($this->event['plan'])) ? $this->event['plan'] : '';?>">
                <?php } ?>
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
                    
                    <label class="form-label-55">
                        <i class="fa fa-folder-open"></i>&nbsp;Upload Event Photo <span class="asterisk">*</span>
                        <?php if(isset($this->event['plan']) && $this->event['plan'] != 'basic'){?>
                        <a data-plan="<?= $this->event['plan']?>" id="add-more" class="btn btn-success" style="float:right;"><i class="fa fa-plus"></i></a>
                        <a id="remove-input" class="btn btn-success" style="float:right;  margin-right:5px;"><i class="fa fa-minus"></i></a>
                        <?php } ?>
                    </label>
                    
                    <div class="imgFileContainer">
                        
                    <?php if(isset($this->event['Photo'])){ 
                        $imagepath = file_exists("assets/photos/events/".$this->event['Photo']) ? "assets/photos/events/".$this->event['Photo'] : "assets/photos/events/default.png";
                        $imageUrl = base_url($imagepath);
                    ?>
                        <div class="img-box">
                            <a href="<?= $imageUrl ?>">
                                <img src="<?= $imageUrl ?>" class="img-thumbnail">
                            </a>
                            <button data-id="" class="btn btn-primary img-update" style="">
                                <i class="fa fa-edit"></i>
                            </button>
                            <input type="hidden" id="updatefile" name="updatefile" value="<?= $this->event['Photo'] ?>"/>
                        </div>
                    <?php } ?>
                        
                    <?php if(isset($this->event['Photo1'])){ 
                        $imagepath1 = file_exists("assets/photos/events/".$this->event['Photo1']) ? "assets/photos/events/".$this->event['Photo1'] : "assets/photos/events/default.png";
                        $imageUrl1 = base_url($imagepath1);
                    ?>
                        <div class="img-box">
                            <a href="<?= $imageUrl1 ?>">
                                <img src="<?= $imageUrl1 ?>" class="img-thumbnail">
                            </a>
                            <button data-id="" class="btn btn-primary img-update">
                                <i class="fa fa-edit"></i>
                            </button>
                            <input type="hidden" id="updatefile" name="updatefile" value="<?= $this->event['Photo1'] ?>"/>
                        </div>
                    <?php } ?>
                        
                    <?php if(isset($this->event['Photo2'])){ 
                        $imagepath2 = file_exists("assets/photos/events/".$this->event['Photo2']) ? "assets/photos/events/".$this->event['Photo2'] : "assets/photos/events/default.png";
                        $imageUrl2 = base_url($imagepath2);
                    ?>
                        <div class="img-box">
                            <a href="<?= $imageUrl2 ?>">
                                <img src="<?= $imageUrl2 ?>" class="img-thumbnail">
                            </a>
                            <button data-id="" class="btn btn-primary img-update">
                                <i class="fa fa-edit"></i>
                            </button>
                            <input type="hidden" id="updatefile" name="updatefile" value="<?= $this->event['Photo2'] ?>"/>
                        </div>
                    <?php } ?>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="fileContainer" <?= (isset($this->event['EventId'])) ? 'style="display:none;"' : ''  ?>>
                        <input id="add_file" type="file" class="form-control file-input" name="userfile" required/>
                    </div>
                    <span class="form-info-span">ONLY [PNG, JPG, JPEG] 4000MB 800x500</span>
                    <?php if(isset($this->event['Photo'])){ ?>
                        <button id="updatePhoto" class="btn btn-primary text-uppercase" style="width:200px"><i class="fa fa-upload"></i>&nbsp;Upload New Photo</button>
                    <?php } ?>
                </div>
                
                <script type="text/javascript">
                    $(document).ready(function(){
                        
                        $('#add-more').on('click', function(){
                            var self = $(this);
                            var plan = self.attr('data-plan');
                            addMore( plan );
                        });
                        
                        $('#remove-input').on('click', function(){
                            var inputCount = countFileInput();
                            disRemove();
                            if(inputCount > 1){
                                $('.file-input').last().remove();
                            }
                        });
                        
                        $('#add-more-video').on('click', function(){
                            var self = $(this);
                            var plan = self.attr('data-plan');
                            addMoreVideo( plan );
                        });
                        
                        $('#remove-input-video').on('click', function(){
                            var inputCount = countFileInputVideo();
                            disRemoveVideo();
                            if(inputCount > 1){
                                $('.video-input').last().remove();
                            }
                        });
                        
                        var addMore = function( plan ){
                            var inputCount = countFileInput();
                            if( plan == 'brilliant' ){
                                if( inputCount < 3 ){
                                    generateInput( inputCount );
                                    disRemove();
                                }else{
                                    alert('Sorry, the total files you can upload is 3');
                                }
                            }
                            if( plan == 'professional' ){
                                if( inputCount < 5 ){
                                    generateInput( inputCount );
                                    disRemove();
                                }else{
                                    alert('Sorry, the total files you can upload is 5');
                                }
                            }
                        }
                        
                        var addMoreVideo = function( plan ){
                            var inputCount = countFileInputVideo();
                            if( plan == 'professional' ){
                                if( inputCount < 3 ){
                                    generateInputVideo( inputCount );
                                    disRemoveVideo();
                                }else{
                                    alert('Sorry, the total videos you can add is 3');
                                }
                            }
                        }
                        
                        var countFileInput = function(){
                            var children = $('.fileContainer').find('.file-input');
                            return children.length;
                        }
                        
                        var countFileInputVideo = function(){
                            var children = $('.videoContainer').find('.video-input');
                            return children.length;
                        }
                        
                        var generateInput = function( number ){
                            var html = '<input type="file" class="form-control file-input" name="userfile'+number+'" required/>';
                            $('.fileContainer').append(html);
                        }
                        
                        var generateInputVideo = function( number ){
                            var html = '<input type="url" class="form-control video-input" name="uservideo'+number+'" placeholder="Add video url" />';
                            $('.videoContainer').append(html);
                        }
                        
                        var disRemove = function(){
                            var inputCount = countFileInput();
                            if( inputCount == 1 ){
                                $('#remove-input').addClass('disabled');
                            }else{
                                $('#remove-input').removeClass('disabled');
                            }
                        }
                        disRemove();
                        
                        var disRemoveVideo = function(){
                            var inputCount = countFileInputVideo();
                            if( inputCount == 1 ){
                                $('#remove-input-video').addClass('disabled');
                            }else{
                                $('#remove-input-video').removeClass('disabled');
                            }
                        }
                        disRemoveVideo();
                        
                    });
                </script>
                <script type="text/javascript">
                    $(function(){
                        var $gallery = $('.imgFileContainer a').simpleLightbox();
                    });
                </script>
                
                <?php if(isset($this->event['plan']) && $this->event['plan'] != 'basic'){?>
                <div class="form-group">
                    <label class="form-label-55" for="video">
                        <i class="fa fa-youtube"></i>&nbsp;Youtube Video: 
                        <?php if(isset($this->event['plan']) && $this->event['plan'] == 'professional'){?>
                        <a data-plan="<?= $this->event['plan']?>" id="add-more-video" class="btn btn-success" style="float:right;"><i class="fa fa-plus"></i></a>
                        <a id="remove-input-video" class="btn btn-success" style="float:right;  margin-right:5px;"><i class="fa fa-minus"></i></a>
                        <?php } ?>
                    </label>
                    <div class="videoContainer">
                        <input type="url" class="form-control video-input" name="uservideo" value="<?=(isset($this->event['Video'])) ? $this->event['Video'] : '';?>" placeholder="Enter event video url"/>
                    </div>
                </div>
                 <?php } ?>
                
                <div class="form-group">
                    <label class="form-label-55" for="website"><i class="fa fa-globe"></i>&nbsp;Website: </label>
                    <input type="url" class="form-control" id="website" name="Website" value="<?=(isset($this->event['Website'])) ? $this->event['Website'] : '';?>" placeholder="Enter event website"/>
                </div>
                
                <div class="form-group">
                    <label class="form-label-55" for="facebook"><i class="fa fa-facebook-square"></i>&nbsp;Facebook: </label>
                    <input type="url" class="form-control" id="facebook" name="Facebook" value="<?=(isset($this->event['Facebook'])) ? $this->event['Facebook'] : '';?>" placeholder="Enter facebook link"/>
                </div>
                
                <?php if($this->event['plan']!='basic'){?>
                <div class="form-group">
                    <label class="form-label-55" for="twitter"><i class="fa fa-twitter"></i>&nbsp;Twitter: </label>
                    <input type="url" class="form-control" id="twitter" name="Twitter" value="<?=(isset($this->event['Twitter'])) ? $this->event['Twitter'] : '';?>" placeholder="Enter twitter link"/>
                </div>
                <?php } ?>
                
                <?php if($this->event['plan']!='basic'){?>
                <div class="form-group">
                    <label class="form-label-55" for="googleplus"><i class="fa fa-google-plus-square"></i>&nbsp;Google Plus: </label>
                    <input type="url" class="form-control" id="googleplus" name="Googleplus" value="<?=(isset($this->event['Googleplus'])) ? $this->event['Googleplus'] : '';?>" placeholder="Enter google plus link"/>
                </div>
                <?php } ?>
                
                <?php if($this->event['plan']=='professional'){?>
                <div class="form-group">
                    <label class="form-label-55" for="instagram"><i class="fa fa-instagram"></i>&nbsp;Instagram: </label>
                    <input type="url" class="form-control" id="instagram" name="Instagram" value="<?=(isset($this->event['Instagram'])) ? $this->event['Instagram'] : '';?>" placeholder="Enter instagram link"/>
                </div>
                <?php } ?>
                
                <?php if($this->event['plan']=='professional'){?>
                <div class="form-group">
                    <label class="form-label-55" for="pinterest"><i class="fa fa-pinterest"></i>&nbsp;Pinterest: </label>
                    <input type="url" class="form-control" id="pinterest" name="Pinterest" value="<?=(isset($this->event['Pinterest'])) ? $this->event['Googleplus'] : '';?>" placeholder="Enter pinterest link"/>
                </div>
                <?php } ?>
                
                <div class="form-group">
                    <label class="form-label-55" for="description"><i class="fa fa-fax"></i>&nbsp;Description:</label>
                    <textarea id="description" cols="" rows="10" class="form-control" name="Description" placeholder="Enter event description"><?=(isset($this->event['Description'])) ? $this->event['Description'] : '';?></textarea>
                </div>
                
                <?php if($this->event['plan']!='basic'){?>
                <div class="form-group">
                    <label class="form-label-55" for="comments"><i class="fa fa-list"></i>&nbsp;Comments</label>
                    <textarea id="comments" cols="" rows="10" class="form-control" name="Comments" placeholder="Enter your comment"><?=(isset($this->event['Comments'])) ? $this->event['Comments'] : '';?></textarea>
                </div>
                <?php } ?>
                
                <div class="form-group">
                    <input type="hidden" id="EventId" name="EventId" value="<?= (isset($this->event['EventId'])) ? $this->event['EventId'] : ''  ?>"/>
                    <button id="submit-btn" class="btn btn-primary text-uppercase" style="width:200px" type="submit"><?= (isset($this->event['EventId'])) ? '<i class="fa fa-edit"></i>&nbsp;Update Event' : '<i class="fa fa-save"></i>&nbsp;Save Event' ?></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </section>
    </div>
</div>   
