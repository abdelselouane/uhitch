<!--header>
    <nav>
        <!--?php 
            // Displays Logo
            $this->load->view('Header/logo'); 
        ?>
        <div id="register_menu">
            <div>
                <a href="<!--?=site_url('register/personal');?>">
                    <img src="<!--?=base_url('assets/imgs/header/car.png'); ?>" />
                    <p><b>Personal</b></p>
                </a>
            </div>
            <div>
                <a href="<!--?=site_url('register/schoolinfo');?>">
                    <img src="<!--?=base_url('assets/imgs/header/college.png'); ?>" />
                    <p><b>School</b></p>
                </a>
            </div>
            <div>
                <a href="<!--?=site_url('register/uploadpic');?>">
                    <img src="<!--?=base_url('assets/imgs/header/man.png'); ?>" />
                    <p><b>Photo</b></p>
                </a>
            </div>
        </div>
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

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav navbar-right nav-icon-adjust">
            <li class="center">
                <a href="<?=site_url('register/personal');?>" class="center">
                    <img src="<?=base_url('assets/imgs/header/car.png'); ?>" class="nav-icon" style="margin-left: 10px;"/>
                    <p class="center">Personal</p>
                    <!--p><b>Personal</b></p-->
                </a>
            </li>
            <li class="center">
                <a href="<?=site_url('register/schoolinfo');?>" class="center">
                    <img src="<?=base_url('assets/imgs/header/college.png'); ?>" class="nav-icon" style="margin-left: 5px;"/>
                    <p class="center">School</p>
                </a>
            </li>
            <li class="center">
                <a href="<?=site_url('register/uploadpic');?>" class="center">
                    <img src="<?=base_url('assets/imgs/header/man.png'); ?>" class="nav-icon" style="margin-left: 0px;"/>
                    <p class="center">Photo</p>
                </a>
            </li>
            <!--li><a href="<!--?php echo site_url('welcome/login'); ?>">LOG IN</a></li>
            <li><a href="<!--?php echo site_url('welcome/join')?>"class="btn btn-default btn-black">SIGN UP</a></li-->

        </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>