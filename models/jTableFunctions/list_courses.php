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
    else if($searchId == 2){
        $query1.= " WHERE course_type_id LIKE '$searchText%'";
    }
    else if($searchId == 3){
        $query1.= " WHERE level LIKE '$searchText%'";
    }
    else if($searchId == 4){
        $query1.= " WHERE credits LIKE '$searchText%'";
    }    
}

$result1 = mysql_query($query1);            // Executing the query.
$row = mysql_fetch_array($result1);         // Fetching the result.
$recordCount = $row['RecordCount'];         // Filling the result in an variable.

$sorting = 'id ASC';                        // Assigning a default sorting order.

if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];             // Changing sort order according to what the user has selected.
}

//Get the records from database
$query2 = "SELECT c.*, course_type.name_ar as ct_name, course1.name_ar AS req_name ";
$query2.= "FROM course as c ";
$query2.= "INNER JOIN course_type ON c.course_type_id = course_type.id ";
$query2.= "LEFT JOIN course course1 ON c.req_course_id = course1.id ";
$query2.= "WHERE c.active='A' ";

if(isset($_POST['searchText']) && !empty($_POST['searchText'])){
    $searchText = $_POST['searchText'];
    $searchId = $_POST['searchId'];
    
    if($searchId == 0){                                         // Modifying the query according to the search text.
        $query1.= " WHERE id LIKE '$searchText%'";
    }
    else if($searchId == 1){
        $query1.= " WHERE name_ar LIKE '$searchText%'";
    }    
    else if($searchId == 2){
        $query1.= " WHERE course_type_id LIKE '$searchText%'";
    }
    else if($searchId == 3){
        $query1.= " WHERE level LIKE '$searchText%'";
    }
    else if($searchId == 4){
        $query1.= " WHERE credits LIKE '$searchText%'";
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
for ($i=0 ; $i<count($rows) ; $i++){
    $courseCode = $rows[$i]['id'];
    $query3 = "SELECT count(id) AS count FROM student_suggest WHERE course_id = '$courseCode'";
    $result3 = mysql_query($query3);
    $rows[$i]['wanting_num'] = mysql_result($result3, 0, 'count');
}

//print_r($rows);exit;
//Return results to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['TotalRecordCount'] = $recordCount;
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);
?>