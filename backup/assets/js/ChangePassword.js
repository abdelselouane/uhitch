$(document).ready(function() {
    $('#submit').on('click', function(e) {
        e.preventDefault();

        confirmPassword();
    });
});

function confirmPassword() {
    var password = $('#pw1').val();
    var confirm = $('#psw2').val();
    
    if(!password || !confirm) {
        displayErrorMsg();
    }
    
    if(password !== confirm) {
        displayErrorMsg();
    }
    
    else {
        $('#signup_form').submit();
    }
}

function displayErrorMsg() {  
    $('<div></div>', {
        id: 'message_Error'
    }).append(
        $('<p>Your Passwords do NOT Match <br/>\n\
                Please Try Again</p>')
    ).insertBefore('#password').fadeIn(1000);
}