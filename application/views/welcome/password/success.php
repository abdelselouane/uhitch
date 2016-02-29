<div id="page_content">
    <div id="page">
        <section id="create_password_sucess">
            <img src=<?php echo base_url('assets/imgs/icons/success.png');?>>
            <h2>Your Password Has Been Successfully Changed!</h2>
        </section>
    </div>
</div>

<script type="text/javascript">
    setTimeout("location.href = '<?=site_url('main')?>';", 3000);
</script>

<style>
    #create_password_sucess {
        width:600px;
        min-height: 400px;
        overflow: hidden;
        text-align: center;
        margin: 180px auto 60px auto;
        padding: 1em;
        border-radius: 5px;
        border: 2px solid #ec9826;
        color: #4e4e4e;
        background-color: rgba(250,248,235,0.9);
    }
    
    #create_password_sucess #content img {
        margin: 0 auto;
        text-align: center;
        padding: 0;    
    }
    
    #create_password_sucess h2 {
        width: 100%;
        font-size: 18px;
        margin: 0 auto ;
        text-align: center;
        padding: 40px 0;
        color: #5cb85c;
        font-weight: 600;
    }
</style>