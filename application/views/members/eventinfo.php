
<div id="page_content">
    <div id="page">
        <section id="members">
            
               <?php //echo '<pre>'; print_r($ride); echo '</pre>'; ?>
            
            <div id="rideInformation">
                <?php $this->load->view('members/eventspage/eventinfo'); ?>
            </div>
            <div id="driverInformation">
                <?php $this->load->view('members/eventspage/eventCreator'); ?>
            </div>
        </section>
    </div>
</div>