<?php 
    $imagepath = file_exists("assets/photos/users/".$data->photo) ? "assets/photos/users/".$data->photo : "assets/photos/default.png";
    $imageUrl = base_url($imagepath);

    $userName   = (trim($data->name))    ? $data->name   : 'N/A';
    $location   = (trim($data->city))    ? $data->city   : 'N/A';
    $email      = (trim($data->email))   ? $data->email  : 'N/A';
    $school     = (trim($data->school))  ? $data->school : 'N/A';
    $login      = (trim($data->login))   ? $data->login  : 'N/A';  
    $member     = (trim($data->members)) ? $data->members: 'N/A';
?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-12">
        <div class="well well-sm" style="text-align:left;">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <img src="<?php echo $imageUrl;?>" alt="<?php echo $userName;?>" alt="" style="margin: 0 auto; height: 140px !important;" class="img-rounded img-responsive" />
                </div>
                <div class="col-sm-6 col-md-4">
                    <h4><?= $userName ?>&nbsp;<img src="<?=base_url('assets/imgs/4-stars.png');?>" style="margin-top:-5px;"></h4>
                    <small><cite class="text-uppercase" title="<?= $location ?>"><?= $location ?>&nbsp;<i class="glyphicon glyphicon-map-marker">
                    </i></cite></small>
                    <p>
                        <i class="glyphicon glyphicon-envelope"></i>&nbsp;<?= $email ?>
                        <br />
                        <i class="glyphicon glyphicon-briefcase"></i>&nbsp;<?= $school ?>
                        <br />
                    </p>
                </div>
                <div class="col-sm-6 col-md-5">
                    <a href="<?=site_url('main/postride');?>" class="btn btn-primary" style="margin: 15px auto;">Post Your Ride</a>
                    <p>
                        <i class="glyphicon glyphicon-lock"></i>&nbsp;Last Login: <?= $login?>
                        <br />
                        <i class="glyphicon glyphicon-user"></i>&nbsp;Member Since: <?= $member?>
                        <br />
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>