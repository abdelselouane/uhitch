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
            //console.log(arriveShort);
            $('#arriveShort').val(arriveShort);
            calcRoute();
        });
        
        google.maps.event.addListener(x, 'place_changed', function() {
            infowindow.close();
            var place = x.getPlace(); 
            
            if (!place.geometry) { return; }
            
            var departShort = retrieveShortName(place.vicinity, place.name);
            //console.log(departShort);
            $('#departShort').val(departShort);
            calcRoute();
        });
    });
    
    
    var $passenger = 0;
    $('.prm-btn').click(function(){
        
        var $id = $( this ).attr('id');
        var $psn = $('#passengers_disabled');
        var $psnVl = $psn.val();
        
        if($psnVl == '') $psnVl = 0;
        
        $passenger = parseInt($psnVl);
        
        if($id == 'passenger-plus' ){
            /* MAX NUMBER IS 5 passengers per trip */
            if( parseInt($passenger) >= 0 && parseInt($passenger) < 5 ){
                $psn.val($passenger += 1);
                $('.passenger-ui').append('<span class="psn-box">'+$passenger+'</span>');
            }
        }else{
            /* MIN NUMBER IS 0 passengers per trip */
            if( $passenger > 0){
                $psn.val($passenger -= 1);
                $('.passenger-ui span:last-child').remove();
            }
        }
        
        $('#passengers').val($passenger);
        return false;
        //console.log( $psn.val() );
        
    });
    
    $('#post-btn').click(function(event){
        event.preventDefault();
        //console.log('submit form'); //return false;
        
        $('#ride_form').submit();
    });
    
    $('#ride_form').validate({
        rules: {
            destination: {
                required: true
            },
            date: {
                required: true
            },
            time: {
                required: true
            },
            departure: {
                required: true
            },
            arrival: {
                required: true
            },
            event_date: {
                required: true
            },
            event_time: {
                required: true
            }
        },
        submitHandler: function(element) {
            if ( $('#passengers_disabled').val() == 0 ) {
                alert('Please add the folowing: how many passengers may ride with you? you can use plus/minus button to adjust the number, thank you.');
                return false;
            }
            return true;
        },
        highlight: function (element) {
            $(element).removeClass('success').addClass('error');
        }/*,
        success: function (element) {
            element.addClass('valid')
                .closest('.control-group').removeClass('error').addClass('success');
        }*/
    });
    
    $('#input-date').focus(function(){
        $('#datetimepicker1').click();
    });
    
    $('#input-time').focus(function(){
        $('#datetimepicker2').click();
    });
    
    
    $('#datetimepicker1').datetimepicker({
        format: 'MM/DD/YYYY',
        viewMode: 'days',
        showClear: true,
        showClose: true
    });
    
    $('#datetimepicker2').datetimepicker({
        format: 'LT'
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
            setCoordinates();
        }
    });
}


function setCoordinates() {
    /*var startLat = value.start_location.k;
    var startLon = value.start_location.B;
    
    $('#departLat').val(startLat);
    $('#departLon').val(startLon);
    
    var endLat = value.end_location.k;
    var endLon = value.end_location.B;
    
    $('#arriveLat').val(endLat);
    $('#arriveLon').val(endLon);*/
    
    var start = $('#start').val();
    if(start != ''){
        getLatLngStart(start);
    }else{
        $('#departLat').val(0);
        $('#departLon').val(0);
    }
    
    var arrive = $('#end').val();
    if(arrive != ''){
        getLatLngEnd(arrive);
    }else{
        $('#arriveLat').val(0);
        $('#arriveLon').val(0);
    }
}

function setMileage(value) {
    var mileage = value.distance.value;
    var suggestPrice = 0.0;
    var rideCost = 0.0;
    
    mileage *= 0.000621371192;
    //console.log(mileage);
    
    var dbmileage = Math.floor(mileage * 100) / 100;
    //console.log(dbmileage);
    $('#mileage').val(dbmileage);
         
    if(mileage < 100) {
        suggestPrice = mileage * 0.2;
    } else if(mileage >= 100) {
        suggestPrice = mileage * 0.1;
    } else if(mileage >= 200) {
        suggestPrice = mileage * 0.07;
    }
    
    if( mileage<20 ){
        rideCost = mileage * 0.7;
    } else if(mileage<30){
        rideCost = mileage * 0.6;
    } else if(mileage<60){
        rideCost = mileage * 0.5;
    } else if(mileage<70){
        rideCost = mileage * 0.44;
    } else if(mileage<80){
        rideCost = mileage * 0.39;
    } else if(mileage<90){
        rideCost = mileage * 0.35;
    } else if(mileage<100){
        rideCost = mileage * 0.32;
    } else if(mileage<110){
        rideCost = mileage * 0.30;
    } else if(mileage<120){
        rideCost = mileage * 0.28;
    } else if(mileage<130){
        rideCost = mileage * 0.27;
    } else if(mileage<150){
        rideCost = mileage * 0.25;
    } else if(mileage<160){
        rideCost = mileage * 0.24;
    } else if(mileage<170){
        rideCost = mileage * 0.23;
    } else if(mileage<230){
        rideCost = mileage * 0.22;
    } else if(mileage<290){
        rideCost = mileage * 0.21;
    } else if(mileage>=230){
        rideCost = mileage * 0.20;
    }

    suggestPrice    = Math.floor(suggestPrice * 100) / 100;
    rideCost        = Math.floor(rideCost * 100) / 100;
    
    //console.log(suggestPrice);
    //console.log(rideCost);
    
    $('#ridecost_disabled').val('$' + rideCost);
    $('#price_disabled').val('$' + suggestPrice);
    
    $('#ride_cost').val('$' + rideCost);
    $('#price').val('$' + suggestPrice);
    //$('#price').val('$' + Math.round(suggestPrice));
}

function applyHtmlInput() {
    /*$('#input-date').on('click', function() {
        $(this).prop("type", "text");
    });
    $('#input-date').datepicker({
        minDate: new Date(),
        inline: true,
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    }); */
}

function getLatLngEnd(addr){
    
    var geocoder = new google.maps.Geocoder();
    var address = addr;
    geocoder.geocode( { 'address': address}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
          
          //console.log(latitude);
          //console.log(longitude);
          
          if( latitude != '' && latitude != 0 && latitude != null && latitude != undefined){
            document.getElementById('arriveLat').value = latitude;
            document.getElementById('arriveLon').value = longitude;
          }
                   
          
      }
    
    });
}

function getLatLngStart(addr){
    
    var geocoder = new google.maps.Geocoder();
    var address = addr;
    geocoder.geocode( { 'address': address}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
          
          //console.log(latitude);
          //console.log(longitude);
          
          if( latitude != '' && latitude != 0 && latitude != null && latitude != undefined){
            document.getElementById('departLat').value = latitude;
            document.getElementById('departLon').value = longitude;
          }
                   
          
      }
    
    });
}