$(document).ready(function(){
    
    $('#eventsListing').DataTable({
        ordering:  false,
    });
    
    $('.info').click(function(){
    
        var id = $( this ).attr('data-id');
        $('#eventResult div.left').empty();
        $('#eventResult div.right').empty();
        $('#eventResult div.cancel-row').empty();
        $('#request').empty();
        $('#loading-container').show(); //return false;
        setTimeout(function(){ 
             getEventById(id);
        },3000);
    
    });
    
    $('.cancel').click(function(){
    
        var id = $( this ).attr('data-id');
        
        $('#myModalLabel').text('Remove Event');
        $('#eventResult div.left').empty();
        $('#eventResult div.right').empty();
        $('#eventResult div.cancel-row').empty();
        $('#request').empty();
        $('#loading-container').show(); //return false;
        setTimeout(function(){ //console.log('id: '+id);
             getCancelEventModel(id);
        },3000);
    
    });


});

function warning(title, text){
    title = 'Oh snap! You got an error!';
    return html = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"></button><h4>'+title+'</h4><p>'+text+'</p><p><button type="button" class="btn btn-danger">Take this action</button><button type="button" class="btn btn-default">Or do this</button></p></div>';

}

function getCancelEventModel(id){
    base = base_url('index.php');
    url = base + 'index.php/';
    url += 'main/getEventById/'+ id;
    $.ajax({
       type: "post",
       url: url,
       contentType: "application/json",
       //dataType: "json",
       success: function( data ) {
           var data = JSON.parse(data);
           
           //console.log(data); return false;
          var  title = 'Oh snap! You got a situation!';
          var  text = 'Warning message: this message is very important, if you would like to proceed on this action, the actual event information will be removed immediately, would you like to take this action?';
          var  html = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"></button><h4>'+title+'</h4><p>'+text+'</p><p><a href="" class="btn btn-danger">Take This Action</a></p></div>';
           
           //console.log($('#myModalLabel'));
           
           $('#request').append('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
           $('#eventResult div.cancel-row').html(html);
           $('#loading-container').hide();
       }
    });
}

function getEventById(id){
    if(id){
        base = base_url('index.php');
        url = base + 'index.php/';
        url += 'main/getEventById/'+ id;
        $.ajax({
           type: "post",
           url: url,
           contentType: "application/json",
           //dataType: "json",
           success: function( data ) {
               var data = JSON.parse(data);
               
               //console.log(data.RideId); return false;
               var base = base_url('index.php');
               
               //var profileurlurl = base + 'index.php/';
               
               profileurl    = 'userProfile?q='+data.UserId;
               userprofile   = '<p><a target="_blank" href="'+profileurl+'">View User Profile <i class="fa fa-long-arrow-right"></i></a></p>';
               
               eventurl    = 'eventinfo?q='+data.EventId;
               eventpage   = '<p><a target="_blank" href="'+eventurl+'">View Event Page <i class="fa fa-long-arrow-right"></i></a></p>';

               var formatDepart = new Date(data.EventDate);
               var departDateTime = formatDate(formatDepart);
               
               
               
               var userPhoto = (ImageExist(base + 'assets/photos/users/' +data.UserPhoto)) ? base + 'assets/photos/users/' +data.UserPhoto : base + 'assets/photos/users/default.png';
               
               var eventPhoto = (ImageExist(base + 'assets/photos/events/' +data.Photo)) ? base + 'assets/photos/events/' +data.Photo : base + 'assets/photos/events/default.png';
               
               //return false;
               
               var leftHtml = '';
               
               leftHtml +=  '<div class="form-group"><h5>'+data.Name+'</h5><img src='+ eventPhoto +' >'+eventpage+'</div>';
               leftHtml +=  '<div class="form-group"><label>Location:</label><p>'+data.Location+'<br>'+data.City+', '+data.State+', '+data.Zip+'</p></div>';
               leftHtml +=  '<div class="form-group"><label>At:</label><p>'+departDateTime+' '+data.EventTime+'</p></div>';
               
               
               
               var rightHtml = '';
               rightHtml +=  '<div class="form-group"><h5> by: '+data.UserName+'</h5><img src='+ userPhoto +'>'+userprofile+'</div>';
               
              
               
               if(data.RideId != null){
                    rideurl    = 'hitchARide?q='+data.RideId;
                    ridepage   = '<p><a target="_blank" href="'+rideurl+'">Check out this Ride Page <i class="fa fa-long-arrow-right"></i></a></p>';
                    rightHtml +=  '<div class="form-group"><p class="alert alert-info"> Has Ride: <i class="fa fa-car"></i> YES</p>'+ridepage+'</div>';
               }
               
              // console.log(html);
               
               $('#eventResult div.left').html(leftHtml);
               $('#eventResult div.right').html(rightHtml);
               
               rideurl  = (data.RideId != null) ? base + 'index.php/main/requestride?q=' + data.RideId : '';
               if(data.RideId != null){
                   $('#request').append('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                   $('#request').append('<a target="_blank" href="'+rideurl+'" class="btn btn-primary" >Request Ride</a>');
               }else{
                    $('#request').append('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
               }
               
               $('#loading-container').hide();
               
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
    return date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear();// + "  " + strTime;
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

function ImageExist(url) 
{
   var img = new Image();
   img.src = url;
   return img.height != 0;
}