<?php 

//echo '<pre>'; print_r($this->page['results']); echo '</pre>';//exit;

?>
<div id="page_content">
    <div id="page">
        <section id="members">
            <h2 class="center header">Upcoming Events</h2>
            <div id="events">
                <div><p id="events-title">Events Near <?php echo $data->school;?></p></div>
                <hr class="normal"/>
                
                <?php if($this->page['results']): ?>
                    <?php foreach($page['results']['events'] as $event): ?>
                        
                        <div class="event">
                            <figure>
                                <?php 
                                    $image = base_url().'assets/photos/events/'.$event["Photo"];
                                    $alt = $event['Name'];
                                    echo "<image src='$image' alt='$alt' />";
                                ?>
                            </figure>
                            <div class="event_info">
                                <h2><?php echo $event['Name'];?></h2>
                                <div class="location">
                                    <span class="normal">
                                        <?php 
                                            $address  = strlen($event['Location']) > 75
                                                    ? substr($event['Location'],0,75)."..." : $event['Location'];
                                            $location = $event['City'].', '.$event['State'];
                                            
                                            echo $address.'<br/>'.$location; 
                                        ?> 
                                    </span>
                                </div>
                                <div>
                                    <span class="m-FontSize">
                                    <?php 
                                        $date = new DateTime($event['EventDate']);
                                        echo 'Date: '.$date->format('m/d/Y');
                                    ?>
                                    </span>
                                    <span class="m-FontSize">
                                    <?php 
                                        $time = date("g:i a", strtotime($event['EventTime']));
                                        echo 'Time: '.$time;
                                    ?>
                                    </span>
                                </div>
                                <a href="<?php echo site_url().'/main/eventinfo?q='.$event['EventId']; ?>">See More</a>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                    <p class="paginate m-FontSize"><?php echo $this->page['links'];?></p>
                <?php else : ?>
                    <div id="no-events">
                        <span class="m-FontSize">There aren&#39;t any events within this area at this time</span>
                        <br/><a class="button" href="../main/newevent">Create New Event</a>
                    </div>
                <?php endif; ?> 
            </div>
        </section>
    </div>
</div>