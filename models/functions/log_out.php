<?php 
include_once '../core.php';
if(loggedIn()){
    session_destroy();    
    header('Location: ../../index.php');
}
?>