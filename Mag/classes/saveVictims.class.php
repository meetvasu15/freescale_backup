<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of saveVictims
 *
 * @author B45802
 */
 require_once 'classes/SingletonDb.class.php';
class saveVictims {
    //put your code here
    var $mysqli;
     function saveVictims(){ 
         $db = SingletonDb::getInstance(); 
               $this->mysqli = $db->getMagDbConnection(); 
    }
    function saveVictim(){
        $numAt = array();
        $lengthArr = 0;
        $columnArray = array();
         $allValuesArray = array();
         //text start
         if(isset($_POST["agency"]) && !empty($_POST["agency"])){
             $columnArray[]="agency";
              $allValuesArray[]=$_POST["agency"];
              $lengthArr = $lengthArr+1;
         }
         //checkbox start
        if(isset($_POST["crisisResponse"]) && !empty($_POST["crisisResponse"])){
              $columnArray[]="SVCTYPE_CR";
              $allValuesArray[]=1;
              $numAt[] = $lengthArr;
              $lengthArr = $lengthArr+1;
         }else{
             $allValuesArray[]=0;
             $numAt[] = $lengthArr;
             $lengthArr = $lengthArr+1;
         }
         //end
         
         $insertSql = $this->createInsertSql("victimservices", $columnArray, $allValuesArray, $numAt);
         echo $insertSql;
          $this->mysqli->query( $insertSql) or die(mysqli_error($this->mysqli));
    }
    
   
    function createInsertSql($tableName, $columnArray, $allValuesArray, $numAt){
        foreach ($allValuesArray as $key => &$val){
           
           if(!in_array($key, $numAt)){
               
               $val = addslashes($val);
               $val = "'".$val."'";
           }
           if(!isset($val) && in_array($key, $numAt)){
                   $val = 0;
           }
       } 
        //echo \print_r($allValuesArray);
        $sqlStmnt = "INSERT INTO mag.".$tableName." ( "; // creating inser statement 
        $columnStr = implode(" , ", $columnArray); // creating coulmn string
        $valueStr =  implode(" , ", $allValuesArray);
        $sqlStmnt =   $sqlStmnt.$columnStr." ) VALUES (".$valueStr." )";// joining everything together
        return $sqlStmnt;
    }
}

?>
