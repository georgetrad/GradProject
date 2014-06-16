<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] != 1)){
    header('Location: ../../../index.php');
}
$title = MY_GRADES;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/student/top_bar.php';
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>
<div class="row">
    <div class="medium-1 large-1 columns">
        &nbsp;
    </div>
    <div id="my_grades_table" class="jTable medium-10 large-10 columns"></div>
    <div class="medium-1 large-1 columns">
        &nbsp;
    </div>
</div>
<?php 
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/my_grades_script.php';
?>