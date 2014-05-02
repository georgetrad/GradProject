<?php
/**
 * This file accepts the ajax requests from JQuery files and switches the case accordingly.
 */
include_once '../core.php';
include_once './databaseClass.php';

if (isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];    
    $userInfo = databaseClass::logIn($username, $password);             // getting the user info from the database.
    
    if($userInfo['success'] == true){
        // Assigning the user info to a session to use it later.
        $_SESSION['userId'] = $userInfo['userId'];                
        $_SESSION['username'] = $userInfo['username'];
        $_SESSION['userLevel'] = $userInfo['userLevel'];
    }
    echo json_encode($userInfo);    // Encoding the user info in JSON because it cannot be returned as an array.
}
