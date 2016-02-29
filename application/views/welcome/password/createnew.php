<section id="create_password" style="margin-top: 220px; min-height: 400px;">
    <div id="content">
        <?php 
            // Form Settings
            $pass_attr = array(
                'name' => 'signform',
                'id'=>'signup_form'   
            );   
            echo form_open('welcome/changepassword', $pass_attr); 
        ?>
            <h1>Change Your Password</h1>
            <hr/>
            <div id="password">
                <div class="form-group">
                    <input type="password" placeholder="New Password" name="password" class="form-control" id="pwd1"/>
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Confirm New Password" class="form-control" name="passWordConfirm" id="pwd2"/>
                </div>
            </div>
            <button id="submit" class="btn btn-primary" style="width:100%;">Submit</button>
        <?php echo form_close(); ?>
    </div>
</section>