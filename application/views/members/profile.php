
<div id="page_content">
    <div id="page">
        <section id="profile">
                
                <?php 
                    $imagepath = file_exists("assets/photos/users/".$data->photo) ? "assets/photos/users/".$data->photo : "assets/photos/default.png";
                    $imageUrl = base_url($imagepath);

                    $userName   = (trim($data->name))    ? $data->name   : 'N/A';
                    $location   = (trim($data->city))    ? $data->city   : 'N/A';
                    $email      = (trim($data->email))   ? $data->email  : 'N/A';
                    $school     = (trim($data->school))  ? $data->school : 'N/A';
                    $login      = (trim($data->login))   ? $data->login  : 'N/A';  
                    $member     = (trim($data->members)) ? $data->members: 'N/A';
                    $class      = (trim($data->class))   ? $data->class  : 'N/A';
                    $major      = (trim($data->major))   ? $data->major  : 'N/A';
                    $greek      = (trim($data->greek))   ? $data->greek  : 'None';
                    $act        = (trim($data->activ))   ? $data->activ  : 'None';

                    $music      = (trim($data->music))  ? str_replace('-', ', ', $data->music)  : "None";
                    $org        = (trim($data->org))    ? str_replace('-', ', ', $data->org)    : "None";
                    $actvity    = str_replace('-', ', ', $act);
                ?>
                <div class="container">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-6 col-md-10">
                            <h2 class="page-header green center text-uppercase"><i class="fa fa-user"></i>&nbsp;My Profile</h2>
                            <div class="well well-sm">
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
                                            <i class="glyphicon glyphicon-lock"></i>&nbsp;Last Login: <?= $login?>
                                            <br />
                                            <i class="glyphicon glyphicon-user"></i>&nbsp;Member Since: <?= $member?>
                                        </p>
                                    </div>
                                    <div class="col-sm-6 col-md-5">
                                        <a class="btn btn-primary" href="<?= base_url() ?>index.php/main/settings" style="margin-bottom: 25px">Edit Profile</a>
                                        <p>
                                            <i class="glyphicon glyphicon-book"></i>&nbsp;Class: <?= $class ?>
                                            <br />
                                            <i class="glyphicon glyphicon-bookmark"></i>&nbsp;Major: <?= $major ?>
                                            <br />
                                            <i class="glyphicon glyphicon-tags"></i>&nbsp;Creek: <?= $greek?>
                                            <br />
                                            <i class="glyphicon glyphicon-calendar"></i>&nbsp;Activities: <?= $actvity?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <?php
                    
                    /*$this->load->view('members/user/userImage');
                    $this->load->view('members/user/userDetails');*/
                    $this->load->view('members/user/userRideHistory'); 
                
                ?>
        </section>
    </div>
</div>