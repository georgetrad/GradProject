<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once '../db_connect.php';
$courseId = $_GET['coursetId'];

//// Get records count
//$query1 = "SELECT s.min_req_hrs, COUNT(v.id) AS RecordCount ";
//$query1.= "FROM semester AS s, stu_sugg_hrs AS v ";
//$query1.= "WHERE s.id = (SELECT max(id) FROM semester) AND v.hrs<(s.min_req_hrs)";
////print_r($query1);exit;
//$result1 = mysql_query($query1);            // Executing the query.
//$row = mysql_fetch_array($result1);         // Fetching the result.
//$recordCount = $row['RecordCount'];         // Filling the result in an variable.


//$pageSize = $_GET['jtPageSize'];            // Getting the selected page size, start index from jTable
//$startIndex = $_GET['jtStartIndex'];
//$sorting = 'id ASC';                       // Assigning a default sorting order.

if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];             // Changing sort order according to what the user has selected.
}

//Get the records from database
$query2 = "SELECT student_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS name, level, tot_hrs, gpa, ";
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

//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);