$(document).ready(function() {
    handleRedirect();
});

function handleRedirect() {
    var search = getUrlVars()["searchBy"];
    var id;
    
    $('.search-result').on('click', function() {
        id = $(this).attr('id');
        
        switch(search) {
            case 'user':
            case 'users': 
                window.location.href = 'userProfile?q=' + id;
                break;
            case 'ride':
            case 'rides':  
                window.location.href = 'hitchARide?q=' + id;
                break;
        }
    });
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
