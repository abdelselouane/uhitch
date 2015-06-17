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
    applySeeMoreLink();
});