<?php 
/**
 * Description of APVDataIngestion
 *
 * @author B45802
 */ 
require_once 'includes/global.inc.php'; 
require_once 'includes/sheetDbColumnMapping.php'; 
require_once 'classes/ReadExcel.class.php';
class APVDataIngestion { 
    var $filename;
    var $sheetName; 
     private $mysqli; 
    function APVDataIngestion($_filename, $_sheetname){
        $this->filename = $_filename;
        $this->sheetName = $_sheetname;
         $db = SingletonDb::getInstance(); 
               $this->mysqli = $db->getConnection(); 
    }
            
    function apvResourceIngestion()
    { 
        try{
            $readExcelObj = new ReadExcel();
            $objWorksheet = $readExcelObj->ReadExcelSheet( $this->filename, $this->sheetName);
            $columnArray = array(); 
            $dateColumnArray = array(); 
            $dateInsertQueryColArr = array('system_id', 'apv_month', 'resource_value');
            $allValuesArray = array(); 
            $allDateValuesArray = array();  
              $numAt = array(0);
             $sheetDBColMap =  $GLOBALS['sheetDBColMap'];
            $nextInsertID = $this->generateNextSystemId();
            $columnArray[]= $sheetDBColMap["System ID"];
              //$date = new DateTime();
               //echo "<br> memory usage before for loop". memory_get_usage() ." <br>";
                //echo "::::::::::::before for loop::::::::".$date->getTimestamp()."<br>"; 
            foreach ($objWorksheet->getRowIterator() as $row) {
                     $cellIterator = $row->getCellIterator();
                     $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells
                // its the header row
                if($row->getRowIndex()<=1){
                    // create the columns string 

                        foreach ($cellIterator as $key => $cell) {
                            //auto pv data coulmn loop includes date
                            if($key < 9){ 
                                 if (!$cell->getValue())
                                {
                                     $colNum = $key;
                                     throw new Exception("Column number ".++$colNum." doesn't have a header");
                                }
                                 
                                 $columnArray[]= $sheetDBColMap[$cell->getValue()];
                                 
                            }else{
                              // array_push($dateColumnArray,PHPExcel_Shared_Date::ExcelToPHP($cell->getValue()));  
                                //  $idx = $key;
                                  $datetime = date("Y-m-d",  PHPExcel_Shared_Date::ExcelToPHP($cell->getValue()));
                                   $dateColumnArray[$key]=$datetime;  
                                 // $sql = "INSERT INTO autopvmonthlyvalue (system_id,apv_month) values  (1, '".$datetime."')";
                                
                                 // mysql_query( $sql) or die(mysql_error());

                                
                            }
                        }  
                        //   echo "<br> memory usage exiting if stmnt". memory_get_usage() ." <br>";
                        // $batchInsertapvDataSql =   $this->createInsertSql('autoPVData', $coulmnArray); 
                }else{
                 // its a data row  
                      $apvDataArray = array();
                     array_push($apvDataArray,  $nextInsertID); 
                    foreach ($cellIterator as $key => $cell) {
                         if($key < 9){
                          array_push($apvDataArray, $cell->getValue());
                         }else{
                          //  its a date data row
                             $value = $cell->getValue();
                             if(!empty($value) && isset($value)){ 
 
                            $value = round($value,2);
                            //echo $value;
                                 $insertValues= "( ".$nextInsertID." , '".$dateColumnArray[$key]."' , ".$value." ) ";
                                array_push($allDateValuesArray, $insertValues); 
                             }
                         } 
                    } 
                    
                 $allValuesArray = $this->createAllValArr( $allValuesArray, $apvDataArray, $numAt);
                
                } 
               $nextInsertID++;
            } 
            
              //$date = new DateTime();
               // echo "memory usage after for loop". memory_get_usage() ." <br>";
                //echo "::::::::::::after for loop::::::::".$date->getTimestamp()."<br>"; 
             $batchInsertapvDataSql =  $this->createInsertSql('autoPVData', $columnArray, $allValuesArray);  
               //echo $batchInsertapvDataSql;
            
             $this->mysqli->query( $batchInsertapvDataSql) or die(mysqli_error($this->mysqli));
             unset($batchInsertapvDataSql);
             $batchInsertDateValSql =  $this->createInsertSql('autoPVMonthlyValue', $dateInsertQueryColArr, $allDateValuesArray);   
               $this->mysqli->query( $batchInsertDateValSql) or die(mysqli_error($this->mysqli));
              // echo $batchInsertDateValSql;
               unset($batchInsertDateValSql);
               
             // $date = new DateTime();
            //echo "::::::::::::after  queries::::::::".$date->getTimestamp()."<br>"; 
        }catch(Exception $e)
            {
            echo 'Message: ' .$e->getMessage();
            } 
    }
    
    function generateNextSystemId(){
        $largestIDResult = $this->mysqli->query('select max(system_id) from autopvdata');
        if( $largestIDResult && mysqli_num_rows($largestIDResult) == 1)
	{ 
             $largestID = mysqli_fetch_row($largestIDResult);
            // echo $largestID[0];
             return $largestID[0] +1;
        }else{
            return 1;
        }
    }
    
    function createAllValArr( $allValuesArray, $valueArray, $numAt){
        
       foreach ($valueArray as $key => &$val){
           
           if(!in_array($key, $numAt)){
               
               $val = addslashes($val);
               $val = "'".$val."'";
           }
           if(!isset($val) && in_array($key, $numAt)){
                   $val = 0;
           }
       } 
       $valueStr = implode(" , ", $valueArray); // creating value string 
       $valueStr =   " ( ".$valueStr." ) "; 
       array_push( $allValuesArray, $valueStr); 
       return $allValuesArray;
    } 
    function createInsertSql($tableName, $columnArray, $allValuesArray){
        
        //echo \print_r($allValuesArray);
        $sqlStmnt = "INSERT INTO ".$tableName." ( "; // creating inser statement 
        $columnStr = implode(" , ", $columnArray); // creating coulmn string
        $valueStr =  implode(" , ", $allValuesArray);
        $sqlStmnt =   $sqlStmnt.$columnStr." ) VALUES ".$valueStr;// joining everything together
        return $sqlStmnt;
    }
    
    
}

?>
