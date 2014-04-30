<?php
include_once '../db_connect.php';
// Get record count
$query1 = "SELECT COUNT(*) AS RecordCount FROM student";
if(isset($_POST['searchText']) && !empty($_POST['searchText'])){
    $searchText = $_POST['searchText'];
    $searchId = $_POST['searchId'];
    if($searchId == 0){
        $query1.= " WHERE id LIKE '$searchText%'";
    }
    else if($searchId == 1){
        $query1.= " WHERE first_name LIKE '$searchText%'";
    }
    else if ($searchId == 2) {
        $query1.= " WHERE middle_name LIKE '$searchText%'";
    }
    else if($searchId == 3){
        $query1.= " WHERE last_name LIKE '$searchText%'";
    }
    
}
$result1 = mysql_query($query1);
$row = mysql_fetch_array($result1);
$recordCount = $row['RecordCount'];


$pageSize = $_GET['jtPageSize'];
$startIndex = $_GET['jtStartIndex'];
$sorting = 'id ASC';
if(isset($_GET['jtSorting'])){
 $sorting = $_GET['jtSorting'];   
}

//Get records from database
$query2 = "SELECT * FROM student";
if(isset($_POST['searchText']) && !empty($_POST['searchText'])){
    $searchText = $_POST['searchText'];
    $searchId = $_POST['searchId'];
    if($searchId == 0){
        $query2.= " WHERE id LIKE '$searchText%'";
    }
    else if($searchId == 1){
        $query2.= " WHERE first_name LIKE '$searchText%'";
    }
    else if ($searchId == 2) {
        $query2.= " WHERE middle_name LIKE '$searchText%'";
    }
    else if($searchId == 3){
        $query2.= " WHERE last_name LIKE '$searchText%'";
    }
    
}

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

