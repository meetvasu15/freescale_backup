<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExportDatabase
 *
 * @author B45802
 */
require_once 'classes/ReadExcel.class.php';
require_once 'classes/Constants.php';
require_once 'classes/SingletonDb.class.php';
require_once 'classes/SqlHelper.php';

class ExportDatabase {

    var $objPHPExcel;
    var $activeSheetIndexCount = 0;

    function ExportDatabase() {
        $this->objPHPExcel = new PHPExcel();
    }

    function exportDbExcelSheet() {
        $allTableNames = $GLOBALS['allTableNames'];
        $allTables = $GLOBALS['allTables'];
       // echo "1<br>";
        foreach ($allTableNames as $oneTable) {
         //   echo $oneTable."   1<br>";
            $this->objPHPExcel->setActiveSheetIndex($this->activeSheetIndexCount);
         //   echo $oneTable."   2<br>";
            $this->createExcelSheet($oneTable, $allTables[$oneTable]);
            $this->activeSheetIndexCount++;
         //   echo $oneTable."   3<br>";
            $this->objPHPExcel->createSheet();
         //   echo $oneTable."   4<br>";
        }
// return;
         $this->createExcel();
    }

    function createExcelSheet($tableName, $tableDbHeadArr) {
        $getTableDataSqlQuery = "SELECT * FROM OSWDM." . $tableName;
      //  $getTableDataSqlQuery = "SELECT * FROM " . $tableName;
        // echo $getTableDataSqlQuery."<br>";
        $sqlResult = oswQuery($getTableDataSqlQuery);
        //$allRows = array();
        $colNum = 'A';
        $rowNum = 1;
     //   print_r($GLOBALS[$tableName]);
        foreach ($GLOBALS[$tableName] as $oneColHeadVal){
             $this->objPHPExcel->getActiveSheet()->setCellValue($colNum . $rowNum, $oneColHeadVal);
             $colNum++;
        }
         $colNum = 'A';
            $rowNum++;
         //    echo "here:::: ".print_r($sqlResult)."<br>";
        while ($oneSqlRow = oci_fetch_array($sqlResult, OCI_ASSOC)) {
            //  $oneRow = array();
          //  echo print_r($oneSqlRow);
            foreach ($tableDbHeadArr as $oneCol) { 
                $this->objPHPExcel->getActiveSheet()->setCellValue($colNum . $rowNum, $oneSqlRow[$oneCol]);
                $colNum++;
                // $oneRow[$oneCol] = $oneSqlRow[$tableHeadArr];
            }
            $colNum = 'A';
            $rowNum++;
            // $allRows[] = $oneRow;
        }
        $this->objPHPExcel->getActiveSheet()->setTitle($tableName);
        //return $allRows;
    }

    function createExcel() {
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="OSW Database.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }

    function getRawData($tableName, $tableHeadArr) {
        //$getTableDataSqlQuery = "SELECT * FROM OSWDM." . $tableName;
        $getTableDataSqlQuery = "SELECT * FROM " . $tableName;
        $sqlResult = oswQuery($getTableDataSqlQuery);
        $allRows = array();
        while ($oneSqlRow = oci_fetch_array($sqlResult)) {
            $oneRow = array();
            foreach ($tableHeadArr as $oneCol) {
                $oneRow[$oneCol] = $oneSqlRow[$tableHeadArr];
            }
            $allRows[] = $oneRow;
        }
        return $allRows;
    }

}

?>
