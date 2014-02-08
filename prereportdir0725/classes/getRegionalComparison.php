<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$archiveDataObj = new createArchiveDb();
$region = $_GET["region"];
$archivedData = $archiveDataObj->getArchiveDataComparison($region);
?>
