var filter, base, personal;
var user = {
    address: '', address2: '',
    city: '', state: '',
    zip: '', phone: ''
};
var vehicles = {
    model: '', make: '',
    year: '', color: ''
};
$(document).ready(function() {
    base = $('#url').val() + 'assets/';
    
    handleSelectFiltration();
    
    $('#submitRegistration').on('click', function(e) {
        e.preventDefault();
        
        personal = true;
        submitPersonalData();
        //submitVehicleData();
    });
    
    $('a[href^="#"]').on('click',function (e) {
        e.preventDefault();       
        scrollToSection(this.hash);
    });
    
    validateImageUpload();
    addStudentOrg();
});

function addStudentOrg() {
    $('#add_org').on('click', function(e) {
        e.preventDefault();
        
    });
}

function handleSelectFiltration() {
    $('#vehicle_year').on('change', function() {
        if($(this).val() !== "") { populateMake(); } 
        else { resetMakeTable(); }       
    });
    
    $('#vehicle_make').on('change', function() {
        resetModelTable();
        if($(this).val() !== "") {
            var filter = $('#vehicle_make option:selected').text();
            populateModel(filter);
        }
    });
     
    $('#category').on('change', function() {
        var category = $(this).val();
        filterMajors(category);
    });
}

function validateImageUpload() {
    $('.add_photo').on('click', function(e) {
        e.preventDefault();
        $('#add_file').trigger('click');
    });
    
    $('#uploadBtn').on('click', function(e) {
        e.preventDefault();
        
        var file = $('#add_file').val();
        
        if(file === '' || !file.match(/(?:jpg|JPG|png|bmp)$/)) {
            e.preventDefault();
            $('#add_file').val('');

            $('#message_Error').empty().remove();
            $('<div id="message_Error">' +
                    '<h4>Uploading Error</h4>' +
                    '<p>Image must be eiher .png or .jpg<br/>' +
                    'Please Try Again</p>'   +
                '</div>')
            .insertAfter('#upload_photo_right > h4')
            .fadeIn(1000);
        }    
        else {
            $('#upload_form').submit();
        }
    });
}

function scrollToSection(target) {
    $target = $(target);
    
    $('html, body').stop().animate({
        'scrollTop': $target.offset().top
    }, 900, 'swing', function () {
        window.location.hash = target;
    });
}

function submitPersonalData() {
    user.address    = $('#address').val();
    user.address2   = $('#address2').val();
    user.city       = $('#city').val();
    user.state      = $('#state').val().toUpperCase(); 
    
    $('#vehicle_form').submit();
}

function submitVehicleData() {
    vehicle.model   = $('#vehicle_model').val();
    vehicle.make    = $('#vehicle_make').val();
    vehicle.year    = $('#vehicle_year').val();
    vehicle.color   = $('#vehicle_color').val();   
}

function populateMake() {
    // Cache results
     $.getJSON(base + 'vehicles.json', function(data) {
         resetMakeTable();
         for(var i in data) {
             var make = data[i].Make;
             $('#vehicle_make').append($('<option></option>')
                     .val(make)
                     .text(make));
         }
     });
}

function populateModel(value) {
    $.getJSON(base + 'vehicles.json', function(data) {
        for(var i in data) {
            if(value === data[i].Make) {             
                for(var j in data[i].Model) {
                    var model = data[i].Model[j];
                    $('#vehicle_model').append($('<option></option>')
                     .val(model)
                     .text(model));
                }
                break;
            }
        }
    });
}

function filterMajors(value) {
    console.log(base);
    $.getJSON(base + 'majors.json', function(data) {
        resetMajorTable();
        
        for(var i in data) {
            if(value === data[i].Category) {
                for(var j in data[i].Major) {
                    var major = data[i].Major[j];
                    $('#major').append($('<option></option>')
                     .val(major)
                     .text(major));
                }
            }  
         }
    });
}

function resetMajorTable(){
    $('#major').find('option')
            .remove()
            .end()
            .append($('<option></option>')
            .val('')
            .html('Select Major'));
}

function resetMakeTable() {
    $('#vehicle_make').find('option')
            .remove()
            .end()
            .append($('<option></option>')
            .val('')
            .html('Select Make'));
}

function resetModelTable() {
    $('#vehicle_model').find('option')
            .remove()
            .end()
            .append($('<option></option>')
            .val('')
            .html('Select Model'));
}