/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



function  CreateNpiTableView(data) {
    NpiDataModel.getInstance().npiData = data; //Storing data received in NPI singleton
    var allDataRows = NpiDataModel.getInstance().npiData.response.allDataRows;
    // var npiContent = " <table class='table table-bordered allContentTable tableWithFloatingHeader' id='allIPContentTable'>";
//vasu changes begin 10-09 
    var npiContent = "<span id='npiProjectHead' onclick='showHideColumn()'><a href='#'>More Details</a></span>";
    //vasu changes end 10-09    
    npiContent += " <table  class='tablesorter table-bordered allContentTable tableWithFloatingHeader' id='allNPIContentTable' style='width: 100%;'>";
    npiContent += "<thead><tr class='allProjectTableHead'>";
    npiContent += "<th  class='wrap-td' style='width: 5%;' data-placeholder=''>Region</th>";
    npiContent += "<th  class='wrap-td'  style='width: 17%;' data-placeholder=''>Project</th>";
    npiContent += "<th   style='width: 5%;' data-placeholder='' class='filter-false wrap-td'>Phase</th>";
    npiContent += "<th  class='wrap-td' style='width: 10%;' data-placeholder=''>Vertical Market</th>";
    npiContent += "<th class='wrap-td'  style='width: 8%;'   data-placeholder=''>PM</th>";
    npiContent += "<th  class='wrap-td'  style='width: 9%;' data-placeholder=''>Technology</th>";
    npiContent += "<th  class='wrap-td'  style='width: 8%;' data-placeholder=''>Complexity</th>";
    npiContent += "<th  class='wrap-td'  style='width: 6%;' data-placeholder=''>Qual Date</th>";
    npiContent += "<th   style='width: 6%;' data-placeholder='' class='filter-false wrap-td' >Cycle Time</th>";
    npiContent += "<th    style='width: 6%;'  data-placeholder='' class='filter-false wrap-td'>Financials</th>";
    npiContent += "<th  style='width: 4%;' data-placeholder='' class='filter-false wrap-td'>QMS</th>";
    npiContent += "<th  style='width: 6%;'  data-placeholder='' class='filter-false wrap-td'>Right Reviews</th>";
    npiContent += "<th  style='width: 6%;' data-placeholder='' class='filter-false wrap-td'>Upcoming Milestones</th>";
    npiContent += "<th style='width: 9%;' data-placeholder='' class='filter-false'>Charts</th>";
    npiContent += "</thead></tr>";
    for (var i = 0; i < allDataRows.length; i++) {
        var encodeProjectName = replaceAll(" ", "***", allDataRows[i].Project);
        npiContent += "<tr>";
        npiContent += "<td  class='wrap-td'>" + allDataRows[i].region + "</td>";
        npiContent += "<td class='wrap-td'><a href='http://webnpi.am.freescale.net/docs/TSPG/MCD/NPI/HTML/npi_projects.php?ProjectDisplaying,ID=" + allDataRows[i].NPI_ID + "' target='WebNPI'>" + allDataRows[i].Project + "</a>";
        npiContent += "<a href='http://webnpi.am.freescale.net/docs/TSPG/MCD/NPI/HTML/npi_proj_osir_data_log.php?OSIRdataRecordUpdate,ProjID=" + allDataRows[i].NPI_ID + "' target='WebNPI'> ";
        if (allDataRows[i].issues != '!')
        {
            npiContent += "<img src='/docs/images/stat_s.gif'></a>";
        }
        else
        {
            npiContent += "<img src='/docs/images/urg_s.gif'></a>";
        }
        npiContent += "</td>";
        npiContent += "<td  class='wrap-td'>" + allDataRows[i].Current_Phase + "</td>";
        npiContent += "<td  class='wrap-td'> " + allDataRows[i].Vertical_Market_Space + "</td>";
        npiContent += "<td  class='wrap-td'>" + allDataRows[i].Program_Manager + "</td>";
        npiContent += "<td>" + allDataRows[i].Technology + "</td>";
        npiContent += "<td>" + allDataRows[i].Complexity + "</td>";
        if (!isBlankString(allDataRows[i].milestones.Qual_Compl.cellValue)) {
            npiContent += "<td>" + allDataRows[i].milestones.Qual_Compl.cellValue + "</td>";
        }
        else {
            npiContent += "<td></td>";
        }
        npiContent += "<td >" + allDataRows[i].cycle_time + "</td>";
        npiContent += "<td class='financialModalButton " + allDataRows[i].financialCellColor + "' onclick='GetFinancialView(" + i + ")'> View ($)</td>";
        npiContent += "<td class='qmsModalButton'> <span class='label' onclick='GetQMSHtml(\"" + encodeProjectName + "\")'>View </span><br><span class='label label-info' onclick='LaunchQmsPage(\"" + allDataRows[i].NPI_ID + "\")'>QMS </span></td>";
        npiContent += "<td class='rrModalButton' onclick='GetRRHtml(\"" + allDataRows[i].NPI_ID + "\")'>RR</td>";
        npiContent += "<td class='milestonesModalButton " + allDataRows[i].milestonesCellColor + "' onclick='GetMilestonesView(" + i + ")'>Milestones</td>";
//         npiContent +="<td>IP</td>";
//        npiContent +="<td>IP disconnects</td>";
        npiContent += "<td  class='burndownModalButton' onclick='createBurnDownModalWindow(" + i + ")'>Charts</td>";
        npiContent += "</tr>";
    }
    npiContent += "</table>";
    var dataStr = JSON.stringify(allDataRows);
    npiContent += "<div class='exportBtnContainer'><form action='ExportDashboardGateway.php' method ='POST'>";
    npiContent += "<input type='submit' class='btn' value='Export To Excel'></input><input type='hidden' name='allRowData' value='" + dataStr + "'></form></div>";
    //  alert(npiContent);
    $("#tableContainer").append(npiContent);
    applyFilter();
    var sorting = [[0, 0]];
    $("table.tablesorter").trigger("sorton", [sorting]);
    showHideColumn();
}
function showHideColumn() {
    var isVisible = $('#allNPIContentTable td:nth-child(3),th:nth-child(3),td:nth-child(4),th:nth-child(4),td:nth-child(5),th:nth-child(5),td:nth-child(6),th:nth-child(6),td:nth-child(7),th:nth-child(7),td:nth-child(8),th:nth-child(8)').is(":visible");
    if (isVisible) {
        $('#allNPIContentTable td:nth-child(3),th:nth-child(3),td:nth-child(4),th:nth-child(4),td:nth-child(5),th:nth-child(5),td:nth-child(6),th:nth-child(6),td:nth-child(7),th:nth-child(7),td:nth-child(8),th:nth-child(8)').hide();
        $("#npiProjectHead").html("<a href='#'>More Details</a>");
    } else {
        $('#allNPIContentTable td:nth-child(3),th:nth-child(3),td:nth-child(4),th:nth-child(4),td:nth-child(5),th:nth-child(5),td:nth-child(6),th:nth-child(6),td:nth-child(7),th:nth-child(7),td:nth-child(8),th:nth-child(8)').show();
        $("#npiProjectHead").html("<a href='#'>Less Details</a>");
    }
}
//function exportExcelTrigger(){
//    var allDataRows = NpiDataModel.getInstance().npiData.response.allDataRows;
//    alert();
//}
//function getDashboardExcel(){
//    var GetExcelCommand = new DashboardGateWayCommand();
//            GetExcelCommand.url = DashboardServices.getInstance().controllerUrl+'GetNPIData';
//            GetExcelCommand.error = 'GetExcelCommand Service: Received error from server';
//            GetExcelCommand.caller = CreateNpiTableView;
//            GetExcelCommand.execute();
//}
