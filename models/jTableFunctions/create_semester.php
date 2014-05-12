<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/dbFunctions.php';

// Getting the inserted values in from the form.
$name           = $_POST['name'];
$startDate      = $_POST['start_date'];
$endDate        = $_POST['end_date'];
$minReqHrs      = $_POST['min_req_hrs'];
$maxReqHrs      = $_POST['max_req_hrs'];
$excGpa         = $_POST['exc_gpa'];
$excGpaHrs      = $_POST['exc_gpa_hrs'];
$maxGradStuHrs  = $_POST['max_grad_stu_hrs'];
$userId         = $_SESSION['userId'];

$cols = array(
    'name',
    'start_date', 
    'end_date',
    'min_req_hrs',
    'max_req_hrs',
    'exc_gpa',
    'exc_gpa_hrs',
    'max_grad_stu_hrs',
    'active',
    'create_date',
    'user_id'
    );

$data = array(
    "'$name'",
    $startDate,
    $endDate,
    $minReqHrs,
    $maxReqHrs,
    $excGpa,
    $excGpaHrs,
    $maxGradStuHrs,
    "'A'",
    'now()',
    $userId
);

dbInsert('semester', $cols, $data);

//Get last inserted record (to show it on jTable)
$query = "SELECT * FROM semester WHERE id = LAST_INSERT_ID();";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Record'] = $row;
print json_encode($jTableResult);
