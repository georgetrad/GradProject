<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn()){
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/login.php';
}
else if(loggedIn() && $_SESSION['userLevel'] == -1){
    header('Location: views/scripts/dean/home.php');    
}
else if(loggedIn() && $_SESSION['userLevel'] == 0){
    header('Location: views/scripts/teacher/home.php');
}
?>
<!DOCTYPE html>
<html class="no-js" lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, text/html" />        
        <title><?=$title?></title>
        <base href="http://localhost/GradProject/" />
        <link rel="stylesheet" href="style/css/foundation.css"/>
        <link rel="stylesheet" href="style/css/custom.css"/>
        <script type="text/javascript" src="views/js/vendor/modernizr.js"></script>        
    </head>
    <body>

