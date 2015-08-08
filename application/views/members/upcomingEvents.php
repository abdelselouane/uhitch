<?php

//echo '<pre>'; print_r($this->page['results']); echo '</pre>';exit;

?>
<div id="page_content">
    <div id="page">
        <section id="members">
            <div id="upcoming-events">
                <h2 class="green center">Upcoming Events</h2>
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
                <div class="alert alert-info">
                    <p id="events-title">Events Near <?= ($data->school) ? $data->school : 'By';?></p>
                </div>
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
                                <td class="text-left"><img width="50px" height="auto" src="<?= base_url($eventPhoto); ?>"></td>
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