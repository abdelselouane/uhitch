<div id="page_content">
    <div id="page">
        <section id="profile">
            <div id="user_info">
                <?php
                    $this->load->view('members/user/userImage');
                    $this->load->view('members/user/userDetails');
                ?>
            </div> 
            <hr/>
            <div id="user_info">
                <?php $this->load->view('members/user/userRideHistory'); ?>
            </div>
        </section>
    </div>
</div>