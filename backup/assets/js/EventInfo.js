$(document).ready(function() {
    var lat = $('#lat').val();
    var lon = $('#lon').val();
    applyGoogleMap(lat, lon);
});

function applyGoogleMap(lat, lon) {
    var map;
    var myLatlng = new google.maps.LatLng(lat, lon);
    
    var mapOptions = {
        zoom: 11, 
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        zoomControl: true,
        center: myLatlng,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        }
    };
    
    map = new google.maps.Map(document.getElementById('direction-map'),
    mapOptions);
    
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title:"Hello World!"
    });
}