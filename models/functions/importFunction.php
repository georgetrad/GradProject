<?php
function import($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData = array())
{
/*
 * configurations 
 */
    
//    $inputFileName = '../gdb.xls';
//        $columns = array(
//        "student_id"            => "A",
//        "student_first_name"    => "B",
//        "student_middle_name"   => "C",
//        "student_last_name"     => "D"    
//    );
//    $staticData = array(
//        "status"                => "A",
//        "address"               => "---"
//    );
//    $tableName = 'student';
//    $rows = 1000;
//    $rowsOffSet = 5500;

    /*
     * working
     */
    $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    $highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();

    $data = array();

    $columnName = array_keys($columns);
    
    $sdk = array_keys($staticData);
    foreach ($sdk as $value){
        array_push($columnName, $value);
    }
    
    $sr = array();
    $sdv = array_values($staticData);
    foreach ($sdv as $value){
        array_push($sr, $value);
    }
    $nsr = implode ('", "', $sr);
    
    $columnIndex = array_values($columns);

    $columnsNames = implode (', ', $columnName);
    
    $allValues = array();
    $aValues = array();
    for ($i=$rowsOffSet;$i<$rowsOffSet+$rows and $i<=$highestRow;$i++){
        $records_string = array();
        foreach ($columnIndex as $data){
            $record_string = $objPHPExcel->getActiveSheet()->getCell($data.$i)->getValue();
            array_push($records_string,$record_string);
        }
        
        $values = '"'.implode ('", "', $records_string);
        
        if ($nsr!='')
            $values .= '", "'.$nsr;
        $values .= '"';
        
        array_push($aValues,$values);
        $allValues = array_unique($aValues);
    }

    $sql = "INSERT INTO ".$tableName;
    $sql.= "(".$columnsNames.")";
    $added=0;
    $duplicated=0;
    foreach ($allValues as $value){
        $sqlValues = " VALUES(".$value.");";
//        echo $sql.$sqlValues.'<br>';
        $result = mysql_query($sql.$sqlValues);
        
        if($result){
            $added++;
//                echo '<p><b>YOU HAVE INSERTED YOUR DATA SUCCESSFULY.</b></p>';
        }
        else{
            $duplicated++;
//                echo '<p>You could not insert your data due to a system error!.</p>';
        }
    }     
    $rValue = array ("Rows have been added"=>$added,"Rows that are duplicated"=>$duplicated,"SQL is:"=>$sql.$sqlValues);
    return $rValue;
}