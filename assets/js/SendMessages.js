var valid = true;
var errormsg, buttonPressed = false;
var errorMsg, error;
var users;


$(document).ready(function() {
    attemptSendMessageForm();
    fillAutoComplete();
    
    $('#msgListing').DataTable({
        ordering:  false,
    });
    
    $('#msgListing a.star-item').click(function(event){
        event.preventDefault();
        
        var $id = $(this).attr('data-id');
        var $star = $('#msgListing a.star-item>i.i_'+$id);
        if( $star.hasClass('star-active')){
            $star.removeClass('star-active');
            setImportant($id, 'disable');
        }else{
            $star.addClass('star-active');
            setImportant($id, 'enable');
        }
    });
    
    $('#msgListing a.trash-item').click(function(event){
        event.preventDefault();
        
        var $id = $(this).attr('data-id');
           
        if (confirm("Are you sure, you would like to delete this message?")) {
            $('#loading-container').show();
            setTimeout(function(){ 
                 setDelete($id, 'enable');
            },2000); 
        }
        return false;
        
    });
    
    $('#msgListing a.trash-sent-item').click(function(event){
        event.preventDefault();
        
        var $id = $(this).attr('data-id');
           
        if (confirm("Are you sure, you would like to delete this message?")) {
            $('#loading-container').show();
            setTimeout(function(){ 
                 setDelete($id, 'sent');
            },2000); 
        }
        return false;
        
    });
    
    $('#msgListing #delete-all').click(function(){
        event.preventDefault();
        var checkbox = $('#msgListing input.checkbox');
        //console.log($(checkbox[0]).attr('data-id')); return false;
        var ids = new Array();
        var len = 0;
        len = checkbox.length;
        
        if(len > 0){
            for(var i=0; i < len; i++){
                var id = $(checkbox[i]).attr('data-id');
                //console.log( id );
                if($(checkbox[i]).is(":checked")){
                    ids[i]= id;
                }
            }
        
        }
        
        if(ids.length > 0){
            var idsAll = ids.join('_');
            var tab = $( this ).attr('data-tab');
            if (confirm("Are you sure, do you want to delete all selected messages?")) {
                $('#loading-container').show();
                setTimeout(function(){
                    
                    if( tab == 'deleted' ){
                        setDelete(idsAll, 'completeAll');
                    }else if( tab == 'sent' ){
                        setDelete(idsAll, 'sentAll');
                    }else{
                        setDelete(idsAll, 'enableAll');
                    }
                    
                },2000); 
            }
        }else{
            alert('Please check the messages you would like to delete and try again');
            return false;
        }
        
        
        //console.log(checkbox);
        return false;
        
        
    });
        
    $('#checkAll').change(function() {
        if($(this).is(":checked")) {
            $('#msgListing input:checkbox').attr('checked','checked');
        }else{
            $('#msgListing input:checkbox').removeAttr('checked');
        }
        return false;
    });
    
    $('#inbox ul>li a.tab-item').click(function( event ){
        event.preventDefault();
        $('#inbox ul>li a.tab-item').removeClass('inbox-nav-active');
        $( this ).addClass('inbox-nav-active');
        var tab = $( this ).attr('data-tab');
        
        if(tab != 'new-msg'){
            getMsg(tab);
        }
    });
    
    $('#new-msg').click(function(event){
        event.preventDefault();
        $('#listing-container').hide();
        $('#reply-container').hide();
        $('#form-container').show();
    
    });
    
    $('#msg-form #form-cancel').click(function(){
        var tab = 'inbox';
        $('#loading-container').show();
        setTimeout(function(){ 
             getMsg(tab);
        },2000);
    });
    
    $('#reply-form #form-cancel').click(function(){
        var tab = $( this ).attr('data-tab');
        $('#loading-container').show();
        setTimeout(function(){ 
             getMsg(tab);
        },2000);
    });
    
    $('#msg-form #username').keyup(function(){
        var $value = $( this ).val();
        if( $value != '' && $value != ' ' && isValid($value)){
           getAutoComplete($value);
        }
        return false;
    });
    
    $( document ).on('click', '.auto-item', function(){ 
       $('#msg-form #username').val();
        //console.log('clicked'); return false;
       var $text = $( this ).text();
       var $to = $( this ).attr('data-id');
        
        $('#msg-form #username').val($text);
        $('#msg-form #to_userid').val($to);
        $('#msg-form #from_userid').val($to);
        $('#auto-complete').slideUp();
        $('#auto-complete').empty();
    });
    
    $('#msg-form #form-send').click(function(event){
        event.preventDefault();
        $('#msg-form').submit();
        
    });
    
    $('#reply-form #form-send').click(function(event){
        event.preventDefault();
        $('#reply-form').submit();
        
    });

    $('#msg-form').validate({
        rules: {
            username: {
                required: true
            },
            subject: {
                required: true
            },
            message: {
                required: true
            }
        }
    });
    
    $('#reply-form').validate({
        rules: {
            message: {
                required: true
            }
        }
    });
    
    $('.item-msg').click(function(){
        
        var id = $( this ).attr('data-id');
        //console.log(id);
        
        readMessage(id);
        
        $('#listing-container').hide();
        $('#reply-container').show();
        
        var username = $("#username_"+id).val();
        var to_userid = $("#to_userid_"+id).val();
        var subject = $("#subject_"+id).val();
        var message = $("#message_"+id).val();
        
        //console.log(message);
        //return false;
        $('#reply-form #message_id').val(id);
        $('#reply-form #username').val(username);
        $('#reply-form #to_userid').val(to_userid);
        $('#reply-form #subject').val(subject);
        $('#reply-form #message').text(message);
    });
    
    $('#reply-form #form-restore').click(function( event ){  
        event.preventDefault();
        var id = $('#reply-form #message_id').val();
        //console.log(id);
        if(confirm('Are you sure, would you like to restore this message?')){
            $('#loading-container').show();
            setTimeout(function(){ 
                setDelete(id, 'disable');
            },2000);
        }
        return false;
    });
    
    $('#reply-form #form-delete').click(function( event ){  
        event.preventDefault();
        var id = $('#reply-form #message_id').val();
        var tab = $( this ).attr('data-tab');
        //console.log(tab); return false;
        if(confirm('Are you sure, would you like to delete this message?')){
            $('#loading-container').show();
            setTimeout(function(){ 
                if(tab == 'sent'){
                    setDelete(id, 'sent');
                }else{
                    setDelete(id, 'enable');
                }
            },2000);
        }
        return false;
    });
    
    $('#reply-form #form-trash').click(function( event ){  
        event.preventDefault();
        var id = $('#reply-form #message_id').val();
        //console.log(id);
        if(confirm('Are you sure, would you like to remove this message completely?')){
            $('#loading-container').show();
            setTimeout(function(){ 
                 setDelete(id, 'complete');
            },2000); 
        }
        return false;
    });
    
    $('#msgListing a.trash-item-complete').click(function( event ){  
        event.preventDefault();
        var id = $(this).attr('data-id');
        //console.log(id);
        if(confirm('Are you sure, would you like to remove this message completely?')){
            $('#loading-container').show();
            setTimeout(function(){ 
                 setDelete(id, 'complete');
            },2000); 
        }
        return false;
    });
    
});

function setDelete(id, value){
    if(id){
        base = base_url('index.php');
        url = base + 'index.php/';
        url += 'main/'+value+'Delete/'+ id;
        $.ajax({
            type: "post",
            url: url,
            dataType: "text",
            success: function( data ) {
                location.reload(true);
                //console.log(data);
            }
        });
    }
    return false;
}

function setImportant(id, value){
    if(id){
        base = base_url('index.php');
        url = base + 'index.php/';
        url += 'main/'+value+'Important/'+ id;
        $.ajax({
           type: "post",
           url: url,
           dataType: "text",
           success: function( data ) {
              location.reload(true);
            }
        });
    }
    return false;
}

function readMessage(id){
    if(id){
        base = base_url('index.php');
        url = base + 'index.php/';
        url += 'main/readMessage/'+ id;
        $.ajax({
           type: "post",
           url: url,
           dataType: "text",
           success: function( data ) {
              //location.reload(true);
            }
        });
    }
    return false;
}


function isValid(str){
  return /^[a-zA-Z0-9- ]*$/.test(str);
}

function base_url(segment){
   // get the segments
   pathArray = window.location.pathname.split( '/' );
   // find where the segment is located
   indexOfSegment = pathArray.indexOf(segment);
   // make base_url be the origin plus the path to the segment
   return window.location.origin + pathArray.slice(0,indexOfSegment).join('/') + '/';
}

function getMsg(value) {
    var id = $('#userid').val();
    base = base_url('index.php');
    url = base + 'index.php/';
    url += 'main/getMsgByUserId/'+ value;
    
    //console.log(url); //return false;
    //window.location = url;
    $('#loading-container').show();
    setTimeout(function(){
        location.reload(true);
    },2000);
    window.location = url;
}

function getAutoComplete(value) {
        
    var id = $('#userid').val();
    base = base_url('index.php');
    url = base + 'index.php/';
    url += 'main/getUsername/'+ value;

    $.ajax({
           type: "post",
           url: url,
           dataType: "text",
           success: function( data ) {
               //console.log(JSON.parse(data));
               var $items = JSON.parse(data);

               //console.log($items.length);
              //return $items;
               $('#auto-complete').empty();
               if($items.length > 0){
                   for(var $i = 0; $i < $items.length; $i++){
                       $('#auto-complete').append('<li class="auto-item" data-id="'+$items[$i]['UserId']+'" >'+$items[$i]['Full_Name']+'</li>');
                   }
                   $('#auto-complete').slideDown();
               } else {
                   $('#auto-complete').slideUp();
               }
                return false;
            }
       });
}


function populate_message_board(from,time,message){
    var message_board = document.getElementById("message_board");
    var to_user = document.getElementById("UserToMessage");
    to_user.value = from;
    message_board.innerHTML = "@: " + time + "<br>User: "+ from + " <br> " + " Wrote: " + message;
    
} 

function fillAutoComplete()
{
   $.ajax({
           type: "GET",
           url: $('#url').val() + 'index.php/main/getUsersForMessageSending',
           dataType: "json",
           success: function( event ) {
               users = event;
               $('#UserToMessage').autocomplete({source: event});
            }

       });
}


function attemptSendMessageForm()
{
    submitSendMessageForm();
}

function submitSendMessageForm()
{
    $('#sendmessage_form').submit(function(event) {
        validForm();
        checkSendAttemptForErrors();
        
        if (!formReadyForSubmit())
        {
            event.preventDefault();
        }

    }); 
}

function checkSendAttemptForErrors()
{
    checkSendingUserForErrors();
    checkSendingMessageForErrors();
}

function checkSendingUserForErrors ()
{
    var reg = /[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/;
    var sendingUser = $("#UserToMessage").val();
    var isUserValid = $.inArray(sendingUser, users);
    
    if (!sendingUser || !reg.test(sendingUser) || isUserValid <= -1)
    {
        inValidForm();
        $("#invalidUserError").text("Please Enter a valid User");
        $("#invalidUserError").css("display", "block"); 
    }; 
}

function checkSendingMessageForErrors ()
{
    var sendingMessage = $("#sMessage").val();
    
    if (!sendingMessage)
    {
        inValidForm();
        $("#invalidMessageError").text("Please Enter a Message");
        $("#invalidMessageError").css("display", "block"); 
    }; 
}

function validForm() {
    valid = true;
}

function inValidForm() {
    valid = false;
}


function formReadyForSubmit() {
    return valid === true;
}

