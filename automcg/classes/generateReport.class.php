<?php

require_once 'includes/global.inc.php';
require_once 'includes/sheetDbColumnMapping.php';
require_once 'classes/lib/PHPExcel.php';
/**
 *
 * @author B45802
 */
class generateReport {

    //put your code here
    private $mysqli;
    var $rowNum; 
    var $objPHPExcel;
    var $systemIdNoVal;

    public function __construct() {
        $db = SingletonDb::getInstance();
        $this->mysqli = $db->getConnection();
    }

    function getAllReportData() {
        $sheetDBColMap = $GLOBALS['sheetDBColMap'];
        $concat = "";
      //  $user =$_SESSION['username'];
        $user = $_SERVER['REMOTE_USER'];
        $headerColumnArray = array();
        $headerColumnKeyArray = array();
        $this->systemIdNoVal = "(";
        $allDateColSqlResult = $this->mysqli->query("SELECT DISTINCT apv_month from autoPVMonthlyValue");
        $count = 0;
        while ($oneRow = mysqli_fetch_array($allDateColSqlResult)) {
            $concat = $concat . " sum(case when apv_month = '" . $oneRow['apv_month'] . "' then resource_value end) AS '" . $oneRow['apv_month'] . "',";
            $count++;
        }
        $concat = substr($concat, 0, -1);
        $query = "SELECT  a.* ," . $concat . " 
            FROM  autoPVData a , autoPVMonthlyValue val
            Where(a.functional_manager ='". $user."' 
                         OR a.resource_manager  ='". $user."') AND
                a.system_id = val.system_id 
            GROUP BY val.system_id";
       //echo "here::::".$query."::::<br>";
        $headerColumnArray = (array) array_merge((array) array_keys($sheetDBColMap), (array) $headerColumnArray);
        $headerColumnKeyArray = (array) array_merge((array) array_values($sheetDBColMap), (array) $headerColumnKeyArray);
        // echo "here 3";
        $getAllDatesSqlResult = $this->mysqli->query('select DISTINCT apv_month from autoPVMonthlyValue order by apv_month');
        while ($oneRow = mysqli_fetch_array($getAllDatesSqlResult)) {
            $month = $oneRow['apv_month'];
            $headerColumnArray[] = $month;
            $headerColumnKeyArray[] = $month;
        }
        //  echo "here 5";
        $this->objPHPExcel = new PHPExcel();
        $this->generateReport($query, $headerColumnArray, $headerColumnKeyArray);
         // echo "here 6";
        $restDataquery = "select * from autoPVData b where (b.functional_manager ='". $user."' or resource_manager  ='". $user."') ";
        if($this->systemIdNoVal!= "("){
            $this->systemIdNoVal = substr($this->systemIdNoVal, 0, -1) . ")";
        $restDataquery =$restDataquery ."AND b.system_id not in " . $this->systemIdNoVal;
         }
        // echo "haso ".$restDataquery;
        $headerColumnArray = 0;
        $this->generateReport($restDataquery, $headerColumnArray, $headerColumnKeyArray); //return;  
        $this->createExcel();
    }

    public function prep_stmt($query) {
        $stmt = $this->mysqli->prepare($query) or die(
                        "Could not prepare statement<br>" . $query . "<br>" . $this->mysqli->error);
        return $stmt;
    }

    public function generateReport($query, $headerColumnArray, $headerColumnKeyArray) {
        try{
        $allDataSqlResult = $this->mysqli->query($query) or ($this->mysqli->error);
       // echo "here 1.1";
        if ($headerColumnArray != 0) {
//echo "here 1.1.1<br>";
            $colNum = 'A';
            foreach ($headerColumnArray as $key => $val) {
               // echo "here 1.1.".$key."<br>";
                if ($key > 8) {
                    PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_AdvancedValueBinder());
                    $this->objPHPExcel->getActiveSheet()->getColumnDimension($colNum)->setWidth(12);
                }
               //  echo "here 1.1.1.".$key." Value=".$val." ::<br>";
                $this->objPHPExcel->getActiveSheet()->setCellValue($colNum . "1", $val);
               // echo "hey ";
                $colNum++;
            }
            $this->rowNum = 2;
            $this->objPHPExcel->getActiveSheet()->setTitle('Auto PV Data');
        }
         // echo "here 1.2.0";
        $activesheet = $this->objPHPExcel->getActiveSheet();
        while ($oneRow = mysqli_fetch_array($allDataSqlResult)) {
           //  echo "here 1.2.1";
            $colNum = 'A';
            foreach ($headerColumnKeyArray as $colHeadingKey) {
                if (isset($oneRow[$colHeadingKey])) {
                     $value = $oneRow[$colHeadingKey];
                    if((float)$value ){
                            $value = round($value,2); 
                    }
                    $activesheet->setCellValue($colNum . $this->rowNum, $value );
                } else {
                    
                }
                $colNum++;
            }
            $this->systemIdNoVal = $this->systemIdNoVal . $oneRow['system_id'] . " ,";
            $this->rowNum++;
        }
       //  echo "here 1.3";
        unset($allDataSqlResult);
        unset($headerColumnArray);
        unset($headerColumnKeyArray);
        }catch(Exception $e){
            $e->getMessage();
            $e->getTrace();
        }
    }

    function createExcel() {
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Auto Report.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }

}

?>
