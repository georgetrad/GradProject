<?php
include_once '../db_connect.php';

// Get records count
$query1 = "SELECT COUNT(*) AS RecordCount FROM student";

$result1 = mysql_query($query1);            // Executing the query.
$row = mysql_fetch_array($result1);         // Fetching the result.
$recordCount = $row['RecordCount'];         // Filling the result in an variable.


$pageSize = $_GET['jtPageSize'];            // Getting the selected page size, start index from jTable
$startIndex = $_GET['jtStartIndex'];
$sorting = 'id ASC';                        // Assigning a default sorting order.

if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];             // Changing sort order according to what the user has selected.
}

//Get the records from database
$query2 = "SELECT s.id, concat(s.first_name, ' ', s.middle_name, ' ', s.last_name) AS studentName, ";
$query2.= "concat(t.first_name, ' ', t.last_name) AS advisorName ";
$query2.= "FROM student as s ";
$query2.= "LEFT JOIN teacher as t ";
$query2.= "ON s.advisor_id = t.id ";
$query2.= "ORDER BY $sorting LIMIT $startIndex, $pageSize";

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

