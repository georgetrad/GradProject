<?php 
include_once 'core.php';
if(loggedIn()){
    session_destroy();    
    header('Location: ../views/scripts/login.php');
}
?>