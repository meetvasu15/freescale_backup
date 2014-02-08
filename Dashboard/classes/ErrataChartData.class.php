<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrataChartData
 *
 * @author B45802
 */
require_once 'classes/SqlHelper.php'; 
require_once 'classes/SaveUpdateErrataPdm.class.php';
class ErrataChartData {

    //put your code here


    function getErrataChartData($npi_id){
        $retArray= array(); 
         $npiPdmMapObj = new SaveUpdateErrataPdm();
         $rootItemNumber = $npiPdmMapObj->getWebnpiPdmPartNumber($npi_id); 
         if(!isset($rootItemNumber) || empty($rootItemNumber) || $rootItemNumber == ""){
               $retArray["response"] = array ("noPdm" =>"No PDM Part number found");
               echo json_encode($retArray);
               return;
         }
         
         $dataArray = array();
         $datatableArray[] = array("YY-WW", "New Ticket", "Closed", "Cummulative", "Cummulative Closed");
         $largestDate ;
         $smallestDate;
         $errataSqlStmt = "SELECT DISTINCT psr.psr_number,  
                      to_char( psr_workflow.psr_date_create, 'mm/dd/yyyy hh24:mi:ss') as psr_date_create,     
                     to_char( closed_fixed , 'mm/dd/yyyy hh24:mi:ss') as closed_fixed
                    FROM agiledm.bom, 
                         agiledm.psr_item, 
                         agiledm.psr, 
                         agiledm.psr_workflow 
                   WHERE bom.root_item_number = '".$rootItemNumber."' 
                     AND bom.child_item_id = psr_item.item_id 
                     AND psr_item.psr_id = psr.id 
                     AND psr.psr_type in ('Defect', 'IP Online Ticket') 
                    
                     AND psr.id = psr_workflow.psr_id";
         //echo 'query'.$errataSqlStmt."<br>";
       //  AND ( psr.status NOT IN ('Closed / Fixed', 'Not Fixed / Completed' )  OR psr.status is NULL)
            $errataSqlResult = oswQuery($errataSqlStmt);
      //   echo "query done number ";//.oci_num_rows($errataSqlResult)."<br>"; 
            while ($oneRow = oci_fetch_array($errataSqlResult)) {
                
               if(  !empty($oneRow["PSR_DATE_CREATE"])){
                    $createdateStr = $oneRow["PSR_DATE_CREATE"];
                    $createMonth = date('y-W', strtotime($createdateStr));
                    //echo "createMonth : ".$createMonth."<br>";
                    //echo "create date str : ".$createdateStr."<br>";
                    if(TRUE !== array_search($createMonth, $dataArray)){
                        $_newTickets =$dataArray[$createMonth]["newTickets"];
                        $_closedTickets=$dataArray[$createMonth]["closedTickets"];
                       //   echo "empty PSR_DATE_CREATE : ". $_closedTickets;
                        $dataArray[$createMonth]= array("newTickets" => $_newTickets+1, "closedTickets" => $_closedTickets );
                    } else{
                        $dataArray[$createMonth]= array("newTickets" => 1, "closedTickets" => 0 );
                    }

                    
                }
//                else {
              //      echo "empty PSR_DATE_CREATE : ";
//                }
                if( !empty($oneRow["CLOSED_FIXED"])){
                     $closedateStr = $oneRow["CLOSED_FIXED"];
                    $closeMonth = date('y-W',  strtotime($closedateStr));
                   // echo "createMonth : ".$closeMonth."<br>";
                //    echo "create date str : ".$closedateStr."<br>";
                     if(TRUE !== array_search($closeMonth, $dataArray)){
                        $_newTickets =$dataArray[$closeMonth]["newTickets"];
                        $_closedTickets=$dataArray[$closeMonth]["closedTickets"];
                     //     echo "empty CLOSED_FIXED : ". $_closedTickets;
//                   echo "empty CLOSED_FIXED   ". $closeMonth;
                        
                        $dataArray[$closeMonth]= array("newTickets" => $_newTickets, "closedTickets" => $_closedTickets+1 );
                    } else{
                        $dataArray[$closeMonth]= array("newTickets" => 0, "closedTickets" => 1 );
                    }
                    
                   
//                    echo "closedateStr".$closedateStr."<br>";
//                    //$closedate = date('m/d/y', strtotime($closedateStr)); 
//                    $closedate = strtotime($closedateStr) ; 
//                     echo "close date : ".$closedate."<br>";
//                    echo "largest date : ".$largestDate."<br>";
//                      echo "smallest date : ".$smallestDate."<br>";
//                    if($closedate > $largestDate){
//                        $largestDate = $closedate;
//                          echo "in large";
//                    }
//                    if($closedate < $smallestDate){
//                        $smallestDate = $closedate;
//                          echo "in small";
//                    }
//                      echo "<br><br>";
//                       echo "largest date : ".$largestDate."<br>";
//                      echo "smallest date : ".$smallestDate."<br>";
//                      echo "<br><br><br><br><br><br> ";
                      
                }
//                else {
//                }
               // echo "<br>";
                
               
               
            } 
            ksort($dataArray);
            if(count($dataArray)<=0){
                $retArray["response"] = array ("noPdm" =>"No Matching PDM Part number Ticket entries found, please update the PDM part number");
               echo json_encode($retArray);
               return;
            }
            $cummulativeCount = 0;
            $cummulativeOpen = 0;
            $velTotalClosedTckt = 0;
            $velTotalOpenTckt = 0;
            $velocity = 0;
             $prevFourWeekkeyArr = array();
             $prevFourWeekkeyArr[] =  date('y-W', strtotime("now"));
             for( $i=1;$i<4;$i++){
                 $prevFourWeekkeyArr[] =  date('y-W', strtotime("-".$i." week"));
                // echo date('y-W', strtotime("-".$i." week"));
             } 
            foreach ($dataArray as $key => $oneMonth){
                  $newtckt =  $oneMonth["newTickets"];
                $closedtckt =  $oneMonth["closedTickets"];
                if(!isset($newtckt) || empty($newtckt)){
                    $newtckt = 0;
                }
                 if(!isset($closedtckt) || empty($closedtckt)){
                    $closedtckt = 0;
                }
                if(array_search($key, $prevFourWeekkeyArr)){
                    $velTotalClosedTckt+=$closedtckt;
                    $velTotalOpenTckt+= $newtckt;
                }
                $velocity = ($velTotalClosedTckt/$velTotalOpenTckt);
                $cummulativeCount += $newtckt;
                 $cummulativeOpen += $newtckt;
                  $cummulativeOpen -=  $closedtckt;
                $explodedKey = explode("-", $key);
                $jsonSplKey = $explodedKey[0]."-".$explodedKey[1];
                $datatableArray[]=array($jsonSplKey, $newtckt, $closedtckt, $cummulativeCount, $cummulativeOpen);
//                echo $key ." : " .print_r($oneMonth)."<br>";
            }
            $allDataArr = array();
            $allDataArr["chartData"] = $datatableArray;
               $allDataArr["velocity"] = $velocity;
              $allDataArr["rootItemNumber"] =   $rootItemNumber;
            $retArray["response"] = $allDataArr; 
          
            echo json_encode($retArray);
//            
//            
//    $begin = date('Y-m-01', $smallestDate);
//    echo $begin."<br>";
//    $end = date('Y-m-01', $largestDate);
//    echo $end."<br>";
//    $interval = new DateInterval("P1M"); // 1 month
//    $period = new DatePeriod($begin, $interval, $end);
//    while ($begin !== $end){
//        
//    }
//            foreach ($period  as $oneMonth){
//                echo  $oneMonth ."<br>";
//            }
//             echo "smallest ".date('m/d/y', $smallestDate) ." : largest " .date('m/d/y',$largestDate)."<br>";
//         
         
    }
    
    
}

?>
