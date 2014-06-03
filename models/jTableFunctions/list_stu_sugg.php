<?php
include_once '../db_connect.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';

$stuId = $_POST['stuId'];

$sorting = 'id ASC';                        // Assigning a default sorting order.
if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];             // Changing sort order according to what the user has selected.
}

//Get the records from database
$query2 = "CALL crs_ava_stu ($stuId)";
$result2 = mysql_query($query2);
//Add all records to an array
$rows = array();
while ($row = mysql_fetch_array($result2)) {
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