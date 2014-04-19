<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/lang/ar.php';
ob_start();
session_start();
function loggedIn(){
    if(isset($_SESSION['userId']) && !empty($_SESSION['userId'])){		
        return true;
    }
    else{
        return false;
    }
}