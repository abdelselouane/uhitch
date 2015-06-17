//google.maps.visualRefresh = true;

var directionsDisplay = new google.maps.DirectionsRenderer({ 
        draggable: true 
    });
var directionsService = new google.maps.DirectionsService();
var map; var geocoder = new google.maps.Geocoder();

$(window).load(function() {   
    var address = document.getElementById('school').value;
    
    geocoder.geocode({'address': address },
    function(results) {
        var myOptions = {
            zoom: 9,
            center: results[0].geometry.location,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var place = results[0].formatted_address;

        var temp = place.replace(address, '');
        var i = temp.replace(',', '');

        document.getElementById('start').value = i;

        map = new google.maps.Map(document.getElementById("rideMap"), myOptions);
        directionsDisplay.setMap(map);

        var options = {
            componentRestrictions: {country: "us"}
        };

        var input = (document.getElementById('end'));
        var autocomplete = new google.maps.places.Autocomplete(input, options);    
        
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();

        google.maps.event.addListener(autocomplete, 'place_changed', 
        function() {
            infowindow.close();
            var place = autocomplete.getPlace();
            
            
            calcRoute();
        });
    });
    
    $("#start").on("change", function(){ calcRoute(); });
    $("#end").on("change", function(){ calcRoute(); });
});

function calcRoute() {
    var request = {
        origin: document.getElementById("start").value,
        destination: document.getElementById("end").value,
        travelMode: google.maps.TravelMode.DRIVING
    };

    directionsService.route(request, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
    });
}
