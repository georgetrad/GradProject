<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/PHPExcel/IOFactory.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/importFunction.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/scripts/general/header.php';

$file = $_POST['selectFile'];
$inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
//** Variables ******************************************************************************//
$rows = 5000;
$rowsOffSet = 3;
//** Student name ******************************************************************************//
$columns = array(
    "id"            => "A",
    "first_name"    => "B",
    "middle_name"   => "C",
    "last_name"     => "D"    
);
$staticData = array(
        "status"    => "A"       
);    
$tableName = 'student';
$result = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);

if ($result===true)
    echo 'file imported successfully';
else 
    echo $result;
    
unset($columns, $tableName, $staticData, $a);
return true;