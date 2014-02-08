function showLoader() {
    $('#myLoadDiv').show();
    $('html').addClass('modalWindowOn');
}

function hideLoader() {
    $('#myLoadDiv').hide();
    $('html').removeClass('modalWindowOn');
}

function createBurnDownModalWindow(index) {


    //   showLoader();
    if ($("#burnDownModal")) {
        $("#burnDownModal").remove();
    }
    var src = "";
    var projectName = NpiDataModel.getInstance().npiData.response.allDataRows[index].Project;
//    if(projectName == "Qorivva 5705_McKinley"){
//        src="images/mckinley.png";
//    }else if(projectName == "Matterhorn"){
//        src="images/Matterhorn.png";
//    }else if(projectName == "MPC5777C (Cobra55)"){
//        src="images/cobra55Burndown.png";
//    }

    //  alert (financialsJson.Die_Size.cellValue);
    var modalHtml = "<div id='burnDownModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
    modalHtml += "<div class='modal-header'>";
    modalHtml += "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>";
    modalHtml += "<h3 id='myModalLabel'>Burndown for " + NpiDataModel.getInstance().npiData.response.allDataRows[index].Project + " </h3>";
    modalHtml += "</div>";
    modalHtml += "<div class='modal-body'>";
    modalHtml += "<input type='hidden' name='burndown_modal_npi_id' id = 'burndown_modal_npi_id' value=" + NpiDataModel.getInstance().npiData.response.allDataRows[index].NPI_ID + ">";
    var tapeoutMilestoneVal = NpiDataModel.getInstance().npiData.response.allDataRows[index].milestonesTapeOutFct;
    if(tapeoutMilestoneVal == undefined)
        tapeoutMilestoneVal  = "";
    modalHtml += "<input type='hidden' name='milestonesTapeOutFct' id = 'milestonesTapeOutFct' value=" + tapeoutMilestoneVal + ">";
     modalHtml += "<div class='burndownOptionContainer'>";
    modalHtml += "<div class='burnDownDropdown'>";
//  modalHtml +="<button class='btn dropdown-toggle' role='button' data-toggle='dropdown' id='burdownDropDOwnBtn'>Other Burdown Charts <b class='caret'></b></button>";
//  modalHtml +="<ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>";  
//   modalHtml +="<li><a>Errata </a>";
//   modalHtml +="<li><a>Ver </a>";
//   modalHtml +="<li><a>Pre Si</a></li>";
//   modalHtml +="<li><a>Val</a></li>";
//   modalHtml +="<li><a>Fs</a></li>";
//   modalHtml +="<li><a>Test</a></li>";  
    //modalHtml +="</ul> </div>";
    modalHtml += "<select onchange='ChangeGraph()' id='burnDownSelectMenu'>";
    modalHtml += "<option value='Errata'>Errata</option>";
    modalHtml += "<option value='RM'>RM</option>";
    modalHtml += "<option value='Ver'>Ver</option>";
    modalHtml += "<option value='Pre Si'>Pre Si</option>";
    modalHtml += "<option value='Val'>Val</option>";
    modalHtml += "<option value='Fs'>Fs</option>";
    modalHtml += "<option value='Test'>Test</option>";
    modalHtml += "</select>";
    modalHtml += "  </div>";
    modalHtml += "<div id='burndownUploadDiv' class='burndownUploadDiv'>";
    //  modalHtml += "<input id='fileupload' type='file' name='files' data-url='service.php?service=UploadBurndownExcel' multiple>";
//  modalHtml +=" <div id= 'progress' >";
//  modalHtml +=  "<div class='bar' style='width: 0%;'></div>";
    modalHtml += "</div>";
    modalHtml += "</div>";
    //   modalHtml +="<img src='"+src+"' />"; 
    modalHtml += "<div id='burndownVisualization' style='width: 800px; height: 350px;'></div>";
    modalHtml += "</div>";
    modalHtml += "<div class='modal-footer'>";
    modalHtml += "<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>";
    modalHtml += "</div></div>";
    $('#burnDownModalContainer').append(modalHtml);
    $('#burnDownModal').modal({
        "keyboard": true,
        "show": true});
    // initializeUploadBtn();

    DrawBurnDownChart(NpiDataModel.getInstance().npiData.response.allDataRows[index].NPI_ID, 'Errata');
    // hideLoader();
}
function ChangeGraph() {
    $("#burndownVisualization").html("");
    DrawBurnDownChart($("#burndown_modal_npi_id").val(), $("#burnDownSelectMenu option:selected").val());

}
//function putprogressBar(){
//    var content = "<div id='myLoadDiv'>";
//	 content+="<div id='overlay-container' style='opacity: 0.5;'></div>";
//     content+="<div id='burnDownProgressBar' class='progress progress-striped active'>";
//        content+="<div class='bar' style='width: 100%;'></div>";
//        content+="</div></div>";
//        $('#myLoadDiv').show();
//}
//function removeProgressBar(){
//    $("#burnDownProgressBar").remove();
//}
function DrawBurnDownChart(npi_id, chart_type) {
    if (chart_type != undefined && chart_type == 'Errata') {
       
        var GetBurnDOwnDataCommand = new DashboardGateWayCommand();
        //GetBurnDOwnDataCommand.url = DashboardServices.getInstance().controllerUrl + 'GetErrataChart&rootItemNumber=SOC_MPC5746M_McKinley_cmos055fg_6m4x0y1z_001' ;
        GetBurnDOwnDataCommand.url = DashboardServices.getInstance().controllerUrl + 'GetErrataChart&npi_id=' + npi_id;

        GetBurnDOwnDataCommand.error = 'GetBurnDOwnData Service: Received error from server';
        GetBurnDOwnDataCommand.caller = GetErrataBurndownCallback;
        GetBurnDOwnDataCommand.execute();
    } else {
        removePdmPartInput();
        // alert("Could not capture project id or chart type");
    }
}
function removePdmPartInput() {
    $("#burndownUploadDiv").html("");
}
function addPdmPartInput(velocity, rootItemNumber) {
    if ($("#inputPartnumber")) {
        $("#inputPartnumber").remove();
    }
    var contnt = "<div id='inputPartnumber'>";
    var tapeout= $("#milestonesTapeOutFct").val();
    //var velocity = $("#velocity").val();
     if(tapeout != undefined && $.trim(tapeout) != ""){
      contnt += "TapeOut: "+tapeout+" ";
    }
    if(velocity != undefined && $.trim(velocity) != ""){
        if(velocity < 1){
            contnt += "<strong><font color='red'>";
        }
      contnt += "Velocity: "+parseFloat(velocity).toFixed(2);
      if(velocity < 1){
            contnt += "</font></strong>";
        }
    }
//    contnt += "<input type='text' name='pdmPartNumber' id='pdmPartNumber' ></input>";
//    contnt += "<button class='btn' onclick='SavePdmPartNumber()'>Update</button><br> ";
    contnt += "<br> ";
    if(rootItemNumber != undefined && $.trim(rootItemNumber) != ""){
         contnt += "Pdm Part Number: "+rootItemNumber ;   
    }
    contnt+="</div>";
    $("#burndownUploadDiv").append(contnt);
}
function GetErrataBurndownCallback(data) {
    if (data.response != undefined && data.response != 0) {
        if (data.response.noPdm == undefined) {
            drawErrataVisualization(data.response.chartData);
             addPdmPartInput(data.response.velocity, data.response.rootItemNumber);
        } else {
             addPdmPartInput(undefined, undefined);
            $("#burndownVisualization").html("");
            $("#burndownVisualization").append(data.response.noPdm);
        }
    }
}

function SavePdmPartNumber() {
    var inputVal = $("#pdmPartNumber").val();
    if (inputVal == "" || $.trim(inputVal) == "") {
        return;
    }
    var npi_id = $("#burndown_modal_npi_id").val();
    var SavePartNumberDataCommand = new DashboardGateWayCommand();
    //GetBurnDOwnDataCommand.url = DashboardServices.getInstance().controllerUrl + 'GetErrataChart&rootItemNumber=SOC_MPC5746M_McKinley_cmos055fg_6m4x0y1z_001' ;
    SavePartNumberDataCommand.url = DashboardServices.getInstance().controllerUrl + 'SaveUpdateNpiPdmMap&npi_id=' + npi_id + '&pdmPartNumber=' + inputVal;

    SavePartNumberDataCommand.error = 'GetBurnDOwnData Service: Received error from server';
    SavePartNumberDataCommand.caller = saveUpdatePdmCallback;
    SavePartNumberDataCommand.execute();
}
function saveUpdatePdmCallback() {
    DrawBurnDownChart($("#burndown_modal_npi_id").val(), 'Errata');
}
function drawErrataVisualization(dataTable) {
    // Some raw data (not necessarily accurate)
    // google.load("visualization", "1", {packages:["corechart"]}); 
    var data = google.visualization.arrayToDataTable(dataTable);
    var ac = new google.visualization.ComboChart(document.getElementById('burndownVisualization'));
    ac.draw(data, {
        title: 'Burndown',
        isHtml: true,
        isStacked: true,
        width: '800',
        height: '350',
        animation: {
            duration: 1000,
            easing: 'out'
        },
        vAxis: {title: "Ticket #"},
        hAxis: {title: "Month (YY-WW)"},
          seriesType: "bars",
	series: {2: {type: "line"}, 3: {type: "line"}}
    });
}

