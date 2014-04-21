<?php
include_once '../models/core.php';

if(loggedIn()){
    if($_SESSION['userType'] == 'A'){
        header('Location: ./scripts/dean/home.php');
        exit();
    }
    else if($_SESSION['userType'] == 'U'){
        header('Location: ./scripts/teacher/home.php');
        exit();
    }
}
else{
    header('Location: ./scripts/login.php');
    exit();
}