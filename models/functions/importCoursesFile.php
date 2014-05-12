<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/PHPExcel/IOFactory.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/importFunction.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/import_page_script.php';

$file = $_POST['file'];
$inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
//*******************Variables   *******************//
$rows = 5000;
$rowsOffSet = 2;
////*******************Class name*******************//
$columns = array(
    "id"                => "C",
    "course_type_id"    => "F",
    "req_course_id"     => "E",
    "name_ar"           => "B",
    "course_level"      => "A"
);
$staticData = array();
$tableName = 'course';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);

return true;