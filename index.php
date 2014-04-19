<?php
require './models/core.php';
if(loggedIn()){
    if($_SESSION['userType'] == 'A'){
        header('Location: ./views/scripts/dean/home.php');
        //exit();
    }
    else if($_SESSION['userType'] == 'U'){
        header('Location: ./views/scripts/teacher/home.php');
        //exit();
    }
}
else{
    header('Location: ./views/scripts/login.php');
    //exit();
}