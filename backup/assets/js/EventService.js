var placeSearch, autocomplete, eventLat, eventLon;
var eventForm = {
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    postal_code: 'short_name'
};

$(document).ready(function() {
    applyAutoCompletion();
    applyHtmlInput();
    //submitEventForm();
});

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
    
    var lat = place.geometry.location.k;
    var lon = place.geometry.location.B;
    
    $('#eventLat').val(lat);
    $('#eventLon').val(lon);
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