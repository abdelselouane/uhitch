<div id="members_profile">
    
    <?php 
        $this->load->view('members/user/profilepic');
        $this->load->view('members/user/userinfo');
    ?>

    <div id="profile_school_info">
        <hr/>
        <h4>
            <!--School Name:--> 
            School Name: <?= $data->school ?>
        </h4>
        <hr/>
        <a href="#createride_form" id="createride_pop">
            <button>
                Create Ride
            </button>
        </a>
        <a href="#shareride_form" id="shareride_pop">
            <button>
                Share Ride
            </button>    
        </a>

        <?php 
            // Displays the Create A Ride Form
            $this->load->view('members/forms/createrides');
            $this->load->view('members/forms/sharerides');
        ?>

    </div>            
</div>