/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function initializePage(){ 
    getAllYear();
    var today = new Date();
var thisYear = today.getFullYear();
PurchaseReqModel.getInstance().year = thisYear;
   PurchaseReqModel.getInstance().createPurchaseReqDataModel();
   $("#yearSelectMenu").val(thisYear);
}
function getAllYear(){
    var GetPurchaseYearCommand = new OssGateWayCommand();
            GetPurchaseYearCommand.url = OssServices.getInstance().controllerUrl+'GetPurchaseYear';
            GetPurchaseYearCommand.error = 'GetPurchaseYear Service: Received error from server';
            GetPurchaseYearCommand.caller = CreateYearDropdown;
            GetPurchaseYearCommand.execute();
}

function CreateYearDropdown(data){
    var allYears = data.response.allYearArray;
     var cntnt = "<select  id='yearSelectMenu' onchange='onYearChangeVal(this.value)'>";
     for (var i = 0; i< allYears.length; i++){
         cntnt +=   "<option value="+allYears[i]+ ">"+allYears[i]+"</option>" 
     }
     cntnt +=   "</select>";
     $("#yearDropContainer").append(cntnt);
}
function replaceAll(find, replace, str) {
    return str.replace(new RegExp(find, 'g'), replace);
}