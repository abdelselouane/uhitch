<section id="page_missing">
    <div id='content_wrapper'>
        <div id="about_content">
            <!--<div id='content'>-->
                <h1>Sorry, This Page Does Not Exist</h1>
                <p>
                    The link you followed may either be broken,
                    or the page has been removed.
                </p>
                <figure>
                    <img src="<?php echo base_url('assets/imgs/errorpage/pagemissing.png');?>">
                </figure>

                <p>
                    <a href="javascript:history.back(-1);">
                        <button class="button">
                            Go Back  
                        </button>
                    </a>
                    
                    <label>
                        or    
                    </label>
     
                    <a href="<?= site_url('welcome/') ?>">
                        <button class="button">
                            Return to UHitch  
                        </button>
                    </a>
                </p>
            <!--</div>-->    
        </div>
    </div>
</section>

<style>
    #page_missing,
    #page_missing p{
        text-align: center;
    }
    
    #page_missing p,
    #page_missing h1{
        margin: 0 auto 1%;
        padding: 0;
    }
    
    #page_missing h1{
         background-color: black ;
         -webkit-font-smoothing: antialiased;
        -webkit-background-clip: text;
        -moz-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: rgba(255,255,255,0.5) 2px 3px 6px;
    }
    
    #page_missing img {
        width: 100%;
    }
    
    #page_missing button {
        display: inline;
        background: #904645;
        font-size: 120%;
        width: 10em;
        
        webkit-box-shadow: 0px 7px 0px #643130, 0px 6px 15px rgba(0,0,0,.7);
        -moz-box-shadow: 0px 7px 0px #643130, 0px 6px 15px rgba(0,0,0,.7);
        box-shadow: 0px 7px 0px #643130, 0px 6px 15px rgba(0,0,0,.7);
    }
    
    #page_missing button:active {
        -webkit-box-shadow: 0px 3px 0px #643130, 0px 3px 6px rgba(0,0,0,.9);
        -moz-box-shadow: 0px 3px 0px #643130, 0px 3px 6px rgba(0,0,0,.9);
        box-shadow: 0px 3px 0px #643130, 0px 3px 6px rgba(0,0,0,.9);
        position: relative;
        top: 3px;
    }
    
    #page_missing p a,
    #page_missing p a:hover{
        text-decoration: none;
        margin: 0 0 5%;
    }
    
    #page_missing label {
        margin: 0 1%;
        padding: 10% 0 0;
        font-size: 210%;
    }
    
    #page_missing figure {
        width: 35%;
        margin: 0 auto;
        overflow: hidden;
    }
</style>