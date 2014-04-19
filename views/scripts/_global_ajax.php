<?php
require '../../models/databaseClass.php';
require '../../models/core.php';
require '../../lang/ar.php';

switch($_POST['phpCase']){
    case 'logIn':{
        if (isset($_POST['username'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $userInfo = databaseClass::logIn($username, $password);

            if($userInfo['success'] == true){                
                $_SESSION['userId'] = $userInfo['userId'];				//Assigning the user_id to a session to use it later.                
                $_SESSION['userType'] = $userInfo['userType'];
                $_SESSION['username'] = $userInfo['username'];
            }            
            echo json_encode($userInfo);
        }
        break;
    }
    
    case 'logOut':{
        session_destroy();        
        break;
    }
}