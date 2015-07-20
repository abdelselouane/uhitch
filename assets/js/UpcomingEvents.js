var eventId, map, markers = [];;
var indicator = false;

function applySeeMoreLink() {
    $('.showMore').on('click', function(e) {
        e.preventDefault();

        eventId = $(this).attr('id');
        var data = {id: eventId};
        
        retrieveEventDetails(data);
        applyPopUpCTRL();
    });
}

function updateMaptoPage(lat, lon) {
    var location = new google.maps.LatLng(lat, lon);
    clearMarkers();
    addMarker(location);
    
    map.setCenter(location);
    google.maps.event.trigger(map, 'resize');
}

function applyMaptoPage(lat, lon) {
    var location = new google.maps.LatLng(lat, lon);
    
    var mapOptions = {
        zoom: 15, 
        center: location,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        }
    };
    
    map = new google.maps.Map(document.getElementById('map'),
    mapOptions); 

    addMarker(location);
    indicator = true;
    map.setCenter(mapOptions.center);
}

function displayPopUp(data) {
    $('html,body').animate({scrollTop:0},0);
    $('.overlay').fadeIn();
    
    applyTemplate(data);
    if(!indicator) 
        { applyMaptoPage(data.Lat, data.Lon); }
    else 
        { updateMaptoPage(data.Lat, data.Lon); }
    
    $('.popup').center(true).fadeIn();
}

function addMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        title: "",
        draggable:false,
        animation: google.maps.Animation.DROP,
        map: map
    });
    markers.push(marker);
}

function clearMarkers() {
    markers[0].setMap(null);
    markers = [];
}

function applyTemplate(data) {
    var link = $('#url').val();
    link += 'index.php/'; // remove later
    link += 'main/userProfile?q='+data.CreatedById;
            
    $('#details h2').text(data.Name);
    $('#details .created').text('Created By: ')
            .append("<a href='"+ link +"'>" + data.CreatedByName + "</a>");;  
    $('#details .addr').html(
            data.Address + '<br/>' +
            data.City + ' ' + data.State
    );
}

$.fn.center = function () {
    this.css("position","absolute");
    this.css("top", ($(window).height() / 2) 
            + 100 - (this.outerHeight() / 2));
    this.css("left", ($(window).width() / 2) 
            + 125 - (this.outerWidth() / 2));

    return this;
};

function applyPopUpCTRL() {
    $('#closebtn img').on('click', function() {
        console.log('clicked');
        $('.popup').fadeOut();
        $('.overlay').fadeOut();
    });
}

function retrieveEventDetails(data) {
    var base = $('#url').val();
        base += 'index.php/rest/retrieveEventsInfo';

    $.ajax({
        type: "POST",
        data: data,
        url: base,
        dataType: "json",
        success: function(data) {
            displayPopUp(data);
        },
        error: function(response){
            console.log(response);
        }
    });
}

$(document).ready(function() {
   // applySeeMoreLink();
    
    $('#eventsListing').DataTable({
        ordering:  false,
    });
    
    $('.info').click(function(){
    
        var id = $( this ).attr('data-id');
        $('#eventResult div.left').empty();
        $('#eventResult div.right').empty();
        $('#request').empty();
        $('#loading-container').show(); //return false;
        setTimeout(function(){ 
             getEventById(id);
        },3000);
    
    });
    
    $('#upcoming-events a.advance-link').click(function(){
        var container = $('#advancesearch');
        var icon    = $('#upcoming-events a.advance-link i');
        var display = container.css('display');
        
        if(display == 'none'){
            icon.removeClass('fa-plus').addClass('fa-minus');
            container.slideDown();
        }else{
            icon.removeClass('fa-minus').addClass('fa-plus');
            container.slideUp();
        }
    });
    
    $('#upcoming-events a.search').click(function(){
        $('#advanced-form').submit();
    });

});

function getEventById(id){
    if(id){
        base = base_url('index.php');
        url = base + 'index.php/';
        url += 'main/getEventById/'+ id;
        $.ajax({
           type: "post",
           url: url,
           contentType: "application/json",
           //dataType: "json",
           success: function( data ) {
               var data = JSON.parse(data);
               
               //console.log(data.RideId); return false;
               var base = base_url('index.php');
               
               //var profileurlurl = base + 'index.php/';
               
               profileurl    = 'userProfile?q='+data.UserId;
               userprofile   = '<p><a target="_blank" href="'+profileurl+'">View User Profile <i class="fa fa-long-arrow-right"></i></a></p>';
               
               eventurl    = 'eventinfo?q='+data.EventId;
               eventpage   = '<p><a target="_blank" href="'+eventurl+'">View Event Page <i class="fa fa-long-arrow-right"></i></a></p>';

               var formatDepart = new Date(data.EventDate);
               var departDateTime = formatDate(formatDepart);
               
               
               
               var userPhoto = (ImageExist(base + 'assets/photos/users/' +data.UserPhoto)) ? base + 'assets/photos/users/' +data.UserPhoto : base + 'assets/photos/users/default.png';
               
               var eventPhoto = (ImageExist(base + 'assets/photos/events/' +data.Photo)) ? base + 'assets/photos/events/' +data.Photo : base + 'assets/photos/events/default.png';
               
               //return false;
               
               var leftHtml = '';
               
               leftHtml +=  '<div class="form-group"><h5>'+data.Name+'</h5><img src='+ eventPhoto +' >'+eventpage+'</div>';
               leftHtml +=  '<div class="form-group"><label>Location:</label><p>'+data.Location+'<br>'+data.City+', '+data.State+', '+data.Zip+'</p></div>';
               leftHtml +=  '<div class="form-group"><label>At:</label><p>'+departDateTime+' '+data.EventTime+'</p></div>';
               
               
               
               var rightHtml = '';
               rightHtml +=  '<div class="form-group"><h5> by: '+data.UserName+'</h5><img src='+ userPhoto +'>'+userprofile+'</div>';
               
              // console.log(html);
               
               $('#eventResult div.left').html(leftHtml);
               $('#eventResult div.right').html(rightHtml);
               
               rideurl  = (data.RideId != null) ? base + 'index.php/main/requestride?q=' + data.RideId : '';
               if(data.RideId != null){
                   $('#request').append('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                   $('#request').append('<a target="_blank" href="'+rideurl+'" class="btn btn-primary" >Request Ride</a>');
               }else{
                    $('#request').append('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
               }
               
               $('#loading-container').hide();
               
            }
        });
    }
    return false;
}

function formatDate(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear(); //+ "  " + strTime;
}

function capitalizer(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function base_url(segment){
   // get the segments
   pathArray = window.location.pathname.split( '/' );
   // find where the segment is located
   indexOfSegment = pathArray.indexOf(segment);
   // make base_url be the origin plus the path to the segment
   return window.location.origin + pathArray.slice(0,indexOfSegment).join('/') + '/';
}

function ImageExist(url) 
{
   var img = new Image();
   img.src = url;
   return img.height != 0;
}











