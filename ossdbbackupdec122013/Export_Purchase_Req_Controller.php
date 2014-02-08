<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'classes/ExportPurchaseReq.class.php';
$read = new ExportPurchaseReq();
  $read->exportPurchaseReqExcel();
?>
