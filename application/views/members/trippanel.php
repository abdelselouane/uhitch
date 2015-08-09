<div id="page_content">
    <div id="page">
        <section id="ridepanel">
            <h2 class="green center header-line text-uppercase"><i class="fa fa-road"></i>&nbsp;My Trips</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <?php //echo '<pre>'; print_r($data->ride_data); echo '</pre>'; ?>
                            <table id="rideListing" class="display">
                                <thead>
                                  <tr>
                                    <th>Trip Name</th>
                                    <th>Trip To</th>
                                    <th>Date Time</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                              <tbody>
                                  <?php 
                                    if(isset($data->ride_data) && count($data->ride_data) ){
                                     foreach($data->ride_data as $key => $value){
                                  ?>
                                     <tr>
                                        <td class="text-left"><?= $value['Name']?></td>
                                        <td class="text-left"><?= $value['ArriveShort']?></td>
                                        <td class="text-left"><?= date('m/d/Y H:i a', strtotime($value['DepartDate'].' '.$value['DepartTime']))?></td>
                                        <td><!-- Button trigger modal -->
                                            <a class="item-action info" data-id="<?=$value['id']?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-list"></i></a>
                                            <a class="item-action"><i class="fa fa-trash"></i></a>
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
                        <h4 class="modal-title" id="myModalLabel">Trip Details</h4>
                      </div>
                      <div class="modal-body">
                        <div id="rideResult">
                            <div class="row">
                                 <div class="left">
                                 </div>
                                 <div class="right">
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </section>
    </div>
</div>