<div id="page_content">
    <div id="page">
        <section id="members">
            <h2 class="center">Account Settings</h2>
            <div id="events">
                <div class="section-container">
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
    <button class="button remove" value="Yes">Yes</button>
    <button class="button remove" value="No">No</button>
</div>