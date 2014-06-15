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
    <div class="medium-1 large-1 columns show-for-medium-up">&nbsp;</div>    
    <div class="medium-2 large-1 columns show-for-medium-up">
        <select id="search_id">                    
            <option value="1"><?=NAME?></option>
            <option value="2"><?=COLLEGE_ID?></option>                                   
        </select>
    </div>
    <div class="medium-2 large-2 columns show-for-medium-up">
        <input type="search" id="search_text" style="text-align: center"/>        
    </div>
    <div class="medium-2 large-2 columns show-for-medium-up" style="direction: rtl">
        
    </div>
    <div class="medium-1 large-1 columns show-for-medium-up">
        <input type="submit" class="tiny button" id="search_button" value="<?=SEARCH?>">
    </div>
    <div class="medium-4 large-4 columns show-for-medium-up">
    </div>    
</div>
<div class="row">
    <div class="medium-1 large-1 columns">&nbsp</div>
    <div id="available_courses_table" class="jTable medium-10 large-10 columns"><!--Table--></div>
    <div class="medium-1 large-1 columns">&nbsp;</div>
</div>

<?php 
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/ask_for_courses_script.php';
?>