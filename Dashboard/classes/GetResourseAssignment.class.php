<?php

/**
 * Description of GetResourseAssignment
 *
 * @author B45802
 */
require_once 'includes/Constants.php';
require_once 'classes/SingletonDb.class.php';

class GetResourseAssignment {

    //put your code here
    private $_seaweb_pv_db_mysqli;
    private $allRegions = array();

    function GetResourseAssignment() {
        $db = SingletonDb::getInstance();
        $this->_seaweb_pv_db_mysqli = $db->getSeawebPrimeveraDbConnection();
    }

    function getRegions() {
        $getRegionsMysqlQuery = "SELECT DISTINCT region FROM project_tb";
        $allRegionsSqlResult = $this->_seaweb_pv_db_mysqli->query($getRegionsMysqlQuery);
        if ($allRegionsSqlResult && mysqli_num_rows($allRegionsSqlResult) > 0) {
            while ($oneRow = mysqli_fetch_array($allRegionsSqlResult)) {
                $this->allRegions = $oneRow['region'];
            }
        } else {
            echo "Could not get regions";
        }
    }

    function getProjectPerRegion($region) {
        $getProjectsMysqlQuery = "SELECT id FROM project_tb where region ='" . $region . "'";
        //echo "<br>project regional <br>" . $getProjectsMysqlQuery . "<br>";
        $allProjectsSqlResult = $this->_seaweb_pv_db_mysqli->query($getProjectsMysqlQuery);
        $allProjectsArr = array();
        if ($allProjectsSqlResult && mysqli_num_rows($allProjectsSqlResult) > 0) {
            while ($oneRow = mysqli_fetch_array($allProjectsSqlResult)) {
                $allProjectsArr[] = $oneRow['id'];
            }
        }
        return $allProjectsArr;
    }

    function getAllResources($allProjectsArr, $role, $getPrim) {
        $getResourcesMysqlQuery;
        if ($allProjectsArr) {
            $allProjectStr = "('" . implode("' , '", $allProjectsArr) . "' )";
            if (!$getPrim) {
                $getResourcesMysqlQuery = "SELECT objid FROM resourceassignment_tb resource where active ='true' AND role_name = '" . $role . "' AND project_name in " . $allProjectStr;
            } else {
                $getResourcesMysqlQuery = "SELECT objid FROM resourceassignment_tb resource where active ='true' AND prim_role_name = '" . $role . "' AND project_name in " . $allProjectStr;
            }
            echo "<br> resc query" . $getResourcesMysqlQuery . "<br>";
            $allResources = array();
            $getResourcesMysqlResult = $this->_seaweb_pv_db_mysqli->query($getResourcesMysqlQuery) or ($this->_seaweb_pv_db_mysqli->error);
            if ($getResourcesMysqlResult && mysqli_num_rows($getResourcesMysqlResult) > 0) {
                while ($oneRow = mysqli_fetch_array($getResourcesMysqlResult)) {
                    $allResources[] = $oneRow['objid'];
                }
            }

            return $allResources;
        }
    }

    function getAllRoles() {
        $allRolesArr = array();
        $getRolesMysqlQuery = "SELECT DISTINCT role_name FROM resourceassignment_tb";
        $allRolesSqlResult = $this->_seaweb_pv_db_mysqli->query($getRolesMysqlQuery);
        if ($allRolesSqlResult && mysqli_num_rows($allRolesSqlResult) > 0) {
            while ($oneRow = mysqli_fetch_array($allRolesSqlResult)) {
                $allRolesArr[] = $oneRow['role_name'];
            }
        }
        return $allRolesArr;
    }

    function getResourceAvailData($region) {
//         return;
        $retArray = array();
        $dataArray = array();
        $allDateArray = array();
        //  $allRegions = $this->getRegions();
        $allRoles = array();
        $concat = '';
        $allRolesResourceArr = array();
        $allProjectsArr = $this->getProjectPerRegion($region);
        $allProjectsStr = "('" . implode("' , '", $allProjectsArr) . "' )";
        $allDateColSqlResult = $this->_seaweb_pv_db_mysqli->
                query("SELECT DISTINCT startdate 
                       FROM resourcespread_tb 
                       WHERE startdate >= '" . date('Y-m-01') . "'
                       AND startdate <= '" . date('Y-m-01', strtotime('+20 month')) . "'");
        $count = 0;
        while ($oneRow = mysqli_fetch_array($allDateColSqlResult)) {
            $allDateArray[] = $oneRow['startdate'];
            $concat = $concat . " sum(case when startdate = '" . $oneRow['startdate'] . "' then (val.units/val.max_hours)*100 end) AS '" . $oneRow['startdate'] . "',";
            $count++;
        }
        $concat = substr($concat, 0, -1);
        // foreach ($allRoles as $oneRole) {
        //   $allResourcesArr = $this->getAllResources($allProjectsArr, $oneRole, FALSE);
        //  echo print_r($allResourcesArr);
        //get availabilty
        $getResourceAvailabilityQuery = "SELECT  assignment.resource_name, assignment.prim_role_id ," . $concat . " 
            FROM  resourceassignment_tb assignment , resourcespread_tb val
            Where assignment.objid = val.resourceobjid 
            AND assignment.active ='true'
            AND assignment.project_name in $allProjectsStr
            GROUP BY val.resourceobjid";
        $allResourceAvailabilitySqlResult = $this->_seaweb_pv_db_mysqli->query($getResourceAvailabilityQuery);

        while ($oneRow = mysqli_fetch_array($allResourceAvailabilitySqlResult)) {
            $oneResource = array();
            //$allRolesResourceArr[] = $oneRow['prim_role_id'];
            if (FALSE === array_key_exists($oneRow["prim_role_id"], $allRolesResourceArr)) {
                $allRolesResourceArr[$oneRow['prim_role_id']] = array();
                $allRoles[] = $oneRow['prim_role_id'];
            }
            $oneResource['resource_name'] = intval($oneRow['resource_name']);
            // echo $oneResource['resource_name'] ."  ";
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
            //  echo "<br>";
            $allRolesResourceArr[$oneRow['prim_role_id']]["allResources"][] = $oneResource;
        }

        $dataArray["allRoleResources"] = $allRolesResourceArr;
        $dataArray["allRoles"] = $allRoles;
        $dataArray["allDates"] = $allDateArray;
        $retArray["response"] = $dataArray;
        // echo print_r($allRolesResourceArr);
        echo json_encode($retArray);
        // }
    }

}

?>
