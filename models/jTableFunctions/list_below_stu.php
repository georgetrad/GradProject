<?php
include_once '../db_connect.php';

// Get records count
$query1 = "SELECT s.min_req_hrs, COUNT(v.id) AS RecordCount ";
$query1.= "FROM semester AS s, stu_sugg_hrs AS v ";
$query1.= "WHERE s.id = (SELECT max(id) FROM semester) AND v.hrs<(s.min_req_hrs)";
//print_r($query1);exit;
$result1 = mysql_query($query1);            // Executing the query.
$row = mysql_fetch_array($result1);         // Fetching the result.
$recordCount = $row['RecordCount'];         // Filling the result in an variable.


$pageSize = $_GET['jtPageSize'];            // Getting the selected page size, start index from jTable
$startIndex = $_GET['jtStartIndex'];
$sorting = 'id ASC';                       // Assigning a default sorting order.

if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];             // Changing sort order according to what the user has selected.
}

//Get the records from database
$query2 = "SELECT id,  CONCAT(first_name, ' ', middle_name, ' ', last_name) AS name, name_ar AS depName, current_level AS level, ";
$query2.= "tot_hours_completed AS hours, num_of_crs, hrs ";
$query2.= "FROM stu_sugg_hrs ";
$query2.= "WHERE hrs<(SELECT min_req_hrs FROM semester WHERE id = (SELECT max(id) FROM semester)) OR hrs IS NULL ";
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