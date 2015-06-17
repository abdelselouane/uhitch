<div id="page_content" class="margin-top-100px">
    <div id="page">
        <section id="RegisterUser">
            <div id="content">
                <div id ="content_register">
                    <h2>Upload Profile Photo</h2>   
                    <?php 
                        $uploadForm = array(
                            'name'  => 'uploadform',
                            'id'    => 'upload_form',
                            'novalidate'    => ''
                        );
                        echo form_open_multipart('register/profilepic', $uploadForm);
                        
                    ?>
                    <div id="upload_photo">
                        <div id="upload_photo_left">
                            <img src="<?php echo base_url('assets/imgs/user_profile.png');?>">
                            <span><a class="add_photo" href="">+Add Photo</a></span> 
                        </div>                        
                        <div id="upload_photo_right"> 
                            <h4>Upload Image from your Computer</h4>
                            <input id="add_file" type="file" name="userfile" size="20"  />
                            <button id="uploadBtn" class="button submit_img" type="submit">Upload</button>
                         </div>             
                    </div>
                    <?php echo form_close(); ?>  <br/>  
                </div>
            </div>
        </section>
    </div>
</div>