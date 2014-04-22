<?php 
include_once '../../models/core.php';
if(loggedIn()){
    session_destroy();    
    header('Location: login.php');
}
?>