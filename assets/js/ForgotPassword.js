var base;
$(document).ready(function(){
    $('#forget_btn').on('click', function(e) {
        e.preventDefault();

        base = $('#base').val();
        var email = $('.forget_email').val();
        var reg = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;

        if(email && reg.test(email)) {
            $.ajax({
                type: "POST",
                url: base + 'welcome/sendResetPassword',
                data: { email: email },
                success: function(response) {
                    console.log(response);
                    if(response === '200') {
                        emailSentSuccessfully(email);
                        redirectHome();
                    }
                    else emailSentUnSuccessfully();

                },
                error: function(response) {
                    console.log(response);
                    emailSentUnSuccessfully();
                }
            });
        } 
        else {
            emailSentUnSuccessfully();
        }
    });
});

function redirectHome() {
    setTimeout(function() {
        window.location.href = base;
    }, 2000);
}

function emailSentSuccessfully(email) {
    var msg = "Email Sent";
    $('#message_Error > h4').text(msg);
    $('#message_Error > p').remove();
    $('<p>Your Password Reset link has been sent to' + email + '.</p>')
        .insertAfter('#message_Error > h4');
    $("#message_Error").fadeIn(1000);

    // Apply Redirect
}

function emailSentUnSuccessfully() {
    $('#message_Error > p').remove();
    $('<p>Please use a Valid School Email' +
        ' Address <br/> Affiliated with Uhitch<br/> Please Try Again!</p>')
        .insertAfter('#message_Error > h4');
    $("#message_Error").fadeIn(1000);
}