<?php

/**
 * Description of APVDataIngestion
 *
 * @author B45802
 */
require_once 'classes/SingletonDb.class.php';
//require_once 'classes/ReadExcel.class.php';
require('lib/PHPExcel.php');
require_once 'classes/sheetDbColumnMapping.php';

class PurchaseRequisitionIngestion {

    var $filename;
    var $sheetName;
    private $mysqli;

    function purchaseRequisitionIngestion($_filename) {
        $this->filename = $_filename;
        // $this->sheetName = $_sheetname;
        $db = SingletonDb::getInstance();
        $this->mysqli = $db->getOssDbConnection(); 
    }

    function saveUpdatePurchases() {
        try {
            
        
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
           //  echo "yep 1 ::";
            $objReader->setReadDataOnly(true);
            //echo "yep 2 ::".$this->filename;
             $objPHPExcel = $objReader->load($this->filename);
            //echo "yep3 ::";
            //$readExcelObj = new ReadExcel();
            //iterate over all sheets
            $activeSheetIndex = 0;
            $sheetCount = $objPHPExcel->getSheetCount();
       
            for  ($k = 0; $k< $sheetCount; $k++) {
               // echo $activeSheetIndex."<br>";
                $objPHPExcel->setActiveSheetIndex($activeSheetIndex);
                $year = $objPHPExcel->getActiveSheet()->getTitle();
                //    echo $year."<br>";
                $objWorksheet = $objPHPExcel->getActiveSheet();
                $columnArray = array();
//            $dateColumnArray = array(); 
//            $insertQueryColArr = array('system_id' , 'pr_number' , 'pr_line' , 'po_number'  ,
//                                        'gl_account' ,'cost_center' ,'requestor' ,'budget_line_item' ,
//                                        'vendor' ,'description' ,'status' ,'amount' ,'year' ,'currency' ,'date_approved' );
                $allValuesArray = array();
                $numAt = array(0,  2, 3, 4,5, 12);
                $sheetDBColMap = $GLOBALS['requisitionSheetDBColMap'];
                $nextInsertID = $this->generateNextSystemId();
                // $columnArray[] = $sheetDBColMap["System ID"];
                $isFirstRow = TRUE;
                $deleteSql = "DELETE FROM purchase_requisition WHERE system_id IN (";
                $deleteAnything = FALSE;
                foreach ($objWorksheet->getRowIterator() as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells
                    // its the header row
                    if ($isFirstRow) {
                        // create the columns string 

                        foreach ($cellIterator as $key => $cell) {
                            //auto pv data coulmn loop includes date 
                            if (!$cell->getValue()) {
                                $colNum = $key;
                                throw new Exception("Column number " . ++$colNum . " doesn't have a header");
                            }
                            $columnArray[] = $sheetDBColMap[$cell->getValue()];
                        }
                        $columnArray[] = "year";
                        $isFirstRow = FALSE;
                        //   echo "<br> memory usage exiting if stmnt". memory_get_usage() ." <br>";
                        // $batchInsertapvDataSql =   $this->createInsertSql('autoPVData', $coulmnArray); 
                    } else {
                        // its a data row  
                        $purchaseDataArray = array();
                        //array_push($apvDataArray,  $nextInsertID); 
                        foreach ($cellIterator as $key => $cell) {
                            $value = $cell->getValue();
                            if ($key != 16) {
                                // echo "<br>".$key."value ".$value."<br>"; 
                                if ($key == 0 && (empty($value) || !isset($value) || $value == "")) {
                                    $purchaseDataArray[] = $nextInsertID;
                                    $nextInsertID = $nextInsertID + 1;
                                    //echo $nextInsertID."<br>";
                                } 
                                else if ($key == 0){
                                    if(!$deleteAnything){
                                        $deleteSql = $deleteSql.$cell->getValue();
                                    }else{
                                        $deleteSql = $deleteSql.", ".$cell->getValue();
                                    }
                                    $deleteAnything = TRUE; 
                                    $purchaseDataArray[] = $cell->getValue();
                                }
                                else {
                                    $purchaseDataArray[] = $cell->getValue();
                                }
                            } else {
                                //  its a date data row 
                                if (!empty($value) && isset($value)) {
                                    try {
                                        $datetime = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($cell->getValue()));
                                        $purchaseDataArray[] = $datetime;
                                    } catch (Exception $e) {
                                        $purchaseDataArray[] = "";
                                    }
                                } else {
                                    $purchaseDataArray[] = "";
                                }
                            }
                        }
                        $purchaseDataArray[] = $year;
                        $allValuesArray = $this->createAllValArr($allValuesArray, $purchaseDataArray, $numAt);
                    }
                }

                //$date = new DateTime();
                // echo "memory usage after for loop". memory_get_usage() ." <br>";
                //echo "::::::::::::after for loop::::::::".$date->getTimestamp()."<br>";
                if($deleteAnything){
                    $deleteSql = $deleteSql." )";
                 //   echo $deleteSql;
                     $this->mysqli->query($deleteSql) or die(mysqli_error($this->mysqli));
                }
                $batchInsertPurchaseDataSql = $this->createInsertSql('purchase_requisition', $columnArray, $allValuesArray);
              //   echo $batchInsertPurchaseDataSql;
                $this->mysqli->query($batchInsertPurchaseDataSql) or die(mysqli_error($this->mysqli));
                // unset($batchInsertapvDataSql);
                $activeSheetIndex++;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
        header("Location: /ossdb");
    }

    function generateNextSystemId() {
        $largestIDResult = $this->mysqli->query('select max(system_id) from purchase_requisition');
        if ($largestIDResult && mysqli_num_rows($largestIDResult) == 1) {
            $largestID = mysqli_fetch_row($largestIDResult);
            // echo $largestID[0];
            return $largestID[0] + 1;
        } else {
            return 1;
        }
    }

    function createAllValArr($allValuesArray, $valueArray, $numAt) {

        foreach ($valueArray as $key => &$val) {

            if (!in_array($key, $numAt)) {

                $val = addslashes($val);
                $val = "'" . $val . "'";
            }
            if ((!isset($val) || $val == "" || empty($val)) && in_array($key, $numAt)) {
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
