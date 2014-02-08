/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function GetQMSHtml(projectName) {
    if (projectName != undefined) {
        var GetQMSHtmlDataCommand = new DashboardGateWayCommand();
        GetQMSHtmlDataCommand.url = DashboardServices.getInstance().controllerUrl + 'GetQmsHtml&projectName=' + projectName;
        GetQMSHtmlDataCommand.error = 'GetQMSData Service: Received error from server';
        GetQMSHtmlDataCommand.caller = CreateQMSModal;
        GetQMSHtmlDataCommand.execute();
    } else {
        alert("Could not capture project Name");
    }
}

function LaunchQmsPage(npi_id) {
    if (npi_id != undefined) {
        var GetQMSComponentDataCommand = new DashboardGateWayCommand();
        GetQMSComponentDataCommand.url = DashboardServices.getInstance().controllerUrl + 'GetQmsComponentId&npi_id=' + npi_id;
        GetQMSComponentDataCommand.error = 'GetQMSComponentData Service: Received error from server';
        GetQMSComponentDataCommand.caller = GoToQMSPage;
        GetQMSComponentDataCommand.execute();
    } else {
        alert("Could not capture project Name");
    }
}
function GoToQMSPage(data){
    if(data.response == undefined || data.response == ""){
        modalHtml += "No Data Found";
    }
    if(data.response.error!= undefined){
        alert (data.response.error);
    }
    var url = "http://ipmaturity.freescale.net:8080/partView.php?componentid=";
    /*window.location = url+data.response;
*/
	var win = window.open(url+data.response, 'QMS');
	win.focus()
    
}
function CreateQMSModal(data){
    if($("#qmsModal")){
        $("#qmsModal").remove();
    } 
  //  alert (financialsJson.Die_Size.cellValue);
    var modalHtml = "<div id='qmsModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
    modalHtml +="<div class='modal-header'>"; 
    modalHtml +="<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"; 
    modalHtml +="<h3 id='myModalLabel'>QMS </h3>"; 
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
    $('#qmsModalContainer').append(modalHtml);
    $('#qmsModal').modal({
        	//"backdrop" : "static",
        	"keyboard" : true,
        	"show" : true});
}
