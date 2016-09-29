<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <head>
        <link href='http://fonts.googleapis.com/css?family=Graduate' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href='<?php echo base_url();?>assets/css/splash.css'>
        <!-- Bootstrap and Font-awesome StyleSheet -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
        <title>Welcome to Uhitch | Find & Share Rides</title>
    </head>
    <body>
        
    <!--div id="splash_container">
        <header>
                <nav>
                    <a href="<!--?php echo site_url($this->router->class); ?>">
                        <img src=<!--?php echo base_url('assets/imgs/uhitch.png');?> >
                    </a>
                    <span class="logging">
                        <a href="<!--?php echo site_url('welcome/login'); ?>">
                            <h1>Log In</h1>
                        </a>
                    </span>
                </nav>
                 <div id="splash">
                <div id="splash_content">
                    <a href="<!--?php echo site_url('welcome/join'); ?>">
                        <button>JOIN US</button>  
                    </a>
                    <footer>
                        <menu>
                            <ul>
                                <li><a href="<!--?php echo site_url('safety'); ?>">Safety</a></li>
                                <li><a href="<!--?php echo  site_url('contact'); ?>">Contact Us</a></li>
                                <li><a href="<!--?php echo  site_url('policy'); ?>">Privacy Policy</a></li>
                                <li><a href="https://www.facebook.com/pages/Uhitch/757351874278710?ref=hl"><img src=<!--?php echo base_url('assets/imgs/icons/facebook3.png'); ?>></a></li>
                                <li><a href="http://instagram.com/uhitch1"><img src=<!--?php echo base_url('assets/imgs/icons/instagram3.png'); ?>></a></li>
                                <li><a href="https://twitter.com/uhitch1"><img src=<!--?php echo base_url('assets/imgs/icons/twitter3.png'); ?>></a></li>
                            </ul>
                        </menu>
                        <p>&copy; UHitch <!--?php echo date("Y"); ?></p>
                    </footer> 
                </div>
            </div>
        </header>
    </div-->
        
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
                    <li><a href="<?php echo site_url('welcome/login'); ?>">LOG IN</a></li>
                    <li><a href="<?php echo site_url('welcome/join')?>" class="btn btn-default btn-black">SIGN UP</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
		</div><!-- /.container -->
	</nav>
        
    <!-- heade area, has cover image -->
	<div id="cover">
		<div class="container-fluid">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <video id="U3_video" preload controls autoplay>
                            <source src="<?php echo base_url();?>assets/videos/U3_1080p.mp4" />
                            <source src="<?php echo base_url();?>assets/videos/U3_1080p.mp4" />
                            <source src="<?php echo base_url();?>assets/videos/U3_1080p.mp4" />
                        </video>
					</div>
					<div class="item">
						<img src="<?php echo base_url();?>assets/imgs/bg-home.jpg" alt="..." class="img-responsive">
							<div class="uhitch-caption">
								<h1>RIDE ON DEMAND</h1>
                                <h3>Welcome to uhitch the future of college transportation.</h3>
                                <p>Uhitch is a rideshare network exclusively for college students. We provide the platform for students to post and find rides to their destination.</p>
                                <a href="<?php echo site_url('welcome/join'); ?>" class="btn btn-success join-us" type="button">JOIN US NOW</a>
							</div>
					</div>
				
					<div class="item">
						<img src="<?php echo base_url();?>assets/imgs/bg-uhitch-bw.jpg" alt="..." class="img-responsive">
							<div class="uhitch-caption">
								<h1>WHAT WE DO ?</h1>
                                <h3>Get to your destination the way you would.</h3>
                                <p>We match our users to the best ride experience based on personal preference. We also provide places to go with our events page.</p>
                                <a href="<?php echo site_url('welcome/join'); ?>" class="btn btn-success join-us" type="button">JOIN US NOW</a>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    <div id="diagram">
        <div class="container">
            <div class="row">
                <h1>Four Easy Steps</h1>
                <div class="col-md-3 center">
                    <img src="<?=base_url('assets/imgs/user-laptop.png')?>" class="img-circle">
                    <h4>1. Post and Search for Ride</h4>
                </div>
                <div class="col-md-3 center">
                    <img src="<?=base_url('assets/imgs/deal.png')?>" class="img-circle">
                    <h4>2. Confirm Ride</h4>
                </div>
                <div class="col-md-3 center">
                    <img src="<?=base_url('assets/imgs/payment.png')?>" class="img-circle">
                    <h4>3. Payment</h4>
                </div>
                <div class="col-md-3 center">
                    <img src="<?=base_url('assets/imgs/destination.png')?>" class="img-circle">
                    <h4>4. Uhitch to your destination</h4>
                </div>
            </div>
            <div class="row">
                <h4 class="center green">Nowhere to go? Check our <a href="" class="green" >Events Page.</a></h4>
            </div>
        </div>
    </div>
        
    <!--  Footer -->    
    <footer>
        <div class="container">
            <div class="row center">
                <ul id="footer-nav">
                    <li><a href="<?php echo site_url('safety'); ?>">Safety</a></li>
                    <li><a href="<?php echo  site_url('contact'); ?>">Contact Us</a></li>
                    <li><a href="<?php echo  site_url('policy'); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo  site_url('policy'); ?>">Payment Policy</a></li>
                    <li><a href="https://www.facebook.com/pages/Uhitch/757351874278710?ref=hl" class="social-link"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="http://instagram.com/uhitch1" class="social-link"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="https://twitter.com/uhitch1" class="social-link"><i class="fa fa-twitter"></i></a></li>
                </ul>
                <p>&copy; UHitch <?php echo date("Y"); ?></p>
            </div>
        </div>
    </footer> 
    
    <!-- Script Files 
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#U3_video').on('play', function (e) { 
                $("#carousel-example-generic").carousel('pause');
            });
            $('#U3_video').on('stop pause ended', function (e) { 
                $("#carousel-example-generic").carousel();
            });
        });
    </script>
    </body>
</html>