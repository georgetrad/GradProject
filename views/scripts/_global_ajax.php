<?php
include '../../models/databaseClass.php';

switch($_POST['phpCase']){
    case 'login':{
        if (isset($_POST['username'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $userInfo = databaseClass::login($username, $password);

            if($userInfo['success'] == true){                                
                ob_start();
                session_start();
                $_SESSION['userId'] = $userInfo['userId'];				//Assigning the user_id to a session to use it later.                
                $_SESSION['userType'] = $userInfo['userType'];                
            }            
            echo json_encode($userInfo);
        }        
    }    
}
