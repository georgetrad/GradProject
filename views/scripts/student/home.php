<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] != 1)){
    header('Location: ../../../index.php');
}
$title = WELCOME_TO_AA;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/databaseClass.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/student/top_bar.php';
?>
<br>
<div class="row">
    <h4 class="title text-center"><?=$title;?></h4>    
</div>
<br><br>
<div class="row">
    <div class="medium-2 large-2 columns">&nbsp;</div>
    <div class="medium-7 large-7 columns text-center" style="margin-right: 60px">
        <ul class="orbit" data-orbit>
            <li>
                <img src="style/img/orbit_slider/01.png" alt="slide 1" />				
            </li>
            <li>
                <img src="style/img/orbit_slider/02.png" alt="slide 2" />				
            </li>
            <li>
                <img src="style/img/orbit_slider/03.png" alt="slide 3" />				
            </li>
            <li>
                <img src="style/img/orbit_slider/04.png" alt="slide 4" />				
            </li>
            <li>
                <img src="style/img/orbit_slider/05.png" alt="slide 5" />				
            </li>
            <li>
                <img src="style/img/orbit_slider/06.png" alt="slide 6" />				
            </li>
            <li>
                <img src="style/img/orbit_slider/07.png" alt="slide 7" />				
            </li>
            <li>
                <img src="style/img/orbit_slider/08.png" alt="slide 8" />				
            </li>
            <li>
                <img src="style/img/orbit_slider/09.png" alt="slide 9" />				
            </li>            
        </ul>
    </div>
    <div class="medium-3 large-3 columns">&nbsp;</div>
</div>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/home_script.php';
?>