
var map;
var mapIcon = '../assets/imgs/mapIcon.png'; 
$(document).ready(function(){
    
    var baseUrl = $('#baseUrl').val();
    var url = baseUrl+"index.php/main/getSurroundingRides";
    var schoolLat   = $('#school_lat').val();
    var schoolLon   = $('#school_lon').val();
    
    map = new GMaps({
        el: '#map',
        lat: schoolLat,
        lng: schoolLon,
        zoom: 10
    });
    
    $.ajax({
        url: url,
        type: "post",
        success: function (response) {
            var rides = JSON.parse(response);
            var ridesMap = new Array();
            for(var i=0; i<rides.length; i++){
                html = '<p>Trip to: '+rides[i].Arrival +'</p>';
                console.log(rides[i]);
                ridesMap[i] =   {
                    lat: rides[i].Lat_Dep,
                    lng: rides[i].Lon_Dep,
                    icon: mapIcon,
                    title: rides[i].DepartShort,
                    infoWindow: {
                      content: html
                    }
                }
            }
            map.addMarkers(ridesMap);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
    
    
 
  /*map.addMarker({
    lat: -12.043333,
    lng: -77.03,
    icon: mapIcon,
    title: 'Lima',
    details: {
      database_id: 42,
      author: 'HPNeo'
    },
    click: function(e){
      alert('You clicked in this marker');
    },
    mouseover: function(e){
      console.log('mouseover');
    }
  });*/
  /*map.addMarkers([{
        lat: -12.042,
        lng: -77.028333,
        icon: mapIcon,
        title: 'Marker with InfoWindow',
        infoWindow: {
          content: '<p>HTML Content</p>'
        }
  }, {
        lat: -12.043333,
        lng: -77.03,
        icon: mapIcon,
        title: 'Marker with InfoWindow',
        infoWindow: {
          content: '<p>HTML Content</p>'
        }
  },
    {
        lat: -12.040,
        lng: -77.027,
        icon: mapIcon,
        title: 'Marker with InfoWindow',
        infoWindow: {
          content: '<p>HTML Content</p>'
        }
    }
]);*/
  
});

/*var map, address, mapLat, mapLon;
var markers = [];
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();

function initialize() {
    var mapOptions = {
        zoom: 9, 
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        }
    };

    map = new google.maps.Map(document.getElementById('uhitch-map'),
    mapOptions);

    showlocation(); 

    var options = {
        componentRestrictions: {country: "us"}
    };

    var interest = document.getElementById("search");
    var autocomplete = new google.maps.places.Autocomplete(interest, options); 
    autocomplete.bindTo('bounds', map);

    google.maps.event.addListener(autocomplete, 'place_changed', 
    function() {
        infowindow.close();
        resetView();
        
        var place = autocomplete.getPlace();

        if(!place.geometry) { return; }

        if (place.geometry.viewport) { 
            map.fitBounds(place.geometry.viewport); 
            pushMarkers(place.geometry.k, place.geometry.B);
        }
        else {
            map.setCenter(place.geometry.location);
            map.setZoom(11); 
            pushMarkers(place.geometry.k, place.geometry.B);
        }
    });    
    google.maps.event.addListener(map, 'dragend', resetView);
}

function showCity() {
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
                function(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            var latlng = new google.maps.LatLng(lat, lon);

            geocoder.geocode({'latLng': latlng}, function(results, status) {
            // Need To grab CIty Here
            });
        });
    }
}

function showlocation() {
    var city;
    var address = $('#userSchool').val();

    geocoder.geocode({'address': address },
        function(results, status) {
            
        if (status === google.maps.GeocoderStatus.OK) {
            var options = {
                zoom: 6,
                map: map,
                position: results[0].geometry.location,
                content: address
            };

            var infowindow = new google.maps.InfoWindow(options);
            map.setCenter(options.position);

            mapLat = "" + map.getCenter().k;
            mapLon = "" + map.getCenter().B;

            city = results[0].address_components[3].short_name + ', ';
            city += results[0].address_components[5].short_name;

            pushMarkers(mapLat, mapLon);
        } 
    }); 
}

function handleNoGeolocation(errorFlag) {
    if (errorFlag) { showlocation('school'); }
    else {
        var content = 'Error: Your browser doesn\'t \n\
                        support geolocation.';
    }  
} 

function pushMarkers(lat, lon) {
    var latlng = { lat: lat, lon: lon};
    
    var base = $('#url').val();
    // console.log(base); return false;
        base += 'index.php/rest/retrieveRidesMarkers';
        //base += 'rest/retrieveRidesMarkers';

     $.ajax({
        type: "POST",
        data: latlng,
        url: base,
        dataType: "json",
        success: function(data) {
            if(data) {
                $.each(data, function(index, obj) {
                    loadEachMarker(obj);
                });
            }
        },
        error: function(response){
            console.log(response.responseText);
        }
    }); 
}

function loadEachMarker(data) {
    if(data.Lat_Arr !== 0 || data.Lon_Arr !== 0) {
        var location = new google.maps.LatLng(data.Lat_Arr, 
                    data.Lon_Arr);

        var markerMsg = displayMarkerMessage(data);
        
        var infowindow = new google.maps.InfoWindow({
            content: markerMsg
        });
                
        var marker = new google.maps.Marker({
            position: location,
            title: "" + data.Name,
            map: map
        });
        
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
//            map.setZoom(10);
//            map.setCenter(marker.getPosition());
        });

        markers.push(marker);
    }      
}

function removeMarkers() {  
    setAllMap(null);
}

function setAllMap(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

function deleteMarkers() {
    removeMarkers();
    markers = [];
}

function displayMarkerMessage(data) {
    var date = new Date(data.DepartDate);
    
    var formatDate = (date.getMonth() + 1) 
            + " - " + date.getDate() 
            + " - " + date.getFullYear();
    
    var base = $('#url').val();
        base += 'index.php/';
    
    var msg = "<h3 class='marker'>" 
                + data.DepartShort 
                + " &#x2192; " 
                + data.ArriveShort +
              "</h3>" +
              "<span class='marker'>Departs: "
                + formatDate +
              "</span>" +
              "<span class='marker'>Driver Name: "
                + data.Driver_Name +
              "</span>" +
              "<span class='marker'>Open Seats: "
                + data.Passengers +
              "</span>" +
              "<a class='markerLink' href=" + base + "main/hitchARide?q=" 
                + data.Ride_ID + ">" +
                    "See More" + 
              "</a>";

    return msg;
}

$(document).ready(function() {
    var ticker = "#ride_feeds .ride_ticker";
    
    $(ticker).each(function(index, value) {
        $(value).on('click', function() {
            var id  = $(this).attr("value");
            retrieveInformation(id);   
        });
        
        $(value).on('hover', function() {
            modifyTicker(ticker, value);
        });
    });
    $('#surroundingRideListing').DataTable({
        ordering:  false,
    });
});

function retrieveInformation(id) {
    var url = $('#url').val();
   // console.log(url); return false;
        url += 'index.php/';
        url += 'main/hitchARide?q=' + id;
            
    window.location.href = url;
}

function modifyTicker(allTickers, ticker) {
    $(allTickers).css('background-color', '#fff');
    $(ticker).css('background-color', 'rgb(96,179,96,0.3)');   
}

function resetView() {
    var center = map.getCenter();

    var currLat = "" + center.k;
    var currLon = "" + center.B;
    
    deleteMarkers();
    pushMarkers(currLat, currLon);
}

google.maps.event.addDomListener(window, 'load', initialize);

$(document).ready(function() {
    $('.link-msg').hover(function() {
        
    });
    
});*/