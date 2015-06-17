<div id="page_content">
    <div id="page">
        <section id="RegisterUser">
            <div id="content">
                <div id ="content_register">
                    <div id="menu-container">
                        <menu>
                            <h3>College Lifestyle</h3>
                            <ul>
                                <li><a href="#schoolinfo">Majors of Study</a></li>
                                <li><a href="#campus">Campus & Housing</a></li>
                                <li><a href="#sportsNactivities">Sports & Hobbies</a></li>
                                <li><a href="#submit_content">Submit</a></li>
                            </ul>
                        </menu>
                    </div>
                    <div id="register_content" >
                        <?php 
                            // Form Settings
                            $register_form = array(
                                'name' => 'registerform',
                                'id' => 'register_form',
                                'novalidate' => ''
                            );
                            
                            echo form_open('register/submitSchoolData', $register_form); 
                        ?>
                            <div id="schoolinfo">
                                <?php $this->load->view('register/schoolchoice/schoolinfo'); ?>         
                            </div>
                            <div id="campus">
                                <?php $this->load->view('register/schoolchoice/campusNhousing'); ?>       
                            </div>
                            <div id='sportsNactivities'>
                                <?php $this->load->view('register/schoolchoice/sportsNactivities'); ?>
                            </div>

                            <div id="submit_content">
                                <button type="submit" class="button">Save</button>
                                <button type="reset" class="button">Reset</button>
                            </div>
                    </div>  
                    <?php echo form_close(); ?>
                </div>
            </div>
        </section>
    </div>
</div>