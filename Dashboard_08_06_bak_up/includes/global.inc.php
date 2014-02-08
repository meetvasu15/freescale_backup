<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'classes/SingletonDb.class.php'; 
//mysqlCOnnection
                $db = SingletonDb::getInstance(); 
               $this->mysqli = $db->getConnection(); 
?>
