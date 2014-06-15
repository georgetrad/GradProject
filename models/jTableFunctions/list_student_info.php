<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once '../db_connect.php';
$studentId = $_GET['studentId'];

//Get the records from database
$query2 = "SELECT id, gender, birth_date, address, phone_number, email  ";
$query2.= "FROM student ";
$query2.= "WHERE id = '$studentId'";

$result2 = mysql_query($query2);
//Add all records to an array
$rows = array();
while($row = mysql_fetch_array($result2))
{
    $rows[] = $row;
}

for($i=0 ; $i<count($rows) ; $i++){
    if($rows[$i]['gender'] == 'M'){
        $rows[$i]['gender'] = MALE;
    }
    if($rows[$i]['gender'] == 'F'){
        $rows[$i]['gender'] = FEMALE;
    }
}

//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);