/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 

function  CreateNpiTableView(data){
     NpiDataModel.getInstance().npiData = data; //Storing data received in NPI singleton
     var allDataRows = NpiDataModel.getInstance().npiData.response.allDataRows;
   // var npiContent = " <table class='table table-bordered allContentTable tableWithFloatingHeader' id='allIPContentTable'>";
    var npiContent = " <table  class='tablesorter table-bordered allContentTable tableWithFloatingHeader' id='allNPIContentTable' style='width: 100%; table-layout: fixed;'>";
        npiContent += "<thead><tr class='allProjectTableHead'>";
        npiContent +="<th  class='wrap-td'  style='width: 20%;' data-placeholder=''>Project</th>";
        npiContent += "<th   style='width: 5%;' data-placeholder='' class='filter-false wrap-td'>Phase</th>";
        npiContent +="<th  class='wrap-td' style='width: 12%;' data-placeholder=''>Vertical Market</th>";
        npiContent += "<th class='wrap-td'  style='width: 9%;'   data-placeholder=''>PM</th>";
        npiContent +="<th  class='wrap-td'  style='width: 11%;' data-placeholder=''>Technology</th>";
        npiContent +="<th  class='wrap-td'  style='width: 9%;' data-placeholder=''>Complexity</th>";
        npiContent +="<th   style='width: 6%;' data-placeholder='' class='filter-false wrap-td' >Cycle Time</th>";
        npiContent +="<th    style='width: 6%;'  data-placeholder='' class='filter-false wrap-td'>Financials</th>";
        npiContent +="<th  style='width: 6%;' data-placeholder='' class='filter-false wrap-td'>QMS</th>";
        npiContent +="<th  style='width: 8%;'  data-placeholder='' class='filter-false wrap-td'>Right Reviews</th>";
        npiContent +="<th  style='width: 8%;' data-placeholder='' class='filter-false wrap-td'>Upcoming Milestones</th>";
       // npiContent +="<th data-placeholder='' class='filter-false'>%Beta IP@1st Tapeout</th>";
       // npiContent +="<th data-placeholder='' class='filter-false'>IP disconnects</th>";
       // npiContent +="<th data-placeholder='' class='filter-false'>Burndown Chart</th>";
        npiContent +="</thead></tr>";
        for(var i=0 ; i< allDataRows.length; i++){
            var encodeProjectName = replaceAll(" ", "***", allDataRows[i].Project);
            npiContent +="<tr>";
            npiContent += "<td class='wrap-td'><a href='http://webnpi.am.freescale.net/docs/TSPG/MCD/NPI/HTML/npi_projects.php?ProjectDisplaying,ID="+allDataRows[i].NPI_ID+"' target='WebNPI'>"+allDataRows[i].Project+"</a></td>";
            npiContent += "<td  class='wrap-td'>"+allDataRows[i].Current_Phase+"</td>";
            npiContent += "<td  class='wrap-td'> "+allDataRows[i].Vertical_Market_Space+"</td>";
            npiContent += "<td  class='wrap-td'>"+allDataRows[i].Program_Manager+"</td>";
            npiContent += "<td>"+allDataRows[i].Technology+"</td>";
            npiContent += "<td>"+allDataRows[i].Complexity+"</td>";
             npiContent +="<td >"+allDataRows[i].cycle_time+"</td>";
            npiContent += "<td class='financialModalButton "+allDataRows[i].financialCellColor+"' onclick='GetFinancialView("+i+")'> View ($)</td>";
             npiContent +="<td class='qmsModalButton'> <span class='label' onclick='GetQMSHtml(\""+encodeProjectName+"\")'>View </span><br><span class='label label-info' onclick='LaunchQmsPage(\""+allDataRows[i].NPI_ID+"\")'>QMS </span></td>";
             npiContent +="<td class='rrModalButton' onclick='GetRRHtml(\""+allDataRows[i].NPI_ID+"\")'>RR</td>";
        npiContent +="<td class='milestonesModalButton "+allDataRows[i].milestonesCellColor+"' onclick='GetMilestonesView("+i+")'>Milestones</td>";
        //npiContent +="<td>IP</td>";
        //npiContent +="<td>IP disconnects</td>";
        //npiContent +="<td  class='burndownModalButton' onclick='createBurnDownModalWindow("+i+")'>Charts</td>";
            npiContent +="</tr>";
        }
        npiContent += "</table>";
      //  alert(npiContent);
        $("#tableContainer").append(npiContent);
        applyFilter();
	var sorting = [[0,0]]; 
	$("table.tablesorter").trigger("sorton",[sorting]);
//        var sth = new ScrollTableHeader("scrollMe");
       // floatTableHeaderInitialize();
     //  $('#allIPContentTable').flexigrid();
}
