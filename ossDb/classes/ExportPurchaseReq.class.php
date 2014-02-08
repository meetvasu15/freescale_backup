<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExportPurchaseReq
 *
 * @author b45802
 */
require_once 'classes/ReadExcel.class.php';
require_once 'classes/SingletonDb.class.php';
require_once 'classes/Constants.php';
require_once 'classes/sheetDbColumnMapping.php';

class ExportPurchaseReq {

    var $objPHPExcel;
    var $activeSheetIndexCount = 0;
    var $mysqli;

    function ExportPurchaseReq() {
        $this->objPHPExcel = new PHPExcel();
        $db = SingletonDb::getInstance();
        $this->mysqli = $db->getOssDbConnection();
    }

    function createExcelFile() {
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="OSS Purchase Requisition.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }

    function exportPurchaseReqExcel() {
        //$this->objPHPExcel->setActiveSheetIndex($this->activeSheetIndexCount);
        $allYearArray = $this->getAllPurchaseYears();
        $allYearCount = count($allYearArray);
        
       // echo print_r($allYearArray);
       //  echo $allYearCount;
        for ($i = 0; $i < $allYearCount; $i++) {
            //echo "year".$allYearArray[$i]."<br>";
           // if($i!=0){
                 $this->objPHPExcel->createSheet($i);
                 $this->objPHPExcel->setActiveSheetIndex($i);
           // }
            $this->createExcelDataObj($allYearArray[$i]);
          //  $this->activeSheetIndexCount = $this->activeSheetIndexCount + 1;
        } 
      //  return;
        $this->createExcelFile();
    }

    function createExcelDataObj($year) {
        $getTableDataSqlQuery = "SELECT * FROM seaweb_oss_db.purchase_requisition WHERE year=" . $year;
        $allReqSqlResult = $this->mysqli->query($getTableDataSqlQuery);
        // $allRows = array();
        $colNum = 'A';
        $rowNum = 1;
        $purchaseTableHeader = $GLOBALS["purchaseReqHeader"];
        $sheetDBColMap = $GLOBALS['requisitionSheetDBColMap'];
        $header = array_keys($sheetDBColMap);
        $dbHeader = array_values($sheetDBColMap);
        //  echo print_r($purchaseTableHeader)."<br>";
        $objWorksheet = $this->objPHPExcel->getActiveSheet();
        foreach ($header as $oneColHeadVal) {
            // echo $oneColHeadVal."<br>";
            $objWorksheet->setCellValue($colNum . $rowNum, $oneColHeadVal);
            $colNum++;
        }
        $colNum = 'A';
        $rowNum++;
        while ($oneRow = mysqli_fetch_array($allReqSqlResult)) {
            foreach ($dbHeader as $oneCol) {
                $cellValue=$oneRow[$oneCol];
                if($oneCol === "date_approved"){
                    if($cellValue !== "0000-00-00"){ 
                        PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
                    }  else {
                         $cellValue="";
                    } 
                }
                $objWorksheet->setCellValue($colNum . $rowNum,$cellValue);
                   if($oneCol === "date_approved"){
                        //echo "col :".$colNum."row :".$rowNum."<br>";
                         if($cellValue !== ""){ 
                       $objWorksheet->getStyle($colNum . $rowNum)
                                    ->getNumberFormat()
                                    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
                         }
                }
                $colNum++;
            }
            $colNum = 'A';
            $rowNum++;
        }
        $objWorksheet->setTitle($year);
    }

    function getAllPurchaseYears() {
        $allPurchasesYearArray = array();
        $getAllYearSqlQuery = "SELECT DISTINCT year FROM seaweb_oss_db.purchase_requisition";
        $allYearSqlResult = $this->mysqli->query($getAllYearSqlQuery);
        while ($oneRow = mysqli_fetch_array($allYearSqlResult)) {
            $year = $oneRow['year'];
            if (isset($year) && $year != "")
                $allPurchasesYearArray[] = $year; 
        }
        return $allPurchasesYearArray;
    }

}

?>
