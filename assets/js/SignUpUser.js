var valid = true;
var errormsg, buttonPressed = false;

$(document).ready(function() {
    initiateAutoCompletion();
    handleKeyEvents();
    handleRadioBtns();
    formSubmission();
});

function initiateAutoCompletion() {
    $("#school").autocomplete({
        source: schoolTags,
        minLength: 3,
        autoFocus: true,
        select: false,
        open: function(event) {
            $('.ui-autocomplete').css('height', 'auto');

            var $input = $(event.target),
                inputTop = $input.offset().top,
                inputHeight = $input.height(),
                autocompleteHeight = $('.ui-autocomplete').height(),
                windowHeight = $(window).height();

            if ((inputHeight + inputTop+ autocompleteHeight) > windowHeight) {
                $('.ui-autocomplete').css('height', 
                    (windowHeight - inputHeight - inputTop - 50) + 'px');
            }
       },
       change: function() {
           removeSchoolNameError();
       }
    });
}

function handleKeyEvents() {
    $('#signup_form input').on('keyup', 
        function() { 
            var event = $(this).attr('id');
            cleanErrorsMessage(event);
    });
}

function handleRadioBtns() {
    $('#signup_form input[type=radio]').on('click', 
        function() {
            var event = $(this).attr('name');
            cleanErrorsMessage(event);
    });
    
    $('select').on('change', function() {
        if(!valid) {
            selectedBirthdate();
        }
    });
}

function formSubmission() {
    $("#signup_form").submit(function(event) {
        validForm();
        checkForErrors();

        if(!formReadyForSubmit()) {
            event.preventDefault();
        } 
    });
}

function checkForErrors() {
    verifyName();
    verifySchoolName();
    verifyEmail();
    verifyPassword();
    passwordConfirmation();
    selectedBirthdate();
    selectedGender();
    isDriver();
}

function verifyName() {
    var fName = $("#fname").val();
    var lName = $("#lname").val();
    
    if(!fName || !lName) {
        inValidForm();
        $("#fullName").text("Please Enter Your Full Name");
        $("#fullName").css("display", "block"); 
    } 
    if(fName && lName) {
        $("#fullName").css("display", "none"); 
    }
}

function verifySchoolName() {
    var name = $("#school").val();
    
    if( !name ) {
        inValidForm();
        $("#college").css("display", "block");
    } 
}

function removeSchoolNameError() {
    $("#college").css("display", "none");
}

function verifyEmail() {
    var email = $("#email").val();

    if( !email.includes('.edu')) {
        inValidForm();
        $("#schoolEmail").text("Please Enter A Valid Email Address");
        $("#schoolEmail").css("display", "block");
    } else {
        $("#schoolEmail").css("display", "none");
    }
}

function verifyPassword() {
    var pswd  = $("#pw1").val();
    
    if(!pswd){
        inValidForm();
        $("#passwordEnter").text('Please Enter Your Password');
        $("#passwordEnter").css("display", "block");
    } else {
        if(pswd.length < 6) {
            inValidForm();
            $("#passwordEnter").text('Password Must Be at least 6 Characters');
            $("#passwordEnter").css("display", "block");
        } else {
            $("#passwordEnter").css("display", "none");
        }
    } 
}

function passwordConfirmation() {
    var pswd2 = $("#pw2").val();
    var pswd  = $("#pw1").val();

    if(!pswd2 || !pswd 
            || pswd !== pswd2) {
        inValidForm();
        $("#passwordConfirm").text('Confirmed Password does NOT Match!');
        $("#passwordConfirm").css("display", "block");
    } 
    
    if(pswd2 && pswd === pswd2) {
        $("#passwordConfirm").css("display", "none");
    }
}

function verifyIfNull(value) {
    if(value === '' || value === null) {
        return true;
    } 
        
    return false;  
}

function selectedBirthdate() {
    var month   = $("#month").val();
    var day     = $("#day").val();
    var year    = $("#year").val();
    
    if( !month || !day || !year) {
        inValidForm();
        $("#userBirthdate").css("display", "inline-block");
    } else {
        $("#userBirthdate").css("display", "none");
    }
}

function selectedGender() {
     var isChecked = $('input[name=sex]:checked').size() > 0;

     if(isChecked) {
        $("#userGender").css("display", "none");
    } else {
        inValidForm();
        $("#userGender").text("Please Select Your Gender");
        $("#userGender").css("display", "inline-block");   
    }
}

function isDriver() {
    var isChecked = $('input[name=car]:checked').size() > 0;

    if(isChecked) {
        $("#userCar").css("display", "none");
    } else {
        inValidForm();
        $("#userCar").text("Are You a Driver?");
        $("#userCar").css("display", "inline-block");   
    }
}

function cleanErrorsMessage(value) {
    if(!valid) {
        switch(value) {
            case 'sex':
                selectedGender();
                break;
            case 'car':
                isDriver();
                break;
            case 'fname':
            case 'lname':
                verifyName();
                break;
            case 'email':
                verifyEmail();
                break;
            case 'school':
                verifySchoolName();
                break;
            case 'pw1':
                verifyPassword();
                break;
            case 'pw2':
                passwordConfirmation();
                break;
        }
    }
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