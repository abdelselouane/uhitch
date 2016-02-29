<section>  
<div id="page_content">
    <?php //echo '<pre>'; print_r($data); echo '</pre>';?>
    <div id="page">
        <section id="message">
            <h2 class="green2 center text-uppercase"><i class="fa fa-envelope"></i>&nbsp;My Messages</h2>
            <input type="hidden" name="userid" id="userid" value="<?= (isset($data->userid)) ? $data->userid : '';?>">
            <div id="inbox">
                <ul class="main-nav">
                    <li><a href="" id="new-msg" class="tab-item" data-tab="new-msg">New Message</i></a></li>
                    <li><a href="" class="tab-item <?= (isset($data->tab) && $data->tab == 'inbox') ? 'inbox-nav-active' : ''?>" data-tab="inbox">Inbox</i></a></li>
                    <li><a href="" class="tab-item <?= (isset($data->tab) && $data->tab == 'sent') ? 'inbox-nav-active' : ''?>" data-tab="sent">Sent</a></li>
                    <li><a href="" class="tab-item <?= (isset($data->tab) && $data->tab == 'important') ? 'inbox-nav-active' : ''?>" data-tab="important">Important</a></li>
                    <li><a href="" class="tab-item <?= (isset($data->tab) && $data->tab == 'deleted') ? 'inbox-nav-active' : ''?>" data-tab="deleted">Deleted</a></li>
                </ul>
            </div>
            <?php if(isset($data->get) && $data->get != ''){?>
            <script type="text/javascript">
                    $(document).ready(function(){
                        $('#inbox ul>li a.tab-item').removeClass('inbox-nav-active');
                        $('#new-msg').addClass('inbox-nav-active');
                        $('#listing-container').hide();
                        $('#reply-container').hide();
                        $('#form-container').show();
                    });
            </script>
            <?php } ?>
            <div id="conversation">
                <?php 
                if(isset($data->error) && isset($data->msg)){
                    if($data->error == 'false'){?>
                    <div class="alert alert-success" role="alert">
                        <p><?= $data->msg ?></p>
                    </div>
                    <?php } else if($data->error == 'true'){?>
                    <div class="alert alert-danger" role="alert">
                        <p><?= $data->msg ?></p>
                    </div>
                    <?php } 
                    $data->msg = ''; 
                    $data->error = ''; 
                }   

                //echo '<pre>'; print_r($data->message_inbox); echo '</pre>';
                ?>
                <div id="loading-container">
                    <img src="<?=base_url().'assets/imgs/preloading.gif'?>" alt="loading">
                </div>
                <div id="listing-container">
                    <table id="msgListing" class="display">
                        <thead>
                            <tr>
                                <th class="smallBox"><input type="checkbox" id="checkAll" name="checkAll"></th>
                                <th class="smallBox"><i class="fa fa-star"></i></th>
                                <th style="padding: 10px !important;">Messages</th>
                                <th style="padding: 10px !important; width:80px">Date</th>
                                <th class="smallBox">
                                    <a href="" data-tab="<?= isset($data->tab) ? $data->tab : 'inbox' ?>" id="delete-all"><i class="fa fa-trash"></i></a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($data->message_inbox)){
                                    $i = 0;
                                    foreach($data->message_inbox as $key => $value){

                                        $rowClass    = ($i%2) ? 'even' : 'odd' ; 
                                        $readClass   = ($value['read'] == 1) ? 'read-class' : '';
                                        ?>

                                    <tr class="<?=$rowClass?>">
                                        <td class="smallBox">
                                            <input type="checkbox" id="<?= 'checkbox_'.$value['id']?>" name="<?= 'checkbox_'.$value['id']?>" data-id="<?=$value['id']?>" class="checkbox">
                                        </td>
                                        <td class="smallBox">
                                            <a href="" class="star-item " data-id="<?=$value['id']?>">
                                                <i class="fa fa-star i_<?=$value['id']?> <?= ($value['important'] == 1) ? 'star-active' : ''?>"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a data-id="<?= $value['id']?>" class="item-msg <?=$readClass?>"><?= ($data->tab == 'sent') ? 'To: '.$value['to_userName'] : substr($value['subject'], 0, 50)?></a>
                                            <input type="hidden" id="username_<?= $value['id']?>" value="<?= $value['from_userName']?>">
                                            <input type="hidden" id="to_userid_<?= $value['id']?>" value="<?= $value['from_userId']?>">
                                            <input type="hidden" id="subject_<?= $value['id']?>" value="<?= $value['subject']?>">
                                            <input type="hidden" id="message_<?= $value['id']?>" value="<?= $value['message']?>">
                                        </td>
                                        <td class="<?=$readClass?>">
                                            <?=date('d M,y H:i', strtotime($value['timestamp']))?>
                                        </td>
                                        <td class="smallBox">
                                            <?php if($data->tab == 'sent'){?>
                                            <a href="" data-id="<?= $value['id']?>" class="trash-sent-item"><i class="fa fa-trash"></i></a>
                                            <?php } else {?>
                                            <a href="" data-id="<?= $value['id']?>" class="<?= ($data->tab == 'deleted') ? 'trash-item-complete' : 'trash-item' ?>"><i class="fa fa-trash"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php                   
                                        $i++;
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="clear"></div>
                <div id="reply-container" >
                    <form id="reply-form" name="reply-form" method="post" action="<?= base_url()?>index.php/main/sendMessage">

                        <div class="form-group">
                            <textarea name="message" id="message" rows="11" cols="10" placeholder="Type your message here" required <?= ($data->tab == 'deleted' || $data->tab == 'sent') ? 'disabled' : '' ?> style="<?= ($data->tab == 'deleted' || $data->tab == 'sent') ? 'background-color: #eee;' : '' ?>"></textarea>
                        </div>
                        <div class="form-group margin-left-20">
                            <input type="hidden" id="message_id" name="message_id" value="" >
                            <input type="hidden" id="username" name="username" value="" >
                            <input type="hidden" id="subject" name="subject" value="" >
                            <input type="hidden" id="to_userid" name="to_userid" value="" >
                            <input type="hidden" id="from_userid" name="from_userid" value="<?= (isset($data->userid) ? $data->userid : '')?>" >
                            <input type="hidden" id="from_fullname" name="from_fullname" value="<?= (isset($data->name) ? $data->name : '')?>" >
                            <?php if( $data->tab != 'sent' ){?>
                            <a id="<?= ($data->tab != 'deleted') ? 'form-send' : 'form-restore' ?>" class="form-btn">
                                <?= ($data->tab != 'deleted') ? 'Reply' : 'Restore' ?>
                            </a>
                            <?php } ?>
                            <a id="form-cancel" data-tab="<?= isset($data->tab) ? $data->tab : 'inbox' ?>" class="form-btn">Cancel</a>
                            <a id="<?= ($data->tab != 'deleted') ? 'form-delete' : 'form-trash' ?>" data-tab="<?= isset($data->tab) ? $data->tab : 'inbox' ?>" class="form-btn">
                                <?= ($data->tab != 'deleted') ? 'Delete' : 'Trash It' ?>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="clear"></div>
                <div id="form-container">
                    <form id="msg-form" name="msg-form" method="post" action="<?= base_url()?>index.php/main/sendMessage">
                        <div class="form-group">
                            <input type="text" id="username" name="username" value="<?= isset($data->to_username) ? $data->to_username : ''?>" autocomplete="off" placeholder="User Name" required>
                            <ul id="auto-complete">
                            </ul>
                        </div>
                        <div class="form-group">
                            <input type="text" id="subject" name="subject" value="" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="message" rows="5" cols="10" placeholder="Type your message here" required></textarea>
                        </div>
                        <div class="form-group margin-left-20">
                            <input type="hidden" id="to_userid" name="to_userid" value="<?= isset($data->get) ? $data->get : ''?>" >
                            <input type="hidden" id="from_userid" name="from_userid" value="<?= (isset($data->userid) ? $data->userid : '')?>" >
                            <input type="hidden" id="from_fullname" name="from_fullname" value="<?= (isset($data->name) ? $data->name : '')?>" >
                            <a id="form-cancel" class="form-btn">Cancel</a>
                            <a id="form-send" class="form-btn">Send</a>
                        </div>
                    </form>
                </div>
            </div>           
        </section>
    </div>
</div>
<!--?php echo form_close(); ?-->
</section>
