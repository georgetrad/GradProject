<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once '../db_connect.php';

// Get records count
$studentId = $_SESSION['id'];

$query1 = "SELECT COUNT(*) AS RecordCount FROM grades WHERE student = '$studentId'";
$result1 = mysql_query($query1);
$row = mysql_fetch_array($result1);
$recordCount = $row['RecordCount'];

$pageSize = $_GET['jtPageSize'];
$startIndex = $_GET['jtStartIndex'];
$sorting = 'name ASC';
if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];   
}

//Get records from database
$query2 = "SELECT * FROM grades WHERE student = '$studentId' ";
$query2.= " ORDER BY $sorting LIMIT $startIndex, $pageSize";
$result2 = mysql_query($query2);
//print_r($query2);exit; 
//Add all records to an array
$rows = array();
while($row = mysql_fetch_array($result2))
{
    $rows[] = $row;
}
 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['TotalRecordCount'] = $recordCount;
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);

