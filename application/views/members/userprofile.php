<?php //echo '<pre>'; print_r($page); echo '</pre>'; exit;?>
<div id="page_content">
    <div id="page">
        <section id="profile">
            <div id="user_info">
                <?php
                    $this->load->view('members/foundUser/userImage');
                    $this->load->view('members/foundUser/userDetails');
                ?>
            </div> 
            <hr/>
            <div id="user_info">
                <?php $this->load->view('members/foundUser/userRideHistory'); ?>
            </div>
        </section>
    </div>
</div>