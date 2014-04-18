<?php
include './models/core.php';

if(loggedin()){
    if($_SESSION[userType] == 'A'){
        header('Location: ./views/scripts/dean/home.php');
    }
    else if($_SESSION[userType] == 'U'){
        header('Location: ./views/scripts/teacher/home.php');                
    }
}

