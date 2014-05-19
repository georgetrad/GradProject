<?php
include_once '../db_connect.php';

// Get records count
$query1 = "SELECT COUNT(id) AS RecordCount FROM grades_dist WHERE active='A'";

$result1 = mysql_query($query1);            // Executing the query.
$row = mysql_fetch_array($result1);         // Fetching the result.
$recordCount = $row['RecordCount'];         // Filling the result in an variable.

$pageSize = $_GET['jtPageSize'];            // Getting the selected page size, start index from jTable
$startIndex = $_GET['jtStartIndex'];
$sorting = 'grade_from_up ASC';                        // Assigning a default sorting order.

if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];           // Changing sort order according to what the user has selected.  
}

//Get the records from database
$query2 = "SELECT * FROM grades_dist WHERE active='A'";
$query2.= " ORDER BY $sorting LIMIT $startIndex, $pageSize";
$result2 = mysql_query($query2);
 
//Add all records to an array
$rows = array();
while($row = mysql_fetch_array($result2))
{
    $rows[] = $row;
}
 
//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['TotalRecordCount'] = $recordCount;
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);

