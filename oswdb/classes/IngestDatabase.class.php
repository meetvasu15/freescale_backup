<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IngestDatabase
 *
 * @author B45802
 */
require_once 'classes/ReadExcel.class.php';
require_once 'classes/Constants.php';
require_once 'classes/SingletonDb.class.php';
require_once 'classes/SqlHelper.php';

class IngestDatabase {

    //put your code here 
    var $fileName;
    var  $allValuesArray = array();
    function IngestDatabase($_filename) {
        $this->fileName = $_filename;
    }

    function deleteAllData($tableName) {
        $delDataSql = "DELETE FROM OSWDM." . $tableName;
      // $delDataSql = "DELETE FROM " . $tableName;
        oswQuery($delDataSql);
    }

    function ingestWorkbook() {
        $readExcelObj = new ReadExcel();
        $numAtArr = $GLOBALS['numAtArr'];
        $allTableNames = $GLOBALS['allTableNames'];
        $allTables = $GLOBALS['allTables'];
        foreach ($allTableNames as $oneSheet) { 
            $this->deleteAllData($oneSheet);
          //  $allValuesArray = array();
            $objWorksheet = $readExcelObj->ReadExcelSheet($this->fileName, $oneSheet); 
            foreach ($objWorksheet->getRowIterator() as $row) {
                $oneRow = array();
                if ($row->getRowIndex() != 1) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells
                    foreach ($cellIterator as $cell) { 
                            $oneRow[] = $cell->getValue(); 
                    }
                    $this->createAllValArr(  $oneRow, $numAtArr[$oneSheet]);
                }
               // echo "one row".print_r($oneRow)."<br>";
                
            //echo  "all val Arr". print_r( $this->allValuesArray );
            } 
          // $insertQuery =  $this->createInsertSql("OSWDM.".$oneSheet, $allTables[$oneSheet]);
           $insertQuery =  $this->createInsertSql( $oneSheet, $allTables[$oneSheet]);
           //echo $insertQuery."<br><br><br><br>";
           if ($insertQuery !="INSERT ALL SELECT * FROM dual"){
            oswQuery($insertQuery);
           }
           
                $this->allValuesArray = array();
        }
    }

    function createInsertSql($tableName, $columnArray) {
         $sqlStmnt = "INSERT ALL ";
         $columnStr = " INTO ".$tableName." ( " .implode(" , ", $columnArray)." ) VALUES "; // creating coulmn string
        //echo \print_r($allValuesArray);
        foreach ($this->allValuesArray as $oneRow){
            $sqlStmnt=$sqlStmnt.$columnStr.$oneRow;
        }
        $sqlStmnt = $sqlStmnt."SELECT * FROM dual"; // creating inser statement 
       
//        $valueStr = implode(" , ",  $this->allValuesArray );
//        $sqlStmnt = $sqlStmnt . $columnStr . " ) VALUES " . $valueStr." ;"; // joining everything together
        return $sqlStmnt;
    }

    function createAllValArr( $valueArray, $numAt) {

        foreach ($valueArray as $key => &$val) {

            if (!in_array($key, $numAt)) {

                $val = addslashes($val);
                $val = "'" . $val . "'";
            }
            if (!isset($val) && in_array($key, $numAt)) {
                $val = 0;
            }
        }
        $valueStr = implode(" , ", $valueArray); // creating value string 
        $valueStr = " ( " . $valueStr . " ) ";
        $this->allValuesArray[]= $valueStr;
       // return $allValuesArray;
    }

   

}

?>
