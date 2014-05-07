<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/PHPExcel/IOFactory.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/functions/importFunction.php';
echo '<div id="foo"></div>';
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/views/js/custom/import_page_script.php';


$file = $_POST['file'];
$inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/'.$file;

//*******************Variables   *******************//
$rows = 5000;
$rowsOffSet = 3;
//$inputFileName = $_SERVER['DOCUMENT_ROOT'].'/GradProject/uploads/2008-2009-S1.xls';
//*******************Student name*******************//
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
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);


//*******************Course name*******************//
$columns = array(
    "id"            => "F",
    "name_ar"       => "G"
);
$staticData = array();   
$tableName = 'course';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);
//*******************semester *******************//
$columns = array(
    "name"       => "E"
);
$staticData = array();   
$tableName = 'semester';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);
//*******************Class name*******************//
$columns = array(
    "id"        => "H",
    "course_id" => "F" 
);
$staticData = array();
$tableName = 'class';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);
//*******************Student class*******************//
$columns = array(
    "student_id"    => "A",
    "class_id"      => "H" 
);
$staticData = array();
$tableName = 'student_class';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);
//*******************Student duty , duty number 1*******************//
$columns = array(
    "student_class_student_id"                  => "A",
    "student_class_class_id"                    => "H",
    "grade"                                     => "J"
);
$staticData = array(
        "duty_type_id"    => "1"       
);   
$tableName = 'duty';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);
//*******************Student duty , duty number 2*******************//
$columns = array(
    "student_class_student_id"                  => "A",
    "student_class_class_id"                    => "H",
    "grade"                                     => "K"
);
$staticData = array(
        "duty_type_id"    => "2"       
);   
$tableName = 'duty';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);
//*******************Student duty , duty number 3*******************//
$columns = array(
    "student_class_student_id"                  => "A",
    "student_class_class_id"                    => "H",
    "grade"                                     => "L"
);
$staticData = array(
        "duty_type_id"    => "3"       
);   
$tableName = 'duty';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);
//*******************Student duty , duty number 4*******************//
$columns = array(
    "student_class_student_id"                  => "A",
    "student_class_class_id"                    => "H",
    "grade"                                     => "N"
);
$staticData = array(
        "duty_type_id"    => "4"       
);   
$tableName = 'duty';
$a = import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData);
var_dump($a);echo '<br>';
unset($columns, $tableName, $staticData, $a);


return true;
