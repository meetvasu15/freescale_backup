<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BurndownIngestion
 *
 * @author B45802
 */
require_once 'classes/SingletonDb.class.php';

class BurndownIngestion {

    //put your code here
    private $_dashboard_db_mysqli;

    function BurndownIngestion() {
        $db = SingletonDb::getInstance();
        $this->_dashboard_db_mysqli = $db->getSeawebDashboardDbConnection();
    }

    function generateDataTable($npi_id, $chart_type, $worksheet) {
        if (PHPExcel_Shared_Date::isDateTime($worksheet->getCell('B1'))) {
            $this->generateDataTableXaxis($npi_id, $chart_type, $worksheet);
        } else if (PHPExcel_Shared_Date::isDateTime($worksheet->getCell('A2'))) {
            $this->generateDataTableYaxis($npi_id, $chart_type, $worksheet);
        } else {
            echo json_encode(array("response" => "Excel received is not correctly formatted"));
        }
    }

    function generateDataTableXaxis($npi_id, $chart_type, $worksheet) {
        $BurndownReadcolumn = $GLOBALS['BurndownReadcolumn'];
        $datatableArr = array();
        foreach ($worksheet->getRowIterator() as $rowNum => $row) {

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells 
            $oneRowArr = array();
            if ($worksheet->getCell('A' . $rowNum)->getValue() && array_search(trim($worksheet->getCell('A' . $rowNum)->getValue()), $BurndownReadcolumn)) {
                foreach ($cellIterator as $cellNum => $cell) {
                    //if ($cellNum == 1 && FALSE !== array_search(trim($cell->getValue()), $allColumnValuesArr)) {
                    if ($cell->getValue()) {
                        if ($rowNum == 1) {//its a date
                            $datetime = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($cell->getValue()));
                            $oneRowArr[] = $datetime;
                        } else { // its data
                            $oneRowArr[] = $cell->getValue();
                        }
                    } else {
                        $oneRowArr[] = 0;
                    }
                    //}
                }
                // echo "on  ".print_r($oneRowArr)."<br>";
                if (isset($oneRowArr) || !empty($oneRowArr) || count($oneRowArr) > 1) {
                    $datatableArr[] = $oneRowArr;
                }
            }
        }
        $datatableArr = $this->transpose($datatableArr);
        $jsonedChart = serialize($datatableArr);
        //$jsonedChart = json_encode($datatableArr);
        if (!isset($datatableArr) || empty($datatableArr) || count($datatableArr) <= 1) {
            $datatableArr["error"] = "Empty File received";
            //echo "here 1";
        } else {
            // search if already exists
            // echo "here 2";
            $saveUpdatequery;
            $searchChartSqlResult = $this->_dashboard_db_mysqli->query("SELECT npi_id FROM burndownChartsDump WHERE npi_id = " . $npi_id . " AND chart_type = '" . $chart_type . "'");
            if (mysqli_num_rows($searchChartSqlResult) > 0) {
                // does exist, do a update
                // echo "here 3";
                $saveUpdatequery = "UPDATE burndownChartsDump SET chart_json_data = '" . addslashes($jsonedChart) . "' WHERE npi_id = " . $npi_id . " AND chart_type = '" . $chart_type . "'";
            } else {
                //  echo "here 4 <br>";
                $saveUpdatequery = "INSERT INTO  burndownChartsDump (npi_id, chart_type, chart_json_data  ) 
                    VALUES  ( " . $npi_id . ", '" . $chart_type . "', '" . addslashes($jsonedChart) . "')";
            }
            //  echo $saveUpdatequery;

            $this->_dashboard_db_mysqli->query($saveUpdatequery) or die(mysqli_error($this->_dashboard_db_mysqli));
        }

        echo json_encode($datatableArr);
    }
    
        function generateDataTableYaxis($npi_id, $chart_type, $worksheet) {
        $BurndownReadcolumn = $GLOBALS['BurndownReadcolumn'];
        $datatableArr = array();
        $valIndxArray = array();
        $isFirstRow=TRUE;
        foreach ($worksheet->getRowIterator() as $rowNum => $row) {

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells 
            $oneRowArr = array();
            if ($isFirstRow) {
                $isFirstRow = FALSE;   
                    $allColumnValuesArr = array_keys($BurndownReadcolumn); 
                    foreach ($cellIterator as $key => $val) { 
                        if (FALSE !== array_search(trim($val), $allColumnValuesArr)) {
                            $valIndxArray[$key] = $key; 
                           // echo $val;
                            $oneRowArr[] = "'".$val->getValue()."'";
                        }
                    } 
                           
                //echo print_r($valIndxArray);
            } else{
             
                foreach ($cellIterator as $cellNum => $cell ) {
                    if ( FALSE !== array_search($cellNum, $valIndxArray)) { 
                    if ($cell->getValue()) {
                        if ($cellNum == 0) {//its a date 
                            $datetime = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($cell->getValue()));
                            $oneRowArr[] = $datetime;
                        } else { // its data
                            $oneRowArr[] = $cell->getValue();
                        }
                    } else {
                        $oneRowArr[] = 0;
                    }
                }
                    //}
                }
                  }
                // echo "on  ".print_r($oneRowArr)."<br>";
                if (isset($oneRowArr) || !empty($oneRowArr) || count($oneRowArr) > 1) {
                    $datatableArr[] = $oneRowArr;
                } 
          
        }
        //$datatableArr = $this->transpose($datatableArr);
        $jsonedChart = serialize($datatableArr);
        //$jsonedChart = json_encode($datatableArr);
        if (!isset($datatableArr) || empty($datatableArr) || count($datatableArr) <= 1) {
            $datatableArr["error"] = "Empty File received";
            //echo "here 1";
        } else {
            // search if already exists
            // echo "here 2";
            $saveUpdatequery;
            $searchChartSqlResult = $this->_dashboard_db_mysqli->query("SELECT npi_id FROM burndownChartsDump WHERE npi_id = " . $npi_id . " AND chart_type = '" . $chart_type . "'");
            if (mysqli_num_rows($searchChartSqlResult) > 0) {
                // does exist, do a update
                // echo "here 3";
                $saveUpdatequery = "UPDATE burndownChartsDump SET chart_json_data = '" . addslashes($jsonedChart) . "' WHERE npi_id = " . $npi_id . " AND chart_type = '" . $chart_type . "'";
            } else {
                //  echo "here 4 <br>";
                $saveUpdatequery = "INSERT INTO  burndownChartsDump (npi_id, chart_type, chart_json_data  ) 
                    VALUES  ( " . $npi_id . ", '" . $chart_type . "', '" . addslashes($jsonedChart) . "')";
            }
            //  echo $saveUpdatequery;

            $this->_dashboard_db_mysqli->query($saveUpdatequery) or die(mysqli_error($this->_dashboard_db_mysqli));
        }

        echo json_encode($datatableArr);
    }

    function transpose($array) {
        array_unshift($array, null);
        return call_user_func_array('array_map', $array);
    }

    function getChartData($npi_id, $chart_type) {
        $retArr = Array();
        $searchChartSqlResult = $this->_dashboard_db_mysqli->query("SELECT chart_json_data FROM burndownChartsDump WHERE npi_id = " . $npi_id . " AND chart_type = '" . $chart_type . "'");
        if (mysqli_num_rows($searchChartSqlResult) > 0) {

            while ($oneRow = mysqli_fetch_array($searchChartSqlResult)) {
                $strJson = unserialize($oneRow['chart_json_data']);
                // $strJson = substr($strJson, 0, -1);
                // $strJson = substr($strJson, 1);  
                $retArr["response"] = $strJson;
                echo json_encode($retArr);
                return;
            }
        }
        $retArr["response"] = 0;
        echo json_encode($retArr);
    }

}

?>
