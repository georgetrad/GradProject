<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] != -1)){
    header('Location: ../../../index.php');
}
$title = SUGGESTED_COURSES;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>

<!-- Filtering Area -->
<div class="row">    
<form>
    <div class="medium-2 large-2 columns show-for-medium-up">
        <select id="search_id">                    
            <option value="0"><?=COURSE_CODE?></option>
            <option value="1"><?=COURSE_NAME.' ('.ARABIC.')'?></option>
            <option value="2"><?=COURSE_NAME.' ('.ENGLISH.')'?></option>
            <option value="3"><?=COURSE_TYPE?></option>
            <option value="4"><?=LEVEL?></option>
            <option value="5"><?=CREDITS?></option>
            <option value="6"><?=FEES?></option>
        </select>
    </div> 
    <div class="medium-2 large-2 columns show-for-medium-up">
        <input type="search" id="search_text" style="text-align: center"/>
    </div> 
    <div class="medium-1 large-1 columns show-for-medium-up">
        <input type="submit" class="tiny button" id="search_button" value="<?=SEARCH?>">
    </div> 
    <div class="medium-4 large-4 columns show-for-medium-up">
    </div>
</form>       
</div>    
<div class="row medium-3 large-3 columns show-for-medium-up"></div>        
<div id="sugg_courses_Table" class="medium-12 large-12 columns show-for-medium-up"></div> <!--Table-->

<?php 
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/sugg_courses_script.php';
?>
