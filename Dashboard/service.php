<?php
// is this a request?
if (empty($_GET['service'])) {
  die();
}
// get the business logic
require_once 'classes/GetNPIData.class.php';
require_once 'classes/GetIpData.class.php';
require_once 'classes/GetResourseAssignment.class.php';
require_once 'classes/ReadExcel.class.php';
require_once 'classes/BurndownIngestion.class.php';
require_once 'classes/ErrataChartData.class.php';
require_once 'classes/SaveUpdateErrataPdm.class.php';

 
// figure out the request
// and call the business logic object
switch ($_GET['service']) 
{
  case 'GetNPIData':
    echo GetNpiDataSever();
    break;
case 'GetIpData':
    echo GetIpDataSever();
    break;
case 'GetIpDataPv':
    echo GetIpPvDataSever();
    break;
  case 'GetQmsHtml':  
    echo GetQmsHtmlHandler();
    break;

 case 'GetIpQmsHtml':  
    echo GetIpQmsHtmlHandler();
    break;
 case 'GetRRHtml':  
    echo GetRRHtmlHandler();
    break;
case 'GetQmsComponentId':  
    echo GetQmsComponentIdHandler();
    break;
 case 'GetEnterpriseData':  
    echo GetEnterpriseRegionHandler();
    break;
  case 'UploadBurndownExcel':
    echo UploadBurdownExcelHandler();
    break;
  case 'GetBurndownChart':
    echo getBurdownChartHandler();
    break;
  case 'GetErrataChart':
    echo getErrataChartHandler();
   break;
  case 'SaveUpdateNpiPdmMap':
    echo saveUpdateNpiPdmMap();
   break;

}

function GetNpiDataSever(){
     $Obj = new GetNPIData();
      $Obj->createNPIData();
}

function GetIpDataSever(){
     $Obj = new GetIpData();
      $Obj->createIpData();
}

function GetIpPvDataSever(){
     $Obj = new GetIpData();
      $Obj->createIpPVData();
}

function GetQmsHtmlHandler(){
    //$projectName = $_GET['projectName'];
     $projectName = decodeParamter($_GET['projectName']);
      $Obj = new GetNPIData();
      $Obj->getQMSData($projectName);
}
    function GetIpQmsHtmlHandler(){
        //$projectName = $_GET['projectName'];
         $npi_id = decodeParamter($_GET['obj_id']);
          $Obj = new GetNPIData();
          $Obj->getIpQMSData($npi_id);
    }
function GetRRHtmlHandler(){
    //$projectName = $_GET['projectName'];
       $npi_id = decodeParamter($_GET['npi_id']);
      $Obj = new GetNPIData();
      $Obj->getRRHtml($npi_id);
}

function GetEnterpriseRegionHandler(){
    //$projectName = $_GET['projectName'];
     $region = decodeParamter($_GET['region']);
      $Obj = new GetResourseAssignment();
      $Obj->getResourceAvailData($region);
}
function GetQmsComponentIdHandler(){
     $npi_id = decodeParamter($_GET['obj_id']);
      $Obj = new GetNPIData();
      $Obj->getQMSComponentId($npi_id);
}
function decodeParamter($param){
    return str_replace("***", " ", $param);
}

function UploadBurdownExcelHandler(){
     $npi_id = decodeParamter($_POST['npi_id']);
      $chart_type = decodeParamter($_POST['burndownChartType']);
  
    $workbook = new ReadExcel();
    $worksheet = $workbook->ReadExcelSheet();
    $tableGenerator = new BurndownIngestion();
    $tableGenerator->generateDataTable($npi_id,$chart_type, $worksheet);
}

function getBurdownChartHandler(){
     $npi_id = decodeParamter($_GET['npi_id']);
      $chart_type = decodeParamter($_GET['burndownChartType']);

    $tableGenerator = new BurndownIngestion();
    $tableGenerator->getChartData($npi_id,$chart_type);
}

function getErrataChartHandler(){
      $npi_id = decodeParamter($_GET['npi_id']);
      $Obj = new ErrataChartData(); 
      $Obj->getErrataChartData($npi_id);
}

function saveUpdateNpiPdmMap(){
    $npi_id= decodeParamter($_GET['npi_id']);
    $pdm_partNumber =   decodeParamter($_GET['pdmPartNumber']);
    $obj = new SaveUpdateErrataPdm();
    $obj->saveUpdate($npi_id, $pdm_partNumber);
    
}
?>