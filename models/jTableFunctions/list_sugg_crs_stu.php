<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once '../db_connect.php';
$courseId = $_GET['coursetId'];

if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];             // Changing sort order according to what the user has selected.
}

//Get the records from database
$query2 = "SELECT student_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS name, level, tot_hrs, gpa, status, grade, ";
$query2.= "CONCAT(t_first_name, ' ', t_last_name) AS adviserName ";
$query2.= "FROM stu_in_sugg_crs ";
$query2.= "WHERE id = '$courseId'";
$result2 = mysql_query($query2);
//Add all records to an array
$rows = array();
while($row = mysql_fetch_array($result2))
{
    $rows[] = $row;
}

for($i=0 ; $i<count($rows) ; $i++){
    if($rows[$i]['status'] == 'C'){
        $rows[$i]['status'] = CONDITIONAL_PASS;
    }
    if($rows[$i]['status'] == 'N'){
        $rows[$i]['status'] = NEVER_BEEN_TAKEN;
    }
    if($rows[$i]['status'] == 'F'){
        $rows[$i]['status'] = FAILED;
    }
}

//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);