<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

require_once 'classes/PdmSingletonDb.class.php';

function oswQuery($query) {
   $db = PdmSingletonDb::getInstance();
    $myociConn = $db->getConnection();
    $stid = oci_parse($myociConn, $query);
    if (!$stid) {
        $e = oci_error($myociConn);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

// Perform the logic of the query
    $r = oci_execute($stid);
    if (!$r) {
        $e = oci_error($stid);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    
    return  $stid ;
}

?>
