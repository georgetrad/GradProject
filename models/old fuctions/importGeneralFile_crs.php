<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/PHPExcel/IOFactory.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/importFunction.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/import_page_script.php';

$file = $_POST['file'];
$inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;
//*******************Variables   *******************//
$rows = 5000;
$rowsOffSet = 3;
////*******************Course name*******************//
$columns = array(
    "id"            => "F",
    "name_ar"       => "G"
);
$staticData = array();   
$tableName = 'course';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);

return true;