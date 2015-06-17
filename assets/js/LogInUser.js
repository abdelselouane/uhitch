var errorMsg, error;

$(document).ready(function(){
    $('#log_form').submit(function(e){    
        var email = $(".email_login").val();
        var password = $(".password_login").val();

        verifyLoginCredential(email, password, e);
    });
    
    setErrorMsg();
    checkForError();
});

function checkForError() {
    var error = $('#error').val();
    var msgText = $('#errormsg').text();
    
    if(error) {
        if(msgText) {
            displayError(msgText);
        } else {
            displayError(errorMsg);
        }
    }
}

function verifyLoginCredential(email, password, event) {
    var reg = /[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/;
    
    if(!email || !reg.test(email)) {
        event.preventDefault();
        displayError(errorMsg);
    }
    
    else if(!password || password.length <= 5) {
        event.preventDefault();
        displayError(errorMsg);
    }
    
    else { $("#log_form").submit(); }    
}

function displayError(msg) {
    $("#errormsg").text(msg);
    $("#message_Error").fadeIn(1000);
}

function setErrorMsg() {
    errorMsg = "Please Enter an Email Address & Password " +
                "affiliated with your Uhitch Account";
}