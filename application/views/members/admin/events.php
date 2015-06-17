<div class="container-fluid" style="margin-top:150px">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <h2 class="green center">Events Panel</h2>
            <table class="table table-striped">
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Created</th>
                    <th class="center">Event Date/Time</th>
                    <th class="center">Approved</th>
                    <th class="center">Action</th>
                </tr>
                
                <?
                    if(!empty($events)){
                        foreach( $events as $key => $value ){
                        ?>
                            <tr>
                                <th><img src="<?= base_url().'assets/photos/events/'.$value['Photo']?>" width="100px" height="auto"></th>
                                <td><?= $value['Name']?></td>
                                <td>
                                    <?= $value['Location']?><br>
                                    <?= $value['City'].', '.$value['State'].', '.$value['Zip']?>
                                </td>
                                <td><?= date ( 'd/m/Y', strtotime($value['CreatedDate']) ); ?></td>
                                <td class="center <?= ( $value['Reviewed'] != 1) ? 'alert alert-danger' : 'alert alert-success' ?>"><?= date ( 'd/m/Y', strtotime($value['EventDate']) ).' '.$value['EventTime'] ?></td>
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
                                <td  class="center <?= ( $value['Reviewed'] != 1) ? 'alert alert-danger' : 'alert alert-success' ?>">
                                    <button class="approve-btn" data-url="<?= ( $value['Reviewed'] != 1) ? site_url().'/main/approveEvent/'.$value['id'] : site_url().'/main/disapproveEvent/'.$value['id']; ?>" ><?= ( $value['Reviewed'] != 1) ? 'Approve' : 'Disapprove' ?></button>
                                </td>
                            </tr>
                        <?}
                    }
                ?>
                
            </table>
        </div>
    </div>
</div>