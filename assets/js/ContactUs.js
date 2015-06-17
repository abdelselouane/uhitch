var map, marker, valid;
var data = {
    name:   '',
    email:  '',
    message:''
};

$(document).ready(function() {
    $('#btnContact').on('click', function(e) {
        e.preventDefault();
        sendToEmailUhitch();
    });
    
    textAreaSettings();
});

function textAreaSettings() {
    var placeholder = 'Comments Here...';
    
    $('#msgContact').focusin(function() {
        if ( this.value === placeholder ) {
            this.value = '';    
        }
    }).focusout(function() {
        if ( this.value === '' ) {
            //this.value = placeholder;    
        }
    });
}

function verifyContactForm() {
    var placeholder = 'Comments Here...';
    var reg = /[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/;
    validForm();
    
    data.name   = $('#nameContact').val();
    data.email  = $('#emailContact').val();
    data.message= $('#msgContact').text();
    
    console.log(data.message);
    if(!data.name) 
        { inValidForm('#name-error', '#nameContact'); }  
    if(!data.email || !reg.test(data.email)) 
       { inValidForm('#email-error', '#emailContact'); }  
    //if(!data.message || data.message === placeholder) 
     // {  inValidForm('#msg-error', '#msgContact'); }
}

function sendToEmailUhitch() { 
    verifyContactForm();
    
    if( formReadyForSubmit() ) {
        ajaxCall(data);
    }   
}

function ajaxCall(data) {
    var base = $('#url').val();
    base += 'index.php/';
    
    $.ajax({
        type: "POST",
        url: base + 'rest/contactUhitch',
        data: data,
        success: function(response) {
            emailSentSuccess();
        }
    });
}

function emailSentSuccess() {
    $('#btnContact').hide();
    
    var success = $('<p></p>', {
        id: 'messageSent',
        text: 'Thank You, Your Message Has Been Sent'
    });
    $(success).insertAfter( $( "#msgContact" ).fadeIn() );
}


function initialize() {
    var mapOptions = {
        zoom: 14,
        center: new google.maps.LatLng(33.682200, -84.506770)
    };

    map = new google.maps.Map(document.getElementById('contact-map'),
        mapOptions);

    marker = new google.maps.Marker({
        map:map,
        draggable:false,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(33.682180, -84.506780)
    });

    setTimeout(function() {
        toggleBounce();
    }, 1500);
}

function toggleBounce() {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
    
    var contentString = '<h4 id="bounce"> Uhitch <br/>' +
            'Technologies, LLC</h4>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    
    infowindow.open(map, marker);
}

function validForm() {
    valid = true;
}

function inValidForm(required, input) {
    valid = false;
    $(required).css("display","block");
    $(input).css("border","1px solid #FF0000");
}

function formReadyForSubmit() {
    return valid === true;
}

google.maps.event.addDomListener(window, 'load', initialize);       