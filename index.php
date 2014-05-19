<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
$title = ACADEMIC_ADVISING.' - '.LOGIN;
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';

if(!loggedIn()){
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/login.php';
}
else if(loggedIn() && $_SESSION['userLevel'] == -1){
    header('Location: views/scripts/dean/home.php');    
}
else if(loggedIn() && $_SESSION['userLevel'] == 0){
    header('Location: views/scripts/teacher/home.php');
}
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
?>