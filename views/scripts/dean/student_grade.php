<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = STUDENT_GRADE;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>
<div class="row">
    <br>
    <form>
        <div class="medium-4 large-4 columns show-for-medium-up">
           &nbsp;
        </div> 
        <div class="medium-2 large-2 columns show-for-medium-up">            
            <input type="search" id="search_text" placeholder="<?=ENTER_STU_ID?>"/>
        </div> 
        <div class="medium-1 large-1 columns show-for-medium-up">
            <input type="button" class="tiny button" id="search_button" value="<?=SEARCH?>">
        </div> 
        <div class="medium-7 large-7 columns show-for-medium-up">
        </div>
    </form>       
</div>
<div class="row">
    <div class="medium-4 large-4 columns">
        &nbsp;
    </div>
    <div id="table" class="medium-4 large-4 columns">
        
    </div>
    <div class="medium-4 large-4 columns">
        &nbsp;
    </div>
</div>
<?php 
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/student_grade_script.php';
?>