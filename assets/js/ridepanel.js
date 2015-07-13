$(document).ready(function(){
    
    $('#rideListing').DataTable({
        ordering:  false,
    });
    
    $('.info').click(function(){
    
        var id = $( this ).attr('data-id');
        //console.log($('#myModal'));
        getRideById(id);
    
    });

});

function getRideById(id){
    if(id){
        base = base_url('index.php');
        url = base + 'index.php/';
        url += 'main/getRideById/'+ id;
        $.ajax({
           type: "post",
           url: url,
           contentType: "application/json",
           dataType: "json",
           success: function( data ) {
              
               //var result = JSON.parse(data);
               
               //console.log(data);
               var base = base_url('index.php');
               
               var emptySeats = 0;
               var occupiedSeats = 5;
               var passengers = '';
               
               if(data.Passenger1_ID == ''){
                   emptySeats++;
                   occupiedSeats--;
               } else {
                  var profileurlurl = base + 'index.php/';
                  profileurl = 'userProfile?q='+data.Passenger1_ID;
                  passengers += '<p>Passenger 1: <a target="_blank" href="'+profileurl+'">View Profile </a></p>';
               }
               
               if(data.Passenger2_ID == ''){
                   emptySeats++;
                   occupiedSeats--;
               } else {
                  var profileurlurl = base + 'index.php/';
                  profileurl = 'userProfile?q='+data.Passenger2_ID;
                  passengers += '<p>Passenger 2: <a target="_blank" href="'+profileurl+'">View Profile </a></p>';
               }
               
               if(data.Passenger3_ID == ''){
                   emptySeats++;
                   occupiedSeats--;
               } else {
                  var profileurlurl = base + 'index.php/';
                  profileurl = 'userProfile?q='+data.Passenger3_ID;
                  passengers += '<p>Passenger 3: <a target="_blank" href="'+profileurl+'">View Profile </a></p>';
               }
               
               if(data.Passenger4_ID == ''){
                   emptySeats++;
                   occupiedSeats--;
               } else {
                  var profileurlurl = base + 'index.php/';
                  profileurl = 'userProfile?q='+data.Passenger4_ID;
                  passengers += '<p>Passenger 4: <a target="_blank" href="'+profileurl+'">View Profile </a></p>';
               }
               
               if(data.Passenger5_ID == ''){
                   emptySeats++;
                   occupiedSeats--;
               } else {
                  var profileurlurl = base + 'index.php/';
                  profileurl = 'userProfile?q='+data.Passenger5_ID;
                  passengers += '<p>Passenger 5: <a target="_blank" href="'+profileurl+'">View Profile </a></p>';
               }
               
               var price = '';
               var chargeMethod = '';
               if(data.Charge == 'seat'){
                   chargeMethod = 'Per Seat';
                   price += '<div class="form-group"><label>Seat Price:</label><p>$'+data.Price+' / Seat</p></div>';
               }
               
               if(data.Charge == 'trip'){
                   chargeMethod = 'Per Trip';
                   price += '<div class="form-group"><label>Trip Price:</label><p>$'+data.Ride_Cost+' / Trip</p></div>';
               }
               
               var formatDepart = new Date(data.DepartDate+' '+data.DepartTime);
               var departDateTime = formatDate(formatDepart);
               
               //console.log(departDateTime); return false;
               
               var leftHtml = '';
               leftHtml +=  '<div class="form-group"><label>Name:</label><p>'+data.Name+'</p></div>';
               leftHtml +=  '<div class="form-group"><label>From:</label><p>'+data.Departs+'</p></div>';
               leftHtml +=  '<div class="form-group"><label>To:</label><p>'+data.Arrival+'</p></div>';
               leftHtml +=  '<div class="form-group"><label>At:</label><p>'+departDateTime+'</p></div>';
               
               var rightHtml = '';
               rightHtml +=  '<div class="form-group"><label>Distance:</label><p>'+data.Distance+' Mi</p></div>';
               rightHtml +=  '<div class="form-group"><label>Charge Method:</label><p>'+chargeMethod+'</p></div>';
               rightHtml +=  price;
               
               if(data.Charge != 'trip'){
                    rightHtml +=  '<div class="form-group"><label>Passengers:</label><p>'+data.Passengers+'</p></div>';
                    rightHtml +=  '<div class="form-group"><label>Occupied Seats:</label><p>'+occupiedSeats+'</p></div>';
                    rightHtml +=  '<div class="form-group"><label>Available Seats:</label><p>'+emptySeats+'</p></div>';
               }

               if(passengers != ''){
                rightHtml += '<div class="form-group"><label>Passengers:</label><p>'+passengers+'</p></div>';
               }
              // console.log(html);
               $('#rideResult div.left').html(leftHtml);
               $('#rideResult div.right').html(rightHtml);
            }
        });
    }
    return false;
}

function formatDate(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear() + "  " + strTime;
}

function capitalizer(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function base_url(segment){
   // get the segments
   pathArray = window.location.pathname.split( '/' );
   // find where the segment is located
   indexOfSegment = pathArray.indexOf(segment);
   // make base_url be the origin plus the path to the segment
   return window.location.origin + pathArray.slice(0,indexOfSegment).join('/') + '/';
}