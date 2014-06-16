<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn()){
    header('Location: ../../../index.php');
}
$title = CHANGE_PASSWORD;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>
<div class="row">
    &nbsp;
</div>
<div class="row">
    <div class="medium-1 large-1 columns">
        &nbsp;
    </div>
    <div class="medium-2 large-1 columns">
        <span style="vertical-align: middle; font-size: 12px; font-family: DroidKufi-Regular"><?=OLD_PASSWORD?></span>
    </div>
    <div class="medium-3 large-2 columns">
        <input type="password" id="old_password" placeholder="<?=OLD_PASSWORD?>">
    </div>
    <div class="medium-6 large-8 columns">
        &nbsp;
    </div>
</div>
<div class="row">
    <div class="medium-1 large-1 columns">
        &nbsp;
    </div>
    <div class="medium-2 large-1 columns">
        <span style="vertical-align: middle; font-size: 12px; font-family: DroidKufi-Regular"><?=NEW_PASSWORD?></span>
    </div>
    <div class="medium-3 large-2 columns">
        <input type="password" id="new_password" placeholder="<?=NEW_PASSWORD?>">
    </div>
    <div class="medium-6 large-8 columns">
        &nbsp;
    </div>
</div>
<div class="row">
    <div class="medium-1 large-1 columns">
        &nbsp;
    </div>
    <div class="medium-2 large-1 columns">
        <span style="vertical-align: middle; font-size: 12px; font-family: DroidKufi-Regular"><?=CONFIRM_PASSWORD?></span>
    </div>
    <div class="medium-3 large-2 columns">
        <input type="password" id="confirm_password" placeholder="<?=CONFIRM_PASSWORD?>">
    </div>
    <div class="medium-6 large-8 columns">
        &nbsp;
    </div>
</div>
<div class="row">
    <div class="medium-2 large-2 columns">
        &nbsp;
    </div>
    <div class="medium-1 large-1 columns">
        <input type="button" id="change" class="tiny button" value="<?=CHANGE?>">
    </div>
    <div class="medium-9 large-9 columns">
        &nbsp;
    </div>
</div>
<div class="row">
    <div class="medium-4 large-5 columns">
        &nbsp;
    </div>
    <div class="medium-2 large-2 columns text-center">
        <span id="spinner"></span>
    </div>
    <div class="medium-4 large-5 columns">
        &nbsp;
    </div>
</div>
<div class="row">    
    <div class="medium-4 large-4 columns">
        &nbsp;
    </div>
    <div class="medium-4 large-4 columns text-center">            
        <div id="wrong" data-alert class="alert-box alert" style="font-size: 14px; font-family: DroidKufi-Regular; display: none; ">
            <span><?=EMPTY_PASSWORD?></span>                
        </div>
        <div id="short_password" data-alert class="alert-box alert" style="font-size: 14px; font-family: DroidKufi-Regular; display: none; ">
            <span><?=SHORT_PASSWORD?></span>                
        </div>
        <div id="doesnt_match" data-alert class="alert-box alert" style="font-size: 14px; font-family: DroidKufi-Regular; display: none; ">
            <span><?=DOESNT_MATCH?></span>                
        </div>
        <div id="wrong_old" data-alert class="alert-box alert" style="font-size: 14px; font-family: DroidKufi-Regular; display: none; ">
            <span><?=WRONG_OLD?></span>                
        </div>
        <div id="change_success" data-alert class="alert-box success" style="font-size: 14px; font-family: DroidKufi-Regular; display: none; ">
            <span><?=CHANGE_SUCCESS?></span>                
        </div>
    </div>
    <div class="medium-4 large-4 columns">
        &nbsp;
    </div>     
</div>
<?php 
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/change_password_script.php';
?>