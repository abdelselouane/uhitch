<header>
    <nav>
        <?php 
            // Displays Logo
            $this->load->view('Header/logo'); 
        ?>
        <div id="register_menu">
            <div>
                <a href="<?=site_url('register/personal');?>">
                    <img src="<?=base_url('assets/imgs/header/car.png'); ?>" />
                    <p><b>Personal</b></p>
                </a>
            </div>
            <div>
                <a href="<?=site_url('register/schoolinfo');?>">
                    <img src="<?=base_url('assets/imgs/header/college.png'); ?>" />
                    <p><b>School</b></p>
                </a>
            </div>
            <div>
                <a href="<?=site_url('register/uploadpic');?>">
                    <img src="<?=base_url('assets/imgs/header/man.png'); ?>" />
                    <p><b>Photo</b></p>
                </a>
            </div>
        </div>
    </nav>
</header>