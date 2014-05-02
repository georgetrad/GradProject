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
    <div class="medium-1 large-1 columns show-for-medium-up">
        HOME PAGE
    </div>                       
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';?>