<div class="general_info">
    <figure>
        <img src=<?php echo base_url('assets/imgs/blank.png');?>>
    </figure>
    <div id="user">
        <h3><?=$data->name?></h3>
        <div class="ratings">
            <div class="rating-img">

                <?php
                    // Pass the rating to the for loop
                    // Write if statement to determine if the user
                    // has a rating
                    //for ($i = 1; $i <= 3; $i++) {
                ?>
                
<!--                <figure>
                    <img src=<?php echo base_url('assets/imgs/icons/thumbup.png');?>>    
                </figure>-->
                        
                <?php    
                    //}
                ?>

                <h4>Driver Rating</h4>  
            </div>
        </div>
        <br/>
        <div class="user_info">
            <span>Age: <?=$data->age?></span>
            <span>Classification</span>
            <span>Attends <?=$data->school?></span>
            <span>Message </span>
        </div>
    </div>
</div>