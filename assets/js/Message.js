var message;

$(document).ready(function() {
    handleClick();
    
});

function handleClick() {
    $('#sendMsg').on('click', function() {
        message = $('#comment').val();
        sendMessage();
    });
}

function sendMessage() {
    var send = formatMessage();
    $('.discussion').append(send);
    callBackEnd();
}

function callBackEnd() {
    var data = {message : message };
    var base = $('#url').val();
        base += 'index.php/rest/retrieveRidesMarkers';
    
    $.ajax({
        type: "POST",
        data: data,
        url: base,
        dataType: "json",
        success: function(data) {
            emptyTextBox();
            alert('message sent');
        },
        error: function(response){
            console.log("Error: " + response);
        }
    });
}

function formatMessage() {
    return '<li class="other">' +
                '<div class="avatar">' +
                    '<img src="http://s3-us-west-2.amazonaws.com/s.cdpn.io/5/profile/profile-80_9.jpg" />' +
                '</div>' +
                '<div class="message">' +
                    '<p>' + message + '</p>' +
                    '<time datetime="2009-11-13T20:00">Timothy • 51 min</time>' +
                '</div>' +
            '</li>';
}

function emptyTextBox() {
    $('#comment').val('');
    $('#comment').text('');
}