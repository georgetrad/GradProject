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
    <h4 class="title text-center"><?=$title;?></h4>
</div>
<div class="medium-1 large-1 columns">
    &nbsp;
</div>
<div class="data_container medium-10 large-10 columns">    
    <div class="home row">
        <div class="medium-4 large-4 columns">
            <span class="home_data label" id="date"></span><span class="home_data secondary label" id="time"></span>
        </div>
    </div>
    <div class="home row">
        <div class="medium-4 large-4 columns">
            Current Semester
        </div>
    </div>
    <div class="home row">
        <div class="medium-4 large-4 columns">
            Number of Students
        </div>
    </div>
    <div class="home row">
        <div class="medium-4 large-4 columns">
            Number of Courses
        </div>
    </div>
    <div class="home row">
        <div class="medium-4 large-4 columns">
            Number of Suggested Courses            
        </div>
    </div>
</div>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/home_script.php';
?>