<div id="page_content">
    <div id="page">
        <section id="upcoming-events">
            <h2 class="green center">My Events</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <?php  //echo '<pre>'; print_r($data->event_data); echo '</pre>'; ?>
                            <table id="eventsListing" class="display">
                                <thead>
                                  <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>At</th>
                                    <th>Date/Time</th>
                                    <th>Has Ride</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                              <tbody>
                                  <?php 
                                    if(isset($data->event_data) && count($data->event_data) ){
                                     foreach($data->event_data as $key => $value){
                                        // echo '<pre>'; print_r($value); echo '</pre>';
                                  ?>
                                     <tr>
                                        <td class="text-left"><img src="<?= base_url().'assets/photos/events/'.$value['Photo']?>" width="100px" height="auto"></td>
                                        <td class="text-left"><?= $value['Name']?></td>
                                        <td class="text-left"><?= $value['Location'].'<br>'.$value['City'].', '.$value['State'].', '.$value['Zip']?></td>
                                        <td class="text-left"><?php echo date('m/d/Y', strtotime($value['EventDate'])); echo ' <br>'.$value['EventTime']?></td>
                                         <td class="text-left"><?= ($value['RideId']!='') ? '<span class="alert alert-success"><i class="fa fa-car"></i> YES </span>' : '<span class="alert alert-danger"><i class="fa fa-car"></i> NO </span>'?></td>
                                        <td><!-- Button trigger modal -->
                                            <a class="item-action info" data-id="<?=$value['EventId']?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-list"></i></a>
                                            
                                            <a href="<?= base_url().'index.php/main/newevent?q='.$value['EventId']?>" class="item-action"><i class="fa fa-refresh"></i></a>
                                           <?php  if($value['RideId']==''){ ?>
                                                <a class="item-action cancel" data-id="<?=$value['EventId']?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash"></i></a>
                                            <?php }else{ ?>
                                                <a class="item-action-disabled" ><i class="fa fa-trash"></i></a>
                                            <?php } ?>
                                        </td>
                                      </tr>
                                  <? 
                                     }
                                    }
                                  ?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                                <div class="cancel-row"></div>
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