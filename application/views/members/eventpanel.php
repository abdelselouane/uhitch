<div id="page_content">
    <div id="page">  
        <section id="my-events">
            <h2 class="green center text-uppercase"><i class="fa fa-film"></i>&nbsp;My Events</h2>
                <div class="container">   
                    <div class="row">
                        <div class="col-md-12">
                            <?php  
                                 //echo '<pre>'; print_r($data->event_data); echo '</pre>'; //exit; 

                                 if( isset($data->flash_data) && !empty($data->flash_data) ){ 
                                     //echo '<pre>'; print_r($data->flash_data); echo '</pre>'; 
                            ?>
                            <div class="alert <?=  ($data->flash_data['error']) ? 'alert-warning' : 'alert-success' ?> alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <p><strong><?= ($data->flash_data['msg']) ? 'Warning!' : 'Congratulations!'?></strong> <?= ($data->flash_data['msg']) ? $data->flash_data['msg'] : '' ?></p>
                            </div>
                            <?php } ?>
                            <table id="eventsListing" class="display">
                                <thead>
                                  <tr>
                                    <th>Photo</th>
                                    <th style="width:120px;">Name</th>
                                    <th>At</th>
                                    <th>Date/Time</th>
                                    <th style="width:50px">Has Ride</th>
                                    <th>Approved</th>
                                    <th class="text-center" style="width:120px">Action</th>
                                  </tr>
                                </thead>
                              <tbody>
                                  <?php 
                                    if(isset($data->event_data) && count($data->event_data) ){
                                     foreach($data->event_data as $key => $value){
                                        // echo '<pre>'; print_r($value); echo '</pre>';
                                  ?>
                                     <tr>
                                        <td class="text-left event-gallery<?=$key?>">
                                            
                                            <a href="<?= base_url().'assets/photos/events/'.$value['Photo']?>">
                                                <img src="<?= base_url().'assets/photos/events/'.$value['Photo']?>" class="img-thumbnail" width="100px" height="auto">
                                            </a>
                                            
                                            <?php if(isset($value['Photo1']) && !empty($value['Photo1'])){ ?>
                                            <a href="<?= base_url().'assets/photos/events/'.$value['Photo1']?>" class="hidden"><img src="<?= base_url().'assets/photos/events/'.$value['Photo1']?>" alt="" title=""/></a>
                                            <?php } ?>
                                            <?php if(isset($value['Photo1']) && !empty($value['Photo2'])){ ?>
                                            <a href="<?= base_url().'assets/photos/events/'.$value['Photo2']?>" class="hidden"><img src="<?= base_url().'assets/photos/events/'.$value['Photo2']?>" alt="" title=""/></a>
                                            <?php } ?>
                                            <?php if(isset($value['Photo1']) && !empty($value['Photo3'])){ ?>
                                            <a href="<?= base_url().'assets/photos/events/'.$value['Photo3']?>" class="hidden"><img src="<?= base_url().'assets/photos/events/'.$value['Photo3']?>" alt="" title=""/></a>
                                            <?php } ?>
                                            <?php if(isset($value['Photo1']) && !empty($value['Photo4'])){ ?>
                                            <a href="<?= base_url().'assets/photos/events/'.$value['Photo4']?>" class="hidden"><img src="<?= base_url().'assets/photos/events/'.$value['Photo4']?>" alt="" title=""/></a>
                                            <?php } ?>
                                            
                                            <script type="text/javascript">
                                                $(function(){
                                                    var $gallery<?=$key?> = $('.event-gallery<?=$key?> a').simpleLightbox();
                                                });
                                            </script>
                                            
                                        </td>
                                        <td class="text-left"><a href="<?= base_url()."index.php/main/eventinfo?q=".$value['EventId']?>" target="_blank"><?= $value['Name']?></a></td>
                                        <td class="text-left"><?= $value['Location'].'<br>'.$value['City'].', '.$value['State'].', '.$value['Zip']?></td>
                                        <td class="text-left"><?php echo date('m/d/Y', strtotime($value['EventDate'])); echo ' <br>'.$value['EventTime']?></td>
                                         <td class="text-left"><?= ($value['RideId']!='') ? '<span class="alert alert-success"><i class="fa fa-car"></i> YES </span>' : '<span class="alert alert-danger"><i class="fa fa-car"></i> NO </span>'?></td>
                                        <td class="text-left"><?= ($value['Reviewed']!=0) ? '<span class="alert alert-success"><i class="fa fa-check"></i> YES </span>' : '<span class="alert alert-warning"><i class="fa fa-minus-circle"></i> NO </span>'?></td> 
                                        <td><!-- Button trigger modal -->
                                            <a class="item-action info" data-id="<?=$value['EventId']?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-list"></i></a>
                                            
                                            <a href="<?= base_url().'index.php/main/newevent?plan='.$value['Plan'].'&q='.$value['EventId']?>" class="item-action"><i class="fa fa-edit"></i></a>
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
                                <div class="rides-row"></div>
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