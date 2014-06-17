<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = TEACHERS;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>  
</div>
<!-- Filtering Area -->
<div class="row">    
    <div class="medium-1 large-1 columns show-for-medium-up">
        &nbsp;
    </div>         
    <div class="medium-2 large-2 columns show-for-medium-up">
        <input type="search" id="search_text" placeholder="<?=NAME?>" style="text-align: center"/>
    </div> 
    <div class="medium-1 large-1 columns show-for-medium-up">
        <input type="button" class="tiny button" id="search_button" value="<?=SEARCH?>">
    </div> 
    <div class="medium-7 large-7 columns show-for-medium-up"></div>
</div>

<div class="row">
    <div class="medium-1 large-1 columns show-for-medium-up">&nbsp;</div>
    <div class="medium-4 large-3 columns show-for-medium-up">        
        <input type="radio" name="dep" value="0" checked style="margin-left: 3px"><?=ALL?>&nbsp;
        <input type="radio" name="dep" value="1" style="margin-left: 3px"><?=ICT?>&nbsp;
        <input type="radio" name="dep" value="2" style="margin-left: 3px"><?=ARC?>
    </div>
    <div class="medium-6 large-6 columns show-for-medium-up"></div>
</div>

<div class="row">
    <div class="medium-1 large-1 columns">&nbsp;</div>
    <div id="teachers_table" class="jTable medium-10 large-10 columns"></div><!--Table-->
    <div class="medium-1 large-1 columns">&nbsp;</div>
</div>
<?php 
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/all_teachers_script.php';
?>