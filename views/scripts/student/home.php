<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] != 1)){
    header('Location: ../../../index.php');
}
$title = HOME;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/databaseClass.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/student/top_bar.php';

$semesterInfo   = databaseClass::getCurrSemInfo();
$belowStuNum    = databaseClass::getBelowStuNum();
$withourAdvNum  = databaseClass::getWithouthAdvNum();
$suggCrsNum     = databaseClass::getSuggCoursesNum();
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>    
</div>
Orbit slider
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/home_script.php';
?>