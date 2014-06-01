<?php
include_once '../db_connect.php';

$sorting = 'id ASC';                        // Assigning a default sorting order.
if(isset($_GET['jtSorting'])){
    $sorting = $_GET['jtSorting'];             // Changing sort order according to what the user has selected.
}

//Get the records from database
$query2 = "SELECT course.id,
            course.name_ar,
            course_type.name_ar AS ct_name,
            course.req_course_id,
            course.course_level,
            course.credits,            
            course1.name_ar AS req_course
          FROM course_type
            INNER JOIN course ON course.course_type_id = course_type.id
            INNER JOIN sugg_course ON course.id = sugg_course.course_id AND
              sugg_course.semester_id = (SELECT Max(semester.id) FROM semester)
            LEFT JOIN course course1 ON course.req_course_id = course1.id ";
$query2.= "ORDER BY $sorting";

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
//$jTableResult['TotalRecordCount'] = $recordCount;
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);