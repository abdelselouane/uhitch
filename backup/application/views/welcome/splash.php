<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <head>
        <link href='http://fonts.googleapis.com/css?family=Graduate' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href='<?php echo base_url();?>assets/css/splash.css'>
        <title>Welcome to Uhitch | Find & Share Rides</title>
    </head>
    <body>
        <div id="splash_container">
             <header>
                <nav>
                    <a href="<?php echo site_url($this->router->class); ?>">
                        <img src=<?php echo base_url('assets/imgs/uhitch.png');?> >
                    </a>
                    <span class="logging">
                        <a href="<?php echo site_url('welcome/login'); ?>">
                            <h1>Log In</h1>
                        </a>
                    </span>
                </nav>
                 <div id="splash">
                <div id="splash_content">
                    <a href="<?php echo site_url('welcome/join'); ?>">
                        <button>JOIN US</button>  
                    </a>
                    <footer>
                        <menu>
                            <ul>
                                <li><a href="<?php echo site_url('safety'); ?>">Safety</a></li>
                                <li><a href="<?php echo  site_url('contact'); ?>">Contact Us</a></li>
                                <li><a href="<?php echo  site_url('policy'); ?>">Privacy Policy</a></li>
                                <li><a href="https://www.facebook.com/pages/Uhitch/757351874278710?ref=hl"><img src=<?php echo base_url('assets/imgs/icons/facebook3.png'); ?>></a></li>
                                <li><a href="http://instagram.com/uhitch1"><img src=<?php echo base_url('assets/imgs/icons/instagram3.png'); ?>></a></li>
                                <li><a href="https://twitter.com/uhitch1"><img src=<?php echo base_url('assets/imgs/icons/twitter3.png'); ?>></a></li>
                            </ul>
                        </menu>
                        <p>&copy; UHitch <?php echo date("Y"); ?></p>
                    </footer> 
                </div>
            </div>
            </header>
        </div>
    </body>
</html>