<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dashboard</title>
        <script src="javascript/jquery.js" type="text/javascript"></script>
        <script src="javascript/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="javascript/command/DashboardGatewayCommand.js" type="text/javascript"></script>
        <script src="javascript/model/DashboardServices.js" type="text/javascript"></script>
        <script src="javascript/model/MasterDataModel.js" type="text/javascript"></script>
        <script src="javascript/view/HomePageView.js" type="text/javascript"></script>
        <script src="javascript/view/initialization.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="css/common.css"></link>
    </head>
    <body>
        <?php
        // put your code here
        ?>

        <div class="mainHeaderDiv">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">

                        <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar">aaa</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>

                        <!-- Be sure to leave the brand out there if you want it shown -->
                        <a class="brand" href="#">Dashboard</a>

                        <!-- Everything you want hidden at 940px or less, place within here -->
                        <div class="nav-collapse collapse">
                            <!-- .nav, .navbar-search, .navbar-form, etc -->
                            <ul class="nav">
                                <li class="active"><a href="#">NPI</a></li>
                                <li ><a href="#">Enterprise</a></li>
                                <li><a href="#">IP</a></li>
                                <!--                      <li class="dropdown">
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
                                                      </li>-->
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="contentDiv">
            <div class="allContentContainer">
                <div class="accordion" id="accordion2" style="width: 80%">
                    <div class="accordion-group" >
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                Calypso 6M
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="accordion-inner">
                                <table class="table table-bordered">
                                  <tr><td>Phase</td><td>Vertical Market</td><td>PM</td></tr>
                                  
                                  <tr><td>Technology</td><td>Complexity</td><td>Cycle Time</td></tr>
                                  
                                  <tr><td>Financials</td><td><a href="#myModal" role="button" data-toggle="modal">QMS</a></td><td>Right Reviews</td></tr>
                                  
                                  <tr><td>Upcoming Milestones</td><td>% Beta IP @ 1st Tape out</td><td>IP disconnects</td></tr>
                                  <tr><td colspan="3" text-align="center">Burn Down Charts</td></tr>
                              </table>
                            </div>
                        </div>
                    </div>
                  <div class="accordion-group" >
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                Calypso 6M
                            </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <table class="table table-bordered">
                                  <tr><td>Phase</td><td>Vertical Market</td><td>PM</td></tr>
                                  
                                  <tr><td>Technology</td><td>Complexity</td><td>Cycle Time</td></tr>
                                  
                                  <tr><td>Financials</td><td><a href="#myModal" role="button" data-toggle="modal">QMS</a></td><td>Right Reviews</td></tr>
                                  
                                  <tr><td>Upcoming Milestones</td><td>% Beta IP @ 1st Tape out</td><td>IP disconnects</td></tr>
                                  <tr><td colspan="3" text-align="center">Burn Down Charts</td></tr>
                              </table>
                            </div>
                        </div>
                    </div>
                     <div class="accordion-group" >
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseT">
                                Calypso 6M
                            </a>
                        </div>
                        <div id="collapseT" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <table class="table table-bordered">
                                  <tr><td>Phase</td><td>Vertical Market</td><td>PM</td></tr>
                                  
                                  <tr><td>Technology</td><td>Complexity</td><td>Cycle Time</td></tr>
                                  
                                  <tr><td>Financials</td><td><a href="#myModal" role="button" data-toggle="modal">QMS</a></td><td>Right Reviews</td></tr>
                                  
                                  <tr><td>Upcoming Milestones</td><td>% Beta IP @ 1st Tape out</td><td>IP disconnects</td></tr>
                                  <tr><td colspan="3" text-align="center">Burn Down Charts</td></tr>
                              </table>
                            </div>
                        </div>
                    </div>
                     <div class="accordion-group" >
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse7">
                                Calypso 6M
                            </a>
                        </div>
                        <div id="collapse7" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <table class="table table-bordered">
                                  <tr><td>Phase</td><td>Vertical Market</td><td>PM</td></tr>
                                  
                                  <tr><td>Technology</td><td>Complexity</td><td>Cycle Time</td></tr>
                                  
                                  <tr><td>Financials</td><td><a href="#myModal" role="button" data-toggle="modal">QMS</a></td><td>Right Reviews</td></tr>
                                  
                                  <tr><td>Upcoming Milestones</td><td>% Beta IP @ 1st Tape out</td><td>IP disconnects</td></tr>
                                  <tr><td colspan="3" text-align="center">Burn Down Charts</td></tr>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
            
                
                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Q M S</h3>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>Workflow</td>
                                <td >Signed off</td>
                                <td >current Stage</td> 
                                <td>Current Stage</td>
                                <td >Previous Stage</td> 
                            </tr>
                            <tr>
                                <td>Test prog Workaflow</td>
                                <td>2</td>
                                <td>3.3</td>
                                <td >7/7</td>
                                <td >4/20</td> 
                            </tr>
                            <tr>
                                <td>SOC Workaflow</td>
                                <td>2</td>
                                <td>3.3</td>
                                <td >7/7</td>
                                <td >4/20</td> 
                            </tr>
                            <tr>
                                <td>Enablement tools</td>
                                <td>2</td>
                                <td>3.3</td>
                                <td >7/7</td>
                                <td >4/20</td> 
                            </tr>
                            <tr>
                                <td>Enablement tools</td>
                                <td>2</td>
                                <td>3.3</td>
                                <td >7/7</td>
                                <td >4/20</td> 
                            </tr>
                            <tr>
                                <td>Enablement tools</td>
                                <td>2</td>
                                <td>3.3</td>
                                <td >7/7</td>
                                <td >4/20</td> 
                            </tr>
                            <tr>
                                <td>Enablement tools</td>
                                <td>2</td>
                                <td>3.3</td>
                                <td >7/7</td>
                                <td >4/20</td> 
                            </tr>
                            <tr>
                                <td>Enablement tools</td>
                                <td>2</td>
                                <td>3.3</td>
                                <td >7/7</td>
                                <td >4/20</td> 
                            </tr>


                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> 
                    </div>
                    <div class="mainFooterDiv"></div>
                    </body>
                    </html>