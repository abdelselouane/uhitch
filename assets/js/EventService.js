var placeSearch, autocomplete, eventLat, eventLon;
var eventForm = {
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    postal_code: 'short_name'
};

$(document).ready(function() {
    applyAutoCompletion();
    //applyHtmlInput();
    //submitEventForm();
    
     $('#submit-btn').click(function(event){
        event.preventDefault();
        //console.log('submit form'); //return false;
        
        $('#submit_event').submit();
    });
    
     $('#updatePhoto').click(function(event){
        event.preventDefault();
        //console.log('submit form'); //return false;
        if($('.fileContainer').css('display') == 'none'){
            $('.fileContainer').slideDown();
            $('.imgFileContainer').slideUp();
            $('#updatePhoto').html('<i class="fa fa-picture-o"></i>&nbsp;Keep Old Photo');
        }else{
            $('.fileContainer').slideUp();
            $('.imgFileContainer').slideDown();
            $('#updatePhoto').html('<i class="fa fa-upload"></i>&nbsp;Update Photo');
        }
        //var updatePhoto = $('#fileContainer').is('display');
         
    });
    
    $('#submit_event').validate({
        rules: {
            Name: {
                required: true
            },
            event_address: {
                required: true
            },
            event_city: {
                required: true
            },
            event_state: {
                required: true
            },
            event_zip: {
                required: true
            },
            userfile: {
                required: true
            }
        },
        submitHandler: function(element) {
            /*if ( $('#eventLat').val() == '' || $('#eventLon').val() == '' ) {
                var addr = $('#autocomplete').val();
                addr += ', '+$('#locality').val();
                addr += ', '+$('#administrative_area_level_1').val();
                addr += ', '+$('#postal_code').val();
                getLatLng(addr);
                return false;
            }*/
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
    
    $('#event-date').focus(function(){
        $('#datetimepicker1').click();
    });
    
    $('#event-time').focus(function(){
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

function getLatLng(addr){
    
    var geocoder = new google.maps.Geocoder();
    var address = addr;
    geocoder.geocode( { 'address': address}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
            document.getElementById('eventLat').value = latitude;
            document.getElementById('eventLon').value = longitude;
      }
    
    });
}

function applyAutoCompletion() {
    var input = document.getElementById('autocomplete');
    var options = {
        types: ['geocode'],
        componentRestrictions: {country: "us"}
    };     
            
    autocomplete = new google.maps.places.Autocomplete(input, options);
 
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        fillInAddress();
    });   
}

function fillInAddress() {
    var place = autocomplete.getPlace();
    
    var address = place.name;
    $('#autocomplete').val(address);
    
    for (var component in eventForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }
    
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (eventForm[addressType]) {
            var val = place.address_components[i][eventForm[addressType]];
            document.getElementById(addressType).value = val;
        }
    }
    
    //var lat = place.geometry.location.k;
    //var lon = place.geometry.location.B;
    
        $name       = document.getElementById('name').value;
        $address    = document.getElementById('autocomplete').value;
        $city       = document.getElementById('locality').value;
        $state      = document.getElementById('administrative_area_level_1').value;
        $zip        = document.getElementById('postal_code').value;
         
        $addr = $address + ', ' + $city + ', ' + $state + ', ' + $zip; 
        
        getLatLng($addr);
    
    
    //$('#eventLat').val(lat);
    //$('#eventLon').val(lon);
}

function applyHtmlInput() {
    $('.eventDate').on('click', function() {
        $(this).prop("type", "text");
    });
    $('.eventDate').datepicker({
        minDate: new Date(),
        inline: true,
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
    }); 
}