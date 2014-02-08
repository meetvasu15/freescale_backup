<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreateDashboardExcel
 *
 * @author B45802
 */
require_once 'classes/ReadExcel.class.php'; 
require_once 'includes/Constants.php';

class CreateDashboardExcel {

    var $objPHPExcel;

    function CreateDashboardExcel() {
        $this->objPHPExcel = new PHPExcel();
    }

    function getDashboardExcel() {
        $colNum = 'A';
        $rowNum = 1; 
        $jsonStr = stripslashes ($_POST['allRowData']);  
        $allRowData = json_decode($jsonStr, true);
        // echo $jsonStr;
          //echo print_r($allRowData);
        $excelHeaderArr = $GLOBALS['excelHeaderArr'];
        $prettyHeaderArr = array_keys($excelHeaderArr);
        $worksheet = $this->objPHPExcel->getActiveSheet();
        foreach ($prettyHeaderArr as $oneColHeadVal){
             $worksheet->setCellValue($colNum . $rowNum, $oneColHeadVal);
             $colNum++;
        }
        $excelFinExpHeaderArr = $GLOBALS['excelFinExpHeaderArr'];
        $prettyFinancialHeaderArr = array_keys($excelFinExpHeaderArr);
        foreach ($prettyFinancialHeaderArr as $oneColFinancialHeadArr){
             $worksheet->setCellValue($colNum . $rowNum, $oneColFinancialHeadArr);
             $colNum++;
        }
        foreach ($allRowData as $oneRow){
            $colNum = 'A';
            $rowNum++;
            foreach ($excelHeaderArr as $oneColKey){
              //  echo print_r($oneRow)."<br>";
                 if($oneRow[$oneColKey]){
                    $worksheet->setCellValue($colNum . $rowNum, $oneRow[$oneColKey]);
                 }
                 $colNum++;
            } 
           
            foreach ($excelFinExpHeaderArr as $oneColKey){
             //    echo  print_r( $oneRow['Financials'][$oneColKey]).":::<br><br><br><br>::";
              //  echo print_r($oneRow)."<br>";
                 if($oneRow['Financials'][$oneColKey]){
                     $financeArr = $oneRow['Financials'][$oneColKey];
                    // print_r($financeArr)."<br><br><br><br>";
                     if (strpos($oneColKey,'_Tgt') !== false) {
                         $worksheet->setCellValue($colNum . $rowNum, $financeArr);
                     }else if( !empty ($financeArr['cellValue'])){
                       // echo print_r(  $financeArr['cellValue']);
                        $worksheet->setCellValue($colNum . $rowNum, $financeArr['cellValue']);
                        $worksheet->getStyle($colNum . $rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                        $worksheet->getStyle($colNum . $rowNum)->getFill()->getStartColor()->setRGB($this->getRgb($financeArr['cellColor']));
                     }
                 }
                 $colNum++;
            } 
        }
      $this->createExcel();
        
    } 
    function getRgb($cellColor){
         if (strpos($cellColor,'green') !== false) {
                         return '32cd32';
         }else if (strpos($cellColor,'red') !== false) {
                         return 'ff0000';
         } 
    }
    function createExcel() {
        $this->objPHPExcel->getActiveSheet()->setTitle("Dashboard");
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Dashboard Report.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }

}

?>
