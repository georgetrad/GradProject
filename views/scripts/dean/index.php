<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';

if(loggedIn()){
    if($_SESSION['userType'] == 'A'){
        header('Location: ./dean/home.php');
        exit();
    }
    else if($_SESSION['userType'] == 'U'){
        header('Location: ./home.php');
        exit();
    }
}
else{
    header('Location: ../login.php');
    exit();
}