<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start(); 
if($_SESSION['username']){
    // nothing 
}
else{  
    header("Location: login.php");
}
?>
