<!--header>
    <nav id="members">
        <!--?php 
            // Displays Logo
            $this->load->view('Header/logo'); 
            $this->load->view('header/member/search');
        ?>
    </nav>
</header-->

 <!-- Menu bar -->
<nav class="navbar navbar-default myNav">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand green" href="<?=site_url()?>">
                <img src="<?php echo base_url('assets/imgs/uhitch1.png');?>" class="logo">
            </a>
        </div>
        
        <div id="searchbar" class="navbar-header">
            <?php
                // Search Settings
                $search_attr = array(
                    'name' => 'searchform',
                    'id' => 'search_form',
                    'novalidate' => '',
                    'method' => 'GET'
                );
                echo form_open('main/search', $search_attr);
            ?>
                <div id="search_container">
                    <div id="search-feat">
                        <input type="text" id="place" name="destination" 
                           value="" placeholder="Find Users, Rides & Events"/>
                        <button type="submit">Search</button>
                    </div>
                    <div id="search-radio">
                        <input type="radio" name="searchBy" 
                               id="radioRides" checked="checked" value="ride"/>
                        <label for="radioRides">Rides</label>
                        <input type="radio" name="searchBy" 
                               id="radioUser" value="user"/>
                        <label for="radioUser">User</label>
                        <input type="radio" name="searchBy" 
                               id="radioEvents" value="events"/>
                        <label for="radioEvents">Events</label>
                    </div>
                </div>
        <?php 
            echo form_close();    
            //$this->load->view('header/member/menu');
        ?> 
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right nav-icon-adjust">
                <li class="center">
                     <a href="<?php echo site_url('main/profile');?>" class="center">
                        <i class="fa fa-user icon-font"></i>
                        <p class="center"><?php echo $data->fname; ?></p>
                    </a>
                </li>
                <li class="center">
                    <a href="#" class="center sbm-expand">
                        <i class="fa fa-calendar icon-font"></i>
                        <p class="center">&nbsp;Events</p>
                    </a>
                    <ul class="submenu width-200px">
                        <? if(!empty($data) && $data->admin == 1 ) { ?><li class="sbm"><a href="<?php echo site_url('main/allevent'); ?>">All Events</a></li><? } ?>
                        <li class="sbm"><a href="<?php echo site_url('main/newevent'); ?>">Create New Event</a></li>
                        <li class="sbm"><a href="<?php echo site_url('main/upcoming'); ?>">Upcoming Events</a></li>
                    </ul>
                </li>
                <li class="center">
                    <a href="<?php echo site_url('main/messages');?>" class="center">
                        <i class="fa fa-envelope icon-font"></i>
                        <p class="center">&nbsp;Messages</p>
                    </a>
                </li>
                <li class="center">
                    <a href="#" class="center sbm-expand">
                        <i class="fa fa-gear icon-font"></i>
                        <p class="center">&nbsp;Options</p> 
                    </a>
                    <ul class="submenu width-150px">
                        <li class="sbm"><a href="<?php echo site_url('main/settings');?>">Settings</a></li>
                        <li class="sbm"><a href="<?php echo site_url('main/logout'); ?>">Log Out</a></li>
                    </ul>
                </li>
                <!--li><a href="<!--?php echo site_url('welcome/login'); ?>">LOG IN</a></li>
                <li><a href="<!--?php echo site_url('welcome/join')?>"class="btn btn-default btn-black">SIGN UP</a></li-->

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>


