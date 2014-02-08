/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function GetRRHtml(npi_id) {
    if (npi_id != undefined) {
        var GetRRHtmlDataCommand = new DashboardGateWayCommand();
        GetRRHtmlDataCommand.url = DashboardServices.getInstance().controllerUrl + 'GetRRHtml&npi_id=' + npi_id;
        GetRRHtmlDataCommand.error = 'GetRRData Service: Received error from server';
        GetRRHtmlDataCommand.caller = CreateRRModal;
        GetRRHtmlDataCommand.execute();
    } else {
        alert("Could not capture npi id");
    }
}
 
function CreateRRModal(data){
    if($("#rrModal")){
        $("#rrModal").remove();
    } 
  //  alert (financialsJson.Die_Size.cellValue);
    var modalHtml = "<div id='rrModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
    modalHtml +="<div class='modal-header'>"; 
    modalHtml +="<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"; 
    modalHtml +="<h3 id='myModalLabel'>Right Review</h3>"; 
    modalHtml +="</div>"; 
    modalHtml +="<div class='modal-body'>"; 
    if(data.response == undefined || data.response == ""){
        modalHtml += "No Data Found";
    }else{
     modalHtml +=data.response; 
    }
    modalHtml +="</div>"; 
    modalHtml +="<div class='modal-footer'>"; 
    modalHtml +="<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>" ; 
    modalHtml +="</div>"; 
    $('#rrModalContainer').append(modalHtml);
    $('#rrModal .modal-body table').addClass('tablesorter table table-bordered rrModalTable');
  $('#rrModal .modal-body table thead tr').addClass('allProjectTableHead');
    $('#rrModal .modal-body table thead tr th').attr({"data-placeholder":""});
    $('#rrModal .modal-body table').removeAttr('style')
    $('#rrModal .modal-body table').attr({"style":"table-layout: fixed"});
   // $('#rrModal .modal-body table').addClass('table-bordered');
    $('#rrModal').modal({
        	//"backdrop" : "static",
        	"keyboard" : true,
        	"show" : true});
            applyFilter();
}
