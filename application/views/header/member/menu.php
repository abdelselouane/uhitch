<menu>
    <ul>
        <li>
            <a href="<?php echo site_url('main/profile');?>">
                <img src="<?php echo base_url('assets/imgs/icons/profile.png'); ?>"> 
                <span><?php echo $data->fname; ?></span>
            </a>
        </li>
        <li>    
            <img src="<?php echo base_url('assets/imgs/icons/events.png'); ?>"> 
            <a href=""><span>Events</span></a>
            <ul class="submenu">
                <li><a href="<?php echo site_url('main/postride'); ?>">Post Ride</a></li>
                <li><a href="<?php echo site_url('main/newevent'); ?>">Create New Event</a></li>
                <li><a href="<?php echo site_url('main/upcoming'); ?>">Upcoming Events</a></li>
            </ul>
        </li>
        <li>
            <a class="link-msg" href="<?php echo site_url('main/messages');?>">
            <img src="<?php echo base_url('assets/imgs/icons/message.png'); ?>"> 
            <span>Messages</span>
            </a>
            
        </li>
        <li>
            <a href="">
                <img src="<?php echo base_url('assets/imgs/icons/arrow.png'); ?>"> 
                <span>Options</span> 
            </a>
            <ul class="submenu">
<!--                <li><a href="<//?=site_url('main/settings');?>">Edit Profile</a></li>-->
                <li><a href="<?php echo site_url('main/settings');?>">Settings</a></li>
                <hr/>
                <li>
                    <a href="<?php echo site_url('main/logout'); ?>">
                        <label>Log Out</label>
                        <img src="<?php echo base_url('assets/imgs/icons/door_in.png');?>">
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</menu>