<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] == 0)){
    header('Location: ../../../index.php');
}
$title = SEMESTERS;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/dean/top_bar.php';
?>
<div class="row">
    &nbsp;    
</div>
<div class="row">
    &nbsp;    
</div>
<div class="row">
    <div class="medium-1 large-1 columns">
        &nbsp;
    </div>
    <!--Table-->
    <div id="jTable" class="medium-6 large-10 columns show-for-medium-up">            
    </div>
    <div class="medium-1 large-1 columns">
        &nbsp;
    </div>
</div>
<?php 
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/semester_script.php';
?>
