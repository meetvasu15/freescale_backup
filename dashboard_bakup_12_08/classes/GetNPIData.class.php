<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'classes/ParseCSV.class.php';
require_once 'includes/Constants.php';
require_once 'classes/SingletonDb.class.php';

/**
 * Description of GetNPIData 
 * @author B45802
 */
class GetNPIData {

    private $_npi_data_db_mysqli;
    private $_financialColor = "whiteFinancialModalCell";
    private $_milestonesColor = "whiteMilestoneModalCell";

    function GetNPIData() {
        $db = SingletonDb::getInstance();
        $this->_npi_data_db_mysqli = $db->getNpiDbConnection();
        $this->_seaweb_buffer_db_mysqli = $db->getSeawebBufferDbConnection();
    }

    function createNPIData() {

        //  $parse = new ParseCSV("npi_project_contract_big_dump.csv");
        $parse = new ParseCSV("/proj/.web_webnpi/html/docs/TSPG/MCD/NPI/Reports/npi_project_contract_big_dump.csv");
        $retArray = array();
        $response = array();
        $responseData = array();
        $dataArr = $parse->parse($GLOBALS['NPIFetchColArr']);
        foreach ($dataArr as $oneRow) {
            $this->_financialColor = "whiteFinancialModalCell";
            $this->_milestonesColor = "whiteMilestoneModalCell";
            $retOneRow = array();
            $financialsArray = array();
            $milestonesArray = array();
            // echo print_r($oneRow)."<br><br><br>";
            foreach ($GLOBALS['NPICreateDataLoopArr'] as $oneCellKey) {
                $retOneRow[str_replace(" ", "_", $oneCellKey)] = $oneRow[$oneCellKey];
            }
            //Now do financials
            $financialsArray["Gross_Margin_percent"] = $this->calculateBiggerBetter($oneRow["Gross Margin (%) Act"], $oneRow["Gross Margin (%) Fst"], $oneRow["Gross Margin (%) Tgt"]);
            $financialsArray["Gross_Margin_percent_Tgt"] = $oneRow["Gross Margin (%) Tgt"];
            $financialsArray["Die_Size"] = $this->calculateSmallerBetter($oneRow["Die Size(mmsq) Act"], $oneRow["Die Size(mmsq) Fst"], $oneRow["Die Size(mmsq) Tgt"]);
            $financialsArray["Die_Size_Tgt"] = $oneRow["Die Size(mmsq) Tgt"];
            $financialsArray["NPV"] = $this->calculateBiggerBetter($oneRow["NPV (\$M) Act"], $oneRow["NPV (\$M) Fst"], $oneRow["NPV (\$M) Tgt"]);
            $financialsArray["NPV_Tgt"] = $oneRow["NPV (\$M) Tgt"];
            $financialsArray["Hurdle_Rate"] = $this->calculateBiggerBetter($oneRow["Hurdle Rate Act"], $oneRow["Hurdle Rate Fst"], $oneRow["Hurdle Rate Tgt"]);
            $financialsArray["Hurdle_Rate_Tgt"] = $oneRow["Hurdle Rate Tgt"];
            $financialsArray["FTE"] = $this->calculateSmallerBetter($oneRow["Total FTE# Act"], $oneRow["Total FTE# Fst"], $oneRow["Total FTE# Tgt"]);
            $financialsArray["FTE_Tgt"] = $oneRow["Total FTE# Tgt"];
            $financialsArray["Gross_Margin"] = $this->calculateBiggerBetter($this->calculateGrossMargin($oneRow["Total Revenue (\$M) Act"], $oneRow["Gross Margin (%) Act"]), $this->calculateGrossMargin($oneRow["Total Revenue (\$M) Fst"], $oneRow["Gross Margin (%) Fst"]), $this->calculateGrossMargin($oneRow["Total Revenue (\$M) Tgt"], $oneRow["Gross Margin (%) Tgt"]));
            $financialsArray["Gross_Margin_Tgt"] = $this->calculateGrossMargin($oneRow["Total Revenue (\$M) Tgt"], $oneRow["Gross Margin (%) Tgt"]);
// echo "Project act " . $retOneRow['Project'] . "<br> "; //.$this->calculateGrossMargin($oneRow["Total Revenue (\$M) Act"] , $oneRow["Gross Margin (%) Act"])."<br>";
//             echo "Project fst".$retOneRow['Project']." ".$this->calculateGrossMargin($oneRow["Total Revenue (\$M) Fst"] , $oneRow["Gross Margin (%) Fst"])."<br>";
//              echo "Project tgt".$retOneRow['Project']." ".$this->calculateGrossMargin($oneRow["Total Revenue (\$M) Tgt"] , $oneRow["Gross Margin (%) Tgt"])."<br>";
            $retOneRow["Financials"] = $financialsArray;
            $retOneRow["financialCellColor"] = $this->_financialColor;
            // calculate cycle time
            //$retOneRow["cycle_time"] = $this->getCycleTime($this->getDate($oneRow["Qual Compl Act"], $oneRow["Qual Compl Fst"], $oneRow["Qual Compl Tgt"]), $this->getDate($oneRow["Feasibility Compl Act"], $oneRow["Feasibility Compl Fst"], $oneRow["Feasibility Compl Tgt"]));
            $retOneRow["cycle_time"] = $this->getCycleTime($this->getDate($oneRow["Qual Compl Act"], $oneRow["Qual Compl Fst"], $oneRow["Qual Compl Tgt"]), $this->getDate($oneRow["Concept Compl Act"], $oneRow["Concept Compl Fst"], $oneRow["Concept Compl Tgt"]));
            // get milestone data now
            $milestonesArray["MM_TO_1_0_Tape_Out"] = $this->getColorDate($oneRow["MM-TO 1.0 Tape Out Act"], $oneRow["MM-TO 1.0 Tape Out Fst"], $oneRow["MM-TO 1.0 Tape Out Tgt"]);
            $milestonesArray["MM_TO_1_0_Tape_Out_Tgt"] = $oneRow["MM-TO 1.0 Tape Out Tgt"];
            $milestonesArray["_1_0_Cust_Samples"] = $this->getColorDate($oneRow["1.0 Cust Samples Act"], $oneRow["1.0 Cust Samples Fst"], $oneRow["1.0 Cust Samples Tgt"]);
            $milestonesArray["_1_0_Cust_Samples_Tgt"] = $oneRow["1.0 Cust Samples Tgt"];
            $milestonesArray["MM_TO1_1_Tape_Out"] = $this->getColorDate($oneRow["MM-TO1.1 Tape Out Act"], $oneRow["MM-TO1.1 Tape Out Fst"], $oneRow["MM-TO1.1 Tape Out Tgt"]);
            $milestonesArray["MM_TO1_1_Tape_Out_Tgt"] = $oneRow["MM-TO1.1 Tape Out Tgt"];
            $milestonesArray["_1_1_Cust_Samples"] = $this->getColorDate($oneRow["1.1 Cust Samples Act"], $oneRow["1.1 Cust Samples Fst"], $oneRow["1.1 Cust Samples Tgt"]);
            $milestonesArray["_1_1_Cust_Samples_Tgt"] = $oneRow["1.1 Cust Samples Tgt"];
            $milestonesArray["MM_TO1_2_Tape_Out"] = $this->getColorDate($oneRow["MM-TO1.2 Tape Out Act"], $oneRow["MM-TO1.2 Tape Out Fst"], $oneRow["MM-TO1.2 Tape Out Tgt"]);
            $milestonesArray["MM_TO1_2_Tape_Out_Tgt"] = $oneRow["MM-TO1.2 Tape Out Tgt"];
            $milestonesArray["_1_2_Cust_Samples"] = $this->getColorDate($oneRow["1.2 Cust Samples Act"], $oneRow["1.2 Cust Samples Fst"], $oneRow["1.2 Cust Samples Tgt"]);
            $milestonesArray["_1_2_Cust_Samples_Tgt"] = $oneRow["1.2 Cust Samples Tgt"];
            $milestonesArray["MM_TO2_0_Tape_Out"] = $this->getColorDate($oneRow["MM-TO2.0 Tape Out Act"], $oneRow["MM-TO2.0 Tape Out Fst"], $oneRow["MM-TO2.0 Tape Out Tgt"]);
            $milestonesArray["MM_TO2_0_Tape_Out_Tgt"] = $oneRow["MM-TO2.0 Tape Out Tgt"];
            $milestonesArray["_2_0_Cust_Samples"] = $this->getColorDate($oneRow["2.0 Cust Samples Act"], $oneRow["2.0 Cust Samples Fst"], $oneRow["2.0 Cust Samples Tgt"]);
            $milestonesArray["_2_0_Cust_Samples_Tgt"] = $oneRow["2.0 Cust Samples Tgt"];
            $milestonesArray["MM_TO2_1_Tape_Out"] = $this->getColorDate($oneRow["MM-TO2.1 Tape Out Act"], $oneRow["MM-TO2.1 Tape Out Fst"], $oneRow["MM-TO2.1 Tape Out Tgt"]);
            $milestonesArray["MM_TO2_1_Tape_Out_Tgt"] = $oneRow["MM-TO2.1 Tape Out Tgt"];
            $milestonesArray["_2_1_Cust_Samples"] = $this->getColorDate($oneRow["2.1 Cust Samples Act"], $oneRow["2.1 Cust Samples Fst"], $oneRow["2.1 Cust Samples Tgt"]);
            $milestonesArray["_2_1_Cust_Samples_Tgt"] = $oneRow["2.1 Cust Samples Tgt"];
            $milestonesArray["Proto_Enbl_Tools"] = $this->getColorDate($oneRow["Proto Enbl Tools Act"], $oneRow["Proto Enbl Tools Fst"], $oneRow["Proto Enbl Tools Tgt"]);
            $milestonesArray["Proto_Enbl_Tools_Tgt"] = $oneRow["Proto Enbl Tools Tgt"];
            $milestonesArray["Proto_EVB_Hardware"] = $this->getColorDate($oneRow["Proto EVB Hardware Act"], $oneRow["Proto EVB Hardware Fst"], $oneRow["Proto EVB Hardware Tgt"]);
            $milestonesArray["Proto_EVB_Hardware_Tgt"] = $oneRow["Proto EVB Hardware Tgt"];
            $milestonesArray["Proto_SW_Drivers"] = $this->getColorDate($oneRow["Proto SW Drivers Act"], $oneRow["Proto SW Drivers Fst"], $oneRow["Proto SW Drivers Tgt"]);
            $milestonesArray["Proto_SW_Drivers_Tgt"] = $oneRow["Proto SW Drivers Tgt"];
            $milestonesArray["Qual_Compl"] = $this->getColorDate($oneRow["Qual Compl Act"], $oneRow["Qual Compl Fst"], $oneRow["Qual Compl Tgt"]);
            $milestonesArray["Qual_Compl_Tgt"] = $oneRow["Qual Compl Tgt"];
            $milestonesArray["_1_1_Tape_Out"] = $this->getColorDate($oneRow["1.1 Tape Out Act"], $oneRow["1.1 Tape Out Fst"], $oneRow["1.1 Tape Out Tgt"]);
            $milestonesArray["_1_1_Tape_Out_Tgt"] = $oneRow["1.1 Tape Out Tgt"];
            $milestonesArray["_1_1_Qual_Complete"] = $this->getColorDate($oneRow["1.1 Qual Complete Act"], $oneRow["1.1 Qual Complete Fst"], $oneRow["1.1 Qual Complete Tgt"]);
            $milestonesArray["_1_1_Qual_Complete_Tgt"] = $oneRow["1.1 Qual Complete Tgt"];
            $milestonesArray["_1_2_Tape_Out"] = $this->getColorDate($oneRow["1.2 Tape Out Act"], $oneRow["1.2 Tape Out Fst"], $oneRow["1.2 Tape Out Tgt"]);
            $milestonesArray["_1_2_Tape_Out_Tgt"] = $oneRow["1.2 Tape Out Tgt"];
            $milestonesArray["_1_3_Tape_Out"] = $this->getColorDate($oneRow["1.3 Tape Out Act"], $oneRow["1.3 Tape Out Fst"], $oneRow["1.3 Tape Out Tgt"]);
            $milestonesArray["_1_3_Tape_Out_Tgt"] = $oneRow["1.3 Tape Out Tgt"];
            $milestonesArray["_2_1_Tape_Out"] = $this->getColorDate($oneRow["2.1 Tape Out Act"], $oneRow["2.1 Tape Out Fst"], $oneRow["2.1 Tape Out Tgt"]);
            $milestonesArray["_2_1_Tape_Out_Tgt"] = $oneRow["2.1 Tape Out Tgt"];
            $milestonesArray["_2_1_Qual_Complete"] = $this->getColorDate($oneRow["2.1 Qual Complete Act"], $oneRow["2.1 Qual Complete Fst"], $oneRow["2.1 Qual Complete Tgt"]);
            $milestonesArray["_2_1_Qual_Complete_Tgt"] = $oneRow["2.1 Qual Complete Tgt"];
            $milestonesArray["_2_2_Tape_Out"] = $this->getColorDate($oneRow["2.2 Tape Out Act"], $oneRow["2.2 Tape Out Fst"], $oneRow["2.2 Tape Out Tgt"]);
            $milestonesArray["_2_2_Tape_Out_Tgt"] = $oneRow["2.2 Tape Out Tgt"];
            $milestonesArray["_2_2_Qual_Complete"] = $this->getColorDate($oneRow["2.2 Qual Complete Act"], $oneRow["2.2 Qual Complete Fst"], $oneRow["2.2 Qual Complete Tgt"]);
            $milestonesArray["_2_2_Qual_Complete_Tgt"] = $oneRow["2.2 Qual Complete Tgt"];
            $milestonesArray["_2_3_Tape_Out"] = $this->getColorDate($oneRow["2.3 Tape Out Act"], $oneRow["2.3 Tape Out Fst"], $oneRow["2.3 Tape Out Tgt"]);
            $milestonesArray["_2_3_Tape_Out_Tgt"] = $oneRow["2.3 Tape Out Tgt"];
            $milestonesArray["_2_4_Tape_Out"] = $this->getColorDate($oneRow["2.4 Tape Out Act"], $oneRow["2.4 Tape Out Fst"], $oneRow["2.4 Tape Out Tgt"]);
            $milestonesArray["_2_4_Tape_Out_Tgt"] = $oneRow["2.4 Tape Out Tgt"];
            $milestonesArray["_3_0_Tape_Out"] = $this->getColorDate($oneRow["3.0 Tape Out Act"], $oneRow["3.0 Tape Out Fst"], $oneRow["3.0 Tape Out Tgt"]);
            $milestonesArray["_3_0_Tape_Out_Tgt"] = $oneRow["3.0 Tape Out Tgt"];
            $milestonesArray["_3_0_Customer_Samples"] = $this->getColorDate($oneRow["3.0 Customer Samples Act"], $oneRow["3.0 Customer Samples Fst"], $oneRow["3.0 Customer Samples Tgt"]);
            $milestonesArray["_3_0_Customer_Samples_Tgt"] = $oneRow["3.0 Customer Samples Tgt"];
            $milestonesArray["_3_0_Qual_Complete"] = $this->getColorDate($oneRow["3.0 Qual Complete Act"], $oneRow["3.0 Qual Complete Fst"], $oneRow["3.0 Qual Complete Tgt"]);
            //$milestonesArray["_3_1_Customer_Samples"] =$this->getColorDate($oneRow["3.1 Customer Samples Act"], $oneRow["3.1 Customer Samples Fst"],  $oneRow["3.1 Customer Samples Tgt"]);
            $milestonesArray["_3_0_Qual_Complete_Tgt"] = $oneRow["3.0 Qual Complete Tgt"];
            $milestonesArray["_3_1_Qual_Complete"] = $this->getColorDate($oneRow["3.1 Qual Complete Act"], $oneRow["3.1 Qual Complete Fst"], $oneRow["3.1 Qual Complete Tgt"]);
            $milestonesArray["_3_1_Qual_Complete_Tgt"] = $oneRow["3.1 Qual Complete Tgt"];
            $retOneRow["milestones"] = $milestonesArray;
            $retOneRow["milestonesCellColor"] = $this->_milestonesColor;
            $responseData[] = $retOneRow;
        }
        $response["allDataRows"] = $responseData;
        // $response["headerKeys"] = $GLOBALS['NPIUIDisplayColArr'];
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
                $this->_milestonesColor = "redFinancialModalCell";
            } else {
                $cellColor = "greenCell";
            }
            $cellValue = $forecast;
        } else if (isset($target) && !empty($target)) {
            if ($this->isLargerThanToday($target)) {
                $cellColor = "redCell";
                $this->_milestonesColor = "redFinancialModalCell";
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

    function getDate($actual, $forecast, $target) {
        // TODO COnvert to date and get act/fst or tar
        if (isset($actual) && !empty($actual))
        // return   date('c',strtotime($actual));
            return strtotime($actual);
        if (isset($forecast) && !empty($forecast))
        //return date('c',strtotime($forecast));
            return strtotime($forecast);
        if (isset($target) && !empty($target))
        //return date('c',strtotime($target));
            return strtotime($target);
    }

    function getCycleTime($qualComp, $feasibility) {
        if (isset($qualComp) && !empty($qualComp) && isset($feasibility) && !empty($feasibility)) {
            //   echo "qual ". date('c',$qualComp )." feas ".  date('c',$feasibility)."<br>";
            // echo ($qualComp - $feasibility)/ (86400*7);
            //convet seconds to week
            return round(($qualComp - $feasibility) / (86400 * 7));
        } else {
            return "";
        }
    }

    function calculateSmallerBetter($actual, $forecast, $target) {
        $retArray = array();
        $cellColor = "whiteCell";
        $cellValue = "";
        if (isset($actual) && !empty($actual)) {
            $cellValue = $actual;
            if (isset($forecast) && !empty($forecast) && $actual <= 1.02 * ($forecast)) { // smaller actual is better
                $cellColor = "greenCell";
            } else if (isset($forecast) && !empty($forecast) && $actual > 1.02 * ($forecast)) {
                $this->_financialColor = "redFinancialModalCell";
                $cellColor = "redCell";
            } else if (isset($target) && !empty($target) && $actual <= 1.02 * ($target)) { // smaller actual is better
                $cellColor = "greenCell";
            } else if (isset($target) && !empty($target) && $actual > 1.02 * ($target)) {
                $this->_financialColor = "redFinancialModalCell";
                $cellColor = "redCell";
            }
        } else if (isset($forecast) && !empty($forecast)) {
            $cellValue = $forecast;
            if (isset($target) && !empty($target) && $forecast <= 1.02 * ($target)) { // smaller $forecast is better
                $cellColor = "greenCell";
            } else if (isset($target) && !empty($target) && $forecast > 1.02 * ($target)) {
                $this->_financialColor = "redFinancialModalCell";
                $cellColor = "redCell";
            }
        } else if (isset($target) && !empty($target)) {
            $cellValue = $target;
        }
        $retArray['cellColor'] = $cellColor;
        $retArray['cellValue'] = $cellValue;
        return $retArray;
    }

    /*
     * if act then else fst esle tgt
     */

    function calculateBiggerBetter($actual, $forecast, $target) {
        $retArray = array();
        $cellColor = "whiteCell";
        $cellValue = "";
        if (isset($actual) && !empty($actual)) {
            $cellValue = $actual;
            if (isset($forecast) && !empty($forecast) && $actual >= 0.98 * ($forecast)) { // bigger actual is better
                $cellColor = "greenCell";
            } else if (isset($forecast) && !empty($forecast) && $actual < 0.98 * ($forecast)) {
                $this->_financialColor = "redFinancialModalCell";
                $cellColor = "redCell";
            } else if (isset($target) && !empty($target) && $actual >= 0.98 * ($target)) { // bigger actual is better
                $cellColor = "greenCell";
            } else if (isset($target) && !empty($target) && $actual < 0.98 * ($target)) {
                $this->_financialColor = "redFinancialModalCell";
                $cellColor = "redCell";
            }
        } else if (isset($forecast) && !empty($forecast)) {
            $cellValue = $forecast;
            if (isset($target) && !empty($target) && $forecast >= 0.98 * ($target)) { // bigger $forecast is better
                $cellColor = "greenCell";
            } else if (isset($target) && !empty($target) && $forecast < 0.98 * ($target)) { // bigger $forecast is better
                $this->_financialColor = "redFinancialModalCell";
                $cellColor = "redCell";
            }
        } else if (isset($target) && !empty($target)) {
            $cellValue = $target;
        }
        $retArray['cellColor'] = $cellColor;
        $retArray['cellValue'] = $cellValue;
        return $retArray;
    }

    function getQMSData($projectName) {
        $project_id;
        $retHtml;
        $retArr = array();
        if (!isset($projectName) || empty($projectName)) {
            echo "SEVERE ERROR: Got no project name!";
            return;
        }

        $projectIdSqlResult = $this->_npi_data_db_mysqli->query("SELECT id FROM npi_projects WHERE name ='" . $projectName . "' AND dvn_id=" . $GLOBALS['division_id']);

        if (mysqli_num_rows($projectIdSqlResult) > 0) {
            while ($oneRow = mysqli_fetch_array($projectIdSqlResult)) {
                $project_id = $oneRow['id'];
            }
        } else {
            $retHtml = "No QMS found for this Project";
        }
        if (isset($project_id) && !empty($project_id)) {
            $qmsHtmlSqlResult = $this->_seaweb_buffer_db_mysqli->query("SELECT extra_info FROM ip_gear WHERE npi_id = " . $project_id);
            if (mysqli_num_rows($qmsHtmlSqlResult) > 0) {
                while ($oneRow = mysqli_fetch_array($qmsHtmlSqlResult)) {
                    $retHtml = $oneRow['extra_info'];
                }
            } else {
                $retHtml = "No QMS found for this Project";
            }
        }
        $retArr["response"] = $retHtml;
        echo json_encode($retArr);
    }

    function getQMSComponentId($npi_id) {
        $retArr = array();
        $retHtml;
        if (!isset($npi_id) || empty($npi_id)) {
            echo "SEVERE ERROR: Got no npi id!";
            return;
        }
        $qmsComponentIdSqlResult = $this->_seaweb_buffer_db_mysqli->query("SELECT component_id FROM ip_gear WHERE npi_id = " . $npi_id);
        if (mysqli_num_rows($qmsComponentIdSqlResult) > 0) {
            while ($oneRow = mysqli_fetch_array($qmsComponentIdSqlResult)) {
                $retHtml = $oneRow['component_id'];
            }
        } else {
            $retHtml = "{'Error' : 'No QMS found for this Project'}";
        }
        $retArr["response"] = $retHtml;
        echo json_encode($retArr);
    }
    
    function getRRHtml($npi_id) {
        $retArr = array();
        $retHtml;
        if (!isset($npi_id) || empty($npi_id)) {
            echo "SEVERE ERROR: Got no npi id!";
            return;
        }
        $qmsComponentIdSqlResult = $this->_seaweb_buffer_db_mysqli->query("SELECT rrwrap FROM ip_gear WHERE npi_id = " . $npi_id);
        if (mysqli_num_rows($qmsComponentIdSqlResult) > 0) {
            while ($oneRow = mysqli_fetch_array($qmsComponentIdSqlResult)) {
                $retHtml = $oneRow['rrwrap'];
            }
        } else {
            $retHtml = "{'Error' : 'No QMS found for this Project'}";
        }
        if (!isset($retHtml) || empty($retHtml) || $retHtml == NULL || $retHtml == ""){
            $retHtml = "No right Review found for the project.";
        }
        $retArr["response"] = $retHtml;
        echo json_encode($retArr);
    }

    function calculateGrossMargin($totalRevnue, $GrossMarginPercnt) {
        if (isset($totalRevnue) || !empty($totalRevnue) || isset($GrossMarginPercnt) || !empty($GrossMarginPercnt)) {
            return ($totalRevnue * $GrossMarginPercnt) / 100;
        } else {
            return "";
        }
    }

//    function grossMarginCell($actual, $forecast, $target) {
//        $retArray = array();
//        $cellColor = "whiteCell";
//        $cellValue = "";
//        if (isset($actual) && !empty($actual)) {
//            $cellValue = $actual;
//        } else if (isset($forecast) && !empty($forecast)) {
//            $cellValue = $forecast;
//            $cellColor = "redCell";
//        } else if (isset($target) && !empty($target)) {
//            $cellValue = $target;
//            $cellColor = "redCell";
//        }
//        $retArray['cellColor'] = $cellColor;
//        $retArray['cellValue'] = $cellValue;
//        return $retArray;
//    }
//
//    function calculateDisplayVal($actual, $forecast, $target) {
//        $retArray = array();
//        $cellColor = "whiteCell";
//        $cellValue = "";
//        if (isset($actual) && !empty($actual)) {
//            $cellValue = $actual;
//        } else if (isset($forecast) && !empty($forecast)) {
//            $cellValue = $forecast;
//            $cellColor = "redCell";
//        } else if (isset($target) && !empty($target)) {
//            $cellValue = $target;
//            $cellColor = "redCell";
//        }
//        $retArray['cellColor'] = $cellColor;
//        $retArray['cellValue'] = $cellValue;
//        return $retArray;
//    }
}

?>
