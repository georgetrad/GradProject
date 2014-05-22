<?php
include_once '../db_connect.php';

// Get records count
$query1 = "SELECT COUNT(*) AS RecordCount FROM semester";
$result1 = mysql_query($query1);
$row = mysql_fetch_array($result1);
$recordCount = $row['RecordCount'];

$pageSize = $_GET['jtPageSize'];
$startIndex = $_GET['jtStartIndex'];
$sorting = 'id DESC';
if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];   
}

//Get records from database
$query2 = "SELECT * FROM semester";
$query2.= " ORDER BY $sorting LIMIT $startIndex, $pageSize";
$result2 = mysql_query($query2);
 
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

