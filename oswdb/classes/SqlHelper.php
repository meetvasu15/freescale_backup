<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

require_once 'classes/SingletonDb.class.php';

function oswQuery($query) {
    $db = SingletonDb::getInstance();
    $myociConn = $db->getConnection();
//            $stid = oci_parse($myociConn, $query);
//            return oci_execute($stid); 

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
