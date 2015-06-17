<div class='profile_info'>
    <figure>
        <img src=<?=base_url("assets/photo/default.png"); ?>>
        <p><?=$data->name?></p> 
    </figure>
         
    <span>Current City:</span>
    <span>Member Since:</span>
    <span>Last Login:</span>
</div>
<div class='profile_info full_info'>
    <h3><?=$data->name?></h3>
    <table>
        <tr>
            <td class="bold"><span>School: </span></td>
            <td><span><?=$data->school?></span></td>
        </tr>
        <tr>
            <td class="bold"><span>Major: </span></td>
            <td><span></span></td>
        </tr>
        <tr>
            <td class="bold"><span>Music: </span></td>
            <td><span></span></td>
        </tr>
        <tr>
            <td class="bold"><span>Interest: </span></td>
            <td><span></span></td>
        </tr>
    </table>
    <? $this->load->view('members/user/userRideDetails'); ?>
</div>