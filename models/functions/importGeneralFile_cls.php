<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/PHPExcel/IOFactory.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/importFunction.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/import_page_script.php';

$file = $_POST['file'];

$inputSemester = $_POST['semester'];
$inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
//*******************Variables   *******************//
$rows = 5000;
$rowsOffSet = 3;
////*******************Class name*******************//
$columns = array(
    "id"            => "H",
    "course_id"     => "F"
);
$staticData = array(
    "semester_id"   => $inputSemester
);
$tableName = 'class';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);
////*******************Student class*******************//
$columns = array(
    "student_id"    => "A",
    "class_id"      => "H" 
);
$staticData = array();
$tableName = 'student_class';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);

return true;