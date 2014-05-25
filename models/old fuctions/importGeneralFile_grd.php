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
//*******************Student duty , duty number 5*******************//
$columns = array(
    "student_class_student_id"                  => "A",
    "student_class_class_id"                    => "H",
    "grade"                                     => "O"
);
$staticData = array(
        "duty_type_id"    => "5"       
);   
$tableName = 'duty';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);

return true;