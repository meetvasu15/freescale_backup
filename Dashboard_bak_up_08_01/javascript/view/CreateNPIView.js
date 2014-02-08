/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 

function  CreateNpiTableView(data){
     NpiDataModel.getInstance().npiData = data; //Storing data received in NPI singleton
     var allDataRows = NpiDataModel.getInstance().npiData.response.allDataRows;
   // var npiContent = " <table class='table table-bordered allContentTable tableWithFloatingHeader' id='allIPContentTable'>";
    var npiContent = " <table  class='tablesorter table-bordered allContentTable' id='allIPContentTable'>";
        npiContent += "<thead><tr class='allProjectTableHead'>";
        npiContent +="<th data-placeholder=''>Project</th>";
        npiContent += "<th data-placeholder='' class='filter-false'>Phase</th>";
        npiContent +="<th data-placeholder=''>Vertical Market</th>";
        npiContent += "<th data-placeholder=''>PM</th>";
        npiContent +="<th data-placeholder=''>Technology</th>";
        npiContent +="<th data-placeholder=''>Complexity</th>";
        npiContent +="<th data-placeholder='' class='filter-false' >Cycle Time</th>";
        npiContent +="<th data-placeholder='' class='filter-false'>Financials</th>";
        npiContent +="<th data-placeholder='' class='filter-false'>QMS</th>";
        npiContent +="<th data-placeholder='' class='filter-false'>Right Reviews</th>";
        npiContent +="<th data-placeholder='' class='filter-false'>Upcoming Milestones</th>";
        npiContent +="<th data-placeholder='' class='filter-false'>%Beta IP@1st Tapeout</th>";
        npiContent +="<th data-placeholder='' class='filter-false'>IP disconnects</th>";
        npiContent +="<th data-placeholder='' class='filter-false'>Burndown Chart</th>";
        npiContent +="</thead></tr>";
        for(var i=0 ; i< allDataRows.length; i++){
            var encodeProjectName = replaceAll(" ", "***", allDataRows[i].Project);
            npiContent +="<tr>";
            npiContent += "<td><a href='http://webnpi.am.freescale.net/docs/TSPG/MCD/NPI/HTML/npi_projects.php?ProjectDisplaying,ID="+allDataRows[i].NPI_ID+"'>"+allDataRows[i].Project+"</a></td>";
            npiContent += "<td>"+allDataRows[i].Current_Phase+"</td>";
            npiContent += "<td>"+allDataRows[i].Vertical_Market_Space+"</td>";
            npiContent += "<td>"+allDataRows[i].Program_Manager+"</td>";
            npiContent += "<td>"+allDataRows[i].Technology+"</td>";
            npiContent += "<td>"+allDataRows[i].Complexity+"</td>";
             npiContent +="<td>"+allDataRows[i].cycle_time+"</td>";
            npiContent += "<td class='financialModalButton "+allDataRows[i].financialCellColor+"' onclick='GetFinancialView("+i+")'> View ($)</td>";
             npiContent +="<td class='qmsModalButton'> <span class='label' onclick='GetQMSHtml(\""+encodeProjectName+"\")'>View </span><br><span class='label label-info' onclick='LaunchQmsPage(\""+allDataRows[i].NPI_ID+"\")'>QMS </span></td>";
             npiContent +="<td class='rrModalButton' onclick='GetRRHtml(\""+allDataRows[i].NPI_ID+"\")'>RR</td>";
        npiContent +="<td class='milestonesModalButton "+allDataRows[i].milestonesCellColor+"' onclick='GetMilestonesView("+i+")'>Milestones</td>";
        npiContent +="<td>IP</td>";
        npiContent +="<td>IP disconnects</td>";
        npiContent +="<td  class='burndownModalButton' onclick='createBurnDownModalWindow("+i+")'>Charts</td>";
            npiContent +="</tr>";
        }
        npiContent += "</table>";
      //  alert(npiContent);
        $("#tableContainer").append(npiContent);
        applyFilter();
}
