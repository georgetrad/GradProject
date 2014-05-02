<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';
if(!loggedIn()){
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/login.php';
}
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/footer.php';
?>