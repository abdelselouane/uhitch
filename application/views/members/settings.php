<div id="page_content">
    <div id="page">
        <section id="members">
            <div id="events">
                <h2 class="green center text-uppercase"><i class="fa fa-cogs"></i>&nbsp;Account Settings</h2>
                <div class="section-container" style="padding-bottom:60px;">
                    <?php
                        $this->load->view('members/settings/personal');
                        $this->load->view('members/settings/school');
                        $this->load->view('members/settings/vehicle');
                        $this->load->view('members/settings/deactivate');
                    ?> 
                    
                </div>
            </div>
        </section>
    </div>
</div>
<div class="overlay"></div>
<div class="popup settings-popup">
    <h2>De-Activating Account</h2>
    <p>
        Are you sure you would like to 
        De-Activate your account?<br/> Not too late to 
        say NO!
    </p>
    <button class="btn btn-primary remove" value="Yes">Yes</button>
    <button class="btn btn-primary remove" value="No">No</button>
</div>