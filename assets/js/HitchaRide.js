var map, mapOptions, directionsDisplay,
        start, end;
var directionsService = new google.maps.DirectionsService();
var directionsDisplay = new google.maps.DirectionsRenderer({ 
    draggable: false 
});

function initialize() {
    findLocation();
    displayDirections();
    declareSettings(); 
}

function declareSettings() {
    mapOptions = {
        zoom: 10,
        disableDefaultUI: true,
        streetViewControl: false,
        panControl: false,
        zoomControl: false,
    };
    
    map = new google.maps.Map(document.getElementById('direction-map'),
    mapOptions); 
    
    directionsDisplay.setMap(map);
}

function findLocation() {
    var depart = $('#departLatLng').val();
    var arrive = $('#arriveLatLng').val();
    
    var departLatLng =  depart.split(",");
    var arriveLatLng =  arrive.split(",");
    
    start = new google.maps.LatLng(departLatLng[0],departLatLng[1]);
    end   = new google.maps.LatLng(arriveLatLng[0],arriveLatLng[1]);
}

function displayDirections() {
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
    };
    
    directionsService.route(request, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
        } 
        else {
            ajaxCall();
        }
    });
}

function ajaxCall() {
    // If Lat & Lng missing Retrieve Coords
}

google.maps.event.addDomListener(window, 'load', initialize);