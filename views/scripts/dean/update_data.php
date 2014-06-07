<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = UPDATE_DATA;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>  
</div>

<div class="row">
    <div class="medium-3 large-3 columns show-for-medium-up">
        <form id="updateDataForm">
            <select id="selectUpdate" name="selectUpdate">
                <option value="0">---</option>
                <option value="1"><?=UPDATE_ALL?></option>
                <option value="2"><?=UPDATE_STU?></option>
                <option value="3"><?=UPDATE_RELATION?></option>
                <option value="4"><?=UPDATE_STU_NUM?></option>                
            </select>
        </form>        
    </div>
</div>

<div class="row">
    <div class="medium-2 large-2 columns show-for-medium-up">
        <input id="update_button" type="button" class="tiny button" value="<?=UPDATE?>">
    </div>
</div>

<div class="row">
    <div class="medium-6 large-6 columns show-for-medium-up">
        <div class="result">
            
        </div>
    </div>
</div>
<div class="row" >
    <div id="spinner"></div>
</div>
<div class="row">
    <div class="medium-4 large-4 columns">
        &nbsp;
    </div>
    <div class="medium-4 large-4 columns">
        <div data-alert class="result alert-box info" style="display:none; font-size: 20px; font-family: 'DroidKufi-Regular'; text-align: center">
            <?=UPDATE_SUCCESS?>
            <a href="#" class="close">&times;</a>
        </div>
        
        <div data-alert class="result2 alert-box alert" style="display:none; font-size: 20px; font-family: 'DroidKufi-Regular'; text-align: center">
            <?=UPDATE_NOT_SUCCESS?>
            <a href="#" class="close">&times;</a>
        </div>
    </div>
    <div class="medium-4 large-4 columns">
        &nbsp;
    </div>
</div>
<?php 
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/update_data_script.php';
?>