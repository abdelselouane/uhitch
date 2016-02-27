<?php //echo '<pre>'; print_r($page); echo '</pre>'; exit;?>
<div id="page_content">
    <div id="page">
        <section id="profile">
            <?php
                $imagepath = file_exists("assets/photos/users/".$page['Photo']) ? "assets/photos/users/".$page['Photo'] :   "assets/photos/default.png";

                $imageUrl = base_url($imagepath);

                $userName   = isset($page['Full_Name'])         ? $page['Full_Name']   : 'N/A';
                $login      = isset($page['LastLogin'])         ? date('F j, Y', strtotime($page['LastLogin']))  : 'N/A';  
                $member     = isset($page['AccountCreated'])    ? date('F j, Y', strtotime($page['AccountCreated'])) : 'N/A';
                $email      = isset($page['Email_Address'])     ? $page['Email_Address']  : 'N/A';
                $school     = isset($page['School_Name'])       ? $page['School_Name'] : 'N/A';

                $location   = $page['City'].', '.$page['State'];

                $class      = isset($page['Classification'])   ? $page['Classification']  : 'N/A';
                $major      = isset($page['Major'])   ? $page['Major']  : 'N/A';
                $greek      = isset($page['Greek'])   ? $page['Greek']  : 'N/A';
                $act        = isset($page['Activities'])   ? $page['Activities']  : 'N/A';

                $music      = isset($page['Music'])  ? str_replace('-', ', ', $page['Music'])  : "None";
                $org        = isset($page['Organizations'])    ? str_replace('-', ', ', $page['Organizations'])    : "None";
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
                                        <a class="btn btn-primary" href="<?=site_url('main/messages?q='.$page['UserID']);?>" style="margin-bottom: 25px">Send Message</a>
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
                <?php $this->load->view('members/foundUser/userRideHistory'); ?>
        </section>
    </div>
</div>