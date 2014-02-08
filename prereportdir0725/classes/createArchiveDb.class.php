<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of createArchiveDb
 *
 * @author B45802
 */
require_once 'classes/SingletonDb.class.php';
class createArchiveDb {
    //put your code here
    private $_archive_data_db_mysqli;
     private $_current_pv_data_db_mysqli;
    function createArchiveDb(){
       //   echo "db11";
        $db = SingletonDb::getInstance();
      //    echo "db";
         $this->_archive_data_db_mysqli = $db->getSeawebArchiveDbConnection();
         $this->_current_pv_data_db_mysqli = $db->getSeawebPrimeveraDbConnection();
      //      echo "dbdddd";
    }
    
    function createEmptyDb($databaseName){
        $truncateSqlQuery = "DROP DATABASE ".$databaseName;
        $this->_archive_data_db_mysqli->query($truncateSqlQuery);
        //create a database
        $createDbSql = "CREATE DATABASE ".$databaseName;
        $this->_archive_data_db_mysqli->query($createDbSql);
    }
    
    function createDumpFile($fileName, $fullPath){
        $fullFileName = escapeshellarg($fullPath.$fileName);
     //   echo "fullFileName exec : ". 'gunzip ' . $fullFileName."<br>"; 
       exec("cp ".$fullPath.$fileName." /tmp/".$fileName); 
        $execute = 'gunzip /tmp/' . $fileName;
        exec($execute, $outarr);
        //copy it to tmp location
        $outfileName = str_replace('.gz', '', $fileName);
       //  echo "cp ".$fullPath.$outfileName." /tmp/".$outfileName."<br>";
      // exec("rm ".$fullPath.$outfileName);
        return "/tmp/".$outfileName ; // return full file name
    }
    
    function createDumpedArchiveDb($fullDumpfileName, $databaseHost, $archiveDatabaseName){
        $executionCmd = "/usr/bin/mysql -h ".$databaseHost." -u seaweb -pwebmaster ".$archiveDatabaseName." < ".$fullDumpfileName." >/dev/null &";
         //echo "<br>".$executionCmd."<br>";
         exec($executionCmd);
    }
    
    function refreshArchiveDb($zippedDumpFileName){
        $archiveDatabaseName ="seaweb_pv_archive_db";
        $fullPathDumpFile="/proj/.web_webnpidev/html/prereport/archive/";
        $dbHostName =  "mysqldev01-atx";
        $unzippedDumpfile = $this->createDumpFile($zippedDumpFileName, $fullPathDumpFile);
         // now truncate previous data
         //echo $unzippedDumpfile;
        $this->createEmptyDb($archiveDatabaseName);
        $this->createDumpedArchiveDb($unzippedDumpfile, $dbHostName, $archiveDatabaseName);
        
       
        
    }
    function getArchiveDataComparison($region){ 
       // echo "36436<br>";
        $archive = $this->getResourceAvailData($region, $this->_archive_data_db_mysqli);
        
        $current =  $this->getResourceAvailData($region, $this->_current_pv_data_db_mysqli);
       $retArr["response"]= $this->compareAvailability($archive, $current);
       $retArr["allDates"]=$current["allDates"];
       $retArr["allRegions"]=$this->getRegions();
       return $retArr;
        //echo "56<br>";
        
    }
    function getRegions() {
        $allRegions = array();
        $getRegionsMysqlQuery = "SELECT DISTINCT region FROM project_tb";
        $allRegionsSqlResult = $this->_current_pv_data_db_mysqli->query($getRegionsMysqlQuery);
        if ($allRegionsSqlResult && mysqli_num_rows($allRegionsSqlResult) > 0) {
            while ($oneRow = mysqli_fetch_array($allRegionsSqlResult)) {
                $allRegions[] = $oneRow['region'];
            }
        } else {
            echo "Could not get regions";
        }
        return $allRegions;
    }
    function compareAvailability($archive, $current){
        $retArray = array();
        $allInserted = array();
        
        $allArchiveRolesResourceArr = $archive["allRoleResources"];
        $allCurrentResourceArr = $current["allResourcesById"];
        $allDates = $current["allDates"];
        $allProjectsArr =  $current["allProjects"];
        //echo "current object received<br>".print_r($allCurrentRolesResourceArr)."<br>";
        foreach ($allProjectsArr as $oneRoleResources){
            $oneProjectArr = array();
            $allArchiveResources = $allArchiveRolesResourceArr[$oneRoleResources]["allResources"];
          //  $allCurrentResources = $allCurrentRolesResourceArr[$oneRoleResources]["allResources"];
            foreach ( $allArchiveResources as $oneResource){
                 if ($oneResource["resourceobjid"]){
                    $currResource = $allCurrentResourceArr[$oneResource["resourceobjid"]];
                     foreach ($allDates as $oneDate){
                        if($currResource[$oneDate] && $oneResource[$oneDate] && $currResource[$oneDate] != $oneResource[$oneDate] 
                              && FALSE === array_search($currResource["resourceobjid"], $allInserted)
                                ){
                           
                            $oneProjectArr[]=$currResource;
                            $oneProjectArr[]=$oneResource; 
                      $allInserted[] = $currResource["resourceobjid"];
                      //    echo print_r($oneResource)."<br>current";

                     //   echo  print_r( $allCurrentResourceArr[$oneResource["resourceobjid"]])."<br>end<br>";
                        }
                    }
                 }
            }
            $retArray[$oneRoleResources]=  $oneProjectArr;
        }
        $retArray["allProjects"] = $allProjectsArr ;
        return $retArray;
    }
    function getCurrentData($region){ 
        $this->getResourceAvailData($region, $this->_current_pv_data_db_mysqli);
    }
            
    function getResourceAvailData($region, $whichDb) {
//         return;
       // echo "0<br>";
        $retArray = array();
        $dataArray = array();
        $allDateArray = array();
        //  $allRegions = $this->getRegions();
        $allRoles = array();
        $concat = '';
        $allResourcesById = array();
        $allRolesResourceArr = array();
        $allProjectsArr = $this->getProjectPerRegion($region, $whichDb);
        $allProjectsStr = "('" . implode("' , '", $allProjectsArr) . "' )";
       // echo "1<br>";
        $allDateColSqlResult = $whichDb->
                query("SELECT DISTINCT startdate 
                       FROM resourcespread_tb 
                       WHERE startdate >= '" . date('Y-m-01') . "'
                       AND startdate <= '" . date('Y-m-01', strtotime('+20 month')) . "'");
        $count = 0;
         //  echo "1<br>";
        while ($oneRow = mysqli_fetch_array($allDateColSqlResult)) {
            $allDateArray[] = $oneRow['startdate'];
            $concat = $concat . " sum(case when startdate = '" . $oneRow['startdate'] . "' then (val.units/val.max_hours)*100 end) AS '" . $oneRow['startdate'] . "',";
            $count++;
        }
         //  echo "2<br>";
        $concat = substr($concat, 0, -1);
        // foreach ($allRoles as $oneRole) {
        //   $allResourcesArr = $this->getAllResources($allProjectsArr, $oneRole, FALSE);
        //  echo print_r($allResourcesArr);
        //get availabilty
        $getResourceAvailabilityQuery = "SELECT  assignment.resource_name, val.resourceobjid,assignment.project_name , assignment.prim_role_id ," . $concat . " 
            FROM  resourceassignment_tb assignment , resourcespread_tb val
            Where assignment.objid = val.resourceobjid 
            AND assignment.active ='true'
             AND assignment.project_name in $allProjectsStr
            GROUP BY val.resourceobjid";
        //
        $allResourceAvailabilitySqlResult = $whichDb->query($getResourceAvailabilityQuery);
  // echo "3<br>";
        while ($oneRow = mysqli_fetch_array($allResourceAvailabilitySqlResult)) {
            $oneResource = array();
            //$allRolesResourceArr[] = $oneRow['project_name'];
            if (FALSE === array_key_exists($oneRow["project_name"], $allRolesResourceArr)) {
                $allRolesResourceArr[$oneRow['project_name']] = array();
                $allRoles[] = $oneRow['project_name'];
            }
             //  echo "4<br>";
            $oneResource['resource_name'] =  $oneRow['resource_name'] ;
            $oneResource['resourceobjid'] =  $oneRow['resourceobjid'] ;
         //  echo $oneResource['resource_name'] ."  ";
            foreach ($allDateArray as $oneDate) {
                $oneResource[$oneDate] =intval($oneRow[$oneDate]);
                //   echo $oneResource[$oneDate] ."  ";
                if (FALSE === array_key_exists($oneRow['project_name'] . $oneDate, $allRolesResourceArr[$oneRow['project_name']])) {
                    $allRolesResourceArr[$oneRow['project_name']][$oneRow['project_name'] . $oneDate] = 0;
                }
                if(!empty($oneRow[$oneDate]) && $oneRow[$oneDate] != 0){
                $allRolesResourceArr[$oneRow['project_name']][$oneRow['project_name'] . $oneDate] =
                        $allRolesResourceArr[$oneRow['project_name']][$oneRow['project_name'] . $oneDate] + intval($oneRow[$oneDate]);
                }
            }
            //put the resource into role arr
        //   echo "<br>";
            $allResourcesById[ $oneResource['resourceobjid']] = $oneResource;
            $allRolesResourceArr[$oneRow['project_name']]["allResources"][] = $oneResource;
        }
     //echo "78<br>";
        $dataArray["allRoleResources"] = $allRolesResourceArr;
        $dataArray["allRoles"] = $allRoles;
        $dataArray["allDates"] = $allDateArray;
         $dataArray["allProjects"] = $allProjectsArr;
        $retArray["response"] = $dataArray;
        $dataArray["allResourcesById"] =$allResourcesById;
         // echo print_r($allRolesResourceArr);
         return $dataArray;
        // }
    }
    
      function getProjectPerRegion($region, $whichDb) {
        $getProjectsMysqlQuery = "SELECT id FROM project_tb where region ='" . $region . "'";
        //$getProjectsMysqlQuery = "SELECT id DISTINCT FROM project_tb";
        //echo "<br>project regional <br>" . $getProjectsMysqlQuery . "<br>";
        $allProjectsSqlResult = $whichDb->query($getProjectsMysqlQuery);
        $allProjectsArr = array();
        if ($allProjectsSqlResult && mysqli_num_rows($allProjectsSqlResult) > 0) {
            while ($oneRow = mysqli_fetch_array($allProjectsSqlResult)) {
                $allProjectsArr[] = $oneRow['id'];
            }
        }
        return $allProjectsArr;
    }

}

?>
