<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Constants
 *
 * @author B45802
 */
$division_id = 1846;
$NPIFetchColArr =     array("Project" => "Project",
                            "Current Phase" =>"Phase", 
                            "Status" => array("Active"),
                            "Vertical Market Space" =>"Vertical Market" ,
                            "Program Manager" =>"PM",
                            "Technology" => "Technology",
                            "Complexity" => "Complexity",
                            "Operation" => "AMPG",
                            "Proj Type" => array("NPI"),
                            "Gross Margin (%) Tgt"=>"Gross Margin (%) Tgt",
                            "Gross Margin (%) Fst" => "Gross Margin (%) Fst",
                            "Gross Margin (%) Act"=> "Gross Margin (%) Act",
                            "Die Size(mmsq) Tgt" => "Die Size(mmsq) Tgt",
                            "Die Size(mmsq) Fst" => "Die Size(mmsq) Fst",
                            "Die Size(mmsq) Act" => "Die Size(mmsq) Act",
                            "NPV (\$M) Tgt" => "NPV (\$M) Tgt",
                            "NPV (\$M) Fst" => "NPV (\$M) Fst",
                            "NPV (\$M) Act" => "NPV (\$M) Act",
                            "Hurdle Rate Tgt" => "Hurdle Rate Tgt",
                            "Hurdle Rate Fst" => "Hurdle Rate Fst",
                            "Hurdle Rate Act" => "Hurdle Rate Act",
                            "Total FTE# Tgt" => "Total FTE# Tgt",
                            "Total FTE# Fst" => "Total FTE# Fst",
                            "Total FTE# Act" => "Total FTE# Act",
                            "Total Revenue (\$M) Tgt" => "Total Revenue (\$M) Tgt",
                            "Total Revenue (\$M) Fst" => "Total Revenue (\$M) Fst",
                            "Total Revenue (\$M) Act" => "Total Revenue (\$M) Act",
                            "Qual Compl Tgt"=>"Qual Compl Tgt",
                            "Qual Compl Fst"=>"Qual Compl Fst",
                            "Qual Compl Act"=>"Qual Compl Act",
                            "Feasibility Compl Tgt"=>"Feasibility Compl Tgt",
                            "Feasibility Compl Fst"=>"Feasibility Compl Fst",
                            "Feasibility Compl Act"=>"Feasibility Compl Act",
    
                            "MM-TO 1.0 Tape Out Tgt" => "MM-TO 1.0 Tape Out Tgt",
                            "MM-TO 1.0 Tape Out Fst" => "MM-TO 1.0 Tape Out Fst",
                            "MM-TO 1.0 Tape Out Act" => "MM-TO 1.0 Tape Out Act",
    
                            "1.0 Cust Samples Tgt" => "1.0 Cust Samples Tgt",
                            "1.0 Cust Samples Fst" => "1.0 Cust Samples Fst",
                            "1.0 Cust Samples Act" => "1.0 Cust Samples Act",
    
                            "MM-TO1.1 Tape Out Tgt" => "MM-TO1.1 Tape Out Tgt",
                            "MM-TO1.1 Tape Out Fst" => "MM-TO1.1 Tape Out Fst",
                            "MM-TO1.1 Tape Out Act" => "MM-TO1.1 Tape Out Act",
    
                            "1.1 Cust Samples Tgt" => "1.1 Cust Samples Tgt",
                            "1.1 Cust Samples Fst" => "1.1 Cust Samples Fst",
                            "1.1 Cust Samples Act" => "1.1 Cust Samples Act",
    
                            "MM-TO1.2 Tape Out Tgt" => "MM-TO1.2 Tape Out Tgt",
                            "MM-TO1.2 Tape Out Fst" => "MM-TO1.2 Tape Out Fst",
                            "MM-TO1.2 Tape Out Act" => "MM-TO1.2 Tape Out Act",
    
                            "1.2 Cust Samples Tgt" => "1.2 Cust Samples Tgt",
                            "1.2 Cust Samples Fst" => "1.2 Cust Samples Fst",
                            "1.2 Cust Samples Act" => "1.2 Cust Samples Act",
    
                            "MM-TO2.0 Tape Out Tgt" => "MM-TO2.0 Tape Out Tgt",
                            "MM-TO2.0 Tape Out Fst" => "MM-TO2.0 Tape Out Fst",
                            "MM-TO2.0 Tape Out Act" => "MM-TO2.0 Tape Out Act",
    
                            "2.0 Cust Samples Tgt" => "2.0 Cust Samples Tgt",
                            "2.0 Cust Samples Fst" => "2.0 Cust Samples Fst",
                            "2.0 Cust Samples Act" => "2.0 Cust Samples Act",
    
                            "MM-TO2.1 Tape Out Tgt" => "MM-TO2.1 Tape Out Tgt",
                            "MM-TO2.1 Tape Out Fst" => "MM-TO2.1 Tape Out Fst",
                            "MM-TO2.1 Tape Out Act" => "MM-TO2.1 Tape Out Act",
    
                            "2.1 Cust Samples Tgt" => "2.1 Cust Samples Tgt",
                            "2.1 Cust Samples Fst" => "2.1 Cust Samples Fst",
                            "2.1 Cust Samples Act" => "2.1 Cust Samples Act",
    
                            "Proto Enbl Tools Tgt" => "Proto Enbl Tools Tgt",
                            "Proto Enbl Tools Fst" => "Proto Enbl Tools Fst",
                            "Proto Enbl Tools Act" => "Proto Enbl Tools Act",
    
                            "Proto EVB Hardware Tgt" => "Proto EVB Hardware Tgt",
                            "Proto EVB Hardware Fst" => "Proto EVB Hardware Fst",
                            "Proto EVB Hardware Act" => "Proto EVB Hardware Act",
    
                            "Proto SW Drivers Tgt" => "Proto SW Drivers Tgt",
                            "Proto SW Drivers Fst" => "Proto SW Drivers Fst",
                            "Proto SW Drivers Act" => "Proto SW Drivers Act",
    
                            "1.1 Tape Out Tgt" => "1.1 Tape Out Tgt",
                            "1.1 Tape Out Fst" => "1.1 Tape Out Fst",
                            "1.1 Tape Out Act" => "1.1 Tape Out Act",
    
                            "1.1 Qual Complete Tgt" => "1.1 Qual Complete Tgt",
                            "1.1 Qual Complete Fst" => "1.1 Qual Complete Fst",
                            "1.1 Qual Complete Act" => "1.1 Qual Complete Act",
    
                            "1.2 Tape Out Tgt" => "1.2 Tape Out Tgt",
                            "1.2 Tape Out Fst" => "1.2 Tape Out Fst",
                            "1.2 Tape Out Act" => "1.2 Tape Out Act",
    
                            "1.3 Tape Out Tgt" => "1.3 Tape Out Tgt",
                            "1.3 Tape Out Fst" => "1.3 Tape Out Fst",
                            "1.3 Tape Out Act" => "1.3 Tape Out Act",
    
                            "2.1 Tape Out Tgt" => "2.1 Tape Out Tgt",
                            "2.1 Tape Out Fst" => "2.1 Tape Out Fst",
                            "2.1 Tape Out Act" => "2.1 Tape Out Act",
    
                            "2.1 Qual Complete Tgt" => "2.1 Qual Complete Tgt",
                            "2.1 Qual Complete Fst" => "2.1 Qual Complete Fst",
                            "2.1 Qual Complete Act" => "2.1 Qual Complete Act",
    
                            "2.2 Tape Out Tgt" => "2.2 Tape Out Tgt",
                            "2.2 Tape Out Fst" => "2.2 Tape Out Fst",
                            "2.2 Tape Out Act" => "2.2 Tape Out Act",
    
                            "2.2 Qual Complete Tgt" => "2.2 Qual Complete Tgt",
                            "2.2 Qual Complete Fst" => "2.2 Qual Complete Fst",
                            "2.2 Qual Complete Act" => "2.2 Qual Complete Act",
    
                            "2.3 Tape Out Tgt" => "2.3 Tape Out Tgt",
                            "2.3 Tape Out Fst" => "2.3 Tape Out Fst",
                            "2.3 Tape Out Act" => "2.3 Tape Out Act",
    
                            "2.4 Tape Out Tgt" => "2.4 Tape Out Tgt",
                            "2.4 Tape Out Fst" => "2.4 Tape Out Fst",
                            "2.4 Tape Out Act" => "2.4 Tape Out Act",
    
                            "3.0 Tape Out Tgt" => "3.0 Tape Out Tgt",
                            "3.0 Tape Out Fst" => "3.0 Tape Out Fst",
                            "3.0 Tape Out Act" => "3.0 Tape Out Act",
    
                            "3.0 Customer Samples Tgt" => "3.0 Customer Samples Tgt",
                            "3.0 Customer Samples Fst" => "3.0 Customer Samples Fst",
                            "3.0 Customer Samples Act" => "3.0 Customer Samples Act",
    
                            "3.0 Qual Complete Tgt" => "3.0 Qual Complete Tgt",
                            "3.0 Qual Complete Fst" => "3.0 Qual Complete Fst",
                            "3.0 Qual Complete Act" => "3.0 Qual Complete Act",
    
                            "3.1 Tape Out Tgt" => "3.1 Tape Out Tgt",
                            "3.1 Tape Out Fst" => "3.1 Tape Out Fst",
                            "3.1 Tape Out Act" => "3.1 Tape Out Act",
    
                            "3.1 Qual Complete Tgt" => "3.1 Qual Complete Tgt",
                            "3.1 Qual Complete Fst" => "3.1 Qual Complete Fst",
                            "3.1 Qual Complete Act" => "3.1 Qual Complete Act",
     
                            "Concept Compl Tgt" => "Concept Compl Tgt",
                            "Concept Compl Fst" => "Concept Compl Fst",
                            "Concept Compl Act" => "Concept Compl Act",
                            "region" => "region",
                            "issues" => "issues",
                            "NPI ID" => "NPI ID");

 

//$NPIUIDisplayColArr = array("Project" => "Project",
//                            "Current Phase" =>"Phase", 
//                            "Vertical Market Space" =>"Vertical Market" ,
//                            "Program Manager" =>"PM",
//                            "Technology" => "Technology",
//                            "Complexity" => "Complexity", 
//                             "Cycle Time" => "Cycle Time",
//                             "Financials" => "Financials",
//                             "QMS" => "QMS",
//                             "Right Reviews" => "Right Reviews",
//                             "Upcoming Milestones" => "Upcoming Milestones",
//                             "percentageBeta" => "%Beta IP",
//                             "IP Disconects" =>   "IP Disconects",
//                             "Burndown Charts" => "Burndown Charts");

$NPICreateDataLoopArr = array("region",
			    "Project" ,
                            "Current Phase" , 
                            "Vertical Market Space"   ,
                            "Program Manager"  ,
                            "Technology"  ,
                            "Complexity",
                            "NPI ID");
$OperationGrp = "AMPG";
 $IpFetchColArr =  array("Project" => "Project",
                        "Technology" => "Technology",
                            "Design Team" =>"Design Team" ,
                            "Lead Design Egr." =>"Lead Design Egr.", 
                            "Current Phase" =>"Phase", 
                            "Status" => array("Active"), 
                            "Operation" => "AMPG",
    
                            "IP Prelim Release Tgt" => "IP Prelim Release Tgt",
                            "IP Prelim Release Fst" => "IP Prelim Release Fst",
                            "IP Prelim Release Act" => "IP Prelim Release Act",
    
                            "QMS Solid Release Tgt" => "QMS Solid Release Tgt",
                            "QMS Solid Release Fst" => "QMS Solid Release Fst",
                            "QMS Solid Release Act" => "QMS Solid Release Act",
    
                            "IP Final Release Tgt" => "IP Final Release Tgt",
                            "IP Final Release Fst" => "IP Final Release Fst",
                            "IP Final Release Act" => "IP Final Release Act",
    
                            "M1 Alpha IP Release Tgt" => "M1 Alpha IP Release Tgt",
                            "M1 Alpha IP Release Fst" => "M1 Alpha IP Release Fst",
                            "M1 Alpha IP Release Act" => "M1 Alpha IP Release Act",
     
                            "Proj Type" => array("NTD"), 
                            "region" => "region",
                            "NPI ID" => "NPI ID");
 $IpCreateDataLoopArr = array("Project" ,
                        "Technology"  ,
                            "Design Team" ,
                            "Lead Design Egr."  , 
                            "Current Phase",
                            "NPI ID" );
if (!function_exists('str_getcsv')) { 
    function str_getcsv($input, $delimiter = ",", $enclosure = '"', $escape = "\\") { 
        $fiveMBs = 5 * 1024 * 1024; 
        $fp = fopen("php://temp/maxmemory:$fiveMBs", 'r+'); 
        fputs($fp, $input); 
        rewind($fp); 

        $data = fgetcsv($fp, 1000, $delimiter, $enclosure); //  $escape only got added in 5.3.0 

        fclose($fp); 
        return $data; 
    } 
} 
$BurndownReadcolumn =  array("Date" => "Date",
                            "Remaining hours" => "Remaining hours",
                            "Planned hours Total Work" => "Planned hours Total Work" 
                            );
$excelHeaderArr = array("Project" => "Project", 
    "Phase" => "Current_Phase", 
    "Vertical Market" => "Vertical_Market_Space", 
    "PM" => "Program_Manager", 
    "Technology" => "Technology", 
    "Complexity" => "Complexity", 
    "Cycle Time" => "cycle_time");

$excelFinancialHeaderArr = array("Gross Margin" => "Gross_Margin", "Gross Margin Tgt" => "Gross_Margin_Tgt", 
    "Gross Margin (%)" => "Gross_Margin_percent", "Gross Margin (%) Tgt" => "Gross_Margin_percent_Tgt", 
    "Die Size" => "Die_Size",  "Die Size Tgt" => "Die_Size_Tgt", 
    "NPV" => "NPV", "NPV Tgt" => "NPV_Tgt", 
    "Hurdle Rate" => "Hurdle_Rate", "Hurdle Rate Tgt" => "Hurdle_Rate_Tgt", 
    "FTE" => "FTE", "FTE Tgt" => "FTE_Tgt");
?>
