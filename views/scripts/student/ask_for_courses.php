<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] != 1)){
    header('Location: ../../../index.php');
}
$title = ASK_COURSES;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/student/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>  
</div>
<!-- Filtering Area -->
<div class="row">    
    <div class="medium-7 large-7 columns show-for-medium-up">&nbsp;</div>    
    <div class="medium-5 large-5 columns show-for-medium-up">
        <div class="right_home_title label"><?=NUM_ASK_CRS?></div><div id="num_ask_crs" class="secondary label home_data"></div>
        <div class="right_home_title label"><?=NUM_ASK_HRS?></div><div id="num_ask_hrs" class="secondary label home_data"></div>
    </div>    
    <!--<div class="medium-1 large-1 columns show-for-medium-up">&nbsp;</div>-->    
</div>
<br>
<div class="row">
    <div class="medium-1 large-1 columns">&nbsp</div>
    <div id="available_courses_table" class="jTable medium-10 large-10 columns"><!--Table--></div>
    <div class="medium-1 large-1 columns">&nbsp;</div>
</div>

<?php 
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/ask_for_courses_script.php';
?>