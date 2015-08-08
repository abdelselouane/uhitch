<div id="page_content">
    <div id="page">
        <section id="members">
            <div id="ride_message" style="width:100% !important">
                <h2><?= (isset($this->success)) ? 'YOUR EVENT IS UPDATED' : 'NEW EVENT IS CREATED ' ?></h2>
                <?php if(isset($this->success) && !empty($this->success)){ ?>
                <div class="alert alert-success">
                    <p class="text-uppercase"><i class="fa fa-check"></i> Congratulations</p>
                    <p class="text-uppercase">
                        <?= strtoupper($this->success['Message']);?>
                    </p>
                </div>
                <?php } ?>
                <img src="<?php echo base_url('assets/imgs/icons/check.png');?>">
                <p>
                    We are currently reviewing your Event <br/>
                    The New Event will posted within 24 hours upon approval
                </p>      
            </div>
        </section>
    </div>
</div>

<script type="text/javascript">
    setTimeout(function () {
       window.location.href = "<?php echo site_url('main/eventpanel')?>"; 
    }, 5000);
</script>