<?php
include_once '../db_connect.php';
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/core.php';

// Get records count
$query1 = "SELECT count(student.id) AS RecordCount ";
$query1.= "FROM user ";                                               
$query1.= "INNER JOIN teacher ON teacher.user_username = user.username ";
$query1.= "INNER JOIN student ON student.advisor_id = teacher.id ";       
$query1.= "INNER JOIN department ON department.id = student.department_id ";
$query1.= "AND teacher.user_username = '".$_SESSION['username']."' AND student.status = 'A' ";

if(isset($_POST['searchText']) && !empty($_POST['searchText'])){
    $searchText = $_POST['searchText'];
    $searchId = $_POST['searchId'];
    
    if($searchId == 1){                                         // Modifying the query according to the search text.
        $query1.= " AND CONCAT(student.first_name, ' ', student.middle_name, ' ', student.last_name) LIKE '%$searchText%'";
    }
    else if($searchId == 2){
        $query1.= " AND student.id LIKE '$searchText%'";
    }     
}
$result1 = mysql_query($query1);            // Executing the query.
$row = mysql_fetch_array($result1);         // Fetching the result.
$recordCount = $row['RecordCount'];         // Filling the result in an variable.


$pageSize = $_GET['jtPageSize'];            // Getting the selected page size, start index from jTable
$startIndex = $_GET['jtStartIndex'];
$sorting = 'student.id ASC';                        // Assigning a default sorting order.

if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];           // Changing sort order according to what the user has selected.  
}

$query2 = "SELECT student.id, student.current_level AS level, student.tot_hours_completed AS hrs, ";
$query2.= "CONCAT (student.first_name, ' ', student.middle_name, ' ', student.last_name) as name, department.name_ar as dep_name ";        
$query2.= "FROM user ";                                               
$query2.= "INNER JOIN teacher ON teacher.user_username = user.username ";
$query2.= "INNER JOIN student ON student.advisor_id = teacher.id ";       
$query2.= "INNER JOIN department ON department.id = student.department_id ";
$query2.= "AND teacher.user_username = '".$_SESSION['username']."' AND student.status = 'A' ";

if(isset($_POST['searchText']) && !empty($_POST['searchText'])){            // Modifying the query according to the search text.
    $searchText = $_POST['searchText'];
    $searchId = $_POST['searchId'];
    
    if($searchId == 1){
        $query2.= " AND (student.first_name LIKE '%$searchText%' OR student.middle_name LIKE '%$searchText%' OR student.last_name LIKE '%$searchText%') ";
    }
    else if($searchId == 2){
        $query2.= " AND student..id LIKE '$searchText%'";
    }     
}
$query2.= " ORDER BY $sorting LIMIT $startIndex, $pageSize";
$result2 = mysql_query($query2);
//print_r($query2);exit;
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

