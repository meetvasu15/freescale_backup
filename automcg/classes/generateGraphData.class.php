<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of generateGraphData
 *
 * @author B45802
 */
require_once 'includes/global.inc.php';

class generateGraphData {
    var $getAllRolesSql = "SELECT DISTINCT resource_role from autoPVData";
     var $getAllRolesGraphDataSql = "SELECT DISTINCT resource_role from graphData";
    var $getAllMonthsGraphDataSql = "SELECT DISTINCT apv_month from graphData";
    var $getAllSystemIdWRoleSql = "SELECT system_id from autoPVData where resource_role = '";
    var $deleteGraphData = "DELETE FROM graphData";
    var $allGraphData = array();
     var $allRoles = array();
     var $dataTable = array();
     
     var $headerArray = array();
      var $allMonthsGraphData = array();
     var $insertAllRolesValSql = "INSERT INTO graphData (resource_role, apv_month, role_value) VALUES ";
     private $mysqli;

            public function __construct() 
            { 
               $db = SingletonDb::getInstance(); 
               $this->mysqli = $db->getConnection();
            } 
            
    function calculateGraphData(){ 
       
      $allRolesSqlResult =  $this->mysqli->query( $this->getAllRolesSql) or die(mysqli_error($this->mysqli)); 
      while($oneRow = mysqli_fetch_array( $allRolesSqlResult )){
          $this->getAllSystemId ($oneRow['resource_role']);
      }
      // insert the graph data
      $allgraphDataInserts = implode(" , ", $this->allGraphData);
        //echo "insert all rows sql <br>".$this->insertAllRolesValSql.$allgraphDataInserts." <br>";
       $this->mysqli->query($this->deleteGraphData) or die(mysqli_error($this->mysqli)); 
      $this->mysqli->query($this->insertAllRolesValSql.$allgraphDataInserts) or die(mysqli_error($this->mysqli)); 
    }
    
    function getAllSystemId ($role){
        $allSystemIdRoleSqlStmnt = $this->getAllSystemIdWRoleSql;
        $allSystemId = Array();
         //echo "getAllSystemId sql <br>".$allSystemIdRoleSqlStmnt.$role."'  <br>";
        $allSystemIdRoleSqlResult =  $this->mysqli->query($allSystemIdRoleSqlStmnt.$role."' " ) or die(mysqli_error($this->mysqli)); 
      while($oneRow = mysqli_fetch_array( $allSystemIdRoleSqlResult )){
          $allSystemId[] = $oneRow['system_id'];
      }
       $this->createMonthlyData(array_values($allSystemId), $role);
    }
    
    function createMonthlyData($allSystemId, $role){
        $role = addslashes($role);
        $allSystemIdSqlStr = "( ".implode(" , ", $allSystemId)." )";
        $getAllMonthValuesSqlStmt = "SELECT apv_month, SUM(resource_value) as val FROM autoPVMonthlyValue WHERE system_id IN ".$allSystemIdSqlStr." GROUP BY apv_month";
         // echo " createMonthlyData sql <br>".$getAllMonthValuesSqlStmt." <br>";
        $allMonthValuesSqlRslt = $this->mysqli->query( $getAllMonthValuesSqlStmt) or die(mysqli_error($this->mysqli)); 
          while($oneRow = mysqli_fetch_array( $allMonthValuesSqlRslt )){
             $this->allGraphData[] = " ( '".$role."' , '".$oneRow['apv_month']."' , ".$oneRow['val']." )";
            // echo "graph data values :::".print_r($this->allGraphData);
          }
        
    }
    
    function getUIGraphArray(){
        $this->createDataTable();
        $retArray = array();
        
        $retArray[]=$this->headerArray;
        foreach ($this->dataTable['months'] as $oneMonth){
            $oneArray = array();
            $oneArray[] = $oneMonth; 
            foreach ($this->dataTable['allRoles'] as $oneRole){
                if (array_key_exists($oneMonth, $this->dataTable[$oneRole])) {
                     $oneArray[] = floatval($this->dataTable[$oneRole][$oneMonth]) ;
                }else{
                      $oneArray[] = 0;
                }
            } 
            $retArray[]=$oneArray;
        }
        return $retArray;
    }
    function getAllRoles(){
        array_shift($this->headerArray);
       // echo print_r($this->headerArray);
        return $this->headerArray;
    }
            function createDataTable(){
         $this->headerArray[] = "Month";
       //  echo $this->getAllRolesGraphDataSql."<br>";
        $allRolesSqlResult =  $this->mysqli->query( $this->getAllRolesGraphDataSql) or die(mysqli_error($this->mysqli));
            while($oneRow = mysqli_fetch_array( $allRolesSqlResult )){
                    $oneRole=$oneRow['resource_role'];
                    $this->allRoles[] = $oneRole; 
                    $this->headerArray[] = $oneRole; 
                  $this->dataTable[$oneRole] =   $this->getMonthlyData($oneRole);
              }
     // echo $this->getAllMonthsGraphDataSql."<br>";
       $allMonthsSqlResult =   $this->mysqli->query( $this->getAllMonthsGraphDataSql) or  die(mysqli_error($this->mysqli));
            while($oneRow = mysqli_fetch_array( $allMonthsSqlResult )){
             $this->allMonthsGraphData[] = $oneRow['apv_month'];
      }
            $this->dataTable['months']=$this->allMonthsGraphData;
             $this->dataTable['allRoles']=$this->allRoles;
              $this->dataTable['headerArray']=$this->headerArray;
            return  $this->dataTable;
    }
    
    function getMonthlyData($role){
        $roleValueArr = array();
        $monthlyRoleDataSqlStmt = "SELECT apv_month, role_value FROM graphData WHERE resource_role ='".$role."'";
       //  echo  $monthlyRoleDataSqlStmt."<br>";
        $monthlyRoleDataSqlRslt =  $this->mysqli->query($monthlyRoleDataSqlStmt) or  die(mysqli_error($this->mysqli));
         while($oneRow = mysqli_fetch_array( $monthlyRoleDataSqlRslt )){
             $roleValueArr[$oneRow['apv_month']]=$oneRow['role_value'];
         }
//         echo $role."<br>";
//         print_r ($roleValueArr);
//          echo $role."<br>";
        return $roleValueArr;
    }
}

?>
