<?php 
    $userName   = (trim($data->name))    ? $data->name   : '';
    $school     = (trim($data->school))  ? $data->school : 'N/A';
    $class      = (trim($data->class))   ? $data->class  : 'N/A';
    $major      = (trim($data->major))   ? $data->major  : 'N/A';
    $greek      = (trim($data->greek))   ? $data->greek  : 'None';
    $act        = (trim($data->activ))   ? $data->activ  : 'None';
    
    $music  = (trim($data->music))  ? str_replace('-', ', ', $data->music)  : "None";
    $org    = (trim($data->org))    ? str_replace('-', ', ', $data->org)    : "None";
    $actvity = str_replace('-', ', ', $act);
?>

<div id="profile_userDetails">
    <h2 class="green"><?php echo $userName;?>&nbsp;<img src="<?=base_url('assets/imgs/4-stars.png');?>" style="margin-top:-5px;"></h2>
    <div class="splitInfo">
        <span>School: <?php echo $school;?></span>
        <span>Class: <?php echo $class;?></span>
        <span>Major: <?php echo $major;?></span>
    </div>
    <div class="splitInfo">
        <span>Greek: <?php echo $greek;?></span>
        <span>Music: <?php echo $music;?></span>
        <span>Activities: <?php echo $actvity;?></span>
        <span>Organizations: <?php echo $org;?></span>
    </div>
</div>
