var status = false;
var base, personal, vehicle, school, url;
var vehicleJson = [];
var majorJson = [];

$(document).ready(function() {
    base = $('#url').val();
    
    setJsonData();
    changeUserInfo();
    changeVehicleInfo();
    handleMajorFilter();  
    deActivation();
});

function changeUserInfo() {
    $(".settings").on('click', function(e) {
        e.preventDefault();
        
        var command = $(this).val();
        captureData();
        submitChanges(command);
    });
}

function submitChanges(value) {
    url = base + 'index.php/';
    url += 'rest/handleAjax/' + value;
    
    switch(value) {
        case 'personal':
            ajaxCall(personal, url);
            break;
        case 'vehicle':
            verifyVehicleData();
            break;
        case 'school':
            verifySchoolData();
            break;
    }  
}

function verifySchoolData() {
    status = true;
    
    $('.vehicle select').each(function(index, value) {
        var data = $(value).val();
        
        if(!data) {
            alert('Missing Remaining School Data');
            status = false;
            return false; 
        }
    });
    
    if(status === true)
        { ajaxCall(school, url); }
}

function verifyVehicleData() {
    status = true; 
    
    $('.vehicle select').each(function(index, value) {
        var data = $(value).val();
        
        if(!data) {
            alert('Missing Remaining Vehicle Data');
            return false; 
        }
    });
    
    if(status === true) 
        { ajaxCall(vehicle, url); }
}

function ajaxCall(data, url) {
    $.ajax({
        url : url,
        type: 'POST', 
        data: data,
        dataType: 'text',  
        success: function(client) {
            alert('Changes Have Been Submitted');
        }
    });
} 

function modifyData(command) {
    var target = $('.personal input[type=text]');

    if(command.toLowerCase() === 'submit') {
        target.each(function(index, value) {
            $(value).css("background-color", "rgb(255, 255, 199)");
            $(value).prop('readonly', false);
        });
    } 
    else {
        changeBtn();
        target.each(function(index, value) {
            $(value).css("background-color", "rgb(255, 255, 199)");
            $(value).prop('readonly', false);
        });
    }   
}

function changeVehicleInfo() {
    $('#vehicle_year').on('change', function() {
        var value = $(this).val();
        populateMake(value);      
    });
    
    $('#vehicle_make').on('change', function() {
        var value = $(this).val();
        populateModel(value);
    });
}

function setJsonData() {
    $.getJSON(base + 'assets/vehicles.json', function(data) {
        vehicleJson = data;
    });
    
    $.getJSON(base + 'assets/majors.json', function(data) {
        majorJson = data;
    });
}

function populateMake(value) {
    var id = '#vehicle_make';
    resetTable(id, 'Select Make');
    
    if(value) {
        for(var i in vehicleJson) {
            appendTable(vehicleJson[i].Make, id);
        }
    }
}

function populateModel(value) {
    var id = '#vehicle_model';
    resetTable(id, 'Select Model');
    
    if(value) {
        for(var i in vehicleJson) {
            if(value === vehicleJson[i].Make) {             
                for(var j in vehicleJson[i].Model) {
                    var model = vehicleJson[i].Model[j];
                    appendTable(model, id);
                } break;
            }
        }
    }
}

function appendTable(value, id) {
    $(id).append($('<option></option>')
        .val(value).text(value));
}

function resetTable(id, text) {
    $(id).find('option')
            .remove().end()
            .append($('<option></option>')
            .val('').html(text));
}

function handleMajorFilter() {
    $('#category').on('change', function() {
        var value = $(this).val();
        filterMajors(value);
    });
}

function filterMajors(value) {  
    var id = '#major';
    resetTable(id, 'Select Major');
    
    for(var i in majorJson) {
        if(value === majorJson[i].Category) {
            for(var j in majorJson[i].Major) {
                var major = majorJson[i].Major[j];
                appendTable(major, id);
            } break;
        }  
     }
}

function captureData() {
    personal = {
        fname: $('#firstname').val(),
        mname: $('#middlename').val(),
        lname: $('#lastname').val(),
        email: $('#email').val(),
        phone: $('#phone').val(),
        address: $('#address').val(),
        address2: $('#address2').val(),
        city:  $('#city').val(),
        state: $('#state').val()
    };
    
    vehicle = {
        year: $('#vehicle_year').val(),
        make: $('#vehicle_make').val(),
        model: $('#vehicle_model').val(),
        color: $('#vehicle_color').val()
    };
    
    school = {
        school: $('#school').val(),
        classification: $('#classification').val(),
        major: $('#major').val(),
        greek: $('#greek').val()
    };
}

function deActivation() {
    $('.cancel').on('click', function() {
        $('.overlay').fadeIn();
        $('.settings-popup').center().fadeIn();
    });
    
    $('.settings-popup button').each(function(index, value) {
        $(value).on('click', function() {
            var cmd = $(this).val();
            
            if(cmd.toLowerCase() !== 'yes') {
                $('.settings-popup').fadeOut();
                $('.overlay').fadeOut();
            } else {
                removeAccount();
            }
        });
    });
}

function removeAccount() {
    url = base + 'index.php/';
    url += 'rest/removeAccount';
    
    $.ajax({
        url : url,
        type: 'POST',
        dataType: 'text',  
        success: function(client) {
            console.log(client);
            window.location.reload();
            //alert('Changes Have Been Submitted');
        }
    });
}

$.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth() + 300) / 2) + 
                                                $(window).scrollLeft()) + "px");
                                        
    return this;
  }