<?php 
    $userName   = !empty(trim($data->name))    ? $data->name   : '';
    $school     = !empty(trim($data->school))  ? $data->school : 'N/A';
    $class      = !empty(trim($data->class))   ? $data->class  : 'N/A';
    $major      = !empty(trim($data->major))   ? $data->major  : 'N/A';
    $greek      = !empty(trim($data->greek))   ? $data->greek  : 'None';
    $act        = !empty(trim($data->activ))   ? $data->activ  : 'None';
    
    $music  = !empty(trim($data->music))  ? str_replace('-', ', ', $data->music)  : "None";
    $org    = !empty(trim($data->org))    ? str_replace('-', ', ', $data->org)    : "None";
    $actvity = str_replace('-', ', ', $act);
?>

<div id="profile_userDetails">
    <h2><?php echo $userName;?></h2>
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