<?php
include_once '../core.php';
include_once './databaseClass.php';
include_once '../functions/dbFunctions.php';

$advisorId          = $_POST['advisorId'];
$selectedStudents   = $_POST['selectedStudents'];
print_r($selectedStudents);exit;
$tableName = 'student';

$cols = array(    
    "id",
    "advisor_id"
);

foreach ($selectedStudents as $id){
    $data = array( $id, $advisorId);
    dbInsert('student', $cols, $data, true, $cols, $data);
}
//$data = array(    
//    $selectedStudents[0],
//    $advisorId
//);
//
//$uCols = array(    
//    "id",
//    "advisor_id"   
//);
//
//$uData = array(    
//    $selectedStudents[0],
//    $advisorId
//);
//
//$result = dbInsert('student', $cols, $data, true, $uCols, $uData);

//print json_encode($result);
