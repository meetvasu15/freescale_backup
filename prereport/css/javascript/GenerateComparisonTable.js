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
            for (var i = 0; i < allProjects.length; i++) {
                content += "<tr>";
               content += "<td>"+ allProjects[i]+"</td></tr><tr>";
               // content += "<td>"+allArchiveData[i]['resourceobjid']+"</td>";
                for (var j = 0; j < allProjects[i].length; j++){
                   var oneResrc = allArchiveData[allProjects[i]][j];
                   if (oneResrc != undefined && oneResrc['resourceobjid'] != undefined && oneResrc['resource_name'] != undefined){
                    content += "<td>"+oneResrc['resource_name']+"</td>";
                    content += "<td>"+oneResrc['resourceobjid']+"</td>";
                       for (var k = 0; k < allDates.length; k++){
                        content += "<td>"+oneResrc[allDates[k]];
                        content += "%</td>";
                    }
                    content += "</tr>";
                    }
                }
                content += "</tr>";
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