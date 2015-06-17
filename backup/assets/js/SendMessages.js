var valid = true;
var errormsg, buttonPressed = false;
var errorMsg, error;
var users;


$(document).ready(function() {
    attemptSendMessageForm();
    fillAutoComplete();
});

function populate_message_board(from,time,message){
    var message_board = document.getElementById("message_board");
    var to_user = document.getElementById("UserToMessage");
    to_user.value = from;
    message_board.innerHTML = "@: " + time + "<br>User: "+ from + " <br> " + " Wrote: " + message;
    
} 

function fillAutoComplete()
{
   $.ajax({
           type: "GET",
           url: $('#url').val() + 'index.php/main/getUsersForMessageSending',
           dataType: "json",
           success: function( event ) {
               users = event;
               $('#UserToMessage').autocomplete({source: event});
            }

       });
}


function attemptSendMessageForm()
{
    submitSendMessageForm();
}

function submitSendMessageForm()
{
    $('#sendmessage_form').submit(function(event) {
        validForm();
        checkSendAttemptForErrors();
        
        if (!formReadyForSubmit())
        {
            event.preventDefault();
        }

    }); 
}

function checkSendAttemptForErrors()
{
    checkSendingUserForErrors();
    checkSendingMessageForErrors();
}

function checkSendingUserForErrors ()
{
    var reg = /[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/;
    var sendingUser = $("#UserToMessage").val();
    var isUserValid = $.inArray(sendingUser, users);
    
    if (!sendingUser || !reg.test(sendingUser) || isUserValid <= -1)
    {
        inValidForm();
        $("#invalidUserError").text("Please Enter a valid User");
        $("#invalidUserError").css("display", "block"); 
    }; 
}

function checkSendingMessageForErrors ()
{
    var sendingMessage = $("#sMessage").val();
    
    if (!sendingMessage)
    {
        inValidForm();
        $("#invalidMessageError").text("Please Enter a Message");
        $("#invalidMessageError").css("display", "block"); 
    }; 
}

function validForm() {
    valid = true;
}

function inValidForm() {
    valid = false;
}


function formReadyForSubmit() {
    return valid === true;
}

