<?php 
    $imagepath = file_exists($data->photo) ? "assets/photos/users/".$data->photo : "assets/photos/default.png";
    $imageUrl = base_url($imagepath);
?>

<div id="information">
    <div id="user-home">
        <figure>
            <img src="<?php echo $imageUrl;?>" />
        </figure>
        <p>Current City: <span id="city"><?php echo $data->city; ?></span></p>
        <p>Member Since: <?php echo $data->members; ?></p>
        <input hidden value="<?php echo $data->school;?>" id="userSchool"/>
    </div>
    <?php $this->load->view('members/home/events_area'); ?>
</div>
