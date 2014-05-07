<?php
include_once '../db_connect.php';

$name           = $_POST['name'];
$startDate      = $_POST['start_date'];
$endDate        = $_POST['end_date'];
$minReqHrs      = $_POST['min_req_hrs'];
$maxReqHrs      = $_POST['max_req_hrs'];
$excGpa         = $_POST['exc_gpa'];
$excGpaHrs      = $_POST['exc_gpa_hrs'];
$maxGradStuHrs  = $_POST['max_grad_stu_hrs'];
//$userId         = $_SESSION['userId'];

$query1 = "INSERT INTO semester(name, start_date, end_date, min_req_hrs, max_req_hrs, exc_gpa, exc_gpa_hrs, max_grad_stu_hrs, active, create_date, user_id) ";
$query1.= "VALUES('$name', $startDate, $endDate, $minReqHrs, $maxReqHrs, $excGpa, $excGpaHrs, $maxGradStuHrs, 'A', now());";

mysql_query($query1);

//Get last inserted record (to return to jTable)
//$query2 = "SELECT * FROM semester WHERE id = LAST_INSERT_ID();";
//$result2 = mysql_query($query2);
//$row = mysql_fetch_array($result2);
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
//$jTableResult['Record'] = $row;
print json_encode($jTableResult);
