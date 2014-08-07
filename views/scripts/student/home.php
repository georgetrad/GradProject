<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn() || (loggedIn() && $_SESSION['userLevel'] != 1)){
    header('Location: ../../../index.php');
}
$title = WELCOME_TO_AA;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/databaseClass.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/student/top_bar.php';

// To load whatever photos in the style/img/orbit_slider folder and insert them in a slide show.
$photosDirectory = $_SERVER['DOCUMENT_ROOT'].'/GradProject/style/img/orbit_slider'; //Definin the directory string.
$handle = opendir($photosDirectory.'/'); //Opening the directory
if ($handle) {
    $slide = '';
    while ($fileName = readdir($handle)){   //Reading every file in the directory in the order in which they are stored by the filesystem.
        if ($fileName != '.' && $fileName != '..'){                    
            $slide.= '<li>';
            $slide.=    '<img src="style/img/orbit_slider/'.$fileName.'"/>';
            $slide.= '</li>';
        }
    }
}
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
            <?php            
                echo $slide;
            ?>
        </ul>                
    </div>
    <div class="medium-3 large-3 columns">&nbsp;</div>
</div>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/home_script.php';
?>