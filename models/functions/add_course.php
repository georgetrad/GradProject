<?php
include_once '../core.php';
include_once './databaseClass.php';

$action         = $_POST['action'];
$courseCode     = $_POST['courseCode'];
$userId         = $_SESSION['userId'];

if($action == 'add'){
    $query = "INSERT INTO sugg_course(course_id, semester_id, active, create_date, user_id) ";
    $query.= "VALUES ('$courseCode', 11, 'A', now(), $userId);";
}
else if($action == 'remove'){
    $query = "DELETE FROM sugg_course ";
    $query.= "WHERE course_id='$courseCode';";
}

mysql_query($query);                 // Executing the query

$jTableResult = array();
$jTableResult['Result'] = "OK";
print json_encode($jTableResult);

