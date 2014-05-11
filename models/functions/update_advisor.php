<?php
include_once '../core.php';
include_once './databaseClass.php';
include_once '../functions/dbFunctions.php';

$advisorId          = $_POST['advisorId'];
$selectedStudents   = $_POST['selectedStudents'];
$tableName = 'student';

$cols = array(    
    "id",
    "advisor_id"
);

foreach ($selectedStudents as $id){
    $data = array( $id, $advisorId);
    dbInsert('student', $cols, $data, true, $cols, $data);
}
print json_encode($result);
