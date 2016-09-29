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
                    <?php $countPhotos = 0; $countAllowed = 0; ?>
                    <label class="form-label-55">
                        <i class="fa fa-folder-open"></i>&nbsp;Upload Event Photo <span class="asterisk">*</span>
                        <?php if(!isset($this->event['EventId'])){?>
                        <a data-plan="<?= $this->event['plan']?>" id="add-more" class="btn btn-success" style="float:right;"><i class="fa fa-plus"></i></a>
                        <a id="remove-input" class="btn btn-success" style="float:right;  margin-right:5px;"><i class="fa fa-minus"></i></a>
                        <?php }else{ ?>
                             
                        <?php 
                                    echo '<pre>'; print_r($this->event); echo '</pre>';
                        
                            if($this->event['Photo'] !== ''){
                                $countPhotos = $countPhotos + 1;
                            }
                            if($this->event['Photo1'] !== ''){
                                $countPhotos = $countPhotos + 1;
                            }
                            if($this->event['Photo2'] !== ''){
                                $countPhotos = $countPhotos + 1;
                            }
                            if($this->event['Photo3'] !== ''){
                                $countPhotos = $countPhotos + 1;
                            }
                            if($this->event['Photo4'] !== ''){
                                $countPhotos = $countPhotos + 1;
                            }
                
                            echo $countPhotos;
                            if($this->event['Plan'] === 'brilliant'){
                                $countAllowed = 3 - $countPhotos;
                            }
                            if($this->event['Plan'] === 'professional'){
                                $countAllowed = 3 - $countPhotos;
                            }
                            
                        ?>
                        
                        
                        <a data-plan="<?= $this->event['plan']?>" class="btn btn-success" style="float:right;"><i class="fa fa-plus"></i></a>
                        <?php } ?>
                    </label>
                    
                    <?php if(isset($this->event['Photo']) || isset($this->event['Photo1']) || isset($this->event['Photo2'])){ ?>
                    <div class="imgFileContainer">
                        
                    <?php if(isset($this->event['Photo']) && $this->event['Photo'] !== ''){ 
                        $imagepath = file_exists("assets/photos/events/".$this->event['Photo']) ? "assets/photos/events/".$this->event['Photo'] : "assets/photos/events/default.png";
                        $imageUrl = base_url($imagepath);
                    ?>
                        <div class="img-box">
                            <a href="<?= $imageUrl ?>">
                                <img src="<?= $imageUrl ?>" class="img-thumbnail">
                            </a>
                            <div class="btn btn-danger img-remove" data-id="1" data-event-id="<?=$this->event['EventId']?>" data-event-photo="<?=$this->event['Photo']?>"><i class="fa fa-remove"></i></div>
                            <div class="btn btn-primary img-update" data-id="1" id="fileuploader1"></div>
                            <input type="hidden" id="updatefile" name="updatefile" value="<?= $this->event['Photo'] ?>"/>
                        </div>
                    <?php } ?>
                        
                    <?php if(isset($this->event['Photo1']) && $this->event['Photo1'] !== ''){ 
                        $imagepath1 = file_exists("assets/photos/events/".$this->event['Photo1']) ? "assets/photos/events/".$this->event['Photo1'] : "assets/photos/events/default.png";
                        $imageUrl1 = base_url($imagepath1);
                    ?>
                        <div class="img-box">
                            <a href="<?= $imageUrl1 ?>">
                                <img src="<?= $imageUrl1 ?>" class="img-thumbnail">
                            </a>
                             <div class="btn btn-danger img-remove" data-id="2" data-event-id="<?=$this->event['EventId']?>" data-event-photo="<?=$this->event['Photo1']?>"><i class="fa fa-remove"></i></div>

                            <div class="btn btn-primary img-update" data-id="2" id="fileuploader2"></div>
                            <input type="hidden" id="updatefile1" name="updatefile1" value="<?= $this->event['Photo1'] ?>"/>
                        </div>
                    <?php } ?>
                        
                    <?php if( isset($this->event['Photo2']) && $this->event['Photo2'] !== ''){ 
                        $imagepath2 = file_exists("assets/photos/events/".$this->event['Photo2']) ? "assets/photos/events/".$this->event['Photo2'] : "assets/photos/events/default.png";
                        $imageUrl2 = base_url($imagepath2);
                    ?>
                        <div class="img-box">
                            <a href="<?= $imageUrl2 ?>">
                                <img src="<?= $imageUrl2 ?>" class="img-thumbnail">
                            </a>
                            <div class="btn btn-danger img-remove" data-id="3" data-event-id="<?=$this->event['EventId']?>" data-event-photo="<?=$this->event['Photo2']?>"><i class="fa fa-remove"></i></div>
                            <div class="btn btn-primary img-update" data-id="3" id="fileuploader3"></div>
                            <input type="hidden" id="updatefile2" name="updatefile2" value="<?= $this->event['Photo2'] ?>"/>
                        </div>
                    <?php } ?>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>
                    <div class="fileContainer" <?= (isset($this->event['EventId'])) ? 'style="display:none;"' : ''  ?>>
                        <input id="add_file" type="file" class="form-control file-input" name="userfile" required/>
                        <input type='hidden' name='whichFile' value='1' />
                    </div>
                    
                    <?php if(isset($this->event['EventId'])){ ?>
                    <div id="extrabutton" class="ajax-file-upload-green">Update the selected photo</div>
                    <?php } ?>
                    
                    <span class="form-info-span">ONLY [PNG, JPG, JPEG] 4000MB 800x500</span>
                    
                    <div id="eventsmessage"></div>
                    
                    <!--?php if(isset($this->event['Photo'])){ ?>
                        <button id="updatePhoto" class="btn btn-primary text-uppercase" style="width:200px"><i class="fa fa-upload"></i>&nbsp;Upload New Photo</button>
                    <!--?php } ?-->
                </div>
                <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function(){
                        
                        
                        $('.img-remove').click(function(){
                        
                            var eventId = $(this).attr('data-event-id');
                            var photo = $(this).attr('data-id');
                            var root = $(this).attr('data-event-photo');
                            var data = { eventId : eventId, photoId: photo, photo: root };
                            $.ajax({
                                  type: 'POST',
                                  url: '<?=base_url()?>/index.php/main/deleteeventphoto',
                                  data: data,
                                  success: function(resultData) {
                                    //console.log(resultData); return false;
                                      toastr.success('Your Image was successfully removed');
                                        setTimeout(function(){ 
                                          location.reload();
                                     }, 3000);
                                  },
                                error: function(error) {
                                    console.log(error);
                                      toastr.error('Sorry, this Image can\'t be removed');
                                  }
                            });
                            
                        });
                        
                        var whichFile = 0;
                        
                        $('.img-update').click(function(){
                            whichFile = $(this).attr('data-id');
                        });
                        
                        var extraObj1 = $("#fileuploader1").uploadFile({
                            
                            url: "<?=base_url()?>index.php/main/eventsubmission",
                            multiple: false,
                            dragDrop: false,
                            maxFileCount: 1,
                            maxFileSize:5000*5000,
                            uploadStr: '<i class="fa fa-edit"></i>',
                            fileName: "userfile",
                            extraHTML:function()
                            {
                                var html = "<input type='hidden' name='editUploadSubmission' value='true' />";
                                     html += "<input type='hidden' name='whichFile' value='"+whichFile+"' />";
                                return html;
                            },
                            //returnType:"json",
                            dynamicFormData: function()
                            {
                                var form = $('#submit_event');
                                var data =  $( form ).serializeArray();
                                return data;
                            },
                            showPreview:true,
                            previewHeight: "100px",
                            previewWidth: "100px",
                            onSuccess:function(files,data,xhr,pd)
                            {
                                var eventId = $('#EventId').val();
                                toastr.success('Your Image was uploaded successfully');
                                setTimeout(function(){ 
                                  location.reload();
                                }, 3000);
                            },
                            onError: function(files,status,errMsg,pd)
                            {
                                $("#eventsmessage").html($("#eventsmessage").html()+"<br/>Error for: "+errMsg);
                            },
                            onCancel:function(files,pd)
                            {
                                $("#eventsmessage").html($("#eventsmessage").html()+"<br/>Canceled  files: "+JSON.stringify(files));
                            },
                            autoSubmit:false
                        }); 
                        
                        var extraObj2 = $("#fileuploader2").uploadFile({
                            
                            url: "<?=base_url()?>index.php/main/eventsubmission",
                            multiple: false,
                            dragDrop: false,
                            maxFileCount: 1,
                            maxFileSize:5000*5000,
                            uploadStr: '<i class="fa fa-edit"></i>',
                            fileName: "userfile",
                            extraHTML:function()
                            {
                                var html = "<input type='hidden' name='editUploadSubmission' value='true' />";
                                     html += "<input type='hidden' name='whichFile' value='"+whichFile+"' />";
                                return html;
                            },
                            //returnType:"json",
                            dynamicFormData: function()
                            {
                                var form = $('#submit_event');
                                var data =  $( form ).serializeArray();
                                return data;
                            },
                            showPreview:true,
                            previewHeight: "100px",
                            previewWidth: "100px",
                            onSuccess:function(files,data,xhr,pd)
                            {
                                var eventId = $('#EventId').val();
                                toastr.success('Your Image was uploaded successfully');
                                setTimeout(function(){ 
                                  location.reload();
                                }, 3000);
                            },
                            onError: function(files,status,errMsg,pd)
                            {
                                $("#eventsmessage").html($("#eventsmessage").html()+"<br/>Error for: "+errMsg);
                            },
                            onCancel:function(files,pd)
                            {
                                $("#eventsmessage").html($("#eventsmessage").html()+"<br/>Canceled  files: "+JSON.stringify(files));
                            },
                            autoSubmit:false
                        });
                        
                        var extraObj3 = $("#fileuploader3").uploadFile({
                            
                            url: "<?=base_url()?>index.php/main/eventsubmission",
                            multiple: false,
                            dragDrop: false,
                            maxFileCount: 1,
                            maxFileSize:5000*5000,
                            uploadStr: '<i class="fa fa-edit"></i>',
                            fileName: "userfile",
                            extraHTML:function()
                            {
                                var html = "<input type='hidden' name='editUploadSubmission' value='true' />";
                                    html += "<input type='hidden' name='whichFile' value='"+whichFile+"' />";
                                return html;
                            },
                            //returnType:"json",
                            dynamicFormData: function()
                            {
                                var form = $('#submit_event');
                                var data =  $( form ).serializeArray();
                                return data;
                            },
                            showPreview:true,
                            previewHeight: "100px",
                            previewWidth: "100px",
                            onSuccess:function(files,data,xhr,pd)
                            {
                                var eventId = $('#EventId').val();
                                toastr.success('Your Image was uploaded successfully');
                                setTimeout(function(){
                                  location.reload();
                                }, 3000);
                            },
                            onError: function(files,status,errMsg,pd)
                            {
                                $("#eventsmessage").html($("#eventsmessage").html()+"<br/>Error for: "+errMsg);
                            },
                            onCancel:function(files,pd)
                            {
                                $("#eventsmessage").html($("#eventsmessage").html()+"<br/>Canceled  files: "+JSON.stringify(files));
                            },
                            autoSubmit:false
                        }); 
    
                        $("#extrabutton").click(function(){
                            if(whichFile == 1)
                                extraObj1.startUpload();
                            else if(whichFile == 2)
                                extraObj2.startUpload();
                            else if(whichFile == 3)
                                extraObj3.startUpload();
                            
                        }); 
                       
                        
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
<style>
.ajax-file-upload-statusbar {
    border: 5px solid #0ba1b5;
    margin-top: 10px;
    width: 430px !important;
    margin-right: 10px;
    margin: 5px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px;
    padding: 10px;
    background-color: #fff;
}
.ajax-file-upload-filename {
    width: 300px;
    height: auto;
    margin: 0 5px 5px 0px;
}
.ajax-file-upload-filesize {
    width: 50px;
    height: auto;
    margin: 0 5px 5px 0px;
    display: inline-block;
    vertical-align:middle;
}
.ajax-file-upload-progress {
    margin: 5px 10px 5px 0px;
    position: relative;
    width: 250px;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 3px;
    display: inline-block;
    color:#FFFFFF;
    vertical-align:middle;
}
.ajax-file-upload-bar {
    background-color: #0ba1b5;
    width: 0;
    height: 20px;
    border-radius: 3px;
    color:#FFFFFF;
}
.ajax-file-upload-percent {
    position: absolute;
    display: inline-block;
    top: 3px;
    left: 48%
}
.ajax-file-upload-red {
    -moz-box-shadow: inset 0 39px 0 -24px #e67a73;
    -webkit-box-shadow: inset 0 39px 0 -24px #e67a73;
    box-shadow: inset 0 39px 0 -24px #e67a73;
    background-color: #e4685d;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    display: inline-block;
    color: #fff;
    font-family: arial;
    font-size: 13px;
    font-weight: normal;
    padding: 4px 15px;
    text-decoration: none;
    text-shadow: 0 1px 0 #b23e35;
    cursor: pointer;
    vertical-align: middle;
    margin-right:5px;
}   
.ajax-file-upload-green {
    width: 50%;
    background-color: #77b55a;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    margin: 0;
    padding: 0;
    display: inline-block;
    color: #fff;
    font-family: arial;
    font-size: 13px;
    font-weight: normal;
    padding: 10px 15px;
    text-decoration: none;
    cursor: pointer;
    text-shadow: 0 1px 0 #5b8a3c;
    vertical-align: middle;
    /* margin-right: 5px; */
    margin: 10px auto;
}
.ajax-file-upload-preview{
    display: inline-block;
    max-width: 100%;
    height: auto;
    padding: 4px;
    line-height: 1.42857143;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    -webkit-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    transition: all .2s ease-in-out;
}
.ajax-upload-dragdrop
{

	border:2px dotted #A5A5C7;
	width:420px;
	color: #DADCE3;
	text-align:left;
	vertical-align:middle;
	padding:10px 10px 0px 10px;
}
.state-hover
{
    border:2px solid #A5A5C7;
}
#eventsmessage{
    color: #a94442;
    padding: 20px;
}
</style>