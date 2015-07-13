<div id="page_content">
    <div id="page">
        <section id="members">
            <div id="ride_message">
                <h2>Ride has been updated successful</h2>
                <img src=<?=base_url('assets/imgs/icons/check.png');?>>
                <p>Your Ride has now been Posted!!!</p> 
            </div>
        </section>
    </div>
</div>

<script type="text/javascript">
    setTimeout(function () {
       window.location.href = "<?=site_url('main/ridepanel')?>"; 
    }, 2200);
</script>