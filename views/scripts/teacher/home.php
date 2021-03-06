<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] != 0)){
    header('Location: ../../../index.php');
}
$title = HOME;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/databaseClass.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/teacher/top_bar.php';

$semesterInfo   = databaseClass::getCurrSemInfo();
$belowStuNum    = databaseClass::getBelowStuNum();
$myStudents     = databaseClass::getMyStudentsNum(); 
$suggCrsNum     = databaseClass::getSuggCoursesNum();
?>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>
</div>
<div class="medium-1 large-1 columns">
    &nbsp;
</div>
<div class="data_container medium-10 large-10 columns text-center">    
    <div class="row" style="padding-bottom: 25px; padding-top: 25px">
        <div class="medium-12 large-12 columns">
            <span class=" date_title label" id="date"></span> <span class=" time_title secondary label" id="time"></span>
        </div>
    </div>
    <div class="row">
        <div class="medium-5 large-5 columns">
            <div class=" right_home_title label"><?=CURRENT_SEMESTER?></div> <div class="secondary label home_data"><?=$semesterInfo[0]['name']?></div>
        </div>
        <div class="medium-5 large-5 columns">
            <div class=" left_home_title label"><?=NUM_SUGG_CRS?></div> <div class="home_data secondary label"><?=$suggCrsNum?></div>
        </div>
    </div>    
    <div class="row">
        <div class="medium-5 large-5 columns">
            <div class=" right_home_title label"><?=START_DATE?></div> <div class="secondary label home_data"><?=$semesterInfo[0]['start_date']?></div>
        </div>        
        <div class="medium-5 large-5 columns">
            <div class=" left_home_title label"><?=MY_STUDENTS?></div> <div class="home_data secondary label"><?=$myStudents?></div>
        </div>
    </div>    
    <div class="row">
        <div class="medium-5 large-5 columns">
            <div class=" right_home_title label"><?=END_DATE?></div> <div class="secondary label home_data"><?=$semesterInfo[0]['end_date']?></div>
        </div>
        <div class="medium-5 large-5 columns">
            <div class=" left_home_title label"><?=NUM_SUGG_CRS?></div> <div class="home_data secondary label"><?=$suggCrsNum?></div>
        </div>
    </div>    
    <div class="row">
        <div class="medium-5 large-5 columns">
            <div class=" right_home_title label"><?=MIN_REQ_HRS?></div> <div class="secondary label home_data"><?=$semesterInfo[0]['min_req_hrs']?></div>
        </div>               
    </div>    
    <div class="row">
        <div class="medium-5 large-5 columns">
            <div class=" right_home_title label"><?=MAX_REQ_HRS?></div> <div class="secondary label home_data"><?=$semesterInfo[0]['max_req_hrs']?></div>
        </div>                
    </div>    
</div>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/home_script.php';
?>