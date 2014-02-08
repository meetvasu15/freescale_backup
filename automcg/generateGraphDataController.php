<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'classes/generateGraphData.class.php';
 $createData = new generateGraphData();
  $createData->calculateGraphData();
  header("Location: index.php");
?>
