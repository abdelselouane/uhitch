<div id="page_content">
    <div id="page">
        <section id="RegisterUser">
            <div id="content">
                <div id ="content_register">
                    <?php 
                        // Form Settings
                        $personal_form = array (
                            'name' => 'vehicleform',
                            'id'   => 'vehicle_form'
                        );
                        echo form_open('register/submitUserData', $personal_form); 

                        $this->load->view('register/userInfo/personal');
                        $this->load->view('register/userInfo/vehicle');
                    ?>
                     
                    <div id="submit_content">
                        <button type="submit" id="submitRegistration" class="button">Next</button>
                        <a href="<?= site_url('register/schoolinfo') ?>" class="button" value="skip">
                            Skip
                        </a>
                    </div>
                    <?php echo form_close(); ?>  
                </div>               
            </div> 
        </section>
    </div>
</div>