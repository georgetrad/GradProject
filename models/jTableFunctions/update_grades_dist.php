<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/dbFunctions.php';

// Getting the inserted values in from the form.
$primKey    = $_POST['id'];
$gradeFrom  = $_POST['grade_from_up'];
$appliesTo  = $_POST['applies_to'];
$points     = $_POST['points'];
$userId     = $_SESSION['userId'];

$cols = array(    
    'grade_from_up', 
    'applies_to',
    'points',    
    'update_date',
    'user_id'
    );

$data = array(
    $gradeFrom,
    $appliesTo,
    $points,   
    'now()',
    $userId
);

dbUpdate('grades_dist', $cols, $data, "id = $primKey");

//Get last inserted record (to show it on jTable)
$query2 = "SELECT * FROM grades_dist WHERE id = LAST_INSERT_ID();";
$result2 = mysql_query($query2);
$row = mysql_fetch_array($result2);

//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Record'] = $row;
print json_encode($jTableResult);