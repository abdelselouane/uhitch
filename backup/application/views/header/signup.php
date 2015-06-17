<header>
    <nav>
        <?php 
            // Displays Logo
            $this->load->view('Header/logo');  
        ?>   
        <a href="<?=site_url('welcome/join'); ?>" >
            <button class="altbutton button">Sign Up</button>    
        </a>
    </nav>
</header>
