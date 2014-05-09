<?php
include_once '../db_connect.php';

// Get records count
$query1 = "SELECT COUNT(*) AS RecordCount FROM course";
if(isset($_POST['searchText']) && !empty($_POST['searchText'])){
    $searchText = $_POST['searchText'];
    $searchId = $_POST['searchId'];
    
    if($searchId == 0){                                         // Modifying the query according to the search text.
        $query1.= " WHERE id LIKE '$searchText%'";
    }
    else if($searchId == 1){
        $query1.= " WHERE name_ar LIKE '$searchText%'";
    }
    else if ($searchId == 2) {
        $query1.= " WHERE name_en LIKE '$searchText%'";
    }
    else if($searchId == 3){
        $query1.= " WHERE course_type_id LIKE '$searchText%'";
    }
    else if($searchId == 4){
        $query1.= " WHERE level LIKE '$searchText%'";
    }
    else if($searchId == 5){
        $query1.= " WHERE credits LIKE '$searchText%'";
    }
    else if($searchId == 6){
        $query1.= " WHERE fees LIKE '$searchText%'";
    }
}

$result1 = mysql_query($query1);            // Executing the query.
$row = mysql_fetch_array($result1);         // Fetching the result.
$recordCount = $row['RecordCount'];         // Filling the result in an variable.


//$pageSize = $_GET['jtPageSize'];            // Getting the selected page size, start index from jTable
//$startIndex = $_GET['jtStartIndex'];
$sorting = 'id ASC';                        // Assigning a default sorting order.

if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];             // Changing sort order according to what the user has selected.
}

//Get the records from database
$query2 = "SELECT * FROM course";
if(isset($_POST['searchText']) && !empty($_POST['searchText'])){            // Modifying the query according to the search text.
    $searchText = $_POST['searchText'];
    $searchId = $_POST['searchId'];
    
    if($searchId == 0){                                         // Modifying the query according to the search text.
        $query1.= " WHERE id LIKE '$searchText%'";
    }
    else if($searchId == 1){
        $query1.= " WHERE name_ar LIKE '$searchText%'";
    }
    else if ($searchId == 2) {
        $query1.= " WHERE name_en LIKE '$searchText%'";
    }
    else if($searchId == 3){
        $query1.= " WHERE course_type_id LIKE '$searchText%'";
    }
    else if($searchId == 4){
        $query1.= " WHERE level LIKE '$searchText%'";
    }
    else if($searchId == 5){
        $query1.= " WHERE credits LIKE '$searchText%'";
    }
    else if($searchId == 6){
        $query1.= " WHERE fees LIKE '$searchText%'";
    }   
}

$query2.= " ORDER BY $sorting";
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

