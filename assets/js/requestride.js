$( document ).ready(function(){

    $('#select_seats').change( function(){
    
        var $seat   = $( this ).val();
        var $price  = $( '#price' ).val();
        
        var result = $seat * $price;
        
        $('#result').val(result);
        $('.result-text').text('Your Total is $'+result+'.00');
        //console.log(result);
        
    });

});