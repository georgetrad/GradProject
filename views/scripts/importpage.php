<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/PHPExcel/IOFactory.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/importFunction.php';
    
//*******************Student name*******************//
//configurations 
$inputFileName = '../../uploads/crn.xlsx';
$columns = array(
    "id"            => "A",
    "first_name"    => "B",
    "middle_name"   => "C",
    "last_name"     => "D"    
);
$table_name = 'student';
$rows = 5000;
$rowsOffSet = 1;

$a = import($inputFileName, $columns, $table_name, $rows, $rowsOffSet);
var_dump($a);echo '<br>';

