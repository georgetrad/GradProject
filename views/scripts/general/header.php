<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
if(!loggedIn()){
    include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/login.php';
}
?>
<!DOCTYPE html>
<html class="no-js" lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, text/html" />        
        <title><?=$title?></title>
        <base href="http://localhost/GradProject/" />
        <link rel="icon" type="image/png" href="style/img/Ebla_logo.png"/>
        <link rel="stylesheet" href="style/css/foundation.css"/>
        <link rel="stylesheet" href="style/jTable/themes/metro/darkgray/jtable.css"  type="text/css" />
        <link rel="stylesheet" href="style/jTable/themes/basic/jtable_basic.css"/>
        <link rel="stylesheet" href="style/jTable/themes/jqueryui/jtable_jqueryui.min.css"/>
        <link rel="stylesheet" href="style/jTable/themes/metro/jtable_metro_base.css"/>
        <link rel="stylesheet" href="style/jTable/themes/jMetro/css/jquery-ui.css"/>
        <link rel="stylesheet" href="style/css/custom.css"/>
        <script type="text/javascript" src="views/js/vendor/modernizr.js"></script>
        <script type="text/javascript" src="views/js/spin.min.js"></script>   
    </head>
    <body style="height: 700px">

