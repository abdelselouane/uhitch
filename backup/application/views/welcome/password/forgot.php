<section id="forgot_password">
    <div id="content">
        <h1>Forgot Your Password?</h1>
        <hr/><br/>
        <div id="message_Error">
            <h4>Email Verification Error</h4>
            <p>The Email Address was Not Recognized<br/>Please Try Again.</p>
        </div>
        <span>Enter your Email Address:</span>
        <input class="forget_email" type="text" placeholder="Your School Email Address" name="email_retrieval"/>     
        <button id="forget_btn" class="button">Submit</button>      
        <input hidden id="base" value="<?php echo base_url(); ?>"/>
    </div>
</section>