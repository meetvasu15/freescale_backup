<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of updateAPVData
 *
 * @author B45802
 */
require_once 'includes/global.inc.php';
require_once 'includes/sheetDbColumnMapping.php';
require_once 'classes/ReadExcel.class.php';

class updateAPVData {

    var $filename;
    var $sheetName;
    private $mysqli;

    function updateAPVData($_filename, $_sheetname) {
        $this->filename = $_filename;
        $this->sheetName = $_sheetname;
        $db = SingletonDb::getInstance();
        $this->mysqli = $db->getConnection();
    }

    function apvResourceUpdate() {
        try {
            $readExcelObj = new ReadExcel();
            $objWorksheet = $readExcelObj->ReadExcelSheet($this->filename, $this->sheetName);
            $columnArray = array();
            $dateColumnArray = array();
            $dateInsertQueryColArr = array('system_id', 'apv_month', 'resource_value');
            $allValuesArray = array();
            $allSystemIdStr = "(";
            $allDateValuesArray = array();
            $numAt = array(0);
            $sheetDBColMap = $GLOBALS['sheetDBColMap'];
            //  $nextInsertID = $this->generateNextSystemId();
            //$columnArray[]= $sheetDBColMap["System ID"];
            //$date = new DateTime();
            //echo "<br> memory usage before for loop". memory_get_usage() ." <br>";
            //echo "::::::::::::before for loop::::::::".$date->getTimestamp()."<br>"; 
            foreach ($objWorksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells
                // its the header row
                if ($row->getRowIndex() <= 1) {
                    // create the columns string 

                    foreach ($cellIterator as $key => $cell) {
                        //auto pv data coulmn loop includes date
                        if ($key < 10) {
                            if (!$cell->getValue()) {
                                $colNum = $key;
                                throw new Exception("Column number " . ++$colNum . " doesn't have a header");
                            }
                            if ($key == 0 && $cell->getValue() != 'System ID') {
                                //   echo $cell->getValue();
                                throw new Exception("First column for updating values should be 'System ID'");
                            }

                            $columnArray[] = $sheetDBColMap[$cell->getValue()];
                        } else {
                            // array_push($dateColumnArray,PHPExcel_Shared_Date::ExcelToPHP($cell->getValue()));  
                            //  $idx = $key;
                            $datetime = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($cell->getValue()));
                            $dateColumnArray[$key] = $datetime;
                            // $sql = "INSERT INTO autopvmonthlyvalue (system_id,apv_month) values  (1, '".$datetime."')";
                            // mysql_query( $sql) or die(mysql_error());
                        }
                    }
                    //   echo "<br> memory usage exiting if stmnt". memory_get_usage() ." <br>";
                    // $batchInsertapvDataSql =   $this->createInsertSql('autoPVData', $coulmnArray); 
                } else {
                    // its a data row  
                    $apvDataArray = array();
                    //    array_push($apvDataArray,  $nextInsertID); 
                    foreach ($cellIterator as $key => $cell) {
                        if ($key < 10) {

                            $apvDataArray[] = $cell->getValue();
                        } else {
                            //  its a date data row
                            $value = $cell->getValue();
                            if (!empty($value) && isset($value)) {

                                $allDateValuesArray[] = "( " . $apvDataArray[0] . " , '" . $dateColumnArray[$key] . "' , " . $value . " ) ";
                            }
                        }
                    }

                    $allSystemIdStr = $allSystemIdStr . $apvDataArray[0] . " ,";
                    $allValuesArray = $this->createAllValArr($allValuesArray, $apvDataArray, $numAt);
                }
            }
             //echo $allSystemIdStr;
            $allSystemIdStr = substr($allSystemIdStr, 0, -1) . ")";
            unset($objWorksheet);
            //$date = new DateTime();
            // echo "memory usage after for loop". memory_get_usage() ." <br>";
            //echo "::::::::::::after for loop::::::::".$date->getTimestamp()."<br>"; 
            $batchInsertapvDataSql = $this->createInsertSql('autoPVData', $columnArray, $allValuesArray);
            //  echo "Delete from autopvdata where system_id in".$allSystemIdStr;
           // echo $allSystemIdStr;
             if($allSystemIdStr != ")"){
            $this->mysqli->query("Delete from autoPVData where system_id in" . $allSystemIdStr) or die(mysqli_error($this->mysqli));
            $this->mysqli->query("Delete from autoPVMonthlyValue where system_id in" . $allSystemIdStr) or die(mysqli_error($this->mysqli));
             }
       // echo $batchInsertapvDataSql;
            $this->mysqli->query($batchInsertapvDataSql) or die(mysqli_error($this->mysqli));
          //    echo $batchInsertapvDataSql;
            unset($batchInsertapvDataSql);
            $batchInsertDateValSql = $this->createInsertSql('autoPVMonthlyValue', $dateInsertQueryColArr, $allDateValuesArray);
            $this->mysqli->query($batchInsertDateValSql) or die(mysqli_error($this->mysqli));
         //    echo $batchInsertDateValSql;
            unset($batchInsertDateValSql);

            // $date = new DateTime();
            //echo "::::::::::::after  queries::::::::".$date->getTimestamp()."<br>"; 
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            throw new Exception("<br>ERROR: FAILED UPLOAD<br>");
        }
    }

    function createAllValArr($allValuesArray, $valueArray, $numAt) {

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
        array_push($allValuesArray, $valueStr);
        return $allValuesArray;
    }

    function createInsertSql($tableName, $columnArray, $allValuesArray) {

        //echo \print_r($allValuesArray);
        $sqlStmnt = "INSERT INTO " . $tableName . " ( "; // creating inser statement 
        $columnStr = implode(" , ", $columnArray); // creating coulmn string
        $valueStr = implode(" , ", $allValuesArray);
        $sqlStmnt = $sqlStmnt . $columnStr . " ) VALUES " . $valueStr; // joining everything together
        return $sqlStmnt;
    }

}

?>
