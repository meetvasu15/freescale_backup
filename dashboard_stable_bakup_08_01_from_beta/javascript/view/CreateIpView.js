/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 

function  CreateIpTableView(data){
     IpDataModel.getInstance().ipData = data; //Storing data received in NPI singleton
     var allDataRows = IpDataModel.getInstance().ipData.response.allDataRows;
   // var ipContent = " <table class='table table-bordered allContentTable tableWithFloatingHeader' id='allIPContentTable'>";
    var ipContent = " <table  class='tablesorter table-bordered allContentTable' id='allIPContentTable'>";
        ipContent += "<thead><tr class='allProjectTableHead'>";
        ipContent +="<th data-placeholder=''>Project</th>";
        ipContent += "<th data-placeholder='' class='filter-false'>Technology</th>";
        ipContent +="<th data-placeholder=''>Team</th>";
        ipContent += "<th data-placeholder=''>Lead Desiger</th>";
        ipContent +="<th data-placeholder=''>Phase</th>";
        ipContent +="<th data-placeholder='' class='filter-false' >Qms</th>";
        ipContent +="<th data-placeholder='' class='filter-false' >3.3 forecast</th>";
        ipContent +="<th data-placeholder=''  class='filter-false'>3.4 forecast</th>";
        ipContent +="<th data-placeholder=''  class='filter-false'>3.5 forecast</th>";
        ipContent +="<th data-placeholder=''  class='filter-false'>GDS Forecast</th>";
        ipContent +="<th data-placeholder=''  class='filter-false'>Issues</th>";
        ipContent +="<th data-placeholder=''  class='filter-false'>Validation page</th>";
        ipContent +="<th data-placeholder='' class='filter-false'>Right Reviews</th>";
        ipContent +="<th data-placeholder=''  class='filter-false'>MPW</th>";
        ipContent +="<th data-placeholder=''  class='filter-false'>Tickets</th>";
        ipContent +="</thead></tr>";
        for(var i=0 ; i< allDataRows.length; i++){
            var encodeProjectName = replaceAll(" ", "***", allDataRows[i].Project);
            ipContent +="<tr>";
            ipContent += "<td><a href='http://webnpi.am.freescale.net/docs/TSPG/MCD/NPI/HTML/npi_projects.php?ProjectDisplaying,ID="+allDataRows[i].NPI_ID+"'>"+allDataRows[i].Project+"</a></td>";
            ipContent += "<td>"+allDataRows[i].Technology+"</td>";
            ipContent += "<td>"+allDataRows[i].Design_Team+"</td>";
            ipContent += "<td>"+allDataRows[i]["Lead_Design_Egr."]+"</td>";
            ipContent += "<td>"+allDataRows[i].Current_Phase+"</td>";
            ipContent +="<td class='qmsModalButton'> <span class='label' onclick='GetQMSHtml(\""+encodeProjectName+"\")'>View </span><br><span class='label label-info' onclick='LaunchQmsPage(\""+allDataRows[i].NPI_ID+"\")'>QMS </span></td>";
            ipContent += "<td  class='" + allDataRows[i]._3_3_forecast.cellColor + "'>"+allDataRows[i]._3_3_forecast.cellValue+"</td>";
            ipContent += "<td class='" + allDataRows[i]._3_4_forecast.cellColor + "'>"+allDataRows[i]._3_4_forecast.cellValue+"</td>";
            ipContent += "<td class='" + allDataRows[i]._3_5_forecast.cellColor + "'>"+allDataRows[i]._3_5_forecast.cellValue+"</td>";
            ipContent += "<td class='" + allDataRows[i].gds_forecast.cellColor + "'>"+allDataRows[i].gds_forecast.cellValue+"</td>";
            ipContent += "<td> </td>";
            ipContent += "<td> </td>";
            ipContent += "<td> </td>";
            ipContent += "<td> </td>";
            ipContent += "<td> </td>";
              
            ipContent +="</tr>";
        }
        ipContent += "</table>";
      //  alert(ipContent);
        $("#ipTableContainer").append(ipContent);
        applyFilter();
}
