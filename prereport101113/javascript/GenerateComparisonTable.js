/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

   function createComaprisonTable(data){
        
        var allArchiveData = data.response;
        // alert(data.response);   
          //alert(data.response.length); 
          var allDates = data.allDates; 
           var allProjects = allArchiveData.allProjects;
            var content = "<table class='table table-bordered'>"; 
            var altColor = new Array();
                altColor[0] = "greenRow";
                altColor[1] = "yellowRow";
             var currRow = 0;
            
            for (var i = 0; i < allProjects.length; i++) {
                if(allArchiveData[allProjects[i]].length > 0){
                content += "<tr  class='projectHeading'>";
               content += "<td > Project </td>";
             content += "<td> Resource Name </td>";
             content += "<td> Resource Role </td>";
             content += "<td> Month </td>";
             content += "<td> Changes </td>";
               content += "<td> History </td>";
//              for (var l = 0; l < allDates.length; l++){
//                   content += "<td>"+allDates[l]+"</td>";
//              }
              content += "</tr><tr>";
                for (var j = 0; j < allProjects[i].length; j++){
                     if (currRow > 1){
                         currRow = 0;
                         }
                   var oneResrc = allArchiveData[allProjects[i]][j];
                   if (oneResrc != undefined &&   oneResrc['resource_name'] != undefined){
                    content += "<tr class="+altColor[currRow]+"><td>"+ allProjects[i]+"</td>";
                    content += "<td>"+oneResrc['resource_name']+"</td>";
                       content += "<td>"+oneResrc['role']+"</td><td>";
                       var dateChanges = oneResrc['dateChanges'];
                       for (var k = 0; k < dateChanges.length; k++){
                        content +=  dateChanges[k][0]+"<br>"; 
                    }
                     content += "</td><td>";
                     for (var k = 0; k < dateChanges.length; k++){ 
                        content +=  dateChanges[k][1]+"%<br>";
                       
                    }
                    content += "</td><td>"+ oneResrc['history']+"</td></tr>";
                    }
                    currRow++;
                }
                content += "</tr>";
                }
            }
            content += "</table>";
           // alert(content);
            //  alert(allArchiveData);
            $("#compareTableContainer").append(content);
            }

function ChangeRegion(){
   var regionSelected =   $("#regionSelectMenu option:selected").val();
  location.href = 'getArchiveData.php?region='+regionSelected;
}