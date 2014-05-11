<?php
include_once '../core.php';
include_once './databaseClass.php';
include_once '../functions/dbFunctions.php';

$advisorId          = $_POST['advisorId'];
$selectedStudents   = $_POST['selectedStudents'];
$tableName = 'student';

$cols = array(    
    "advisor_id"   
);

$data = array(    
    $advisorId
);


print json_encode($result);


