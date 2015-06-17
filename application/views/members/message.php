<section>
<?php
    $message_attr = array(
                    'name' => 'sendmessageform',
                    'id' => 'sendmessage_form'
                );
    echo form_open('main/sendUserMessages', $message_attr); ?>

<?php 
   $rrmessages  = $data->message_inbox;
   $recieved_messages = array();
   
   foreach ($rrmessages as $value) {
       array_push($recieved_messages, $value);
   }
?>
    
    
<div id="page_content">
    <div id="page">
        <section id="message">
            <div id="inbox">
                <span>Inbox</span>
                <div class="inbox-content">
                    <hr class="margin-10"/>
                    <?php if(empty($recieved_messages)): ?>
                    <div class='noItems margin-10'>
                        <h3 class="no-shadow">No New Messages</h3>
                    </div>
        
                    <?php else: ?>  
                        <?php foreach ($recieved_messages as $messageinfo): ?>
                        <div class="latest-msg">
                            <figure>
                                
                            </figure>
                            <div class="msg" onclick="javascript:populate_message_board('<?php echo $messageinfo['from_userName'];?>','<?php echo $messageinfo['timestamp'];?>','<?php echo $messageinfo['message'];?>')">
                                <?php echo $messageinfo['from_userName']; ?>
                                <?php echo $messageinfo['timestamp']; ?>
                                <div class="time">
                                    <?php $messageinfo['message']; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div id="conversation">
                <input id="UserToMessage"
                       name="to_user_name"
                       type="text"
                       onkeyup="fillAutoComplete()"
                       placeholder="Who would you like to send a message to?" 
                       />
                <span class="error" id="invalidUserError"></span>
                
                <div id="message_board">
                    
                </div>
                
                <textarea name="message_to_be_sent" 
                          id="sMessage"
                          placeholder="Type your message here"
                          rows="3" 
                          cols="50"></textarea>
                
                <span class="error" id="invalidMessageError"></span>  
                
                <button class="button" id="sendMessageBtn" type="submit">Send</button>
            </div>           
        </section>
    </div>
</div>
<?php echo form_close(); ?>
</section>
