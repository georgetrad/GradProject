<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/dbFunctions.php';

// Getting the inserted values in from the form.
$primKey        = $_POST['id'];
$dep            = $_POST['dep'];
$degree         = strtoupper($_POST['deg']);
$phone          = $_POST['phone_number'];
$email          = $_POST['email'];
$userId         = $_SESSION['userId'];

$cols = array(
    'department_id',    
    'phone_number',
    'degree',
    'email',    
    'update_date',
    'user_id'
    );

$data = array(
    $dep,    
    "'$phone'",
    "'$degree'",
    "'$email'",
    'now()',
    $userId
);

dbUpdate('teacher', $cols, $data, "id = $primKey");

//Get last inserted record (to show it on jTable)
$query2 = "SELECT * FROM teacher WHERE id = LAST_INSERT_ID();";
$result2 = mysql_query($query2);
$row = mysql_fetch_array($result2);

//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Record'] = $row;
print json_encode($jTableResult);