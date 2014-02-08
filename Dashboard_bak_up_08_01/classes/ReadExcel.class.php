<?php

/**
 * Description of ReadExcel
 *
 * @author B45802
 */
require('lib/PHPExcel.php');

class ReadExcel {

    //this method reads the excel file and returns a worksheet object
    function ReadExcelSheet( ) {
        $allowedExts = array("xls", "xlsx", "xlsm");
        $fileName = $_FILES["files"]["name"];
        $fileNameArr = explode(".", $_FILES["files"]["name"]);
        $extension = end($fileNameArr);
        if (in_array($extension, $allowedExts)) {
            if ($_FILES["files"]["error"] > 0) {
                echo "There was some error reading your file Return Code: " . $_FILES["file"]["error"] . ".<br> Please look <a href='http://php.net/manual/en/features.file-upload.errors.php'>here</a> for detail on return code. ";
            } else { 
                move_uploaded_file($_FILES["files"]["tmp_name"], $_FILES["files"]["name"]); 
            }
              //echo "Valid file";
        } else {
            echo "Invalid file";
            return;
        }

        $Reader = PHPExcel_IOFactory::createReaderForFile($fileName);
       /// $Reader->setReadDataOnly(true); // set this, to not read all excel properties, just data
        //$Reader->setLoadSheetsOnly("Sheet1");
        $objXLS = $Reader->load($fileName);
         $objWorksheet = $objXLS->getActiveSheet(); 
        //$objWorksheet = $objXLS->getActiveSheet();
         
         return $objWorksheet;
    }

}

?>
