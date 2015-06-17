<footer>
    <div>
        <menu>
            <ul>
                <li><a href="<?php echo site_url('safety') ?>">Safety Features</a></li>
                <li><a href="<?php echo site_url('contact') ?>">Contact Us</a></li>
                <li><a href="<?php echo site_url('policy') ?>">Privacy Policy</a></li>
                <li><a href="https://www.facebook.com/pages/Uhitch/757351874278710?ref=hl"><img src=<?php echo base_url('assets/imgs/icons/facebook.png'); ?>></a></li>
                <li><a href="http://instagram.com/uhitch1"><img src=<?php echo base_url('assets/imgs/icons/instagram.png'); ?>></a></li>
                <li><a href="https://twitter.com/uhitch1"><img src=<?php echo base_url('assets/imgs/icons/twitter.png'); ?>></a></li>
            </ul>
        </menu>       
        <br/>
        <p>&copy; UHitch <?php echo date("Y"); ?></p>
    </div>
    <input type="hidden" id="url" value="<?php echo base_url();?>"/>
</footer> 
    <script src="<?php echo base_url();?>/assets/js/jquery-1.11.1.min.js"></script>
    <?php if(isset($scripts)): ?>
        <?php foreach($scripts as $script): ?>
            <script src='<?php echo $script;?>'></script>
        <?php endforeach; ?>
    <?php endif; ?>
    </body>
</html>