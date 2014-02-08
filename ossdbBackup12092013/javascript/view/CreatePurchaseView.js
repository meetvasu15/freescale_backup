/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function onYearChangeVal(val){
   
    PurchaseReqModel.getInstance().year =  val;
   PurchaseReqModel.getInstance().createPurchaseReqDataModel();
}
function  CreatePurchaseReqTableView(data) {
    $("#allPurchaseContentTable").remove();
    //$("#addBtnId").remove();
    PurchaseReqModel.getInstance().purchaseReqData = data; //Storing data received in NPI singleton
    var allDataRows = PurchaseReqModel.getInstance().purchaseReqData.response.allPurchasesArray; 
    var purchaseReqContent = " <table  class='table table-bordered' id='allPurchaseContentTable' style='width: 100%;'>";
    purchaseReqContent += "<tr> <td> System ID </td> <td>   PR Number </td>  <td>PR line</td><td>PO Number</td> <td>GL Account	</td>" +
            " <td>Cost Center</td>" +
            " <td>Requestor</td>" +
            " <td>Budget line item</td>" +
            " <td>VENDOR</td>	" +
            " <td>DESCRIPTION</td>	" +
            "  <td>STATUS </td>" +
            " <td>Amount Actual</td>" +
            " <td>Currency</td>	" +
            "  <td>Date approved" +
            " </td> " +
            " </td><td>Edit/ Delete</td> </tr>";
    purchaseReqContent += "</tr>";
    for (var i = 0; i < allDataRows.length; i++) {
        purchaseReqContent += "<tr>";
        purchaseReqContent += "<td>" + allDataRows[i].system_id + "</td>";
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
} 