<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetIpData
 *
 * @author B45802
 */
require_once 'classes/ParseCSV.class.php';
require_once 'includes/Constants.php';
require_once 'classes/SingletonDb.class.php';

class GetIpData {

    private $_ip_data_db_mysqli; 
    

    function GetIpData() {
        $db = SingletonDb::getInstance();
        $this->_ip_data_db_mysqli = $db->getNpiDbConnection();
        $this->_seaweb_buffer_db_mysqli = $db->getSeawebBufferDbConnection();
    }

    function createIpData() {
        
       $parse = new ParseCSV("npi_project_contract_big_dump.csv");
     // $parse = new ParseCSV("/proj/.web_webnpi/html/docs/TSPG/MCD/NPI/Reports/npi_project_contract_big_dump.csv");
        $retArray = array();
        $response = array();
        $responseData = array();
        $dataArr = $parse->parse($GLOBALS['IpFetchColArr']);
        foreach ($dataArr as $oneRow) { 
            $retOneRow = array(); 
            // echo print_r($oneRow)."<br><br><br>";
            foreach ($GLOBALS['IpCreateDataLoopArr'] as $oneCellKey) {
                $retOneRow[str_replace(" ", "_", $oneCellKey)] = $oneRow[$oneCellKey];
            }
            $retOneRow["_3_3_forecast"] = $this->getColorDate($oneRow["IP Prelim Release Act"], $oneRow["IP Prelim Release Fst"], $oneRow["IP Prelim Release Tgt"]);
            $retOneRow["_3_4_forecast"] = $this->getColorDate($oneRow["QMS Solid Release Act"], $oneRow["QMS Solid Release Fst"], $oneRow["QMS Solid Release Tgt"]);
            $retOneRow["_3_5_forecast"] = $this->getColorDate($oneRow["IP Final Release Act"], $oneRow["IP Final Release Fst"], $oneRow["IP Final Release Tgt"]);
            $retOneRow["gds_forecast"] = $this->getColorDate($oneRow["M1 Alpha IP Release Act"], $oneRow["M1 Alpha IP Release Fst"], $oneRow["M1 Alpha IP Release Tgt"]);
            
            $responseData[] = $retOneRow;
        }
        $response["allDataRows"] = $responseData;
        // $response["headerKeys"] = $GLOBALS['IpUIDisplayColArr'];
        $retArray["response"] = $response;
        // echo print_r($retArray);
        //return $retArray;
        echo json_encode($retArray);
    } 
    
    function getColorDate($actual, $forecast, $target) {
        $retArray = array();
        $cellColor = "whiteCell";
        $cellValue = "";
        if (isset($actual) && !empty($actual)) {
            $cellColor = "blueCell";
            $cellValue = $actual;
        } else if (isset($forecast) && !empty($forecast)) {
            if ($this->isLargerThanBase($forecast, $target)) {
                $cellColor = "redCell"; 
            } else {
                $cellColor = "greenCell";
            }
            $cellValue = $forecast;
        } else if (isset($target) && !empty($target)) {
            if ($this->isLargerThanToday($target)) {
                $cellColor = "redCell"; 
            } else {
                $cellColor = "greenCell";
            }
            $cellValue = $target;
        }

        $retArray['cellColor'] = $cellColor;
        $retArray['cellValue'] = $cellValue;
        return $retArray;
    }

    function isLargerThanToday($compareDate) {
        if (time() >= strtotime($compareDate)) {
            return TRUE;
        }
        return FALSE;
    }

    function isLargerThanBase($compareDate, $baseDate) {
        if (strtotime($baseDate) < strtotime($compareDate)) {
            return TRUE;
        }
        return FALSE;
    }

   
}

?>
