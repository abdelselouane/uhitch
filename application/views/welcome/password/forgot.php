<section id="forgot_password" style="margin-top: 220px; min-height: 400px;">
    <div id="content">
        <h1>Forgot Password</h1>
        <hr/>
        <div id="message_Error" style="display:none;">
            <h4>Email Verification Error</h4>
            <p>The Email Address was Not Recognized<br/>Please Try Again.</p>
        </div>
        <div class="form-group">
            <label for="">Enter your Email Address:</label>
            <input class="form-control" type="text" placeholder="Your School Email Address" name="email_retrieval"/> 
        </div>
        <button id="forget_btn" class="btn btn-primary" style="width:100%">Submit</button>
        <input hidden id="base" value="<?php echo base_url(); ?>"/>
    </div>
</section>