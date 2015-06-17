var directionsDisplay = new google.maps.DirectionsRenderer({ 
        draggable: true 
    });
var directionsService = new google.maps.DirectionsService();
var geocoder = new google.maps.Geocoder();
var origin, map, destination, status, address;

$(window).load(function() {   
    applyHtmlInput();
    address = document.getElementById('start').value;
    status = false;
    
    geocoder.geocode({'address': address },
    function(results) {
        var myOptions = {
            zoom: 9,
            center: results[0].geometry.location,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        map = new google.maps.Map(document.getElementById("rideMap"), myOptions);
           
        $('#start').val(results[0].formatted_address);
        $('#departShort').val(results[0].address_components[0].short_name);

        directionsDisplay.setMap(map);

        var start =  document.getElementById('start');
        var end   =  document.getElementById('end');
        
        var options = {
            componentRestrictions: {country: "us"}
        };
        
        var x = new google.maps.places.Autocomplete(start, options);
        var y = new google.maps.places.Autocomplete(end, options);
  
        x.bindTo('bounds', map);
        y.bindTo('bounds', map);
       
        var infowindow = new google.maps.InfoWindow();

        google.maps.event.addListener(y, 'place_changed', function() {
            infowindow.close();
            var place = y.getPlace(); 
            
            if (!place.geometry) { return; }
            
            var arriveShort = retrieveShortName(place.vicinity, place.name);
            console.log(arriveShort);
            //$('#arriveShort').val(arriveShort);
            calcRoute();
        });
        
        google.maps.event.addListener(x, 'place_changed', function() {
            infowindow.close();
            var place = x.getPlace(); 
            
            if (!place.geometry) { return; }
            
            var departShort = retrieveShortName(place.vicinity, place.name);
            console.log(departShort);
            //$('#departShort').val(departShort);
            calcRoute();
        });
    });
});

function retrieveShortName(vicinity, name) {
    var count = vicinity.split(" ");
    
    if(count.length > 1) {
        return name;
    }
    return vicinity;
}

function calcRoute() {
    var request = {
        origin: document.getElementById('start').value,
        destination: document.getElementById('end').value,
        travelMode: google.maps.TravelMode.DRIVING
    };
    
    directionsService.route(request, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);

            status = true;
            setMileage(response.routes[0].legs[0]);
            setCoordinates(response.routes[0].legs[0]);
        }
    });
}

function setCoordinates(value) {
    var startLat = value.start_location.k;
    var startLon = value.start_location.B;
    
    $('#departLat').val(startLat);
    $('#departLon').val(startLon);
    
    var endLat = value.end_location.k;
    var endLon = value.end_location.B;
    
    $('#arriveLat').val(endLat);
    $('#arriveLon').val(endLon);
}

function setMileage(value) {
    var mileage = value.distance.value;
    var suggestPrice = 0;
    
    mileage *= 0.000621371192;
    $('#mileage').val(Math.round(mileage));
         
    if(mileage <= 100) {
        suggestPrice = mileage * 0.21;
    } else {
        var temp = mileage - 100;
        suggestPrice = 0.21 * 100;
        suggestPrice += 0.19 * temp;
    }

    $('.priceValue').val('$' + Math.round(suggestPrice));
}

function applyHtmlInput() {
    $('#input-date').on('click', function() {
        $(this).prop("type", "text");
    });
    $('#input-date').datepicker({
        minDate: new Date(),
        inline: true,
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    }); 
}