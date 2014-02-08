<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PurchaseService
 *
 * @author B45802
 */
require_once 'classes/SingletonDb.class.php';
require_once 'classes/Constants.php';
require_once 'classes/sheetDbColumnMapping.php';

class PurchaseService {

    //put your code here
    private $mysqli;
   // private $allValuesArray = array();
    function PurchaseService() {
        $db = SingletonDb::getInstance();
        $this->mysqli = $db->getOssDbConnection();
    }

    function saveUpdatePurchase($purchaseObj) {
        
        $valueArray = array();
        $allValuesArray = array();  
           $sheetDBColMap = $GLOBALS['requisitionSheetDBColMap'];
            $dbHeader = array_values($sheetDBColMap);
            $newDbHeader = array();
            $lengthYet=0;
         $numAt = array();
         if (isset($_GET["system_id"]) && !empty($_GET["system_id"])){
            $system_id = $purchaseObj["system_id"];
         // $valueArray[]=$system_id;
            $numAt[]=$lengthYet;
            $lengthYet=$lengthYet+1;
        }
        $pr_number="";
        if (isset($_GET["pr_number"]) && !empty($_GET["pr_number"])){
            $pr_number = $purchaseObj["pr_number"]; 
            $numAt[]=$lengthYet;
            $lengthYet=$lengthYet+1;
        } 
         $pr_line="" ;
        if (isset($_GET["pr_line"]) && !empty($_GET["pr_line"])){
            $pr_line = $purchaseObj["pr_line"];
            $numAt[]=$lengthYet;
            $lengthYet=$lengthYet+1;
            //$valueArray[]=$pr_line;
        }
        $po_number="";
        if (isset($_GET["po_number"]) && !empty($_GET["po_number"])){
            $po_number = $purchaseObj["po_number"];
            $numAt[]=$lengthYet;
            $lengthYet=$lengthYet+1;
            //$valueArray[]=$po_number;
        }
        $gl_account="";
        if (isset($_GET["gl_account"]) && !empty($_GET["gl_account"])){
            $gl_account = $purchaseObj["gl_account"];
            $numAt[]=$lengthYet;
            $lengthYet=$lengthYet+1;
           // $valueArray[]=$gl_account;
        }
        $cost_center="";
        if (isset($_GET["cost_center"]) && !empty($_GET["cost_center"])){
            $cost_center =  $purchaseObj["cost_center"] ;
            $lengthYet=$lengthYet+1;
            //$valueArray[]=$cost_center;
        }
        $requestor="";
        if (isset($_GET["requestor"]) && !empty($_GET["requestor"])){
            $requestor =   $purchaseObj["requestor"] ;
            $lengthYet=$lengthYet+1;
           // $valueArray[]=$requestor;
        }
        
        $budget_line_item="";
        if (isset($_GET["budget_line_item"]) && !empty($_GET["budget_line_item"])){
            $budget_line_item =   $purchaseObj["budget_line_item"] ;
            $lengthYet=$lengthYet+1;
           // $valueArray[]=$budget_line_item;
        }
        $vendor="";
        if (isset($_GET["vendor"]) && !empty($_GET["vendor"])){
            $vendor =  $purchaseObj["vendor"] ;
            $lengthYet=$lengthYet+1;
           // $valueArray[]=$vendor;
        }
        $description="";
        if (isset($_GET["description"]) && !empty($_GET["description"])){
            $description =  $purchaseObj["description"] ;
            $lengthYet=$lengthYet+1;
           // $valueArray[]=$description;
        }
        $status="";
        if (isset($_GET["status"]) && !empty($_GET["status"])){
            $status =  $purchaseObj["status"] ;
            $lengthYet=$lengthYet+1;
            //$valueArray[]=$status;
        }
        $amount="";
        if (isset($_GET["amount"]) && !empty($_GET["amount"])){
            $amount = $purchaseObj["amount"]; 
            $numAt[]=$lengthYet;
            $lengthYet=$lengthYet+1;
            //$valueArray[]=$amount;
        }
        $year="";
        if (isset($_GET["year"]) && !empty($_GET["year"])){
            $year = $purchaseObj["year"];
            $lengthYet=$lengthYet+1;
            //$valueArray[]=$year;
        }
        $currency="";
        if (isset($_GET["currency"]) && !empty($_GET["currency"])){
            $currency =   $purchaseObj["currency"] ;
            $lengthYet=$lengthYet+1;
            //$valueArray[]=$currency;
        }
        $date_approved="";
        if (isset($_GET["date_approved"]) && !empty($_GET["date_approved"])){
            $date_approved =  $purchaseObj["date_approved"];
            //$valueArray[]=$date_approved;
        } 
       //  $nextInsertID = $this->generateNextSystemId();
        $headerLength = count($dbHeader);
        $newDbHeader[] ="system_id";
        $dbHeader[]="year";
        $valueArray[]=$this->generateNextSystemId();
        //for($i = 0 ; $i<$headerLength ; $i++){
            foreach ($dbHeader as $value) { 
            if(array_key_exists( $value,$purchaseObj )){
            $valueArray[]=$purchaseObj[$value];
            $newDbHeader[] = $value   ;
            
            }
        }
        $saveUpdateSqlQuery = "";

      //  echo print_r($numAt)."<br>";
    //    echo print_r($newDbHeader)."<br>";
        if (FALSE === array_key_exists("system_id", $purchaseObj)) {
            // its a new purchase 
//            $saveUpdateSqlQuery = "INSERT INTO purchase_requisition 
//                ( pr_number , pr_line , po_number , 
//                gl_account , cost_center , requestor , budget_line_item , 
//                vendor , description , status , amount , currency , date_approved, year )
//                VALUES ( " . $pr_number . " , " . $pr_line . " , " . $po_number . " , 
//                " . $gl_account . " , '" . $cost_center . "' , '" . $requestor . "' , '" . $budget_line_item . "' , 
//                '" . $vendor . "' , '" . $description . "' , '" . $status . "' , " . $amount . " , '" . $currency . "' , '" . $date_approved . "' , " . $year . ")";
          $allValuesArray=  $this->createAllValArr($allValuesArray, $valueArray, $numAt);
        $saveUpdateSqlQuery =   $this->createInsertSql("purchase_requisition", $newDbHeader, $allValuesArray);
        //echo $saveUpdateSqlQuery;
        } else {
            //its a old purchase
            $system_id = $purchaseObj["system_id"];
            $saveUpdateSqlQuery = "UPDATE purchase_requisition SET ";
            if(isset($pr_number)&& !empty($pr_number) && $pr_number!== "")
              $saveUpdateSqlQuery .=  " pr_number= " . $pr_number ;
            if(isset($pr_line)&& !empty($pr_line) && $pr_line!== "")
              $saveUpdateSqlQuery .=     ", pr_line=" . $pr_line ;
            if(isset($po_number)&& !empty($po_number) && $po_number!== "")
              $saveUpdateSqlQuery .=     ", po_number=" . $po_number ;
            if(isset($gl_account)&& !empty($gl_account) && $gl_account !== "")
             $saveUpdateSqlQuery .=       " ,gl_account=" . $gl_account ;
            if(isset($cost_center)&& !empty($cost_center) && $cost_center!== "")
             $saveUpdateSqlQuery .=       " ,cost_center ='" . $cost_center."'" ; 
            if(isset($requestor)&& !empty($requestor) && $requestor!== "")
             $saveUpdateSqlQuery .=       " ,requestor ='" . $requestor."'"   ;
            if(isset($budget_line_item)&& !empty($budget_line_item) && $budget_line_item!== "")
             $saveUpdateSqlQuery .=       " ,budget_line_item ='" . $budget_line_item."'" ; 
            if(isset($vendor)&& !empty($vendor) && $vendor!== "")
             $saveUpdateSqlQuery .=       " , vendor ='" . $vendor."'"; 
            if(isset($description)&& !empty($description) && $description!== "")
             $saveUpdateSqlQuery .=       " ,description ='" . $description."'" ; 
            if(isset($status)&& !empty($status) && $status!== "")
             $saveUpdateSqlQuery .=       " ,status ='" . $status ."'"; 
            if(isset($amount)&& !empty($amount) && $amount!== "")
             $saveUpdateSqlQuery .=       " ,amount =" . $amount ; 
            if(isset($currency)&& !empty($currency) && $currency!== "")
            $saveUpdateSqlQuery .=        " , currency  ='" . $currency ."'"; 
            if(isset($date_approved)&& !empty($date_approved) && $date_approved!== "")
           $saveUpdateSqlQuery .=         " ,date_approved ='" . $date_approved."'" ; 
            if(isset($year)&& !empty($year) && $year!== "")
           $saveUpdateSqlQuery .=         " ,year =" . $year ;  
            $saveUpdateSqlQuery .=        " WHERE system_id = " . $system_id;
        }
       // echo $saveUpdateSqlQuery;
        $this->mysqli->query($saveUpdateSqlQuery) or die(mysqli_error($this->mysqli));
        $retArray=array();
        $response= array();
        $retArray["response"]=$response;
        echo json_encode($retArray);
        
    }
function createAllValArr($allValuesArray, $valueArray, $numAt) {

        foreach ($valueArray as $key => &$val) {

            if (!in_array($key, $numAt)) {

                $val = addslashes($val);
                $val = "'" . $val . "'";
            }
            if ((!isset($val) || $val == "" || empty($val)) && in_array($key, $numAt)) {
                $val = 0;
            }
        }
        $valueStr = implode(" , ", $valueArray); // creating value string 
        $valueStr = " ( " . $valueStr . " ) ";
        array_push($allValuesArray, $valueStr);
        return $allValuesArray;
    }

    function createInsertSql($tableName, $columnArray, $allValuesArray) {

        //echo \print_r($allValuesArray);
        $sqlStmnt = "INSERT INTO " . $tableName . " ( "; // creating inser statement 
        $columnStr = implode(" , ", $columnArray); // creating coulmn string
        $valueStr = implode(" , ", $allValuesArray);
        $sqlStmnt = $sqlStmnt . $columnStr . " ) VALUES " . $valueStr; // joining everything together
        return $sqlStmnt;
    }
    function getAllPurchases($year) {
        $retArray = array();
        $allPurchasesArray = array();
        $getTableDataSqlQuery = "SELECT * FROM seaweb_oss_db.purchase_requisition WHERE year=" . $year;
        $allReqSqlResult = $this->mysqli->query($getTableDataSqlQuery);
        $purchaseTableHeader = $GLOBALS["purchaseReqHeader"];
        while ($oneRow = mysqli_fetch_array($allReqSqlResult)) {
            $onePurchase = array();
            foreach ($purchaseTableHeader as $oneCol) {
                // echo  $oneRow[$oneCol]."<br>";
                $onePurchase[$oneCol] = $oneRow[$oneCol];
            }
            $allPurchasesArray[] = $onePurchase;
        }
        $response["allPurchasesArray"] = $allPurchasesArray;
        $retArray["response"] = $response;
        echo json_encode($retArray);
    }

    function getAllPurchaseYears() {
        $retArray = array();
        $allPurchasesYearArray = array();
        $getAllYearSqlQuery = "SELECT DISTINCT year FROM seaweb_oss_db.purchase_requisition";
        $allYearSqlResult = $this->mysqli->query($getAllYearSqlQuery);
        while ($oneRow = mysqli_fetch_array($allYearSqlResult)) {
            $year = $oneRow['year'];
            if (isset($year) && $year != "")
                $allPurchasesYearArray[] = $year;
        }
        $response["allYearArray"] = $allPurchasesYearArray;
        $retArray["response"] = $response;
        echo json_encode($retArray);
    }
    
    function deletePurchase($system_id){
         $deletePurchaseSqlQuery = "DELETE FROM seaweb_oss_db.purchase_requisition Where system_id=".$system_id;
         $this->mysqli->query($deletePurchaseSqlQuery);
         $retArray=array();
        $response= array();
        $retArray["response"]=$response;
        echo json_encode($retArray);
    }
function generateNextSystemId() {
        $largestIDResult = $this->mysqli->query('select max(system_id) from purchase_requisition');
        if ($largestIDResult && mysqli_num_rows($largestIDResult) == 1) {
            $largestID = mysqli_fetch_row($largestIDResult);
            // echo $largestID[0];
            return $largestID[0] + 1;
        } else {
            return 1;
        }
    }

}

?>
