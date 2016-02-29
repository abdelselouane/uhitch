<section id="login" style="margin-top: 220px; min-height: 400px;">
    <div id="content">
        <?php 
            // Form Settings
            $form_attr = array(
                'name'  => 'logform',
                'id'    =>'log_form'
            );   
            echo form_open('welcome/logInAttempt', $form_attr); 
        ?>
            <h1>Login</h1>      
            <hr/>
            <input type="hidden" id="error" value="<?=$error;?>"/>
            <div id="message_Error" style="display:none;">
                <h4>Validation Error</h4>
                <p>
                    <span id="errormsg"><?=$msg;?></span>
                    Please Try Again
                </p>
            </div>
            <div id="form_login">
                <div class="form-group">
                    <input class="form-control" placeholder="Your Email Address" type="text" id="login_username" name="login_userName" />
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Your Password" type="password" id="login_password" name="login_password" />
                </div>
                <div class="checkbox">
                    <label>
                      <input type="checkbox" id="remember" name="remember" value="1" />&nbsp;Keep Me Logged In
                    </label>
                </div>
                <button id="submit_login" type="submit" class="btn btn-primary" style="width: 100%">Sign In</button>
                <div class="checkbox">
                    <a id="loginbtn" href="<?=site_url('welcome/forgotPassword') ?>" class="green2">
                         Forgot My Password?
                    </a>
                </div>
                <div class="checkbox">
                    <a id="loginbtn" href="<?=site_url('welcome/join') ?>" class="green2">
                        Register
                    </a>
                </div>
            </div>          
        <?php echo form_close(); ?>
    </div>
</section>