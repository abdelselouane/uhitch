<section id="create_password">
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
                <input type="password" 
                       placeholder="New Password" 
                       name="password" 
                       size="50"
                       id="pwd1"/>

                <input type="password" 
                       placeholder="Confirm New Password" 
                       name="passWordConfirm" 
                       size="50" 
                       id="pwd2"/>
            </div>
            <button id="submit" class="button">Submit</button>
        <?php echo form_close(); ?>
    </div>
</section>