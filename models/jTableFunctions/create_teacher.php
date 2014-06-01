<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/dbFunctions.php';

// Getting the inserted values in from the form.
$firstName      = $_POST['first_name'];
$middleName     = $_POST['middle_name'];
$lastName       = $_POST['last_name'];
$dep            = $_POST['dep'];
$degree         = strtoupper($_POST['deg']);
$phone          = $_POST['phone_number'];
$email          = $_POST['email'];
$userId         = $_SESSION['userId'];

$cols = array(
    'department_id',
    'first_name',
    'middle_name',
    'last_name',
    'phone_number',
    'degree',
    'email',
    'active',
    'create_date',
    'user_id'
    );

$data = array(
    $dep,
    "'$firstName'",
    "'$middleName'",
    "'$lastName'",
    "'$phone'",
    "'$degree'",
    "'$email'",
    "'A'",
    'now()',
    $userId
);

dbInsert('teacher', $cols, $data);

//Get last inserted record (to show it on jTable)
$query = "SELECT * FROM teacher WHERE id = LAST_INSERT_ID();";
//$query.= "FROM teacher as t ";
//$query.= "LEFT JOIN department as d ON  t.department_id= d.id ";
//$query.= "WHERE id = LAST_INSERT_ID() ";

$result = mysql_query($query);
$row = mysql_fetch_array($result);

//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Record'] = $row;
print json_encode($jTableResult);
