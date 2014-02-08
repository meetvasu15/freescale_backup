/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function replaceAll(find, replace, str) {
    return str.replace(new RegExp(find, 'g'), replace);
}

function onMainTabClick(tabId) {
    hideAllTabs();
    if (tabId == "npiTab") {
        showNpiTab();
    } else if (tabId == "enterpriseTab") {
        showEnterpirseView();
    }
    else if (tabId == "ipTab") {
        showIpTab();
    }
    $("#" + tabId).addClass('active');
}
function showNpiTab() {
    $("#allNpiContent").show();
}
function showIpTab() {
    $("#allIpContent").show();
    if(!IpDataModel.getInstance().hasData){
     IpDataModel.getInstance().createIpDataModel();
    }
}
function showEnterpirseView() {
    if(EnterpriseRegionDataModel.getInstance().instantiated == false){
        intializeEnterpriseView();
        EnterpriseRegionDataModel.getInstance().instantiated = true;
    }
$("#allEnterpriseContent").show();
}
function hideAllTabs() {
    $("#allEnterpriseContent").hide();
    $("#allNpiContent").hide();
    $("#allIpContent").hide();
    $("#npiTab").removeClass('active');
    $("#ipTab").removeClass('active');
    $("#enterpriseTab").removeClass('active');
} 

function isBlankString(val){
    val =String(val).trim();
    if (val == undefined || 
            val == "" || 
            val.length <= 0){
        return true;
    }
    return false;
}

if(typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, ''); 
  }
}