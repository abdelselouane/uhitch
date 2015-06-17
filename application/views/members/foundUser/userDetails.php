<?php 

   // echo '<pre>'; print_r($page); echo '</pre>';

    $userName   = !empty($page['Full_Name'])    ? $page['Full_Name']   : '';
    $school     = !empty(trim($page['School_Name']))  ? $page['School_Name'] : 'N/A';
    $class      = !empty(trim($page['Classification']))   ? $page['Classification']  : 'N/A';
    $major      = !empty(trim($page['Major']))   ? $page['Major']  : 'N/A';
    $greek      = !empty(trim($page['Greek']))   ? $page['Greek']  : 'None';
    $act        = !empty(trim($page['Activities']))   ? $page['Activities']  : 'None';
    
    $music  = !empty(trim($page['Music']))  ? str_replace('-', ', ', $page['Music'])  : "None";
    $org    = !empty(trim($page['Organizations'])) ? str_replace('-', ', ', $page['Organizations'])    : "None";
    $actvity = str_replace('-', ', ', $act);
?>

<div id="userprofile" >
    <h2 style="margin-left: 20px" class="green"><?php echo $userName;?>&nbsp;<img src="<?=base_url('assets/imgs/4-stars.png');?>" style="margin-top:-5px;"></h2>
    <div style="margin-left: 20px" class="splitInfo">
        <span>School: <?php echo $school;?></span>
        <span>Class: <?php echo $class;?></span>
        <span>Major: <?php echo $major;?></span>
    </div>
    <div style="margin-left: 20px"  class="splitInfo">
        <span>Greek: <?php echo $greek;?></span>
        <span>Music: <?php echo $music;?></span>
        <span>Activities: <?php echo $actvity; ?></span>
        <span>Organizations: <?php echo $org; ?></span>
    </div>
    
</div>