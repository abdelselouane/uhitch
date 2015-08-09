<?php

//echo '<pre>'; print_r($this->page['results']); echo '</pre>';exit;

?>
<div id="page_content">
    <div id="page">
        <section id="members">
            <div id="upcoming-events">
                <h2 class="green center text-uppercase"><i class="fa fa-map-marker"></i>&nbsp; Upcoming Events</h2>
            <!-- Carousel
            ================================================== -->
<!--        <?php //echo '<pre>'; print_r($data->events); echo '</pre>';?>-->
            <?php if(is_array($this->page['results']['events']) && count($this->page['results']['events'])>0){?>
            <div id="myUpcomingEventsCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                  <?php
                    if(isset($this->page['results']['events']) && count($this->page['results']['events'])>0){
                        for($i=0; $i < count($this->page['results']['events']); $i++){
                            if($i==0){
                                echo '<li data-target="#myUpcomingEventsCarousel" data-slide-to="0" class="active"></li>';
                            }else{
                                echo '<li data-target="#myUpcomingEventsCarousel" data-slide-to="'.$i.'"></li>';
                            }
                        }
                    }
                  ?>
              </ol>
              <div class="carousel-inner" role="listbox">
                <?php 
                  $display = 0;                                                      
                                                         
                 foreach ($this->page['results']['events'] as $key => $value){
                  //if($display < 3) {   
                  
                    $imagepath = file_exists("assets/photos/events/".$value['Photo']) ? "assets/photos/events/".$value['Photo']:   "assets/photos/events/default.png";
     
                  $imageUrl = base_url($imagepath);
                
                ?>
                  
                    <div class="item <?= $key == 0 ? 'active' : '' ?>">
                      <img class="" style="max-height: 450px;width:800px; height: auto; display: table; margin: 0 auto;" src="<?= base_url("assets/photos/events/".$value['Photo']) ?>">
                      <div class="container">
                        <div class="carousel-caption">
                          <h1 style="color: #fefefe;"><?= $value['Name'];?></h1>
                          <p><a class="btn btn-primary" target="_blank" href="<?= base_url('index.php/main/eventinfo?q='.$value['EventId'])?>" role="button">GO TO THE EVENT PAGE NOW</a></p>
                        </div>
                      </div>
                    </div>
                <?php 
                     //$display++; }
                }
                ?>
              </div>
              <a class="left carousel-control" href="#myUpcomingEventsCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myUpcomingEventsCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div><!-- /.carousel -->
           <?php } ?>
            
                <a class="advance-link">Advanced Search <i class="fa fa-plus"></i></a>
                <div id="advancesearch">
                    <form action="<?= base_url().'index.php/main/upcoming'?>" method="POST" id="advanced-form" name="advanced-form">
                        <div class="left">
                            <div class="form-group">
                                <input  type="text" name="Name" class="form-control" id="Name" placeholder="Event Name" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input  type="text" name="City" class="form-control" id="City" placeholder="City" autocomplete="off">
                            </div>
                        </div>
                        <div class="right">
                            <div class="form-group">
                                <input  type="text" name="Location" class="form-control" placeholder="Address" id="Location" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <select name="State" class="form-control" id="State" >
                                    <option value="">Select State</option>
                                    <?php 
                                        if(isset($this->page['results']['states'])){
                                            foreach($this->page['results']['states'] as $key => $value){
                                                echo '<option value="'.$value.'">'.$key.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group">
                            <a class="btn btn-primary search">Search <i class="fa fa-search"></i></a>
                        </div>
                    </form>
                </div>
                <?php if( isset($this->page['results']['events']) ){ ?>
                <div class="alert <?= (count($this->page['results']['events']) != 0 ) ? 'alert-info' : 'alert-warning' ?>">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p id="events-title"> <strong>Searching Events: </strong><?= (count($this->page['results']['events']) != 0 ) ? ( (count($this->page['results']['events']) > 1 ) ?  '#'.count($this->page['results']['events']).' Events Found' : '#'.count($this->page['results']['events']).' Event Found' ) : 'No Events Found...' ?></p>
                </div>
                <?php } ?>
                <table id="eventsListing" class="display">
                    <thead>
                      <tr>
                        <th>Photo</th>
                        <th>Event Name</th>
                        <th>Address</th>
                        <th>At</th>
                        <th class="text-center">Details</th>
                      </tr>
                    </thead>
                  <tbody>
                      <?php 
                            if(isset($this->page['results']['events']) && count($this->page['results']['events']) > 0 ){
                             foreach($this->page['results']['events'] as $key => $value){
                                 
                                $eventPhoto = ( !file_exists('assets/photos/events/'.$value['Photo']) ) ? 'assets/photos/events/default.png' : 'assets/photos/events/'.$value['Photo'];
                                 
                          ?>
                             <tr>
                                <td class="text-left"><img width="100px" height="auto" src="<?= base_url($eventPhoto); ?>"></td>
                                <td class="text-left"><?= $value['Name']?></td>
                                <td class="text-left"><?= $value['Location'].'<br>'.$value['City'].', '.$value['State'].', '.$value['Zip']?></td>
                                <td class="text-left"><?= date('m/d/Y', strtotime($value['EventDate'])).'<br>'.$value['EventTime']?></td>
                                <td><!-- Button trigger modal -->
                                    <a class="item-action info" data-id="<?=$value['EventId']?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-list"></i></a>
                                </td>
                              </tr>
                          <? 
                             }
                            }

                          ?>
                  </tbody>
               </table>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Event Details</h4>
                      </div>
                      <div class="modal-body">
                        <div id="loading-container">
                            <img src="<?=base_url().'assets/imgs/preloading.gif'?>" alt="loading">
                        </div>
                        <div id="eventResult">
                            <div class="row">
                                 <div class="left">
                                 </div>
                                 <div class="right">
                                </div>
                            </div>
                            <div class="row">
                                <div class="rides-row"></div>
                            </div>
                        </div>
                      </div>
                      <div id="request" class="modal-footer">
                        
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </section>
    </div>
</div>