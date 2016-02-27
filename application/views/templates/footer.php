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
    <script src="<?php echo base_url();?>assets/js/toastr.min.js"></script>
    <?php if(isset($scripts)): ?>
        <?php foreach($scripts as $script): ?>
            <script src='<?php echo $script;?>'></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <script type="text/javascript">  
        $( document ).ready(function(){
            
             toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
             
            //alert('ok');
            $('.sbm-expand').click(function(){//alert('ok');
                   
               // console.log($( this ).next());
                $( '.submenu' ).slideUp();
                                              
                if( $( this ).next().css('display') == 'none' )
                { 
                   // console.log($( this ).next());
                    $( this ).next().slideDown();//css('display', 'block');//slideDown();
                }else{
                     $( this ).next().slideUp();
                }
            });
            
            var mouse_is_inside = false;
            
            $('.submenu').hover(function(){ 
                mouse_is_inside=true; 
            }, function(){ 
                mouse_is_inside=false; 
            });

            $("body").mouseup(function(){ 
                if(! mouse_is_inside) $('.submenu').slideUp();
            });
            
            $('#search-btn-submit').click(function(event){
                event.preventDefault();
                $('#search_form').submit();
            
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