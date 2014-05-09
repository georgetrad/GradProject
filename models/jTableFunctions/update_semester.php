<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once '../db_connect.php';

// Getting the inserted values in from the form.
$primKey        = $_POST['id'];
$name           = $_POST['name'];
$startDate      = $_POST['start_date'];
$endDate        = $_POST['end_date'];
$minReqHrs      = $_POST['min_req_hrs'];
$maxReqHrs      = $_POST['max_req_hrs'];
$excGpa         = $_POST['exc_gpa'];
$excGpaHrs      = $_POST['exc_gpa_hrs'];
$maxGradStuHrs  = $_POST['max_grad_stu_hrs'];
$userId         = $_SESSION['userId'];

$query1 = "UPDATE semester ";
$query1.= "SET name='$name', start_date=$startDate, end_date=$endDate, ";
$query1.= "min_req_hrs=$minReqHrs, max_req_hrs=$maxReqHrs, ";
$query1.= "exc_gpa=$excGpa, exc_gpa_hrs=$excGpaHrs, max_grad_stu_hrs=$maxGradStuHrs, ";
$query1.= "active='A', create_date=now(), user_id=$userId ";
$query1.= "WHERE id=$primKey;";
//print_r($query1);exit;
mysql_query($query1);           // Executing the query

//Get last inserted record (to show it on jTable)
$query2 = "SELECT * FROM semester WHERE id = LAST_INSERT_ID();";
$result2 = mysql_query($query2);
$row = mysql_fetch_array($result2);

//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Record'] = $row;
print json_encode($jTableResult);
