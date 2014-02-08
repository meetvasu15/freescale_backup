<?php

/**
 * Description of ReadExcel
 *
 * @author B45802
 */
require('lib/PHPExcel.php');

class ReadExcel {

    //this method reads the excel file and returns a worksheet object
    function ReadExcelSheet ($fileName, $sheetName) { 
        
           
        $Reader = PHPExcel_IOFactory::createReaderForFile($fileName);  
        $Reader->setReadDataOnly(true); // set this, to not read all excel properties, just data
        $Reader->setLoadSheetsOnly($sheetName);  
        $objXLS = $Reader->load($fileName);
         //$objWorksheet = $objXLS->setActiveSheetIndexByName($sheetName);
          $objWorksheet = $objXLS->getActiveSheet(); 
        return $objWorksheet;
    }

}

?>
