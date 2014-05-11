<?php
include_once '../core.php';
include_once './databaseClass.php';

function dbInsert($tableName, $columns = array(), $values = array()){
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
    
    print_r($query);exit;
    mysql_query($query);                 // Executing the query

    $result = array();
    $result['Result'] = "Sucess";
    return $result;
}

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
    
    print_r($query);exit;
    mysql_query($query);                 // Executing the query

    $result = array();
    $result['Result'] = "Sucess";
    return $result;
}

