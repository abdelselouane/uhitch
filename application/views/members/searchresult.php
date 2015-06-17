<?php $search = $this->input->get('searchBy');?>

<div id="page_content">
    <div id="page">
        <section id="members" style="width: 45em;">
            <?php if($this->page['results']): ?>
                <h2 class="no-shadow">Search Results for "<?php echo $this->input->get('destination'); ?>"</h2>
                <hr/>
                <?php foreach($page['results'] as $result): ?>
                    
                    <?php // Users ?>
                    <?php if($search === 'user' || $search === 'users'): ?>
                        <div id="<?php echo $result['UserID'];?>" class="search-result">
                            <figure>
                                <img src="<?php echo base_url().'assets/photos/users/'.$result['Photo']; ?>" 
                                     alt="<?php echo $result['Full_Name']; ?>" />
                            </figure>
                            <div class="search-info">
                                <h2 class="margin-10 no-shadow"><?php echo $result['Full_Name']; ?></h2>
                                <h3 class="margin-10 no-shadow"><?php echo $result['School_Name']; ?></h3>
                                <h3 class="margin-10 no-shadow">
                                    <?php echo !empty($result['Classification']) ? $result['Classification'] : 'N/A' ; ?>
                                </h3>
                            </div>
                        </div>
                        
                    <?php // Events ?>
                    <?php elseif($search === 'event' || $search === 'events'): ?>
                        <div class="search-result">
                            <figure>
                                <img src="<?php echo base_url().'assets/photos/users/'.$result['Photo']; ?>" 
                                     alt="<?php echo $result['Name']; ?>" />
                            </figure>
                            <div class="search-info">
                                <h2 class="margin-10 no-shadow"><?php echo $result['Name'];?></h2>
                                <h3 class="margin-10 no-shadow">
                                    <?php echo $result['City'] . ', '. $result['State'];?>
                                </h3>
                                <h3 class="margin-10 no-shadow">
                                    <span>
                                        <?php 
                                            $date = new DateTime($result['EventDate']);
                                            echo 'Date: '.$date->format('m/d/Y');
                                        ?>
                                    </span>
                                    <span>
                                        <?php echo 'Time: '.date("g:i a", strtotime($result['EventTime'])); ?>
                                    </span>
                                </h3>
                            </div>
                        </div>
                
                    <?php // Rides ?>
                    <?php elseif($search === 'ride' || $search === 'rides'): ?>
                        <?php 
                            $date = new DateTime($result['DepartDate']);
                            $future = strtotime($result['DepartDate']);
                            $now = time();
                            $timeleft = $future-$now;
                            $daysleft = round((($timeleft/24)/60)/60);
                            
                            switch (TRUE) {
                                case ($daysleft > 5):
                                    $departs = $date->format('m/d/Y');
                                    break;
                                case ($daysleft > 0 && $daysleft <= 5):
                                    $departs = "$daysleft Days Left";
                                    break;
                                default :
                                    $departs = "Expired";
                                    break;
                            }
                        ?>
                        <div id="<?php echo $result['Ride_ID']; ?>" class="search-result">
                            <figure></figure>
                            <div class="search-info">
                                <h2 class="margin-10 green no-shadow"><?php echo $result['DepartShort']; ?> &#x21c6; <?php echo $result['ArriveShort']; ?></h2>
                                <h3 class="margin-10 no-shadow">
                                    <span>Departs: <?php echo $departs; ?></span>
                                    <span>Time: <?php echo date("g:i a", strtotime($result['DepartTime']) );?></span>
                                </h3>
                                <h3 class="margin-10 no-shadow">
                                    <span>Seats: <?php echo $result['Passengers']; ?> Left</span>
                                    <span>Price: $<?php echo $result['Price']; ?>/Seat</span>
                                </h3>
                            </div>
                        </div>
                
                    <?php endif; ?>
                <?php endforeach; ?>
                
            <?php else: ?>
                <br/>
                <?php $search = $this->input->get('destination'); ?>
                <h2 class="no-shadow" style="margin-left: 15%;">
                    No Results Found for <?php echo $search; ?>
                </h2>
                <div style="margin-left: 15%; margin-top: 5%;">
                    <h4 class="no-shadow" style="margin-bottom: 0;">Suggestions</h4>
                    <ul>
                        <li>Ensure words are Spell Correctly</li>
                        <li>Use more General or Exact Keywords</li>
                        <li>Be as specific as Possible when Searching</li>
                    </ul>
                </div>
                <br/><br/>
            <?php endif; ?>
            <p class="paginate text-center m-FontSize"><?php echo $this->page['links'];?></p>
        </section>
    </div>
</div>