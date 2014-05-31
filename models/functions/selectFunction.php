<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/GradProject/models/db_connect.php';
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
/*
 * @function: getValue
 * @return: value
 */
function getValue($columns, $tableName, $conditions = '1 = 1'){
    $query =   "SELECT ".$columns."
                FROM ".$tableName."
                WHERE ".$conditions." AND active = 'A'";
    $result =  mysql_query($query);
    $row = mysql_fetch_array($result);
    return $row[0];
}
/*
 * @function: getRow
 * @return: array
 */
function getRow($columns, $tableName, $conditions = '1 = 1'){
    $query =   "SELECT ".$columns."
                FROM ".$tableName."
                WHERE ".$conditions." AND active = 'A'";
    $result =  mysql_query($query);
    while($row = mysql_fetch_row($result)) {
        return $row;
    }
    //return mysql_fetch_array($result);
}
/*
 * @function: getData
 * @return: array
 */
function getData($columns, $tableName, $conditions = '1 = 1'){
    $query =   "SELECT ".$columns."
                FROM ".$tableName."
                WHERE ".$conditions." AND active = 'A'";
    echo $query;
    $result =  mysql_query($query);
    $resultArray = array();
    while ($res =  mysql_fetch_array($result)){
        array_push($resultArray,$res);
    } return $resultArray;
}

function do_offset($level){
    $offset = "";             // offset for subarry 
    for ($i=1; $i<$level;$i++){
    $offset = $offset . "<td></td>";
    }
    return $offset;
}

function show_array($array, $level, $sub){
    if (is_array($array) == 1){          // check if input is an array
       foreach($array as $key_val => $value) {
           $offset = "";
           if (is_array($value) == 1){   // array is multidimensional
           echo "<tr>";
           $offset = do_offset($level);
           echo $offset . "<td style='background-color:blue'>" . $key_val . "</td>";
           show_array($value, $level+1, 1);
           }
           else{                        // (sub)array is not multidim
           if ($sub != 1){          // first entry for subarray
               echo "<tr nosub>";
               $offset = do_offset($level);
           }
           $sub = 0;
           echo $offset . "<td main ".$sub." width=\"120\">" . $key_val . 
               "</td><td width=\"120\">" . $value . "</td>"; 
           echo "</tr>\n";
           }
       } //foreach $array
    }  
    else{ // argument $array is not an array
        return;
    }
}

function html_show_array($array){
  echo "<table cellspacing=\"0\" border=\"2\">\n";
  show_array($array, 1, 0);
  echo "</table>\n";
}

/**
 * Translate a result array into a HTML table
 *
 * @author      Aidan Lister <aidan@php.net>
 * @version     1.3.2
 * @link        http://aidanlister.com/2004/04/converting-arrays-to-human-readable-tables/
 * @param       array  $array      The result (numericaly keyed, associative inner) array.
 * @param       bool   $recursive  Recursively generate tables for multi-dimensional arrays
 * @param       string $null       String to output for blank cells
 */
function array2table($array, $recursive = false, $null = '&nbsp;')
{
    // Sanity check
    if (empty($array) || !is_array($array)) {
        return false;
    }
 
    if (!isset($array[0]) || !is_array($array[0])) {
        $array = array($array);
    }
 
    // Start the table
    $table = "<table>\n";
 
    // The header
    $table .= "\t<tr>";
    // Take the keys from the first row as the headings
    foreach (array_keys($array[0]) as $heading) {
        $table .= '<th>' . $heading . '</th>';
    }
    $table .= "</tr>\n";
 
    // The body
    foreach ($array as $row) {
        $table .= "\t<tr>" ;
        foreach ($row as $cell) {
            $table .= '<td>';
 
            // Cast objects
            if (is_object($cell)) { $cell = (array) $cell; }
             
            if ($recursive === true && is_array($cell) && !empty($cell)) {
                // Recursive mode
                $table .= "\n" . array2table($cell, true, true) . "\n";
            } else {
                $table .= (strlen($cell) > 0) ?
                    htmlspecialchars((string) $cell) :
                    $null;
            }
 
            $table .= '</td>';
        }
 
        $table .= "</tr>\n";
    }
 
    $table .= '</table>';
    return $table;
}