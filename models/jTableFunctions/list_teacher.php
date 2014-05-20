<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once '../db_connect.php';

// Get records count
$query1 = "SELECT COUNT(*) AS RecordCount FROM teacher WHERE active='A' ";
if(isset($_POST['searchText']) && !empty($_POST['searchText'])){
    $searchText = $_POST['searchText'];   
    $query1.= " AND (first_name LIKE '$searchText%' OR middle_name LIKE '$searchText%' OR last_name LIKE '$searchText%') ";    
}

$result1 = mysql_query($query1);            // Executing the query.
$row = mysql_fetch_array($result1);         // Fetching the result.
$recordCount = $row['RecordCount'];         // Filling the result in an variable.


$pageSize = $_GET['jtPageSize'];            // Getting the selected page size, start index from jTable
$startIndex = $_GET['jtStartIndex'];
$sorting = 'first_name ASC';                        // Assigning a default sorting order.

if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];             // Changing sort order according to what the user has selected.
}

//Get the records from database
$query2 = "SELECT CONCAT(t.first_name, ' ', t.last_name) as name, t.degree, t.phone_number, d.name_ar as dep_name ";
$query2.= "FROM teacher as t ";
$query2.= "LEFT JOIN department as d ON  t.department_id= d.id ";
$query2.= "WHERE t.active='A'";

if(isset($_POST['searchText']) && !empty($_POST['searchText'])){            // Modifying the query according to the search text.
    $searchText = $_POST['searchText'];    
    $query2.= " AND CONCAT(t.first_name, ' ', t.last_name) LIKE '%$searchText%'";
}
$query2.= " ORDER BY t.$sorting LIMIT $startIndex, $pageSize";
$result2 = mysql_query($query2);
 
//Add all records to an array
$rows = array();
while($row = mysql_fetch_array($result2))
{
    $rows[] = $row;
}

for($i=0 ; $i<count($rows) ; $i++){
    if($rows[$i]['degree'] == 'P'){
        $rows[$i]['degree'] = DOCTOR;
    }
    if($rows[$i]['degree'] == 'E'){
        $rows[$i]['degree'] = ENGINEER;
    }
}
//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['TotalRecordCount'] = $recordCount;
$jTableResult['Records'] = $rows;

print json_encode($jTableResult);

