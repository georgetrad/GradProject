<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = HOME;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>

<div class="row">   
    <br><br><br>
    <form>
        <div class="medium-2 large-2 columns show-for-medium-up">
           &nbsp;
        </div> 
        <div class="medium-2 large-2 columns show-for-medium-up">            
            <span>الرجاء إدخال رقم الطالب: </span>
        </div> 
        <div class="medium-8 large-8 columns show-for-medium-up">
            &nbsp;
        </div> 
    </form>       
</div>  
<div class="row">   
    <br>
    <form>
        <div class="medium-2 large-2 columns show-for-medium-up">
           &nbsp;
        </div> 
        <div class="medium-2 large-2 columns show-for-medium-up">            
            <input type="search" id="search_text" />
        </div> 
        <div class="medium-1 large-1 columns show-for-medium-up">
            <input type="submit" class="tiny button" id="search_button" value="<?=SEARCH?>">
        </div> 
        <div class="medium-7 large-7 columns show-for-medium-up">
        </div>
    </form>       
</div>  

<div class="row">
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;  
    </div>
    <div class="medium-8 large-8 columns show-for-medium-up" style="padding: 2em;">
        <div class="result">&nbsp;</div>
    </div>  
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;  
    </div>    
</div>
			
<?php 
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/student_grade_script.php';
?>