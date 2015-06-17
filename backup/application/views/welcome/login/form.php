<section id="login">
    <div id="content">
        <?php 
            // Form Settings
            $form_attr = array(
                'name'  => 'logform',
                'id'    =>'log_form'
            );   
            echo form_open('welcome/logInAttempt', $form_attr); 
        ?>
            <h1>Uhitch Login</h1>      
            <hr/><br/>
            
            <input hidden id="error" value="<?=$error;?>"/>
            <div id="message_Error">
                <h4>Validation Error</h4>
                <p>
                    <span id="errormsg"><?=$msg;?></span>
                    Please Try Again
                </p>
            </div>

            <div id="form_login">         
                <input class="email_login" 
                       placeholder="Your Email Address" 
                       type="text" 
                       name="login_userName"
                />
                <input class="password_login" 
                       placeholder="Your Password" 
                       type="password" 
                       name="login_password"
                />
                <input type="checkbox" 
                       name="remember" 
                       value="1" 
                />Keep Me Logged In
                <br/>
                <p>
                    <button id="submit_login" type="submit" class="button">Submit</button>
                    <label>or</label>
                    <a class="button" id="loginbtn" href="<?=site_url('welcome/join') ?>">Register</a>
                </p>
                <p id="content_forgot">
                    <a id="loginbtn" href="<?=site_url('welcome/forgotPassword') ?>">
                        Forgot My Password?
                    </a>
                </p>
            </div>          
        <?php echo form_close(); ?>
    </div>
</section>