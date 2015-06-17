<!--header>
    <nav>
        <figure>
            <a href="<!--?=site_url('/welcome/'); ?>">
                <img src=<!--?=base_url('assets/imgs/uhitch.png');?>>
            </a>
        </figure>
         
        <a href="javascript: history.go(-1)" >
            <button class="altbutton button">Go Back</button>    
        </a>
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

        <ul class="nav navbar-nav navbar-right">
            <li><a href="javascript: history.go(-1)" class="btn btn-default btn-black">Go Back</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>
