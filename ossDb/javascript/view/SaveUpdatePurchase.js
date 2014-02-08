var priorityArr = new Array();
priorityArr[0]="";
priorityArr[1]="1-High";
priorityArr[2]="2-Med";
priorityArr[3]="3-Low";

var recurringArr = new Array();
recurringArr[0]="";
recurringArr[1]="Monthly";
recurringArr[2]="Quaterly";
recurringArr[3]="Yearly";


function SaveUpdatePurchaseModal(index) {
    if ($("#myPurchaseModal")) {
        $("#myPurchaseModal").remove();
    }
    var purchaseJson;
//    if(system_id != undefined && system_id != ""){
    purchaseJson = PurchaseReqModel.getInstance().purchaseReqData.response.allPurchasesArray[index];

    //  alert (financialsJson.Die_Size.cellValue);
    var modalCntnt = "<div id='myPurchaseModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
    modalCntnt += "<div class='modal-header'>";
    modalCntnt += "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>X</button>";
    modalCntnt += "<h3 id='myModalLabel'>Add a Purchase</h3>";
    modalCntnt += "</div>";
    modalCntnt += "<div class='modal-body'>";
    modalCntnt += "<table>";
    modalCntnt += "<tr><td>System Id</td><td>" + purchaseJson.system_id + "</td></tr>";
    modalCntnt += "<tr><td>Project</td><td><input id='editModal_project' type='text' value='" + purchaseJson.project + "'></input></td></tr>";
     modalCntnt += "<tr><td>Pr Number</td><td><input id='editModal_pr_number' type='text' value='" + purchaseJson.pr_number + "'></input></td></tr>";
    modalCntnt += "<tr><td>PR Line</td><td><input id='editModal_pr_line'  type='text' value='" + purchaseJson.pr_line + "'></input></td></tr>";
    modalCntnt += "<tr><td>PO Number</td><td><input  id='editModal_po_number'  type='text' value='" + purchaseJson.po_number + "'></input></td></tr>";
    modalCntnt += "<tr><td>GL Account</td><td><input  id='editModal_gl_account'  type='text' value='" + purchaseJson.gl_account + "'></input></td></tr>";
    modalCntnt += "<tr><td>Cost Center</td><td><input  id='editModal_cost_center'  type='text' value='" + purchaseJson.cost_center + "'></input></td></tr>";
    modalCntnt += "<tr><td>Requestor</td><td><input id='editModal_requestor'  type='text' value='" + purchaseJson.requestor + "'></input></td></tr>";
    modalCntnt += "<tr><td>Budget Line Item</td><td><input  id='editModal_budget_line_item'  type='text' value='" + purchaseJson.budget_line_item + "'></input></td></tr>";
    modalCntnt += "<tr><td>Status</td><td><input id='editModal_status'  type='text' value='" + purchaseJson.status + "'></input></td></tr>";
    modalCntnt += "<tr><td>Description</td><td><input id='editModal_description'  type='text' value='" + purchaseJson.description + "'></input></td></tr>";
    modalCntnt += "<tr><td> Vendor</td><td><input  id='editModal_vendor'  type='text' value='" + purchaseJson.vendor + "'></input>  </td></tr>";
    modalCntnt += "<tr><td>Amount</td><td><input  id='editModal_amount'  type='text' value='" + purchaseJson.amount + "'></input></td></tr>";
    modalCntnt += "<tr><td>Currency</td><td><input  id='editModal_currency'  type='text' value='" + purchaseJson.currency + "'></input></td> </tr>";
     modalCntnt += "<tr><td>Reccuring?</td><td><select  id='recurringDropDown'>";
        for (var j=0; j< window.recurringArr.length; j++){
            if( purchaseJson.recurring == window.recurringArr[j]){
                modalCntnt += "<option value="+window.recurringArr[j]+" selected>"+window.recurringArr[j]+"</option>";
            }else{
                modalCntnt += "<option value="+window.recurringArr[j]+">"+window.recurringArr[j]+"</option>";
            }
        } 
        modalCntnt += "</select></td></tr>";  
        modalCntnt += "<tr><td>Priority</td><td><select  id='priorityDropDown'>";
        for (var j=0; j< window.priorityArr.length; j++){
            if( purchaseJson.priority == window.priorityArr[j]){
                modalCntnt += "<option value="+window.priorityArr[j]+" selected>"+window.priorityArr[j]+"</option>";
            }else{
                modalCntnt += "<option value="+window.priorityArr[j]+">"+window.priorityArr[j]+"</option>";
            }
        } 
        modalCntnt += "</select></td></tr>";  
    modalCntnt += "</table>";
    modalCntnt += "</div>";
    modalCntnt += "<div class='modal-footer'>";
    modalCntnt += "<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>";
    modalCntnt += "<button class='btn btn-primary' onclick='saveUpdateCaller(" + purchaseJson.system_id + ")'>Save changes</button>";

    modalCntnt += "</div>";
    modalCntnt += "</div>";
    $('#purchaseContainer').append(modalCntnt);
    $('#myPurchaseModal').modal({
        "keyboard": true,
        "show": true});
}

function addPurchaseModal() {
    if ($("#myPurchaseModal")) {
        $("#myPurchaseModal").remove();
    }
    var modalCntnt = "<div id='myPurchaseModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
    modalCntnt += "<div class='modal-header'>";
    modalCntnt += "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>X</button>";
    modalCntnt += "<h3 id='myModalLabel'>Add a Purchase</h3>";
    modalCntnt += "</div>";
    modalCntnt += "<div class='modal-body'>";
    modalCntnt += "<table>";
     
      modalCntnt += "<tr><td>Project</td><td><input id='editModal_project' type='text' value=''></input></td></tr>";
    modalCntnt += "<tr><td>Pr Number</td><td><input id='editModal_pr_number' type='text' value=''></input></td></tr>";
    modalCntnt += "<tr><td>PR Line</td><td><input id='editModal_pr_line'  type='text' value=''></input></td></tr>";
    modalCntnt += "<tr><td>PO Number</td><td><input  id='editModal_po_number'  type='text' value=''></input></td></tr>";
    modalCntnt += "<tr><td>GL Account</td><td><input  id='editModal_gl_account'  type='text' value=''></input></td></tr>";
    modalCntnt += "<tr><td>Cost Center</td><td><input  id='editModal_cost_center'  type='text' value=''></input></td></tr>";
    modalCntnt += "<tr><td>Requestor</td><td><input id='editModal_requestor'  type='text' value=''></input></td></tr>";
    modalCntnt += "<tr><td>Budget Line Item</td><td><input  id='editModal_budget_line_item'  type='text' value=''></input></td></tr>";
    modalCntnt += "<tr><td>Status</td><td><input id='editModal_status'  type='text' value=''></input></td></tr>";
    modalCntnt += "<tr><td>Description</td><td><input id='editModal_description'  type='text' value=''></input></td></tr>";
    modalCntnt += "<tr><td> Vendor</td><td><input  id='editModal_vendor'  type='text' value=''></input>  </td></tr>";
    modalCntnt += "<tr><td>Amount</td><td><input  id='editModal_amount'  type='text' value=''></input></td></tr>";
    modalCntnt += "<tr><td>Currency</td><td><input  id='editModal_currency'  type='text' value=''></input></td> </tr>"; 
    modalCntnt += "<tr><td>Reccuring?</td><td><select  id='recurringDropDown'>";
   for (var j=0; j< window.recurringArr.length; j++){ 
           modalCntnt += "<option value="+window.recurringArr[j]+">"+window.recurringArr[j]+"</option>"; 
   } 
   modalCntnt += "</select></td></tr>";  
   modalCntnt += "<tr><td>Priority</td><td><select  id='priorityDropDown'>";
   for (var j=0; j< window.priorityArr.length; j++){ 
           modalCntnt += "<option value="+window.priorityArr[j]+">"+window.priorityArr[j]+"</option>"; 
   } 
   modalCntnt += "</select></td></tr>";  
    modalCntnt += "</table>";
    modalCntnt += "</div>";
    modalCntnt += "<div class='modal-footer'>";
    modalCntnt += "<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>";
    modalCntnt += "<button class='btn btn-primary' onclick='saveUpdateCaller()'>Save</button>";

    modalCntnt += "</div>";
    modalCntnt += "</div>";
    $('#purchaseContainer').append(modalCntnt);
    $('#myPurchaseModal').modal({
        "keyboard": true,
        "show": true});
}
function saveUpdateCaller(system_id) {
    var pr_number;
    var year = $('#yearSelectMenu :selected').text();
    var params = "";
    if ($("#editModal_pr_number").val() != undefined) {
        var pr_number = replaceAll(" ", "***", $("#editModal_pr_line").val());
        params += '&pr_number=' + pr_number;
    }
     if ($('#recurringDropDown :selected').val() != undefined) {
        var recurring = replaceAll(" ", "***", $('#recurringDropDown :selected').val());
        params += '&recurring=' + recurring;
    }
     if ($('#priorityDropDown :selected').val() != undefined) {
        var priority = replaceAll(" ", "***", $('#priorityDropDown :selected').val());
        params += '&priority=' + priority;
    }
    if (system_id != undefined) { 
        params += '&system_id=' + system_id; 
    }
    if ($("#editModal_pr_line").val() != undefined) {
        var pr_line = replaceAll(" ", "***", $("#editModal_pr_line").val());
        params += '&pr_line=' + pr_line;
    }
    if ($("#editModal_gl_account").val() != undefined) {
        var gl_account = replaceAll(" ", "***", $("#editModal_gl_account").val());
        params += '&gl_account=' + gl_account;
    }
    if ($("#editModal_po_number").val() != undefined) {
        var po_number = replaceAll(" ", "***", $("#editModal_po_number").val());
        params += '&po_number=' + po_number;
    }
    if ($("#editModal_cost_center").val() != undefined) {
        var cost_center = replaceAll(" ", "***", $("#editModal_cost_center").val());
        params += '&cost_center=' + cost_center;
    }
    if ($("#editModal_budget_line_item").val() != undefined) {
        var budget_line_item = replaceAll(" ", "***", $("#editModal_budget_line_item").val());
        params += '&budget_line_item=' + budget_line_item;
    }
    if ($("#editModal_status").val() != undefined) {
        var status = replaceAll(" ", "***", $("#editModal_status").val());
        params += '&status=' + status;
    }
    if ($("#editModal_description").val() != undefined) {
        var description = replaceAll(" ", "***", $("#editModal_description").val());
        params += '&description=' + description;
    }
    if ($("#editModal_vendor").val() != undefined) {
        var vendor = replaceAll(" ", "***", $("#editModal_vendor").val());
        params += '&vendor=' + vendor;
    }
    if ($("#editModal_amount").val() != undefined) {
        var amount = replaceAll(" ", "***", $("#editModal_amount").val());
        params += '&amount=' + amount;
    }
    if ($("#editModal_currency").val() != undefined) {
        var currency = replaceAll(" ", "***", $("#editModal_currency").val());
        params += '&currency=' + currency;
    }
    
     if ($("#editModal_requestor").val() != undefined) {
        var requestor = replaceAll(" ", "***", $("#editModal_requestor").val());
        params += '&requestor=' + requestor;
    }
    
     if ($("#editModal_project").val() != undefined) {
        var project = replaceAll(" ", "***", $("#editModal_project").val());
        params += '&project=' + project;
    }
        params += '&year='+year;
//    var budget_line_item =  replaceAll(" ", "***", $("#editModal_budget_line_item").val());
//    var status =  replaceAll(" ", "***", $("#editModal_status").val());
//    var description =  replaceAll(" ", "***", $("#editModal_description").val());
//    var vendor =  replaceAll(" ", "***", $("#editModal_vendor").val());
//    var amount =  replaceAll(" ", "***", $("#editModal_amount").val());
//    var currency =  replaceAll(" ", "***", $("#editModal_currency").val()); 
//    
//    var params='&system_id='+system_id++'&pr_line='+pr_line++++
//            '&requestor='+requestor+'&requestor='+requestor++++
//           ++'&currency='+currency;
    var SaveUpdatePurchaseCommand = new OssGateWayCommand();
    SaveUpdatePurchaseCommand.url = OssServices.getInstance().controllerUrl + 'SaveUpdatePurchase' + params;
    SaveUpdatePurchaseCommand.error = 'SaveUpdatePurchaseCommand Service: Received error from server';
    SaveUpdatePurchaseCommand.caller = nothingtocall;
    SaveUpdatePurchaseCommand.execute();
    $("#myPurchaseModal").modal('hide');
    //  $("#myPurchaseModal").remove();
    PurchaseReqModel.getInstance().createPurchaseReqDataModel();

}
function nothingtocall() {

}

function deletePurchase(system_id) {
    var r = confirm("Are You sure you want to delete this purchase");
    if (r == true)
    {
         var DeletePurchaseCommand = new OssGateWayCommand();
        DeletePurchaseCommand.url = OssServices.getInstance().controllerUrl + 'DeletePurchase&system_id=' + system_id;
        DeletePurchaseCommand.error = 'DeletePurchaseCommand Service: Received error from server';
        DeletePurchaseCommand.caller = nothingtocall;
        DeletePurchaseCommand.execute();
        PurchaseReqModel.getInstance().createPurchaseReqDataModel();
    }
    else
    {
       return;
    }
   
}