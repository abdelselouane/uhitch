 <!--  Footer -->    
    <footer>
        <div class="container">
            <div class="row center">
                <ul id="footer-nav">
                    <li><a href="<?php echo  site_url('safety'); ?>">Safety</a></li>
                    <li><a href="<?php echo  site_url('contact'); ?>">Contact Us</a></li>
                    <li><a href="<?php echo  site_url('policy'); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo  site_url('payment'); ?>">Payment Policy</a></li>
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
	<!--script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script-->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

    <?php if(isset($scripts)): ?>
        <?php foreach($scripts as $script): ?>
            <script src='<?php echo $script;?>'></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <script type="text/javascript">  
        $( document ).ready(function(){
            //alert('ok');
            $('.sbm-expand').click(function(){//alert('ok');
                   
               // console.log($( this ).next());
                $( '.submenu' ).slideUp();
                                              
                if( $( this ).next().css('display') == 'none' )
                { 
                   // console.log($( this ).next());
                    $( this ).next().css('display', 'block');//slideDown();
                }else{
                     $( this ).next().slideUp();
                }
            });
            
        });
    </script>

    <!--/***  END OLD CODE COMMENTED OUT ON 04/25/2015 ***/-->
    <!--script src="<!--?php echo base_url();?>/assets/js/jquery-1.11.1.min.js"></script-->
    <!--?php if(isset($scripts)): ?>
        <!--?php foreach($scripts as $script): ?>
            <script src='<!--?php echo $script;?>'></script>
        <!--?php endforeach; ?>
    <!--?php endif; ?!-->
    <!--/***  END OLD CODE ***/-->

    </body>
</html>