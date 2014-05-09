<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
/*
 * @function: select
 * @return: array
 */
$resultA =array();
$columns = 'COURSE_ID';
$tableName = 'sugg_course';
$query =   "SELECT ".$columns."
            FROM ".$tableName;
$result =  mysql_query($query);
while ($result2 = mysql_fetch_array($result)){
    array_push($resultA, $result2);
}
echo json_encode($resultA);