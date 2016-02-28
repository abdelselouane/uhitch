<div class="container-fluid" style="margin-top:150px">
    <div id="allevent" class="row">
        <div class="col-sm-12 col-md-12">
            <?php //echo '<pre>'; print_r($events['events']); echo '</pre>';?>
            <h2 class="green center text-uppercase"><i class="fa fa-calendar"></i>&nbsp;Events Panel</h2>
            <a class="advance-link btn btn-primary">Advanced Search <i class="fa fa-plus"></i></a>
            <a href="<?= site_url().'/main/allevent'?>" class="btn btn-primary">Reload <i class="fa fa-refresh"></i></a>
            <div id="advancesearch">
                <h4>Advanced Search:</h4>
                <form action="<?= base_url().'index.php/main/allevent'?>" method="POST" id="advanced-form" name="advanced-form">
                    <div class="left">
                        <div class="form-group">
                            <input  type="text" name="Name" class="form-control" id="Name" placeholder="Event Name" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input  type="text" name="City" class="form-control" id="City" placeholder="City" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <select name="State" class="form-control" id="State" >
                                <option value="">Select State</option>
                                <?php 
                                    if(isset($events['states'])){
                                        foreach($events['states'] as $key => $value){
                                            echo '<option value="'.$value.'">'.$key.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="right">
                        <div class="form-group">
                            <input  type="text" name="Location" class="form-control" placeholder="Address" id="Location" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input  type="text" name="Zip" class="form-control" placeholder="Zip Code" id="Zip" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <select name="Approve" class="form-control" id="Approve" >
                                <option value="">Select Status</option>
                                <option value="1">Approved</option>
                                <option value="0">Disapproved</option>
                                <option value="2">Pre Removed</option>
                            </select>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group">
                        <a class="btn btn-primary search">Search <i class="fa fa-search"></i></a>
                    </div>
                </form>
            </div>
            <table id="eventsListing" class="display">
                <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Created</th>
                    <th class="center">Rides</th>
                    <th class="center">Event Date/Time</th>
                    <th class="center">Approved</th>
                    <th class="center" style="width:140px;">Action</th>
                </tr>
                </thead>
                <tbody>
                <?
                    if(!empty($events['events'])){
                        foreach( $events['events'] as $key => $value ){
                        ?>
                            <tr>
                                <td class="text-left"><a href="<?= site_url().'/main/eventinfo?q='.$value['EventId']?>" target="_blank"><img src="<?= base_url().'assets/photos/events/'.$value['Photo']?>" class="img-thumbnail" width="100px" height="auto"></a></td>
                                <td class="text-left"><a href="<?= site_url().'/main/eventinfo?q='.$value['EventId']?>" target="_blank"><?= $value['Name']?></a></td>
                                <td class="text-left">
                                    <?= $value['Location']?><br>
                                    <?= $value['City'].', '.$value['State'].', '.$value['Zip']?>
                                </td>
                                <td class="text-left"><?= date ( 'd/m/Y', strtotime($value['CreatedDate']) ); ?></td>
                                <td class="center <?= ( $value['hasrides'] > 0) ? 'alert alert-warning' : '' ?>">
                                    <?= ($value['hasrides']) ? ( ($value['hasrides']>1) ? $value['hasrides'].' Rides' : $value['hasrides'].' Ride' ) : 'No Rides' ?>
                                </td>
                                <td class="center <?= ( $value['Reviewed'] != 1) ? 'alert alert-danger' : 'alert alert-success' ?>"><?= date ( 'd/m/Y', strtotime($value['EventDate']) ).'<br>'.$value['EventTime'] ?></td>
                                <td class="center <?= ( $value['Reviewed'] != 1) ? 'alert alert-danger' : 'alert alert-success' ?>">
                                    <? 
                                        if( $value['Reviewed'] != 1){
                                    ?>
                                        <i class="fa fa-remove" style="color: red;"></i>
                                    <?
                                        }else{
                                    ?>
                                        <i class="fa fa-check" style="color: green;"></i>
                                    <?
                                        } 
                                    ?>
                                </td>
                                <?php if($value['Reviewed'] != 2){ ?>
                                <td class="center">
                                    <a class="btn btn-primary btn-sm aprv-btn" data-toggle="tooltip" title="<?= ( $value['Reviewed'] != 1) ? 'Approve' : 'Disapprove'?> Event" data-url="<?= ( $value['Reviewed'] != 1) ? site_url().'/main/approveEvent/'.$value['id'] : site_url().'/main/disapproveEvent/'.$value['id']; ?>" ><?= ( $value['Reviewed'] != 1) ? '<i class="fa fa-thumbs-up"></i>' : '<i class="fa fa-thumbs-down"></i>' ?></a>
                                    <a id="alleventedit" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Event" href="<?= site_url().'/main/newevent?q='.$value['EventId'] ?>&admin=1"><i class="fa fa-pencil-square-o"></i></a>
                                    <a class="btn btn-primary btn-sm aprv-btn" data-toggle="tooltip" title="Pre Removal" data-url="<?= site_url().'/main/deleteevent/'.$value['EventId'] ?>"><i class="fa fa-flag"></i></a>
                                </td>
                                <?php }else{ ?>
                                <td  class="center">
                                    <a class="btn btn-primary btn-sm aprv-btn" data-toggle="tooltip" title="This Event is temporary off site - Revert it back?" data-url="<?= site_url().'/main/eventrevert/'.$value['EventId'] ?>"><i class="fa fa-file"></i></a>
                                    <a class="btn btn-primary btn-sm aprv-btn trash" data-toggle="tooltip" title="This Event is temporary off site - Trash it?" data-url="<?= site_url().'/main/trashevent/'.$value['id'] ?>"><i class="fa fa-trash"></i></a>
                                </td>
                                <?php } ?>
                            </tr>
                        <?}
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>