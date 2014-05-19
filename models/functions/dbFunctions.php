<?php
include_once '../core.php';
include_once '../db_connect.php';
/**
 * This dbInsert functions receives all the necessary data and it executes the query on its own.
 * @author George Trad
 * @category Database
 * @version 0.3
 * 
 * @param String $tableName The name of the table you want to insert into
 * @param String Array $columns This array contains the columns you want to insert into.
 * @param String Array $values This array contains the values you want to insert.
 * @param boolean $isDuplicate This parameter defines if you want to update values on key duplicate
 * @param type $uColumns This array contains the columns you want to update in case you set isDublicate to true. 
 * @param type $uValues This array contains the values you want to update in case you set isDublicate to true.
 * @return string
 */

function dbInsert($tableName, $columns = array(), $values = array(), $isDuplicate=false, $uColumns='', $uValues=''){
    if($isDuplicate){
        $query = "INSERT INTO $tableName ";
        $query.= "(";
        for ($i=0 ; $i<count($columns) ; $i++){
            $query.= $columns[$i];
            if(count($columns)>1 && $i<(count($columns)-1)){
                $query.= ", ";
            }
        }
        $query.= ") ";

        $query.= "VALUES ";
        $query.= "( ";
        for ($i=0 ; $i<count($values) ; $i++){
            $query.= $values[$i];
            if(count($values)>1 && $i<(count($values)-1)){
                $query.= ", ";
            }
        }
        $query.= ") ";
        
        $query.= "ON DUPLICATE KEY UPDATE ";
        for ($i=0 ; $i<count($uColumns) ; $i++){
            $query.= $uColumns[$i]." = ".$uValues[$i];
            if(count($uColumns)>1 && $i<(count($uColumns)-1)){
                $query.= ", ";
            }
        }
    }
    else if($isDuplicate == false){
        $query = "INSERT INTO $tableName ";
        $query.= "(";
        for ($i=0 ; $i<count($columns) ; $i++){
            $query.= $columns[$i];
            if(count($columns)>1 && $i<(count($columns)-1)){
                $query.= ", ";
            }
        }
        $query.= ") ";

        $query.= "VALUES ";
        $query.= "( ";
        for ($i=0 ; $i<count($values) ; $i++){
            $query.= $values[$i];
            if(count($values)>1 && $i<(count($values)-1)){
                $query.= ", ";
            }
        }
        $query.= ") ";
    }
    //print_r($query);exit;
    mysql_query($query);                 // Executing the query
    $result = array();
    $result['Result'] = "Sucess";
    return $result;
}

/**
 * This dbUpdate functions receives all the necessary data and it executes the query on its own.
 * @author George Trad
 * @category Database
 * @version 0.1
 * 
 * @param String $tableName The name of the table you want to insert into
 * @param Array $columns This array contains the columns you want to insert into.
 * @param Array $values This array contains the values you want to insert.
 * @param String $condition The WHERE condition.
 * @return string
 */

function dbUpdate($tableName, $columns = array(), $values = array(), $condition = '1 = 1'){
    $query = "UPDATE $tableName ";
    $query.= "SET ";
    for ($i=0 ; $i<count($columns) ; $i++){
        $query.= $columns[$i]." = ".$values[$i];
        if(count($columns)>1 && $i<(count($columns)-1)){
            $query.= ", ";
        }
    }    
    $query.= " WHERE $condition";
    mysql_query($query);                 // Executing the query
    
    $result = array();
    $result['Result'] = "Sucess";
    return $result;
}