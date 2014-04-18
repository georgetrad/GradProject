<?php
ob_start();
session_start();
include '../../lang/ar.php';

function loggedin(){
    if(isset($_SESSION['userId']) && !empty($_SESSION['userId'])){		
        return true;
    }
    else{
        return false;
    }
}