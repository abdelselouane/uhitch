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
        
        <!--div id="searchbar" class="navbar-header">
            <!?php
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
        <!?php 
            echo form_close();    
            //$this->load->view('header/member/menu');
        ?> 
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right nav-icon-adjust">
                <li class="center">
                     <a href="<?php echo site_url('main/');?>" class="center">
                        <i class="fa fa-home icon-font"></i>
                        <p class="center">Home</p>
                    </a>
                </li>
                <li class="center">
                    <a href="#" class="center sbm-expand">
                        <i class="fa fa-calendar icon-font"></i>
                        <p class="center">&nbsp;Events</p>
                    </a>
                    <ul class="submenu width-200px">
                        <li class="sbm"><a href="<?php echo site_url('main/eventpricing'); ?>"><i class="fa fa-glass"></i>&nbsp;Create New Event</a></li>
                        <li class="sbm"><a href="<?php echo site_url('main/upcoming'); ?>"><i class="fa fa-map-marker"></i>&nbsp;Upcoming Events</a></li>
                    </ul>
                </li>
                <li class="center">
                    <a href="<?php echo site_url('main/messages/inbox');?>" class="center">
                        <i class="fa fa-envelope icon-font"></i>
                        <p class="center">&nbsp;Messages</p>
                    </a>
                </li>
                <li class="center">
                     <a href="#" class="center sbm-expand">
                        <i class="fa fa-search icon-font"></i>
                        <p class="center">Search</p>
                    </a>
                    <div class="submenu">
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
                                        <div id="search-feat" class="form-group">
                                            <input type="text" id="place" class="form-control" name="destination" 
                                               value="" placeholder="Find Users, Rides & Events"/>
                                        </div>
                                        <div id="search-radio" class="form-group">
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
                                        <div class="form-group">
                                            <button id="search-btn-submit" type="button" class="btn btn-primary">Search&nbsp;<i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                            <?php echo form_close(); ?>
                            </div>
                    </div>
                </li>
                <li class="center">
                    <a href="#" class="center sbm-expand">
                        <i class="fa fa-gear icon-font"></i>
                        <p class="center">&nbsp;Settings</p> 
                    </a>
                    <ul class="submenu width-200px">
                        <li class="sbm"><a href="<?php echo site_url('main/ridepanel');?>"><i class="fa fa-dashboard"></i>&nbsp;My Rides</a></li>
                        <li class="sbm"><a href="<?php echo site_url('main/trippanel');?>"><i class="fa fa-road"></i>&nbsp;My Trips</a></li>
                        <li class="sbm"><a href="<?php echo site_url('main/eventpanel');?>"><i class="fa fa-film"></i>&nbsp;My Events</a></li>
                        <li class="sbm"><a href="<?php echo site_url('main/profile');?>"><i class="fa fa-user"></i>&nbsp;My Profile</a></li>
                        <li class="sbm"><a href="<?php echo site_url('main/settings');?>"><i class="fa fa-usd"></i>&nbsp;My Payments</a></li>
                        <li class="sbm"><a href="<?php echo site_url('main/settings');?>"><i class="fa fa-unlock-alt"></i>&nbsp;My Account</a></li>
                        <li class="sbm"><a href="<?php echo site_url('main/logout'); ?>"><i class="fa fa-power-off"></i>&nbsp;Log Out</a></li>
                    </ul>
                </li>
                <!--li><a href="<!--?php echo site_url('welcome/login'); ?>">LOG IN</a></li>
                <li><a href="<!--?php echo site_url('welcome/join')?>"class="btn btn-default btn-black">SIGN UP</a></li-->

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>
<style type="text/css">
    .collapser{
        width: 60px;
        height: 60px;
        position: absolute;
        background-color: #f5f5f5;
        border-bottom: 1px solid #e3e3e3;
        border-top: 1px solid #e3e3e3;
        border-right: 1px solid #e3e3e3;
        z-index:1;
    }
    .collapser:hover,
    .collapser:focus,
    .collapser:active{
        background-color: #fff;
    }
    .collapser a>i{
        font-size: 35px;
        padding: 10px;
    }
    .admin-expand{
        left:250px;
        -webkit-transition: left .45s; /* For Safari 3.1 to 6.0 */
        transition: left .45s;
    }
    .admin-collapse{
        left:0px;
        -webkit-transition: left .45s; /* For Safari 3.1 to 6.0 */
        transition: left .45s;
    }
    .panel-arrow{
        float: right;
        font-size: 20px;
    }
    .header-icon{
        font-size: 20px;
        padding-right: 10px;
    }
    .admin-panel{
        display:none;
        position:absolute;
        width:250px;
        height:auto;
        background-color: #f5f5f5;
        border-top: 1px solid #e3e3e3;
        border-right: 1px solid #e3e3e3;
        z-index: 1000;
    }
    .admin-panel ul.menu{
        list-style-type: none;
        margin-left: -40px;
        margin-bottom: 0;
    }
    .admin-panel ul.menu>li a{
        width: 100%;
        display: inline-block;
        text-align: left;
        padding: 19px 15px;
        text-decoration: none;
        border-bottom: 1px solid #e3e3e3;
    }
    .admin-panel ul.menu>li a:hover,
    .admin-panel ul.menu>li a:focus,
    .admin-panel ul.menu>li a:active{
        background-color: #23527c;
        color:#fff;
    }
    .admin-panel ul.sub-menu{
        display:none;
        list-style-type: none;
        margin-left: -40px;
        margin-bottom: 0;
    }
    .admin-panel ul.sub-menu>li a{
        width: 100%;
        display: inline-block;
        text-align: left;
        padding: 7px 20px;
        text-decoration: none;
        border-bottom: 1px solid #e3e3e3;
        background-color: #fff;
        color:#23527c;
        font-size:12px;
    }
    .admin-panel ul.sub-menu>li a:hover{
        background-color: #23527c;
        border-bottom: 1px solid #23527c;
    }
</style>
<? if(!empty($data) && $data->admin == 1 ) { ?>
<div class="collapser admin-collapse">
    <a href="#"><i class="fa fa-gears"></i></a>
</div>
<div class="admin-panel">
    <ul class="menu">
        <li><a href="#"><i class="fa fa-home header-icon"></i>&nbsp;Home</a></li>
        <li>
            <a href="#" class="sub-menu-link sub-menu-collapse">
                <i class="fa fa-film header-icon"></i>&nbsp;Events Panel<i class="fa fa-angle-right panel-arrow"></i></a>
            <ul class="sub-menu">
                <li><a href="<?php echo site_url('main/allevent'); ?>">All Events</a></li>
                <li><a href="<?php echo site_url('main/eventpricing'); ?>">Create New Event</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="sub-menu-link sub-menu-collapse">
                <i class="fa fa-road header-icon"></i>&nbsp;Rides Panel<i class="fa fa-angle-right panel-arrow"></i></a>
            <ul class="sub-menu">
                <li><a href="#">Sub Link 1</a></li>
                <li><a href="#">Sub Link 2</a></li>
                <li><a href="#">Sub Link 3</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="sub-menu-link sub-menu-collapse">
                <i class="fa fa-envelope header-icon"></i>&nbsp;Messages Panel<i class="fa fa-angle-right panel-arrow"></i></a>
            <ul class="sub-menu">
                <li><a href="#">Sub Link 1</a></li>
                <li><a href="#">Sub Link 2</a></li>
                <li><a href="#">Sub Link 3</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="sub-menu-link sub-menu-collapse">
                <i class="fa fa-users header-icon"></i>&nbsp;Users Panel<i class="fa fa-angle-right panel-arrow"></i></a>
            <ul class="sub-menu">
                <li><a href="#">Sub Link 1</a></li>
                <li><a href="#">Sub Link 2</a></li>
                <li><a href="#">Sub Link 3</a></li>
            </ul>
        </li>
        <li><a href="<?php echo site_url('main/logout'); ?>"><i class="fa fa-power-off header-icon"></i>&nbsp;Log Out</a></li>
    </ul>
</div>
<? } ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.collapser').click(function(e){
            var collapser = $(this);
            if(collapser.hasClass('admin-expand')){
                collapser.removeClass('admin-expand').addClass('admin-collapse');
            }else{
                collapser.removeClass('admin-collapse').addClass('admin-expand');
            }
            $('.admin-panel').toggle( "slide", function(){
                
            });
            e.preventDefault();
        });
        $('.admin-panel a.sub-menu-link').click(function(e){
            var sibling = $(this).siblings();
            var children = $(this).children();
            if($(this).hasClass('sub-menu-expand')){
                $(children[1]).removeClass('fa-angle-down').addClass('fa-angle-right');
                $(this).removeClass('sub-menu-expand').addClass('sub-menu-collapse');
                sibling.slideUp();
            }else{
                $(children[1]).removeClass('fa-angle-right').addClass('fa-angle-down');
                $(this).removeClass('sub-menu-collapse').addClass('sub-menu-expand');
                sibling.slideDown();
            }
            e.preventDefault();
        });
    });
</script>