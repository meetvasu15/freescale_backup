/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function onYearChangeVal(val){
   PurchaseReqModel.getInstance().year =  val;
   if(val == nextYear){
       PurchaseReqModel.getInstance().createPurchaseForcastDataModel();
   }else{
        PurchaseReqModel.getInstance().createPurchaseReqDataModel();
   }
}
function  CreatePurchaseReqTableView(data) {
    $("#allPurchaseContentTable").remove();
    //$("#addBtnId").remove();
    PurchaseReqModel.getInstance().purchaseReqData = data; //Storing data received in NPI singleton
    var allDataRows = PurchaseReqModel.getInstance().purchaseReqData.response.allPurchasesArray; 
    var purchaseReqContent = " <table  class='tabel tablesorter table-bordered tableWithFloatingHeader' id='allPurchaseContentTable' style='width: 100%;'>";
    purchaseReqContent += "<thead><tr> <th data-placeholder=''> System ID </th>"+
                          "<th data-placeholder=''>NPI</th>" +
                          "<th data-placeholder=''>PR Number</th> ";
    purchaseReqContent += " <th data-placeholder=''>PR line</th>"+
                        "<th data-placeholder=''>PO Number</th>"+
                        "<th data-placeholder=''>GL Account</th>" +
                        " <th data-placeholder=''>Cost Center</th>" +
                        " <th data-placeholder=''>Requestor</th>" +
                        " <th data-placeholder=''>Budget line item</th>" +
                        " <th data-placeholder=''>VENDOR</th>" +
                        " <th data-placeholder=''>DESCRIPTION</th>	" +
                        " <th data-placeholder=''>STATUS </th>" +
                        " <th data-placeholder=''>Amount Actual</th>" +
                        " <th data-placeholder=''>Currency</th>	" +
                        "  <th data-placeholder=''>Date</th>" + 
                        "  <th data-placeholder=''>Recurring</th>" +
                        "  <th data-placeholder=''>Priority</th>" +
                        " </th><th>Edit/ Delete</th> </tr></thead>";
    purchaseReqContent += "</tr>";
    for (var i = 0; i < allDataRows.length; i++) {
        purchaseReqContent += "<tr>";
        purchaseReqContent += "<td>" + allDataRows[i].system_id + "</td>";
         purchaseReqContent += "<td>" + allDataRows[i].project + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].pr_number + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].pr_line + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].po_number + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].gl_account + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].cost_center + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].requestor + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].budget_line_item + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].vendor + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].description + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].status + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].amount + "</td>";
        // purchaseReqContent += "<td>" + allDataRows[i].year + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].currency + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].date_approved + "</td>";  
         purchaseReqContent += "<td>" + allDataRows[i].recurring + "</td>"; 
          purchaseReqContent += "<td>" + allDataRows[i].priority + "</td>"; 
         
        purchaseReqContent += "<td><button class='btn' onclick='SaveUpdatePurchaseModal("+i+")'><i class='icon-pencil'></i></button><button class='btn' onclick='deletePurchase("+allDataRows[i].system_id+")'><i class='icon-trash'></i></button></td>";
        purchaseReqContent += "</tr>";
    }
    purchaseReqContent += "</table>";
    
    // purchaseReqContent += "<button id='addBtnId' class='btn' onclick='addPurchaseModal()'>Add Purchase</button>"
    var dataStr = JSON.stringify(allDataRows);
  //  purchaseReqContent += "<div class='exportBtnContainer'><form action='ExportDashboardGateway.php' method ='POST'>";
  //  purchaseReqContent += "<input type='submit' class='btn' value='Export To Excel'></input><input type='hidden' name='allRowData' value='" + dataStr + "'></form></div>";
    //  alert(purchaseReqContent);
    $("#tableContainer").append(purchaseReqContent);
      applyFilter();
} 


function  CreateForecastPurchaseReqTableView(data) {
    $("#allPurchaseContentTable").remove();
    //$("#addBtnId").remove();
    PurchaseReqModel.getInstance().purchaseReqData = data; //Storing data received in NPI singleton
    var allDataRows = PurchaseReqModel.getInstance().purchaseReqData.response.allPurchasesArray; 
    var purchaseReqContent = " <table  class='tabel tablesorter table-bordered tableWithFloatingHeader' id='allPurchaseContentTable' style='width: 100%;'>";
    purchaseReqContent += "<thead><tr> <th data-placeholder=''> System ID </th>"+
                          "<th data-placeholder=''>NPI</th>" +
                        "<th data-placeholder=''>PO Number</th>"+
                          "<th data-placeholder=''>PO Line</th>"+
                        "<th data-placeholder=''>GL Account</th>" +
                        " <th data-placeholder=''>Cost Center</th>" +
                        " <th data-placeholder=''>Requestor</th>" +
                        " <th data-placeholder=''>Budget line item</th>" +
                        " <th data-placeholder=''>VENDOR</th>" +
                        " <th data-placeholder=''>DESCRIPTION</th>	" +
                        " <th data-placeholder=''>STATUS </th>" +
                        " <th data-placeholder=''>Amount Actual</th>" +
                        " <th data-placeholder=''>Currency</th>	" +
                        "  <th data-placeholder=''>Date</th>" + 
                        "  <th data-placeholder=''>Category</th>" +
                        "  <th data-placeholder=''>Recurring</th>" +
                        "  <th data-placeholder=''>Priority</th>" +
                        " </th><th>Edit/ Delete</th> </tr></thead>";
    purchaseReqContent += "</tr>";
    for (var i = 0; i < allDataRows.length; i++) {
        purchaseReqContent += "<tr>";
        purchaseReqContent += "<td>" + allDataRows[i].system_id + "</td>";
         purchaseReqContent += "<td>" + allDataRows[i].project + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].po_number + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].po_line + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].gl_account + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].cost_center + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].requestor + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].budget_line_item + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].vendor + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].description + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].status + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].amount + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].currency + "</td>";
        purchaseReqContent += "<td>" + allDataRows[i].date_approved + "</td>";  
        purchaseReqContent += "<td>" + allDataRows[i].category + "</td>";  
         purchaseReqContent += "<td>" + allDataRows[i].recurring + "</td>"; 
          purchaseReqContent += "<td>" + allDataRows[i].priority + "</td>"; 
         
        purchaseReqContent += "<td><button class='btn' onclick='SaveUpdatePurchaseModal("+i+")'><i class='icon-pencil'></i></button><button class='btn' onclick='deletePurchase("+allDataRows[i].system_id+")'><i class='icon-trash'></i></button></td>";
        purchaseReqContent += "</tr>";
    }
    purchaseReqContent += "</table>";
    
    // purchaseReqContent += "<button id='addBtnId' class='btn' onclick='addPurchaseModal()'>Add Purchase</button>"
    var dataStr = JSON.stringify(allDataRows);
  //  purchaseReqContent += "<div class='exportBtnContainer'><form action='ExportDashboardGateway.php' method ='POST'>";
  //  purchaseReqContent += "<input type='submit' class='btn' value='Export To Excel'></input><input type='hidden' name='allRowData' value='" + dataStr + "'></form></div>";
    //  alert(purchaseReqContent);
    $("#tableContainer").append(purchaseReqContent);
      applyFilter();
} 