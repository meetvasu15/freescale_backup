/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 

function  CreateIpTableView_old(data){
     IpDataModel.getInstance().ipData = data; //Storing data received in NPI singleton
     var allDataRows = IpDataModel.getInstance().ipData.response.allDataRows;
   // var ipContent = " <table class='table table-bordered allContentTable tableWithFloatingHeader' id='allIPContentTable'>";
    var ipContent = " <table  class='tablesorter table-bordered allContentTable tableWithFloatingHeaderIp' id='allIPContentTable'  style='width: 100%; table-layout: fixed;'>";
        ipContent += "<thead><tr class='allProjectTableHead'>";
        ipContent +="<th data-placeholder=''>Project</th>";
        ipContent += "<th  class='wrap-td' data-placeholder='' class='filter-false'>Technology</th>";
        ipContent +="<th data-placeholder=''>Team</th>";
        ipContent += "<th data-placeholder=''>Lead Desiger</th>";
        ipContent +="<th data-placeholder=''>Phase</th>";
        ipContent +="<th data-placeholder='' class='filter-false wrap-td' >Qms</th>";
        ipContent +="<th data-placeholder='' class='filter-false wrap-td' >3.3 forecast</th>";
        ipContent +="<th data-placeholder=''  class='filter-false wrap-td'>3.4 forecast</th>";
        ipContent +="<th data-placeholder=''  class='filter-false wrap-td'>3.5 forecast</th>";
        ipContent +="<th data-placeholder=''  class='filter-false wrap-td'>GDS Forecast</th>";
        ipContent +="<th data-placeholder=''  class='filter-false wrap-td'>Issues</th>";
        ipContent +="<th data-placeholder=''  class='filter-false wrap-td'>Validation page</th>";
        ipContent +="<th data-placeholder='' class='filter-false wrap-td'>Right Reviews</th>";
        ipContent +="<th data-placeholder=''  class='filter-false wrap-td'>MPW</th>";
        ipContent +="<th data-placeholder=''  class='filter-false wrap-td'>Tickets</th>";
        ipContent +="</thead></tr>";
        for(var i=0 ; i< allDataRows.length; i++){
            var encodeProjectName = replaceAll(" ", "***", allDataRows[i].Project);
            ipContent +="<tr>";
            ipContent += "<td class='wrap-td'><a href='http://webnpi.am.freescale.net/docs/TSPG/MCD/NPI/HTML/npi_projects.php?ProjectDisplaying,ID="+allDataRows[i].NPI_ID+"'>"+allDataRows[i].Project+"</a></td>";
            ipContent += "<td class='wrap-td'>"+allDataRows[i].Technology+"</td>";
            ipContent += "<td class='wrap-td'>"+allDataRows[i].Design_Team+"</td>";
            ipContent += "<td class='wrap-td'>"+allDataRows[i]["Lead_Design_Egr."]+"</td>";
            ipContent += "<td class='wrap-td'>"+allDataRows[i].Current_Phase+"</td>";
            ipContent +="<td class='qmsModalButton'> <span class='label' onclick='GetQMSHtml(\""+encodeProjectName+"\")'>View </span><br><span class='label label-info' onclick='LaunchQmsPage(\""+allDataRows[i].NPI_ID+"\")'>QMS </span></td>";
            ipContent += "<td  class='wrap-td  " + allDataRows[i]._3_3_forecast.cellColor + "'>"+allDataRows[i]._3_3_forecast.cellValue+"</td>";
            ipContent += "<td class='wrap-td  " + allDataRows[i]._3_4_forecast.cellColor + "'>"+allDataRows[i]._3_4_forecast.cellValue+"</td>";
            ipContent += "<td class='wrap-td  " + allDataRows[i]._3_5_forecast.cellColor + "'>"+allDataRows[i]._3_5_forecast.cellValue+"</td>";
            ipContent += "<td class='wrap-td  " + allDataRows[i].gds_forecast.cellColor + "'>"+allDataRows[i].gds_forecast.cellValue+"</td>";
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
         //floatTableHeaderInitializeIp();
}


function  CreateIpTableView(data){
    
    IpDataModel.getInstance().ipData = data; //Storing data received in NPI singleton
    var allDataRows = IpDataModel.getInstance().ipData.response.allDataRows; 
    var ipContent = " <table  class='tablesorter table-bordered allContentTable tableWithFloatingHeaderIp' id='allIPContentTable'  style='width: 60%; table-layout: fixed;'>";
        ipContent += "<thead><tr class='allProjectTableHead'>";
        ipContent +="<th data-placeholder=''>Project</th>";
        ipContent +="<th data-placeholder=''>Preliminary QMS Stage 3.3</th>"; 
        ipContent +="<th data-placeholder=''>Solid QMS Stage 3.4</th>";
        ipContent +="<th data-placeholder=''>Final Layout QMS Stage 3.5</th>";
        ipContent +="<th data-placeholder=''>QMS</th>";
        ipContent +="<th data-placeholder=''>Maturity</th>";
        ipContent +="<th data-placeholder=''>GFD</th>";
        ipContent +="</thead></tr>";
        for(var i=0 ; i< allDataRows.length; i++){
            //var encodeProjectName = replaceAll(" ", "***", allDataRows[i].Project);
            ipContent +="<tr>";
            ipContent += "<td class='wrap-td'>"+allDataRows[i].project+" </td>";
            if(allDataRows[i]["Preliminary QMS Stage 3.3"] != undefined)
             {
                 ipContent += "<td class='wrap-td'> "+allDataRows[i]["Preliminary QMS Stage 3.3"]+" </td>";
             }
             else{
                 ipContent += "<td class='wrap-td'>  </td>"; 
             }
            if(allDataRows[i]["Solid QMS Stage 3.4"] != undefined){
                ipContent += "<td class='wrap-td'> "+allDataRows[i]["Solid QMS Stage 3.4"]+" </td>";
            }else{
                 ipContent += "<td class='wrap-td'>  </td>";
            }
            if(allDataRows[i]["Final3.5"] != undefined){
                ipContent += "<td class='wrap-td'> "+allDataRows[i]["Final3.5"]+" </td>"; 
            }
            else{
                 ipContent += "<td class='wrap-td'>  </td>";
            }
             ipContent += "<td class='qmsModalButton'  style='width: 4%;'> <span class='label' onclick='GetIPQMSHtml(\"" + allDataRows[i]["objid"] + "\")'>View </span></td>";
        
                ipContent += "<td class='wrap-td'>  </td>";
                  ipContent += "<td class='wrap-td'>  </td>";
            ipContent +="</tr>";
        }
        ipContent += "</table>"; 
        $("#ipTableContainer").append(ipContent);
        applyFilter(); 
}
