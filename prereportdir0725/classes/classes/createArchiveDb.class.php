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
        $db = SingletonDb::getInstance();
         echo "db";
         $this->_archive_data_db_mysqli = $db->getSeawebArchiveDbConnection();
         $this->_current_pv_data_db_mysqli = $db->getSeawebPrimeveraDbConnection();
            echo "dbdddd";
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
        $fullPathDumpFile="/proj/.web_webnpidev/html/prereport/";
        $dbHostName =  "mysql02-atx";
        $unzippedDumpfile = $this->createDumpFile($zippedDumpFileName, $fullPathDumpFile);
         // now truncate previous data
        //echo $unzippedDumpfile;
        $this->createEmptyDb($archiveDatabaseName);
        $this->createDumpedArchiveDb($unzippedDumpfile, $dbHostName, $archiveDatabaseName);
        
       
        
    }
    function getArchiveData($region){ 
       // echo "36436<br>";
        $archive = $this->getResourceAvailData($region, $this->_archive_data_db_mysqli);
        $this->compareAvailability($archive, $archive);
        //echo "56<br>";
        
    }
    
    function compareAvailability($archive, $current){
        $allArchiveRolesResourceArr = $archive["allRoleResources"];
        foreach ($allArchiveRolesResourceArr as $oneRoleResources){
            $allResources = $oneRoleResources["allResources"];
            foreach ( $allResources as $oneResource){
                echo print_r($oneResource)."<br>";
            }
        }
    }
    function getCurrentData($region){ 
        $this->getResourceAvailData($region, $this->_current_pv_data_db_mysqli);
    }
            
    function getResourceAvailData($region, $whichDb) {
//         return;
        echo "0<br>";
        $retArray = array();
        $dataArray = array();
        $allDateArray = array();
        //  $allRegions = $this->getRegions();
        $allRoles = array();
        $concat = '';
        $allRolesResourceArr = array();
        $allProjectsArr = $this->getProjectPerRegion($region, $whichDb);
        $allProjectsStr = "('" . implode("' , '", $allProjectsArr) . "' )";
        echo "1<br>";
        $allDateColSqlResult = $whichDb->
                query("SELECT DISTINCT startdate 
                       FROM resourcespread_tb 
                       WHERE startdate >= '" . date('Y-m-01') . "'
                       AND startdate <= '" . date('Y-m-01', strtotime('+20 month')) . "'");
        $count = 0;
           echo "1<br>";
        while ($oneRow = mysqli_fetch_array($allDateColSqlResult)) {
            $allDateArray[] = $oneRow['startdate'];
            $concat = $concat . " sum(case when startdate = '" . $oneRow['startdate'] . "' then (val.units/val.max_hours)*100 end) AS '" . $oneRow['startdate'] . "',";
            $count++;
        }
           echo "2<br>";
        $concat = substr($concat, 0, -1);
        // foreach ($allRoles as $oneRole) {
        //   $allResourcesArr = $this->getAllResources($allProjectsArr, $oneRole, FALSE);
        //  echo print_r($allResourcesArr);
        //get availabilty
        $getResourceAvailabilityQuery = "SELECT  assignment.resource_name, val.resourceobjid, assignment.prim_role_id ," . $concat . " 
            FROM  resourceassignment_tb assignment , resourcespread_tb val
            Where assignment.objid = val.resourceobjid 
            AND assignment.active ='true'
            AND assignment.project_name in $allProjectsStr
            GROUP BY val.resourceobjid";
        $allResourceAvailabilitySqlResult = $whichDb->query($getResourceAvailabilityQuery);
   echo "3<br>";
        while ($oneRow = mysqli_fetch_array($allResourceAvailabilitySqlResult)) {
            $oneResource = array();
            //$allRolesResourceArr[] = $oneRow['prim_role_id'];
            if (FALSE === array_key_exists($oneRow["prim_role_id"], $allRolesResourceArr)) {
                $allRolesResourceArr[$oneRow['prim_role_id']] = array();
                $allRoles[] = $oneRow['prim_role_id'];
            }
             //  echo "4<br>";
            $oneResource['resource_name'] =  $oneRow['resource_name'] ;
            $oneResource['resourceobjid'] =  $oneRow['resourceobjid'] ;
         //  echo $oneResource['resource_name'] ."  ";
            foreach ($allDateArray as $oneDate) {
                $oneResource[$oneDate] =intval($oneRow[$oneDate]);
                //   echo $oneResource[$oneDate] ."  ";
                if (FALSE === array_key_exists($oneRow['prim_role_id'] . $oneDate, $allRolesResourceArr[$oneRow['prim_role_id']])) {
                    $allRolesResourceArr[$oneRow['prim_role_id']][$oneRow['prim_role_id'] . $oneDate] = 0;
                }
                if(!empty($oneRow[$oneDate]) && $oneRow[$oneDate] != 0){
                $allRolesResourceArr[$oneRow['prim_role_id']][$oneRow['prim_role_id'] . $oneDate] =
                        $allRolesResourceArr[$oneRow['prim_role_id']][$oneRow['prim_role_id'] . $oneDate] + intval($oneRow[$oneDate]);
                }
            }
            //put the resource into role arr
        //   echo "<br>";
            $allRolesResourceArr[$oneRow['prim_role_id']]["allResources"][] = $oneResource;
        }
     //echo "78<br>";
        $dataArray["allRoleResources"] = $allRolesResourceArr;
        $dataArray["allRoles"] = $allRoles;
        $dataArray["allDates"] = $allDateArray;
        $retArray["response"] = $dataArray;
         // echo print_r($allRolesResourceArr);
         return $dataArray;
        // }
    }
    
      function getProjectPerRegion($region, $whichDb) {
        $getProjectsMysqlQuery = "SELECT id FROM project_tb where region ='" . $region . "'";
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
