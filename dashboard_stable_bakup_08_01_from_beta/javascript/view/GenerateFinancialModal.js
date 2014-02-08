
function GetFinancialView(index){
    if($("#financialsModal")){
        $("#financialsModal").remove();
    }
    var financialsJson = NpiDataModel.getInstance().npiData.response.allDataRows[index].Financials;
  //  alert (financialsJson.Die_Size.cellValue);
    var modalHtml = "<div id='financialsModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
    modalHtml +="<div class='modal-header'>"; 
    modalHtml +="<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"; 
    modalHtml +="<h3 id='myModalLabel'>Financials for "+NpiDataModel.getInstance().npiData.response.allDataRows[index].Project+" </h3>"; 
    modalHtml +="</div>"; 
    modalHtml +="<div class='modal-body'>"; 
    modalHtml +="<table class='table table-bordered'>";
     modalHtml +="<tr><td></td><td>Target</td><td>Actual / Forecast</td></tr>";
     modalHtml +="<tr><td>Gross Margin</td><td>"+financialsJson.Gross_Margin_Tgt+"</td><td class='"+financialsJson.Gross_Margin.cellColor+"'>"+financialsJson.Gross_Margin.cellValue+"</td>";
    modalHtml +="<tr><td>Gross Margin (%)</td><td>"+financialsJson.Gross_Margin_percent_Tgt+"</td><td class='"+financialsJson.Gross_Margin_percent.cellColor+"'>"+financialsJson.Gross_Margin_percent.cellValue+"</td>";
    modalHtml +="<tr><td>Die Size</td><td>"+financialsJson.Die_Size_Tgt+"</td><td class='"+financialsJson.Die_Size.cellColor+"'>"+financialsJson.Die_Size.cellValue+"</td>";
    modalHtml +="<tr><td>NPV</td><td>"+financialsJson.NPV_Tgt+"</td><td class='"+financialsJson.NPV.cellColor+"'>"+financialsJson.NPV.cellValue+"</td>";
    modalHtml +="<tr><td>Hurdle Rate</td><td>"+financialsJson.Hurdle_Rate_Tgt+"</td><td class='"+financialsJson.Hurdle_Rate.cellColor+"'>"+financialsJson.Hurdle_Rate.cellValue+"</td>";
    modalHtml +="<tr><td>FTE</td><td>"+financialsJson.FTE_Tgt+"</td><td class='"+financialsJson.FTE.cellColor+"'>"+financialsJson.FTE.cellValue+"</td>";
    modalHtml +="</table>";
    modalHtml +="</div>"; 
    modalHtml +="<div class='modal-footer'>"; 
    modalHtml +="<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>" ; 
    modalHtml +="</div>"; 
    $('#financialsModalContainer').append(modalHtml);
    $('#financialsModal').modal({
        	"keyboard" : true,
        	"show" : true});
}