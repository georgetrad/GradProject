<?php
// This core.php files includes the most common commands and functions that will
// be used in other pages.

include $_SERVER['DOCUMENT_ROOT'].'/GradProject/lang/ar.php';   // Including tha Arabic language file.
ob_start();         // Starting output buffering.
session_start();    // Starting a session.

/**
 * @author George Trad
 * This function checks if the user is logged in or not.
 * Returns true or false according to that.
 * @return boolean
 */
function loggedIn(){
    if(isset($_SESSION['userId']) && !empty($_SESSION['userId'])){		
        return true;
    }
    else{
        return false;
    }
}