$( document ).ready(function(){
    
// for success - green box
//toastr.success('Success messages');

// for errors - red box
//toastr.error('errors messages');

// for warning - orange box
//toastr.warning('warning messages');

// for info - blue box
//toastr.info('info messages');
    
    $('#eventsListing').DataTable({
        ordering:  false,
    });
    
    $('[data-toggle="tooltip"]').tooltip();

    $('.aprv-btn').click(function(){
        $url = $( this ).attr('data-url');
        if($(this).hasClass('trash')){
            var conf = confirm("This action will completely delete all event information from the system, are sure you want to delete it?");
            if(!conf) return false;
        }
        $.ajax({
            type: "POST",
            url: $url,
            success: function(message) {      
                var alertMsg = JSON.parse(message);     
                if(alertMsg.error){
                    toastr.error(alertMsg.msg);
                }else{
                    toastr.success(alertMsg.msg);
                }     
                setTimeout(function(){
                    location.reload();
                }, 3000);
            },
            error: function(error) {
                toastr.error(error);
            }
        });
    });
    
     $('a.advance-link').click(function(){
        var container = $('#advancesearch');
        var icon    = $('a.advance-link i');
        var display = container.css('display');
        
        if(display == 'none'){
            icon.removeClass('fa-plus').addClass('fa-minus');
            container.slideDown();
        }else{
            icon.removeClass('fa-minus').addClass('fa-plus');
            container.slideUp();
        }
    });
    
    $('a.search').click(function(){
        $('#advanced-form').submit();
    });
    
});