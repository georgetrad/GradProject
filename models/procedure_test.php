<?php

include_once './db_connect.php';

$query = "CALL courses_available_to_student('20810268');";
$result = mysql_query($query);

$rows = array();
while($row = mysql_fetch_array($result))
{
    $rows[] = $row;
}
print_r($rows[0]);exit;


?>