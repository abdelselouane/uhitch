<header>
    <nav>
        <?php 
            // Displays Logo
            $this->load->view('Header/logo');  
        ?>
        <label>
            Sign Up
        </label>
        
        <a href="<?=site_url('welcome/login')?>" >
            <button class="altbutton button">Log In</button>    
        </a>
    </nav>
</header>

