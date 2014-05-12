<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/dbFunctions.php';

$case = $_POST['case'];

switch ($case){
    case 'getSuggCoursesNum':{
        $query = "SELECT count(id) FROM sugg_course WHERE active='A'";
        $result = mysql_query($query);
        $num = mysql_fetch_array($result);
        print $num[0];        
    }     
}