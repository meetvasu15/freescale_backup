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
    private $_pv_db_mysqli;

    function GetIpData() {
        $db = SingletonDb::getInstance();
        $this->_ip_data_db_mysqli = $db->getNpiDbConnection();
        $this->_pv_db_mysqli = $db->getSeawebPrimeveraDbConnection();
        $this->_seaweb_buffer_db_mysqli = $db->getSeawebBufferDbConnection();
    }

    function createIpData() {
        
      // $parse = new ParseCSV("npi_project_contract_big_dump.csv");
      $parse = new ParseCSV("/proj/.web_webnpi/html/docs/TSPG/MCD/NPI/Reports/npi_project_contract_big_dump.csv");
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
    function createIpPVData(){
        $esp_digital = "2384357";
        $esp_analog = "2475172";
        $retArray = array();
        $response = array();
        $allDataArray = array();
      //  $headerArr = array("Project", "ActiveName",  "FinishDate");
       $allIpProjSqlStmnt =  "SELECT * 
                              FROM milestone_tb m
                            Join project_tb proj 
                            on proj.objid = m.proj_objid
                            WHERE m.proj_objid in ( SELECT objid FROM project_tb WHERE epsobjid in ( ".$esp_analog.", ".$esp_digital." )  AND status = 'Active' )";
       // $allIpProjSqlStmnt = "SELECT * FROM milestone_tb WHERE proj_objid in ( SELECT objid FROM project_tb WHERE epsobjid in ( ".$esp_analog.", ".$esp_digital." ) AND status = 'Active' )";
        $allIpProjSqlResult = $this->_pv_db_mysqli->query($allIpProjSqlStmnt);
        while ($oneRawRow = mysqli_fetch_array($allIpProjSqlResult)) {
      //      $oneRowArr = array();
//            foreach($headerArr as $key){
//                $oneRowArr[$key] = $oneRawRow[$key]; 
//            }
            if(FALSE === array_key_exists($oneRawRow["project"], $allDataArray)){
                $allDataArray[$oneRawRow["project"]] = array(); 
                 $allDataArray[$oneRawRow["project"]]["project"] = $oneRawRow["project"]; 
               //  $allDataArray[$oneRawRow["project"]]["npi_id"] = $oneRawRow["npi_id"]; 
             //  $allDataArray[$oneRawRow["project"]]["ActiveId"]=$oneRawRow["ActiveId"];
            }
              $allDataArray[$oneRawRow["project"]][$oneRawRow["ActiveName"]]=$this->convertDbDateToDisplay($oneRawRow["FinishDate"]);
              if($oneRawRow["ActiveId"] = "Final3.5")
               $allDataArray[$oneRawRow["project"]]["Final3.5"]=$this->convertDbDateToDisplay($oneRawRow["FinishDate"]);
              // echo print_r(array_keys($oneRawRow))."<br>";
        }
        $response["allDataRows"] = array_values($allDataArray);
        $retArray["response"] = $response; 
        echo json_encode($retArray);
    }
    function convertDbDateToDisplay($originalDate){
        return date("d-M-Y", strtotime($originalDate));
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
