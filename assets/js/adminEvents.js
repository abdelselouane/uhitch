$( document ).ready(function(){
    
    $('#eventsListing').DataTable({
        ordering:  false,
    });

    $('.approve-btn').click(function(){
        $url = $( this ).attr('data-url');
       // console.log($url);
        $.ajax({
            type: "POST",
            url: $url, 
            //data: "id="+$id,
            success: function(data) {
                //console.log(data);
                location.reload();
            },
            error: function(error) {
                console.log(error);
            }
        });
    
    });

});