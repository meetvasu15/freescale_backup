/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function createBubbleChartModal(dataTable){
    
    //   showLoader(); 
   
    var modalHtml  = "<div id='bubbleVisualization' style='width: 970px; height: 350px;'></div>";
   
    $('#bubbleChartModalContainer').append(modalHtml);
     
drawBubbleChart(dataTable); 
}
function sanitizeDataTabel(dataTable){
   var firstElemRef = dataTable;
    for(var i=0; i<firstElemRef.length; i++){
      var tmpdate =   stringTodate(firstElemRef[i][2]);
      firstElemRef[i][2]=tmpdate;
       firstElemRef[i][3]= new Date(tmpdate.getTime() + (24 * 60 * 60 * 1000));
    }
    return dataTable;
}
function stringTodate(str){
  var monthArr= new Array();
  monthArr["JAN"]=0;
  monthArr["FEB"]=1;
  monthArr["MAR"]=2;
  monthArr["APR"]=3;
  monthArr["MAY"]=4;
  monthArr["JUN"]=5;
  monthArr["JUL"]=6;
  monthArr["AUG"]=7;
  monthArr["SEP"]=8;
  monthArr["OCT"]=9;
  monthArr["NOV"]=10;
  monthArr["DEC"]=11;
  var DateStr = new String(str);
  var day = DateStr.substring( 0, 2);
  var month = DateStr.substring(2, 5);
  var year = DateStr.substring( 5, 9);
  var date = new Date(year, monthArr[month], day);
  return date;
}
function drawBubbleChart() {
drawBubbleChartCallback();
}

function drawBubbleChartCallback() {
    var data = NpiDataModel.getInstance().npiData.response.bubbleChartDataArr;
    data= sanitizeDataTabel(data);   
  var container = document.getElementById('bubbleVisualization');
  var chart = new google.visualization.Timeline(container);

  var dataTable = new google.visualization.DataTable();
  dataTable.addColumn({ type: 'string', id: 'Milestone' }); 
    dataTable.addColumn({ type: 'string', id: 'Project Name' }); 
  dataTable.addColumn({ type: 'date', id: 'Start' });
  dataTable.addColumn({ type: 'date', id: 'End' });  

  dataTable.addRows( data); 
var options = {   width: '970', height: '350', singleColor: '#8d8' 

    };
  chart.draw(dataTable ,options);
}