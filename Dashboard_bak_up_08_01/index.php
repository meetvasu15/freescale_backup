<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dashboard</title>

    </head>
    <body onload="initializePage()">
        <?php
        // put your code here
         require_once 'classes/GetResourseAssignment.class.php';
          $parse = new GetResourseAssignment();
       //  $jsonResp = $parse->getResourceAvailData("IDC");
        ?>
        <script type="text/javascript">
//       var allData= <?php // echo json_encode($jsonResp);?>; 
        </script>
   <div class="allContentContainer">
        <div class="mainHeaderDiv">
            <div class="navbar headerPadding">
                <div class="navbar-inner">
                    <div class="container">

                        <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>

                        <!-- Be sure to leave the brand out there if you want it shown -->
                        <a class="brand" href="#">Dashboard</a>

                        <!-- Everything you want hidden at 940px or less, place within here -->
                        <div class="nav-collapse collapse">
                            <!-- .nav, .navbar-search, .navbar-form, etc -->
                            <ul class="nav">
                                <li onclick="onMainTabClick(this.id)" id="npiTab" class="active"><a href="#">NPI</a></li>
                      <li onclick="onMainTabClick(this.id)" id="enterpriseTab"><a href="#">Enterprise</a></li>
                      <li onclick="onMainTabClick(this.id)" id="ipTab"><a href="#">IP</a></li> 
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li class="divider"></li>
                          <li class="nav-header">Nav header</li>
                          <li><a href="#">Separated link</a></li>
                          <li><a href="#">One more separated link</a></li>
                        </ul>
                      </li> 
                    </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
       <div id="allEnterpriseContent"> 
<!--          <div id="visualization" ></div> -->
               <div class="enterprisetableContainer" id="enterprisetableContainer"> 

               </div>   
           </div>
          <div id="allNpiContent">
            <div class="tableContainer" id="tableContainer"> 

               </div>  
          </div>
       <div id="allIpContent">
            <div class="ipTableContainer" id="ipTableContainer"> 

               </div>  
          </div>
                </div>  
        <div id="financialsModalContainer"></div>
         <div id="milestonesModalContainer"></div>
         <div id="qmsModalContainer"></div>
         <div id="rrModalContainer"></div>
         <div id="burnDownModalContainer"></div>
               
        
    </body>
            <script src="javascript/jquery.js" type="text/javascript"></script>
        <script src="javascript/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="javascript/command/DashboardGatewayCommand.js" type="text/javascript"></script>
        <script src="javascript/model/DashboardServices.js" type="text/javascript"></script>
        <script src="javascript/model/MasterDataModel.js" type="text/javascript"></script>
        <script src="javascript/model/NpiDataModel.js" type="text/javascript"></script>
        <script src="javascript/model/EnterpriseRegionDataModel.js" type="text/javascript"></script>
        <script src="javascript/model/IpDataModel.js" type="text/javascript"></script>
        <script src="javascript/model/UploadBurndownModel.js" type="text/javascript"></script>
        
        <script src="javascript/view/HomePageView.js" type="text/javascript"></script>
        <script src="javascript/view/CreateIpView.js" type="text/javascript"></script>
        <script src="javascript/view/intialization.js" type="text/javascript"></script>
         <script src="javascript/view/CreateNPIView.js" type="text/javascript"></script>
         <script src="javascript/view/GenerateFinancialModal.js" type="text/javascript"></script>
          <script src="javascript/view/GenerateQMSModal.js" type="text/javascript"></script>
          <script src="javascript/view/GenerateRRModal.js" type="text/javascript"></script>
          <script src="javascript/view/CreateEnterpriseView.js" type="text/javascript"></script>
         <script src="javascript/view/GenerateMilestoneModal.js" type="text/javascript"></script>
           <script src="javascript/view/CreateBurndownModal.js" type="text/javascript"></script>
          <script src="javascript/util/CommonUtil.js" type="text/javascript"></script>
          <script src="javascript/util/bootstrap.file-input.js" type="text/javascript"></script>
        
           <script src="javascript/util/jquery.ui.widget.js" type="text/javascript"></script>
         <script src="javascript/util/jquery.iframe-transport.js" type="text/javascript"></script>
            <script src="javascript/util/jquery.fileupload.js" type="text/javascript"></script>
           <script src="javascript/util/MovingTableHeader.js" type="text/javascript"></script>
            <script src="javascript/tableSorter/jquery.tablesorter.js" type="text/javascript"></script>
         <script src="javascript/tableSorter/jquery.tablesorter.widgets.js" type="text/javascript"></script>
       <script src="javascript/tableSorter/FilterTable.js" type="text/javascript"></script>
       <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css" />
         <link rel="stylesheet" type="text/css" href="css/common.css" />
          <link rel="stylesheet" type="text/css" href="css/tableFilter.css" />  
   
</html>