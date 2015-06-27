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
        
        var flag = $('#vehicle_flag').val();
        
       // console.log(flag);
       //    return false;
        
        if(flag == 'submitVehicle'){
            submitVehicleData();
            return false;
        }
        
        submitPersonalData();
        
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
   /* $('#vehicle_year').on('change', function() {
        if($(this).val() !== "") { populateMake(); } 
        else { resetMakeTable(); }       
    }); */
    
    $('#vehicle_year').on('change', function() {
        var value = $(this).val();
        //populateMake(value); 
        //alert(value);
        
        $('#vehicle_make').empty();
        var vehicle_make = document.getElementById("vehicle_make");
        if(value != ''){
            
            var url = 'https://api.edmunds.com/api/vehicle/v2/makes?year='+value+'&fmt=json&api_key=29vmhtd5d2yefj8ucsk75sqr';
            
            $.ajax({
                url : url,
                type: 'GET',
                dataType: 'json',  
                success: function(data) {
                    
                    var option = document.createElement("option");
                    option.text = 'Select Make';
                    option.value = '';
                    vehicle_make.add(option);
                    
                   // console.log(data.makesCount);
                    for( i=0; i < data.makesCount; i++){
                       // console.log(data.makes[i]);
                        var option = document.createElement("option");
                        option.text = data.makes[i].name;
                        option.value = data.makes[i].niceName;
                        vehicle_make.add(option);
                    }
                },
                error: function(error) {
                   // console.log(error);
                }
            });

        }
        
    });
    
    
    /*$('#vehicle_make').on('change', function() {
        resetModelTable();
        if($(this).val() !== "") {
            var filter = $('#vehicle_make option:selected').text();
            populateModel(filter);
        }
    });*/
    
     $('#vehicle_make').on('change', function() {
        
        var value = $(this).val();
        //populateMake(value); 
        //alert(value);
        
        $('#vehicle_model').empty();
        
        var vehicle_model = document.getElementById("vehicle_model");
        var year = document.getElementById("vehicle_year").value;
        
        if(value != ''){
            
            var url = 'https://api.edmunds.com/api/vehicle/v2/'+value+'?year='+year+'&fmt=json&api_key=29vmhtd5d2yefj8ucsk75sqr';
            
            $.ajax({
                url : url,
                type: 'GET',
                dataType: 'json',  
                success: function(data) {
                    //console.log(data);
                    var option = document.createElement("option");
                    option.text = 'Select Model';
                    option.value = '';
                    vehicle_model.add(option);
                    
                    for( i=0; i < data.models.length; i++){
                       // console.log(data.models[i].name);
                        var option = document.createElement("option");
                        option.text = data.models[i].name;
                        option.value = data.models[i].niceName;
                        vehicle_model.add(option);
                    }
                },
                error: function(error) {
                   // console.log(error);
                }
            });

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
    vehicles.model   = $('#vehicle_model').val();
    vehicles.make    = $('#vehicle_make').val();
    vehicles.year    = $('#vehicle_year').val();
    vehicles.color   = $('#vehicle_color').val();
    
    $('#vehicle_form').submit();
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