
function GetMilestonesView(index) {
    if ($("#milestonesModal")) {
        $("#milestonesModal").remove();
    }
    var milestonesJson = NpiDataModel.getInstance().npiData.response.allDataRows[index].milestones;
    //  alert (financialsJson.Die_Size.cellValue);
    var modalHtml = "<div id='milestonesModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
    modalHtml += "<div class='modal-header'>";
    modalHtml += "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>";
    modalHtml += "<h3 id='myModalLabel'>Milestones for " + NpiDataModel.getInstance().npiData.response.allDataRows[index].Project + " </h3>";
    modalHtml += "</div>";
    modalHtml += "<div class='modal-body'>";
    modalHtml += "<table class='tablesorter table table-bordered'>";
    modalHtml +="<thead><tr class='allProjectTableHead'><th></td><th data-placeholder=''>Target</th><th data-placeholder='' >Actual / Forecast</th></tr></thead>";
    if(!isBlankString(milestonesJson.MM_TO_1_0_Tape_Out_Tgt) || !isBlankString(milestonesJson.MM_TO_1_0_Tape_Out.cellValue)){
    modalHtml += "<tr><td>MM-TO 1.0 Tape Out</td><td>"+milestonesJson.MM_TO_1_0_Tape_Out_Tgt+"</td><td class='" + milestonesJson.MM_TO_1_0_Tape_Out.cellColor + "'>" + milestonesJson.MM_TO_1_0_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._1_0_Cust_Samples_Tgt) || !isBlankString(milestonesJson._1_0_Cust_Samples.cellValue)){
    modalHtml += "<tr><td>1.0 Cust Samples Act</td><td>"+milestonesJson._1_0_Cust_Samples_Tgt+"</td><td class='" + milestonesJson._1_0_Cust_Samples.cellColor + "'>" + milestonesJson._1_0_Cust_Samples.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson.MM_TO1_1_Tape_Out_Tgt) || !isBlankString(milestonesJson.MM_TO1_1_Tape_Out.cellValue)){
    modalHtml += "<tr><td>MM-TO1.1 Tape Out</td><td>"+milestonesJson.MM_TO1_1_Tape_Out_Tgt+"</td><td class='" + milestonesJson.MM_TO1_1_Tape_Out.cellColor + "'>" + milestonesJson.MM_TO1_1_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._1_1_Cust_Samples_Tgt) || !isBlankString(milestonesJson._1_1_Cust_Samples.cellValue)){
    modalHtml += "<tr><td>1.1 Cust Samples</td><td>"+milestonesJson._1_1_Cust_Samples_Tgt+"</td><td class='" + milestonesJson._1_1_Cust_Samples.cellColor + "'>" + milestonesJson._1_1_Cust_Samples.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson.MM_TO1_2_Tape_Out_Tgt) || !isBlankString(milestonesJson.MM_TO1_2_Tape_Out.cellValue)){
    modalHtml += "<tr><td>MM-TO1.2 Tape Out</td><td>"+milestonesJson.MM_TO1_2_Tape_Out_Tgt+"</td><td class='" + milestonesJson.MM_TO1_2_Tape_Out.cellColor + "'>" + milestonesJson.MM_TO1_2_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._1_2_Cust_Samples_Tgt) || !isBlankString(milestonesJson._1_2_Cust_Samples.cellValue)){
    modalHtml += "<tr><td>1.2 Cust Samples</td><td>"+milestonesJson._1_2_Cust_Samples_Tgt+"</td><td class='" + milestonesJson._1_2_Cust_Samples.cellColor + "'>" + milestonesJson._1_2_Cust_Samples.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson.MM_TO2_0_Tape_Out_Tgt) || !isBlankString(milestonesJson.MM_TO2_0_Tape_Out.cellValue)){
    modalHtml += "<tr><td>MM-TO2.0 Tape Out</td><td>"+milestonesJson.MM_TO2_0_Tape_Out_Tgt+"</td><td class='" + milestonesJson.MM_TO2_0_Tape_Out.cellColor + "'>" + milestonesJson.MM_TO2_0_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._2_0_Cust_Samples_Tgt) || !isBlankString(milestonesJson._2_0_Cust_Samples.cellValue)){
    modalHtml += "<tr><td>2.0 Cust Samples</td><td>"+milestonesJson._2_0_Cust_Samples_Tgt+"</td><td class='" + milestonesJson._2_0_Cust_Samples.cellColor + "'>" + milestonesJson._2_0_Cust_Samples.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson.MM_TO2_1_Tape_Out_Tgt) || !isBlankString(milestonesJson.MM_TO2_1_Tape_Out.cellValue)){
    modalHtml += "<tr><td>MM-TO2.1 Tape Out</td><td>"+milestonesJson.MM_TO2_1_Tape_Out_Tgt+"</td><td class='" + milestonesJson.MM_TO2_1_Tape_Out.cellColor + "'>" + milestonesJson.MM_TO2_1_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._2_1_Cust_Samples_Tgt) || !isBlankString(milestonesJson._2_1_Cust_Samples.cellValue)){
    modalHtml += "<tr><td>2.1 Cust Samples Act</td><td>"+milestonesJson._2_1_Cust_Samples_Tgt+"</td><td class='" + milestonesJson._2_1_Cust_Samples.cellColor + "'>" + milestonesJson._2_1_Cust_Samples.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson.Proto_Enbl_Tools_Tgt) || !isBlankString(milestonesJson.Proto_Enbl_Tools.cellValue)){
    modalHtml += "<tr><td>Proto Enbl Tools</td><td>"+milestonesJson.Proto_Enbl_Tools_Tgt+"</td><td class='" + milestonesJson.Proto_Enbl_Tools.cellColor + "'>" + milestonesJson.Proto_Enbl_Tools.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson.Proto_EVB_Hardware_Tgt) || !isBlankString(milestonesJson.Proto_EVB_Hardware.cellValue)){
    modalHtml += "<tr><td>Proto EVB Hardware</td><td>"+milestonesJson.Proto_EVB_Hardware_Tgt+"</td><td class='" + milestonesJson.Proto_EVB_Hardware.cellColor + "'>" + milestonesJson.Proto_EVB_Hardware.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson.Proto_SW_Drivers_Tgt) || !isBlankString(milestonesJson.Proto_SW_Drivers.cellValue)){
    modalHtml += "<tr><td>Proto SW Drivers</td><td>"+milestonesJson.Proto_SW_Drivers_Tgt+"</td><td class='" + milestonesJson.Proto_SW_Drivers.cellColor + "'>" + milestonesJson.Proto_SW_Drivers.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson.Qual_Compl_Tgt) || !isBlankString(milestonesJson.Qual_Compl.cellValue)){
    modalHtml += "<tr><td>Qual Compl</td><td>"+milestonesJson.Qual_Compl_Tgt+"</td><td class='" + milestonesJson.Qual_Compl.cellColor + "'>" + milestonesJson.Qual_Compl.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._1_1_Tape_Out_Tgt) || !isBlankString(milestonesJson._1_1_Tape_Out.cellValue)){
    modalHtml += "<tr><td>1.1 Tape Out</td><td>"+milestonesJson._1_1_Tape_Out_Tgt+"</td><td class='" + milestonesJson._1_1_Tape_Out.cellColor + "'>" + milestonesJson._1_1_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._1_1_Qual_Complete_Tgt) || !isBlankString(milestonesJson._1_1_Qual_Complete.cellValue)){
    modalHtml += "<tr><td>1.1 Qual Complete</td><td>"+milestonesJson._1_1_Qual_Complete_Tgt+"</td><td class='" + milestonesJson._1_1_Qual_Complete.cellColor + "'>" + milestonesJson._1_1_Qual_Complete.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._1_2_Tape_Out_Tgt) || !isBlankString(milestonesJson._1_2_Tape_Out.cellValue)){
    modalHtml += "<tr><td>1.2 Tape Out</td><td>"+milestonesJson._1_2_Tape_Out_Tgt+"</td><td class='" + milestonesJson._1_2_Tape_Out.cellColor + "'>" + milestonesJson._1_2_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._1_3_Tape_Out_Tgt) || !isBlankString(milestonesJson._1_3_Tape_Out.cellValue)){
    modalHtml += "<tr><td>1.3 Tape Out</td><td>"+milestonesJson._1_3_Tape_Out_Tgt+"</td><td class='" + milestonesJson._1_3_Tape_Out.cellColor + "'>" + milestonesJson._1_3_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._2_1_Tape_Out_Tgt) || !isBlankString(milestonesJson._2_1_Tape_Out.cellValue)){
    modalHtml += "<tr><td>2.1 Tape Out</td><td>"+milestonesJson._2_1_Tape_Out_Tgt+"</td><td class='" + milestonesJson._2_1_Tape_Out.cellColor + "'>" + milestonesJson._2_1_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._2_1_Qual_Complete_Tgt) || !isBlankString(milestonesJson._2_1_Qual_Complete.cellValue)){
    modalHtml += "<tr><td>2.1 Qual Complete</td><td>"+milestonesJson._2_1_Qual_Complete_Tgt+"</td><td class='" + milestonesJson._2_1_Qual_Complete.cellColor + "'>" + milestonesJson._2_1_Qual_Complete.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._2_2_Tape_Out_Tgt) || !isBlankString(milestonesJson._2_2_Tape_Out.cellValue)){
    modalHtml += "<tr><td>2.2 Tape Out</td><td>"+milestonesJson._2_2_Tape_Out_Tgt+"</td><td class='" + milestonesJson._2_2_Tape_Out.cellColor + "'>" + milestonesJson._2_2_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._2_2_Qual_Complete_Tgt) || !isBlankString(milestonesJson._2_2_Qual_Complete.cellValue)){
    modalHtml += "<tr><td>2.2 Qual Complete</td><td>"+milestonesJson._2_2_Qual_Complete_Tgt+"</td><td class='" + milestonesJson._2_2_Qual_Complete.cellColor + "'>" + milestonesJson._2_2_Qual_Complete.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._2_3_Tape_Out_Tgt) || !isBlankString(milestonesJson._2_3_Tape_Out.cellValue)){
    modalHtml += "<tr><td>2.3 Tape Out</td><td>"+milestonesJson._2_3_Tape_Out_Tgt+"</td><td class='" + milestonesJson._2_3_Tape_Out.cellColor + "'>" + milestonesJson._2_3_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._2_4_Tape_Out_Tgt) || !isBlankString(milestonesJson._2_4_Tape_Out.cellValue)){
    modalHtml += "<tr><td>2.4 Tape Out</td><td>"+milestonesJson._2_4_Tape_Out_Tgt+"</td><td class='" + milestonesJson._2_4_Tape_Out.cellColor + "'>" + milestonesJson._2_4_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._3_0_Tape_Out_Tgt) || !isBlankString(milestonesJson._3_0_Tape_Out.cellValue)){
    modalHtml += "<tr><td>3.0 Tape Out</td><td>"+milestonesJson._3_0_Tape_Out_Tgt+"</td><td class='" + milestonesJson._3_0_Tape_Out.cellColor + "'>" + milestonesJson._3_0_Tape_Out.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._3_0_Customer_Samples_Tgt) || !isBlankString(milestonesJson._3_0_Customer_Samples.cellValue)){
    modalHtml += "<tr><td>3.0 Customer Samples</td><td>"+milestonesJson._3_0_Customer_Samples_Tgt+"</td><td class='" + milestonesJson._3_0_Customer_Samples.cellColor + "'>" + milestonesJson._3_0_Customer_Samples.cellValue + "</td>";
    }
    if(!isBlankString(milestonesJson._3_0_Qual_Complete_Tgt) || !isBlankString(milestonesJson._3_0_Qual_Complete.cellValue)){
    modalHtml += "<tr><td>3.0 Qual Complete</td><td>"+milestonesJson._3_0_Qual_Complete_Tgt+"</td><td class='" + milestonesJson._3_0_Qual_Complete.cellColor + "'>" + milestonesJson._3_0_Qual_Complete.cellValue + "</td>";
    }
    //modalHtml +="<tr><td>3.1 Customer Samples</td><td class='"+milestonesJson._3_1_Customer_Samples.cellColor+"'>"+milestonesJson._3_1_Customer_Samples.cellValue+"</td>";
    if(!isBlankString(milestonesJson._3_1_Qual_Complete_Tgt) || !isBlankString(milestonesJson._3_1_Qual_Complete.cellValue)){
    modalHtml += "<tr><td>3.1 Qual Complete</td><td>"+milestonesJson._3_1_Qual_Complete_Tgt+"</td><td class='" + milestonesJson._3_1_Qual_Complete.cellColor + "'>" + milestonesJson._3_1_Qual_Complete.cellValue + "</td>";
    }
    modalHtml += "</table>";
    modalHtml += "</div>";
    modalHtml += "<div class='modal-footer'>";
    modalHtml += "<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>";
    modalHtml += "</div>";
    $('#milestonesModalContainer').append(modalHtml); 
    $('#milestonesModal').modal({
        "keyboard": true,
        "show": true});
     //applyFilter();
}