<!DOCTYPE HTML><html>
    <head> 
        <title>OSS</title>
    </head>
    <body onload="initializePage()">
        <div class="navbar  navbar-inverse">
            <div class="navbar-inner">
                <a class="brand" href="#">OSS Database</a> 
            </div>
        </div>
        <div id="compareTableContainer">
            <strong>Year: </strong> <div id="yearDropContainer">  </div>  
            <div>
                <form  action="Export_Purchase_Req_Controller.php" method="post" enctype="multipart/form-data" > 
                    <input type="submit" class="btn btn-success" style="margin-top:0" name="submit" value="Export"></input>
                </form>
                <div style="float:right;">  <form  action="save_update_purchase_file.php" method="post" enctype="multipart/form-data" >
                        <input type="file" title="Search for a file to Insert Data" name="file" />
                        <input type="submit" class="btn btn-success" style="margin-top:0" name="submit" value="Upload" />
                    </form></div>

                <div id="tableContainer">
                </div>
                 
                 <div id="purchaseContainer">
                     <button id='addBtnId' class='btn' onclick='addPurchaseModal()'>Add Purchase</button>
                </div>
            </div>


            <script src="javascript/jquery.js" type="text/javascript"></script> 
            <script src="javascript/json2.js" type="text/javascript"></script>
            <script src="javascript/bootstrap/bootstrap.min.js" type="text/javascript"></script>
            <script src="javascript/common.js" type="text/javascript"></script> 
            <script src="javascript/command/OssGatewayCommand.js" type="text/javascript"></script> 
            <script src="javascript/common.js" type="text/javascript"></script> 
            <script src="javascript/model/OssServices.js" type="text/javascript"></script> 
            <script src="javascript/model/PurchaseReqModel.js" type="text/javascript"></script> 
            <script src="javascript/view/CreatePurchaseView.js" type="text/javascript"></script> 
           <script src="javascript/view/SaveUpdatePurchase.js" type="text/javascript"></script>  
    <script src="javascript/tableSorter/FilterTable.js" type="text/javascript"></script>
    
      
    <script src="javascript/tableSorter/jquery.tablesorter.js" type="text/javascript"></script>
    <script src="javascript/tableSorter/jquery.tablesorter.widgets.js" type="text/javascript"></script>
    <script src="javascript/tableSorter/FilterTable.js" type="text/javascript"></script> 
    <script src="javascript/util/MovingTableHeader.js" type="text/javascript"></script> 
    <script src="javascript/util/ScrollTableHeader.js" type="text/javascript"></script>
    
    
    
    
            <script src="javascript/view/intialization.js" type="text/javascript"></script> 
            <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css" />
            <link rel="stylesheet" type="text/css" href="css/common.css" />
    <link rel="stylesheet" type="text/css" href="css/tableFilter.css" />  
    </body>
</html>