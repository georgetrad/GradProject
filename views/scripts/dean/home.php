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
<div class="row">
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;  
    </div>
    <div class="medium-8 large-8 columns show-for-medium-up">
        <?php include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/homeFunction.php';?>
    </div>  
    <div class="medium-2 large-2 columns show-for-medium-up">
        &nbsp;  
    </div>
</div>	
	
			
<?php include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';?>
