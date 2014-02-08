<?php
require_once 'authentication.php';


require_once 'classes/generateGraphData.class.php';
require_once 'classes/generateReport.class.php';
?>
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>
            Auto MCG
        </title>
         <script src="includes/js/jquery.js" type="text/javascript"></script>
        <script src="includes/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="includes/js/bootstrap.file-input.js" type="text/javascript"></script>
         <script src="includes/js/graphData.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="includes/css/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="includes/css/common.css"></link>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
        <?php
        try {
            $createData = new generateGraphData();

            $phpArray = $createData->getUIGraphArray();
            try {
            if (!function_exists('json_decode')) {

                function json_decode($content, $assoc = false) {
                    require_once 'classes/JSON.php';
                    if ($assoc) {
                        $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
                    } else {
                        $json = new Services_JSON;
                    }
                    return $json->decode($content);
                }

            }

            if (!function_exists('json_encode')) {

                function json_encode($content) {
                    require_once 'classes/JSON.php';
                    $json = new Services_JSON;
                    return $json->encode($content);
                }

            }
 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
            $allRolesArr = $createData->getAllRoles(); 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        ?>
        <script type="text/javascript">
            
                  var allData= <?php  echo json_encode($phpArray);?>;
                
            function drawVisualization(dataTable) {
                // Some raw data (not necessarily accurate)
              
                var data = google.visualization.arrayToDataTable(dataTable);
                var allRoles= <?php  echo json_encode($allRolesArr);?>;
                 
               // alert (allRoles);
              // alert(allData);
               // createRoleSelectorTable(allRoles);
                // Create and draw the visualization.
                var ac = new google.visualization.AreaChart(document.getElementById('visualization'));
                ac.draw(data, {
                    title: 'Auto PV Data',
                    isHtml: true,
                    isStacked: true,
                    width: '1400',
                    animation: {
                        duration: 1000,
                        easing: 'out'
                    },
                    height: '600',
                    vAxis: {title: "FTEs"},
                    hAxis: {title: "Month"}
                });
            }
var allRoles= <?php  echo json_encode($allRolesArr);?>;
        function drawEntireData(){
            drawVisualization(allData);
        }

            google.setOnLoadCallback(drawEntireData);
        </script>
       
    </head>

    <body style="font-family: Arial;border: 0 none;"> 
        <div class="navbar">
            <div class="navbar-inner">
                <a class="brand" href="#">Automotive MCG</a>
                <div style="float:right;">
                    <a class="brand" href="#">Welcome <?php
                        
                        if (empty($_SERVER['REMOTE_USER'])){
                            echo ", You seemed to be logged out, please close this window and log in again with your core ID.";
                            return;
                        }
                        $user = $_SERVER['REMOTE_USER'];
                        echo $user;
                        ?> !</a> 
                    <form action="logout.php">
                        <input type="submit" class="btn btn-large btn-primary" type="button" value="Log Out"></input>
                    </form></div>
            </div>
        </div> 
        <div class="well">
            <table style="width:100%">
                <tr>
                    <td>
                        <form  action="upload_auto_pv_file.php" method="post" enctype="multipart/form-data" >
                            <input type="file" title="Search for a file to Insert Data" name="file"></input>
                            <input type="submit" class="btn btn-success" style="margin-top:0" name="submit" value="Upload"></input>
                        </form>
                    </td>
                    <td>
                        <form action="update_auto_pv_file_controller.php" method="post"
                              enctype="multipart/form-data"> 
                            <input type="file" name="file" title="Search for a file to Update Data" ></input>
                            <button  class="btn btn-success" value="Upload"></button>
                        </form>
                    </td>
                    <td>
                        <form action="generateReportController.php" method="post"
                              enctype="multipart/form-data"> 
                            <input type="submit" name="submit" class="btn btn-info" value="Export to Excel"></input>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
       <!--  <div class="hero-unit">   
            <div class="graphFilterMainDiv" id="graphFilterMainDiv">  
               <input type="button" name="Graph Refresh" value="Graph Refresh" class="btn" onclick="refreshGraph();"></input>
            </div>
        </div>-->

        <div id="visualization" style="width: 600px; height: 400px;"></div> 
    </body> 
</HTML>