<?php
require_once 'authentication.php';
require_once 'classes/ExportDatabase.class.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 $obj = new ExportDatabase();
 $obj->exportDbExcelSheet();
?>
