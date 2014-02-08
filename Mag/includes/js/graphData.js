/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function roleOnClick(role){
    var activeClass= "activeRole";
    var inActiveClass= "inActiveRole";
   
    var roleID = "#"+role; 
    if($(roleID).hasClass(activeClass)){
         $(roleID).removeClass(activeClass);
         $(roleID).addClass(inActiveClass);
          removeRolesArr.push(role);
    }else{
         $(roleID).removeClass(inActiveClass);
         $(roleID).addClass(activeClass); 
          removeRolesArr.splice(role,1);
    }
}
function removeByIndex(arr, index) {
    arr.splice(index, 1);
    return arr;
}
var removeRolesArr = new Array();
var allRolesKeyArr = new Array();
function refreshGraph(){ 
    //alert(allData);alert(allRoles); alert(removeRolesArr); 
    var roleIdx =0;
    var allRawData =allData.slice();
         //  alert (" remorole11 "+ removeRolesArr.length);
    var retDataArr = new Array();
     for(var i=0 ;i< removeRolesArr.length; i++){
       roleIdx = Number(allRolesKeyArr.indexOf(removeRolesArr[i]))+1 ; 
         for(var j=0 ;j< allRawData.length; j++){
             var oneArr = allRawData[j].slice();
             var newOneArr = new Array();
             //alert('before splice '+ oneArr);
             newOneArr = removeByIndex(oneArr, roleIdx);
            // alert('after splice '+ newOneArr);

              retDataArr[j] =newOneArr ;
            }
     }
     //alert(retDataArr);
    //  $("#graphFilterMainDiv").append(retDataArr);
     drawVisualization(retDataArr);
     //return retDataArr;
}
function createRoleSelectorTable(allRoles){
    if ($('#filterTableId')){
        $('#filterTableId').remove();
    }
     var content = "<div id='filterTableId'><table class ='table toggle-table'><tr>";
     var tdCount =0; 
        //alert ("curr role = "+ currRole + " remorole"+ removeRolesArr.length);
    for(var i=0 ;i< allRoles.length; i++){
       var rawRole= allRoles[i];
       rawRole = String(rawRole).trim();
       var currRole = rawRole.replace(/ /g,"_");
         currRole = currRole.replace("/" ,"_");
        currRole = escape(currRole);
        allRolesKeyArr.push(currRole);
       if( $.inArray(currRole, removeRolesArr) == -1){
         content +=               "<td id='"+currRole+"' onclick= \"roleOnClick(\'"+currRole+"\')\" class='activeRole'>"+rawRole+"</td>";
       }else{
           
         content +=               "<td id='"+currRole+"' onclick= \"roleOnClick(\'"+currRole+"\')\" class='inActiveRole'>"+rawRole+"</td>";
       }
         if(tdCount == 3){
             content += "</tr><tr>";
             tdCount =0;
         }  else{
             tdCount++;
         }         
    }
     content +="</tr></table>";
     $("#graphFilterMainDiv").append(content);
}