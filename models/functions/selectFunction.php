<?php
include $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
/*
 * @function: select
 * @return: array
 */
function select($columns = '*', $tableName, $conditions = '1 = 1'){
    $query =   "SELECT ".$columns."
                FROM ".$tableName."
                WHERE ".$conditions." AND active = 'A'";
    $result =  mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        return $row;
    }
    //return mysql_fetch_array($result);
}