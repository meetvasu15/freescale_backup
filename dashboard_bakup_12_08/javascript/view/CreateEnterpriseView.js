/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function intializeEnterpriseView(region) {
//    if (region != undefined) {
//        var encodedRegion = replaceAll(" ", "***", region);
//        EnterpriseRegionDataModel.getInstance().region = encodedRegion;
//    }
//    EnterpriseRegionDataModel.getInstance().createEnterpriseDataModel();

var enterpriseCntnt =  " <table class='table table-bordered allContentTable' id='allEnterpriseContentTable'>";
enterpriseCntnt += "<tr>";
enterpriseCntnt +="<td><strong>US</strong><br><a href='/pv/AMPG.php?option=GetRegion&div=AMPG&view=ROLE&Region=US%3A72245%2C98150%2C77297'><img src='http://webnpidev.am.freescale.net/pv/img/ResChart.php?width=1000&hight=400&file=/proj/.web_webnpi/html/pv/img/static/US.csv'  border=2></a></td>";
enterpriseCntnt +="<td><strong>BRZ</strong><br><a href='/pv/AMPG.php?option=GetRegion&div=AMPG&view=ROLE&Region=BRZ%3A98151%2C77011%2C78005'><img src='http://webnpidev.am.freescale.net/pv/img/ResChart.php?width=1000&hight=400&file=/proj/.web_webnpi/html/pv/img/static/BRZ.csv' border=2></a></td>";
enterpriseCntnt += "</tr>";
enterpriseCntnt += "<tr>";
enterpriseCntnt +="<td><strong>EMEA</strong><br><a href='/pv/AMPG.php?option=GetRegion&div=AMPG&view=ROLE&Region=EMEA%3A82435%2C82437%2C80473%2C72136%2C98145%2C80460%2C98147%2C81815%2C77009%2C72565#null'><img src='http://webnpidev.am.freescale.net/pv/img/ResChart.php?width=1000&hight=400&file=/proj/.web_webnpi/html/pv/img/static/EMEA.csv' border=2></a></td>";
enterpriseCntnt +="<td><strong>IDC</strong><br><a href='/pv/AMPG.php?option=GetRegion&div=AMPG&view=ROLE&Region=IDC%3A80461%2C98149%2C72137%2C98146%2C97074%2C95705%2C83571%2C73690%2C82433%2C82127%2C75303%2C75763%2C77103#null'><img src='http://webnpidev.am.freescale.net/pv/img/ResChart.php?width=1000&hight=400&file=/proj/.web_webnpi/html/pv/img/static/IDC.csv' border=2></a></td>";
enterpriseCntnt += "</tr>";
enterpriseCntnt += "</table>";
enterpriseCntnt +=  " <table class='table table-bordered allContentTable' id='allEnterpriseContentTable'>";
enterpriseCntnt += "<tr>";
enterpriseCntnt +="<td><strong>Milestone Metrics</strong><br><img src='http://webnpidev.am.freescale.net/docs/TSPG/MCD/dashboard/img/Milestones.php'  border=2> </td>";
enterpriseCntnt +="<td><strong>Phase vs QMS</strong><br><img src='http://webnpidev.am.freescale.net/docs/TSPG/MCD/dashboard/img/QMSphase.php' border=2></td>";
enterpriseCntnt +="<td><strong>Cycle time - sum of the pieces</strong><br><iframe src='/docs/TSPG/MCD/dashboard/img/CT.php'></iframe></td>";
enterpriseCntnt += "</tr>"; 
enterpriseCntnt += "</table>";
 $("#enterprisetableContainer").append(enterpriseCntnt);

}

function  CreateEnterpriseView(data) {
//    EnterpriseRegionDataModel.getInstance().enterpriseData = data; //Storing data received in Enterprise call singleton
//    var allDates = EnterpriseRegionDataModel.getInstance().enterpriseData.response.allDates;
//    var allRoles = EnterpriseRegionDataModel.getInstance().enterpriseData.response.allRoles;
//    var allResourcesPerRole = EnterpriseRegionDataModel.getInstance().enterpriseData.response.allRoleResources;
//    var enterpriseContent = " <table class='table table-bordered allContentTable tableWithFloatingHeader' id='allEnterpriseContentTable'>";
//    enterpriseContent += "<thead><tr class='allProjectTableHead'>";
//    enterpriseContent += "<th>Resource</th>";
//    for (var i = 0; i < allDates.length; i++) {
//        enterpriseContent += "<th>" + allDates[i] + "</th>";
//    }
//    enterpriseContent += "</thead></tr>";
//    for (var i = 0; i < allRoles.length; i++) {
//        var currRole = allRoles[i];
//        enterpriseContent += "<tr>";
//        enterpriseContent += "<td>"+currRole+"</td>";
//         for (var j = 0; j < allDates.length; j++) {
//             //var allroleDateKey = currRole+allDates[j];
//            enterpriseContent += "<td style='color:blue'>" + allResourcesPerRole[allRoles[i]][currRole+allDates[j]] + "</td>";
//        } 
//        enterpriseContent += "</tr>";
//        var allResources = allResourcesPerRole[allRoles[i]]["allResources"];
//        
//          for (var k = 0; k < allResources.length; k++) {
//               enterpriseContent += "<tr>";
//               enterpriseContent += "<td>"+allResources[k]['resource_name']+"</td>";
//               for (var l = 0; l < allDates.length; l++) {
//                     //var allroleDateKey = currRole+allDates[j];
//                    enterpriseContent += "<td>" + allResources[k][allDates[l]]+ "</td>";
//                 } 
//                   enterpriseContent += "</tr>";
//          }
//        
//
//    }
//    enterpriseContent += "</table>";
//    //  alert(enterpriseContent);
//    $("#enterprisetableContainer").append(enterpriseContent);
}
