 
function createBurnDownModalWindow(index) {
    if ($("#burnDownModal")) {
        $("#burnDownModal").remove();
    }
    //  alert (financialsJson.Die_Size.cellValue);
    var modalHtml = "<div id='burnDownModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
    modalHtml += "<div class='modal-header'>";
    modalHtml += "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>";
    modalHtml += "<h3 id='myModalLabel'>Burndown for " + NpiDataModel.getInstance().npiData.response.allDataRows[index].Project + " </h3>";
    modalHtml += "</div>";
    modalHtml += "<div class='modal-body'>";
    modalHtml += "<input type='hidden' name='burndown_modal_npi_id' id = 'burndown_modal_npi_id' value="+ NpiDataModel.getInstance().npiData.response.allDataRows[index].NPI_ID+">";
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
    modalHtml += "<input id='fileupload' type='file' name='files' data-url='service.php?service=UploadBurndownExcel' multiple>";
//  modalHtml +=" <div id= 'progress' >";
//  modalHtml +=  "<div class='bar' style='width: 0%;'></div>";
    modalHtml += "</div>";
    modalHtml += "</div>";
    // modalHtml +="<img src='images/cobra55Burndown.png' />"; 
    modalHtml += "<div id='burndownVisualization' style='width: 800px; height: 350px;'></div>";
    modalHtml += "</div>"; 
    modalHtml += "<div class='modal-footer'>";
    modalHtml += "<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>";
    modalHtml += "</div></div>";
    $('#burnDownModalContainer').append(modalHtml);
    $('#burnDownModal').modal({
        "keyboard": true,
        "show": true});
    initializeUploadBtn();
    
    DrawBurnDownChart( NpiDataModel.getInstance().npiData.response.allDataRows[index].NPI_ID, 'Errata');
}
function ChangeGraph(){
     $("#burndownVisualization").html("");
    DrawBurnDownChart($("#burndown_modal_npi_id").val(), $("#burnDownSelectMenu option:selected").val());
   
}
function DrawBurnDownChart(npi_id, chart_type) {
    if (npi_id != undefined && chart_type != undefined ) {
        var GetBurnDOwnDataCommand = new DashboardGateWayCommand();
        GetBurnDOwnDataCommand.url = DashboardServices.getInstance().controllerUrl + 'GetBurndownChart&npi_id=' + npi_id+'&burndownChartType='+chart_type;
        GetBurnDOwnDataCommand.error = 'GetBurnDOwnData Service: Received error from server';
        GetBurnDOwnDataCommand.caller = GetBurndownCallback;
        GetBurnDOwnDataCommand.execute();
    } else {
        alert("Could not capture project id or chart type");
    }
}

function GetBurndownCallback(data){
    if(data.response != undefined && data.response != 0){
        drawVisualization(data.response);
    }
}
function drawVisualization(dataTable) {
    // Some raw data (not necessarily accurate)

    var data = google.visualization.arrayToDataTable(dataTable);
    var ac = new google.visualization.AreaChart(document.getElementById('burndownVisualization'));
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
        vAxis: {title: "Hours"},
        hAxis: {title: "Month"}
    });
}