<!DOCTYPE html>
<html lang="en" ng-app>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <?php 
            // Head Tag
            $this->load->view('headTag'); 
        ?>
        <title><?php echo $title;?></title> 
    </head>
    <?php
        if(isset($this->bg) && !empty($this->bg)){ 
            $class = $this->bg; 
        }else{ 
            $class = 'body1';
        } 
    ?>
    <body class="<?=$class?>" >