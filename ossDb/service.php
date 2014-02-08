<?php
// is this a request?
if (empty($_GET['service'])) {
  die();
}
// get the business logic
require_once 'classes/PurchaseService.class.php'; 

 
// figure out the request
// and call the business logic object
switch ($_GET['service']) 
{
  case 'GetPurchaseReq':
    echo GetPurchaseReqHandler();
    break;
  case 'GetPurchaseYear':
      echo GetAllPurchaseYearhandler();
      break;
  case 'SaveUpdatePurchase';
      echo SaveUpdatePurchaseHandler();
      break;
  case 'DeletePurchase':
      echo DeletePurchaseHandler();
      break;

}
function GetPurchaseReqHandler(){
    $year = decodeParamter($_GET['year']);
    $purchaseServiceObj = new PurchaseService();
    $purchaseServiceObj->getAllPurchases($year);
}  
function GetAllPurchaseYearhandler(){
    $purchaseServiceObj = new PurchaseService();
    $purchaseServiceObj->getAllPurchaseYears();
}
function SaveUpdatePurchaseHandler(){
     $purchaseServiceObj = new PurchaseService();
     $purchaseObj = array();
     if(isset($_GET["system_id"]) && !empty($_GET["system_id"]))
          $purchaseObj["system_id"] = decodeParamter($_GET["system_id"]);
      if(isset($_GET["pr_number"]) && !empty($_GET["pr_number"]))
           $purchaseObj["pr_number"] = decodeParamter($_GET["pr_number"]);
      if(isset($_GET["pr_line"]) && !empty($_GET["pr_line"]))
          $purchaseObj["pr_line"] =  decodeParamter($_GET["pr_line"]);
      if(isset($_GET["po_number"]) && !empty($_GET["po_number"]))
          $purchaseObj["po_number"] = decodeParamter($_GET["po_number"]);
      if(isset($_GET["gl_account"]) && !empty($_GET["gl_account"]))
          $purchaseObj["gl_account"] =  decodeParamter($_GET["gl_account"]);
      if(isset($_GET["cost_center"]) && !empty($_GET["cost_center"]))
          $purchaseObj["cost_center"] =  decodeParamter($_GET["cost_center"]);
      if(isset($_GET["requestor"]) && !empty($_GET["requestor"]))
          $purchaseObj["requestor"] = decodeParamter( $_GET["requestor"]);
      if(isset($_GET["budget_line_item"]) && !empty($_GET["budget_line_item"]))
          $purchaseObj["budget_line_item"] =  decodeParamter($_GET["budget_line_item"]);
      if(isset($_GET["vendor"]) && !empty($_GET["vendor"]))
         $purchaseObj["vendor"] =  decodeParamter($_GET["vendor"]);
      if(isset($_GET["description"]) && !empty($_GET["description"]))
          $purchaseObj["description"] =  decodeParamter($_GET["description"]);
      if(isset($_GET["status"]) && !empty($_GET["status"]))
          $purchaseObj["status"] =  decodeParamter($_GET["status"]);
      if(isset($_GET["amount"]) && !empty($_GET["amount"]))
          $purchaseObj["amount"] =  decodeParamter($_GET["amount"]);
      if(isset($_GET["year"]) && !empty($_GET["year"]))
          $purchaseObj["year"] =  decodeParamter($_GET["year"]);
      if(isset($_GET["currency"]) && !empty($_GET["currency"]))
          $purchaseObj["currency"] = decodeParamter($_GET["currency"]);
      if(isset($_GET["date_approved"]) && !empty($_GET["date_approved"]))
          $purchaseObj["date_approved"] =  decodeParamter($_GET["date_approved"]);
      
      
   if(isset($_GET["project"]) && !empty($_GET["project"]))
          $purchaseObj["project"] =  decodeParamter($_GET["project"]);
    if(isset($_GET["requestor"]) && !empty($_GET["requestor"]))
          $purchaseObj["requestor"] =  decodeParamter($_GET["requestor"]);
  
     if(isset($_GET["recurring"]) && !empty($_GET["recurring"]))
          $purchaseObj["recurring"] =  decodeParamter($_GET["recurring"]);
   if(isset($_GET["priority"]) && !empty($_GET["priority"]))
          $purchaseObj["priority"] =  decodeParamter($_GET["priority"]);
  
  
    $purchaseServiceObj->saveUpdatePurchase($purchaseObj);
}
function decodeParamter($param){
    return str_replace("***", " ", $param);
}
function DeletePurchaseHandler(){
     if(isset($_GET["system_id"]) && !empty($_GET["system_id"])){
            $purchaseServiceObj = new PurchaseService();
             $purchaseServiceObj->deletePurchase($_GET["system_id"]);
     }
}
?>