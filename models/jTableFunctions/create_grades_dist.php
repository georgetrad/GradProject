<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/dbFunctions.php';

// Getting the inserted values in from the form.
$gradeFrom  = $_POST['grade_from'];
$appliesTo  = $_POST['applies_to'];
$points     = $_POST['points'];
$userId     = $_SESSION['userId'];

$cols = array(    
    'grade_from', 
    'applies_to',
    'points',    
    'create_date',
    'active',
    'user_id'
    );

$data = array(
    $gradeFrom,
    $appliesTo,
    $points,   
    'now()',
    "'A'",
    $userId
);

dbInsert('grades_dist', $cols, $data);

//Get last inserted record (to show it on jTable)
$query2 = "SELECT * FROM grades_dist WHERE id = LAST_INSERT_ID();";
$result2 = mysql_query($query2);
$row = mysql_fetch_array($result2);

//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Record'] = $row;
print json_encode($jTableResult);