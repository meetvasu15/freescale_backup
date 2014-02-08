<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'classes/generateReport.class.php';
try{
    $getReport = new generateReport();
     $getReport->getAllReportData(); 
}catch(Exception $e){
  echo  $e->getMessage();
}
?>