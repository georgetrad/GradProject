<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = ALL_STUDENTS;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>
<div class="row">
    &nbsp;    
</div>
<div class="row">
    &nbsp;    
</div>
<!-- Filtering Area -->
<div class="row">    
    <div class="medium-4 large-4 columns show-for-medium-up">
        &nbsp;
    </div>
    <form>
        <div class="medium-2 large-1 columns show-for-medium-up">
            <select id="search_id">                    
                <option value="0"><?=COLLEGE_ID?></option>
                <option value="1"><?=NAME?></option>
                <option value="2"><?=MIDDLE_NAME?></option>
                <option value="3"><?=LAST_NAME?></option>                    
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
<div class="row medium-3 large-3 columns show-for-medium-up">
    &nbsp;
</div>
<!--Table-->
<div id="jTable" class="medium-6 large-6 columns show-for-medium-up">            
</div>
<?php 
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/all_students_script.php';
?>
