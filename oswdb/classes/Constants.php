


<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$allTables = array(
"OSW_FG_ASY" => array("OPS",
        "TECH",
        "PKG_GRP",
        "BENCHMARK_DEV",
        "YEAR",
        "VALUE",
        "BU_DEVICE",
        "DIE_COUNT",
        "WIRE_COUNT",
        "PACKAGE_SIZE",
        "BALL_COUNT",
        "WEDGE_CT",
        "IS_AU_AL_CU",
        "STATUS"),

"OSW_FG_TEST" => array( 
        "GLOBAL",
        "TESTER",
        "YEAR", 
        "VALUE" ),

"OSW_FG_FAB_8" => array( 
        "WTC",
        "TECH_GRP",
        "KEY_CODE",
        "TURNS",
        "MLS",
        "YEAR",
        "VALUE" ),
"OSW_FW_BURN_IN" => array( 
        "PLANT",
        "CHAMBER", 
        "YEAR",
        "VALUE" ),
"OSW_FG_PROBE" => array( 
        "GLOBAL",
        "TESTER",
        "YEAR", 
        "VALUE" ),
"OSW_FG_BUMP" => array( 
        "BUMP_CODE",
        "DESCRIPTION",
        "YEAR", 
        "VALUE" ));

$numAtArr = array(
"OSW_FG_ASY" => array(4,5,7,8,9,10),

"OSW_FG_TEST" => array(2,3 ),

"OSW_FG_FAB_8" => array(3,4,5,6),
"OSW_FW_BURN_IN" => array(2,3 ),
"OSW_FG_PROBE" => array( 2,3),
"OSW_FG_BUMP" => array( 2,3 ));


 $OSW_FG_ASY = array("Ops",
        "Tech",
        "Pkg Grp",
        "Benchmark Dev",
        "Year",
        "Value",
        "BU device",
        "Die Count",
        "Wire Count",
        "Package Size",
        "Ball Count",
        "Wedge Ct",
        "CU?",
        "Status");

$OSW_FG_TEST = array( 
        "Global",
        "Tester",
        "Year", 
        "Value" );

$OSW_FG_FAB_8 =  array( 
        "WTC",
        "Tech Grp",
        "Key Code",
        "Turns",
        "MLS",
        "Year",
        "Value" );
$OSW_FW_BURN_IN = array( 
        "Plant",
        "Chamber", 
        "Year",
        "Value" );
$OSW_FG_PROBE = array( 
        "Global",
        "Tester",
        "Year", 
        "Value" );
$OSW_FG_BUMP = array( 
        "Bump Code",
        "Description",
        "Year", 
        "Value" );
$allTableNames = array (
    "OSW_FG_ASY",
    "OSW_FG_TEST",
 "OSW_FG_FAB_8",
 "OSW_FW_BURN_IN",
 "OSW_FG_PROBE",
 "OSW_FG_BUMP", 
);

?>
