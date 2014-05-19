<?php
function importSC($inputFileName, $columns, $tableName, $rows, $rowsOffSet, $staticData = array())
{
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
    
    unset($columnName[0]);
    $duplicate = array();
    foreach ($columnName as $c){
        $x = $c." = VALUES(".$c.")";
        array_push($duplicate,$x);
    }
    
    $sDuplicate = '';
    $sDuplicate .= implode(', ',$duplicate);

    $sqlValues = " VALUES(";
    $sqlValues .= implode('), (',$allValues);
    $sqlValues .= ")";
//    $sqlValues .= "ON DUPLICATE KEY UPDATE ".$sDuplicate.";";
    
    $result = mysql_query($sql.$sqlValues);
    return $result ? '<br>'.$result : '<br>'.$sql.$sqlValues;
}