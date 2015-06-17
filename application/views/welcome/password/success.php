<div id="page_content">
    <div id="page">
        <section id="create_password">
            <!--<div id="content">-->
                <span>
                    <img src=<?php echo base_url('assets/imgs/icons/success.png');?>>
                    <h2>Your Password Has Been Successfully Changed!</h2>
                </span>
            <!--</div>-->
        </section>
    </div>
</div>

<script type="text/javascript">
    setTimeout("location.href = '<?=site_url('main')?>';", 2400);
</script>

<style>
    #page #create_password {
        overflow: hidden;
        text-align: center;
        margin: 0 auto;
        padding: 0 0 1%;
    }
    
    #page #create_password #content span {
        width: 25em;
        text-align: center;
        overflow: hidden;
        margin: 0 auto;
        border: 1px solid;
    }
    
    #page_content #page #create_password #content img {
        margin: 0 auto;
        text-align: center;
        padding: 0;    
    }
    
    #create_password #content span h2 {
        width: 100%;
        border: 1px solid;
        margin: 0 auto ;
        text-align: center;
        padding: 0;
    }
</style>