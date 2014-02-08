<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParseCSV
 *
 * @author B45802
 */
class ParseCSV {

    //put your code here
    var $file_handle;

    function ParseCSV($absolutefilePath) {
        if (empty($absolutefilePath) || !isset($absolutefilePath)) {
            echo "ERROR: Didn't get .csv file path";
            return;
        } else {
            if (is_readable($absolutefilePath)) {
                if (filesize($absolutefilePath) <= 0) {
                    echo "CSV File read is empty";
                    return;
                }
                $this->file_handle = fopen($absolutefilePath, "r");
            } else {
                echo "ERROR: CSV file not readable";
                return;
            }
        }
    }

    function parse($colsToFetchArr) {
        $isFirstRow = TRUE;
        $valIndxArray = Array();
        $indxOfOperation;
        $indxOfProjType;
        $indexOfStatus;
        $count = 0;
        $retDataArr = Array();
        while (!feof($this->file_handle)) {

            $dataReadArr = fgetcsv($this->file_handle, 0, "\n");
            //compute which indexes to iterate: header
            if ($isFirstRow) {
                $isFirstRow = FALSE;
                if (array_key_exists(0, $dataReadArr)) {
                    $headRowArr = str_getcsv($dataReadArr[0], ",");
                    //$headRowArr = explode(",", $dataReadArr[0]);
                    $allColumnValuesArr = array_keys($colsToFetchArr);
                    //echo print_r($allColumnValuesArr) . "<br>";
                    foreach ($headRowArr as $key => $val) {
                        // echo " val ".$val."<br>";
                        if (FALSE !== array_search(trim($val), $allColumnValuesArr)) {
                            $valIndxArray[$key] = $val;
                            // echo "key : ".$key." val : ".$val;
                            //search for operations
                            if ($val == "Operation") {
                                $indxOfOperation = $key;
                            } else if ($val == "Proj Type") {
                                $indxOfProjType = $key;
                            }else if ($val == "Status") {
                                $indexOfStatus = $key;
                            }
                        }
                    }
                }
                if (!isset($indxOfOperation) || !isset($indxOfProjType) ||  !isset($indexOfStatus)) {
                    echo "Didnt get operations or project type in csv file";
                    return;
                }
                //echo print_r($valIndxArray);
            } else {
                // go over the data now
                //echo print_r($valIndxArray);
                if ($dataReadArr && array_key_exists(0, $dataReadArr) ) {
                   // $oneRowArr = explode(",", $dataReadArr[0]);
                   $oneRowArr =   str_getcsv($dataReadArr[0], ",");
                    //check is it AMPG? 
                    if ($oneRowArr && count($oneRowArr) > 2 &&$oneRowArr[$indxOfOperation] && $oneRowArr[$indxOfProjType] 
                            &&  $oneRowArr[$indxOfOperation] == $colsToFetchArr['Operation'] 
                            && (FALSE !== array_search($oneRowArr[$indxOfProjType], $colsToFetchArr['Proj Type']))
                            && (FALSE !== array_search($oneRowArr[$indexOfStatus], $colsToFetchArr['Status']))) {
                        $oneRetRow = Array();
                        $count =0;
                        foreach ($valIndxArray as $key => $val) {
                          //  echo  $allColumnValuesArr[$count]."<br>";
                            $oneRetRow[ $val] = $oneRowArr[$key];
                            $count++;
                        }
                        $retDataArr[] = $oneRetRow;
                    }
                }
            }
        }

        fclose($this->file_handle); 
        return $retDataArr;
    }

//    function removeQuotes($strArr) {
//        foreach ($strArr as $val) {
//            
//        }
//    }

}

?>
