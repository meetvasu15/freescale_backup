<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SaveUpdateErrataPdm
 *
 * @author B45802
 */
require_once 'classes/SingletonDb.class.php';

class SaveUpdateErrataPdm {

    //put your code here
    var $_dashboard_db_mysqli;
    var $_buffer_db_mysqli;

    function SaveUpdateErrataPdm() {
        $db = SingletonDb::getInstance();
        $this->_dashboard_db_mysqli = $db->getSeawebDashboardDbConnection();
         $this->_buffer_db_mysqli = $db->getSeawebBufferDbConnection();
               
                 
    }

    function saveUpdate($npi_id, $pdm_partNumber) {
        if (isset( $npi_id ) && !empty( $npi_id ) ) {
            //search if existing
            $searchNpiErrataMapSql = "SELECT * FROM errataChartsPdmMap WHERE npi_id=" . $npi_id;
            $searchNpiErrataMapResult = $this->_dashboard_db_mysqli->query($searchNpiErrataMapSql);
            // delete if it exists
            if (mysqli_num_rows($searchNpiErrataMapResult) > 0) {
                $delteExistingMapping = "DELETE FROM errataChartsPdmMap WHERE npi_id =" . $npi_id;
                $this->_dashboard_db_mysqli->query($delteExistingMapping);
            }
            // insert 
            $insertMapSql = "INSERT INTO errataChartsPdmMap VALUES (" . $npi_id . " , '" . $pdm_partNumber . "')";
            $this->_dashboard_db_mysqli->query($insertMapSql);
            $retArray = array();
            $retArray["response"]="";
            echo json_encode($retArray);
            
        }
    }

    function getPdmPartNumber($npi_id) {
        if (isset($npi_id) && !empty($npi_id)) {
            $searchNpiErrataMapSql = "SELECT pdmPartNumber FROM errataChartsPdmMap WHERE npi_id=" . $npi_id;
            $searchNpiErrataMapResult = $this->_dashboard_db_mysqli->query($searchNpiErrataMapSql);
            // delete if it exists
            if (mysqli_num_rows($searchNpiErrataMapResult) > 0) {
                while($oneRow = mysqli_fetch_array($searchNpiErrataMapResult)){
                    return $oneRow["pdmPartNumber"];
                }
            }else{
                return ;
            }
        }
    }
    
     function getWebnpiPdmPartNumber($npi_id) {
        if (isset($npi_id) && !empty($npi_id)) {
            $searchNpiErrataMapSql = "SELECT part_number FROM ip_gear WHERE npi_id=" . $npi_id;
            $searchNpiErrataMapResult = $this->_buffer_db_mysqli->query($searchNpiErrataMapSql);
            // delete if it exists
            if (mysqli_num_rows($searchNpiErrataMapResult) > 0) {
                while($oneRow = mysqli_fetch_array($searchNpiErrataMapResult)){
                    return $oneRow["part_number"];
                }
            }else{
                return ;
            }
        }
    }

}

?>
