<?php
include_once '../db_connect.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
// Get records count
$query1 = "SELECT COUNT(id) AS RecordCount ";
$query1.= "FROM student WHERE active='A' AND STATUS = 'A' ";
if(isset($_POST['depSearchId']) && $_POST['depSearchId'] != 0){
    $dep = $_POST['depSearchId'];
    $query1.= "AND department_id = $dep ";
}

if(isset($_POST['searchText']) && !empty($_POST['searchText'])){
    $searchText = $_POST['searchText'];
    $searchId = $_POST['searchId'];
    
    if($searchId == 1){                                         // Modifying the query according to the search text.
        $query1.= " AND first_name LIKE '$searchText%'";
    }
    else if($searchId == 2){
        $query1.= " AND middle_name LIKE '$searchText%'";
    }
    else if($searchId == 3){
        $query1.= " AND last_name LIKE '$searchText%'";
    }
    else if($searchId == 4){
        $query1.= " AND id LIKE '$searchText%'";
    }    
}
$result1 = mysql_query($query1);            // Executing the query.
$row = mysql_fetch_array($result1);         // Fetching the result.
$recordCount = $row['RecordCount'];         // Filling the result in an variable.


$pageSize = $_GET['jtPageSize'];            // Getting the selected page size, start index from jTable
$startIndex = $_GET['jtStartIndex'];
$sorting = 's.id ASC';                        // Assigning a default sorting order.

if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];           // Changing sort order according to what the user has selected.  
}

//Get the records from database
$query2 = "SELECT s.id, CONCAT(s.first_name, ' ', s.middle_name, ' ', s.last_name) AS name, s.current_level AS level, s.tot_hours_completed AS hrs, s.status, d.name_ar as dep_name ";
$query2.= "FROM student AS s ";
$query2.= "INNER JOIN department AS d ON  s.department_id= d.id ";
$query2.= "WHERE s.active='A' AND s.STATUS = 'A' ";

if(isset($_POST['depSearchId']) && $_POST['depSearchId'] != 0){
    $dep = $_POST['depSearchId'];
    $query2.= "AND department_id = $dep ";
}

if(isset($_POST['searchText']) && !empty($_POST['searchText'])){            // Modifying the query according to the search text.
    $searchText = $_POST['searchText'];
    $searchId = $_POST['searchId'];
    
    if($searchId == 1){                                         // Modifying the query according to the search text.
        $query2.= " AND first_name LIKE '$searchText%'";
    }
    else if($searchId == 2){
        $query2.= " AND middle_name LIKE '$searchText%'";
    }
    else if($searchId == 3){
        $query2.= " AND last_name LIKE '$searchText%'";
    }
    else if($searchId == 4){
        $query2.= " AND id LIKE '$searchText%'";
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

//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['TotalRecordCount'] = $recordCount;
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);

