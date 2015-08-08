<div id="page_content">
    <div id="page">
        <section id="members">
            <div id="ride_message" style="width:100% !important">
                <?php //echo '<pre>'; print_r($this->error); echo '</pre>'?>
                <h2>EVENT PHOTO UPLOAD ERROR </h2>
                <?php if(isset($this->error) && !empty($this->error)){ ?>
                <div class="alert alert-danger">
                    <p class="text-uppercase">
                        <?= strtoupper($this->error['Error']);?>
                    </p>
                    <p class="text-uppercase">Please Try Again</p>
                </div>
                <?php } 
                    
                    $url = (isset($this->error['EventId'])) ? '/main/newevent?q='.$this->error['EventId'] : '/main/newevent';
                
                ?>
                <img src=<?php echo base_url('assets/imgs/icons/stop.png');?>>
                <p>We've Encountered an Error When Creating your Event<br/>
                    We are looking into the issue
                </p>
                <a href="<?php echo site_url($url)?>">
                    <button class="button">Try Again</button>
                </a>
            </div>
        </section>
    </div>
</div>