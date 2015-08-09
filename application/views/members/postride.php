<div id="page_content">
    <div id="page">
        <section id='postRide'>
            <?php
                $this->load->view('members/postRides/rideform');
            ?>
            <div id="rideMap"></div>
            <!-- Carousel
            ================================================== -->
<!--            <?php //echo '<pre>'; print_r($data->events); echo '</pre>';?>-->
            <?php if(is_array($data->events) && count($data->events)>0){?>
            <div id="myEventsCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                  <?php
                    if(isset($data->events) && count($data->events)>0){
                        for($i=0; $i < count($data->events); $i++){
                            if($i==0){
                                echo '<li data-target="#myEventsCarousel" data-slide-to="0" class="active"></li>';
                            }else{
                                echo '<li data-target="#myEventsCarousel" data-slide-to="'.$i.'"></li>';
                            }
                        }
                    }
                  ?>
              </ol>
              <div class="carousel-inner" role="listbox">
                <?php 
                  $display = 0;                                                      
                                                         
                 foreach ($data->events as $key => $value){
                  //if($display < 3) {   
                  
                    $imagepath = file_exists("assets/photos/events/".$value['Photo']) ? "assets/photos/events/".$value['Photo']:   "assets/photos/events/default.png";
     
                  $imageUrl = base_url($imagepath);
                
                ?>
                  
                    <div class="item <?= $key == 0 ? 'active' : '' ?>">
                      <img class="" style="min-height: 470px;" src="<?= base_url("assets/photos/events/".$value['Photo']) ?>">
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
              <a class="left carousel-control" href="#myEventsCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myEventsCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div><!-- /.carousel -->
           <?php } ?>
        </section>
    </div>
</div>
<div class="clear"></div>