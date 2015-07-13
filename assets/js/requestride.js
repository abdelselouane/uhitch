$( document ).ready(function(){

    $('#select_seats').change( function(){
    
        var $seat   = $( this ).val();
        var $price  = $( '#price' ).val();
        
        var result = $seat * $price;
        var dbresult = Math.floor(result * 100) / 100;
        $('#result').val(dbresult);
        $('.result-text').text('Your Total is $'+dbresult);
        //console.log(result);
        $('#quantity').val($seat);
    });

});