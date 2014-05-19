<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';
include_once '../db_connect.php';

// Get records count
$query1 = "SELECT COUNT(id) AS RecordCount FROM const ";

$result1 = mysql_query($query1);            // Executing the query.
$row = mysql_fetch_array($result1);         // Fetching the result.
$recordCount = $row['RecordCount'];         // Filling the result in an variable.

$pageSize = $_GET['jtPageSize'];            // Getting the selected page size, start index from jTable
$startIndex = $_GET['jtStartIndex'];
$sorting = 'value ASC';                        // Assigning a default sorting order.

if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];           // Changing sort order according to what the user has selected.  
}

//Get the records from database
$query2 = "SELECT * FROM const ";
$query2.= " ORDER BY $sorting LIMIT $startIndex, $pageSize";
$result2 = mysql_query($query2);
 
//Add all records to an array
$rows = array();
while($row = mysql_fetch_array($result2))
{   
    $rows[] = $row;    
}

for($i=0 ; $i<count($rows) ; $i++){
    if($rows[$i][1] == 'level_2'){
        $rows[$i]['name'] = LEVEL_2;
    }
    else if($rows[$i][1] == 'level_3'){
        $rows[$i]['name'] = LEVEL_3;
    }
    else if($rows[$i][1] == 'level_4'){
        $rows[$i]['name'] = LEVEL_4;
    }
    else if($rows[$i][1] == 'level_5'){
        $rows[$i]['name'] = LEVEL_5;
    }
}
 
//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['TotalRecordCount'] = $recordCount;
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);

