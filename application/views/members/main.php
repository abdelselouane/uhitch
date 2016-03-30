<?php echo '<pre>'; echo print_r($this->session->userdata("school_lat")); echo '</pre>'; //exit;?>
<div id="page_content">
    <div id="page">
        <section id="members">
            <div class="container" id="home">
                  <input type="hidden" id="baseUrl" name="baseUrl" value="<?=base_url()?>" ?>
                  <input type="hidden" id="school_lat" name="school_lat" value="<?=$this->session->userdata("school_lat")?>" ?>
                  <input type="hidden" id="school_lon" name="school_lon" value="<?=$this->session->userdata("school_lon")?>" ?>
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#eventspromo" aria-controls="eventspromo" role="tab" data-toggle="tab">UHITCH EVENTS</a></li>
                    <li role="presentation"><a href="#mapbox" aria-controls="mapbox" role="tab" data-toggle="tab">ON THE MAP</a></li>
                    <li role="presentation"><a href="#eventlist" aria-controls="eventlist" role="tab" data-toggle="tab">SURROUNDING RIDES</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="eventspromo">
                        <?php $this->load->view('members/home/events_promo'); ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="mapbox">
                      <?php $this->load->view('members/home/mapdisplay'); ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="eventlist">
                      <?php $this->load->view('members/home/events_area'); ?>
                    </div>
                  </div>
            </div>
        </section>
    </div>
</div>
<script>
    $('#myTabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
</script>