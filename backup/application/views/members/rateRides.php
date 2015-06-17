<div id="page_content">
    <div id="page">
        <section id="ratings">
            <h1>How would you Rate your Ride?</h1>
            <?php echo form_open('main/submitRating'); ?>
            <div id="rating_info">
                <div>
                    <!--Insert Driver's Name here-->
                    <span>Driver Name</span>
                    <figure><img src="" /></figure>
                </div>
                <div> 
                    <p>Destination &#x21c6; Arrival</p>                  
                    <span class="left">Give FeedBack...</span>
<!--                    <span class="right">Characters Remaining</span>-->
                    <textarea maxlength="250" name="comments"></textarea>
                </div>   
            </div>
            <div id="rateuser">
            <?php
                $rating = array('Bad', 'Poor', 'Fair', 
                    'Good', 'Excellent');
                for($i = 0; $i < 5; $i++) {
            ?>
                <p class="rate">
                    <span><img alt="<?=$rating[$i]?>" src="<?=base_url('assets/imgs/icons/thumbup.png');?>"</span>
                    <span><input type="radio" value="<?=$i?>" name="rating" /></span>
                    <span><?=$rating[$i]?></span>
                </p>
            <?php
                }
            ?>
                <button class="button" type="submit">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </section>
    </div>
</div>