///* 
// * To change this template, choose Tools | Templates
// * and open the template in the editor.
// */
//function onselectvalue(){
//   var valueS= $("#regionSelectMenu option:selected").val();
//   if(valueS == 5){
//     onChangeToForecast()  
//   }else{
//        generateRequisitions(2)
//   }
//}
//function onChangeToForecast(){ 
//      $("#tableContainer").html("");
//    var yearlyCntnt = "  <table class='table table-bordered'>";
//    yearlyCntnt += "<tr>   <td>GL Account	</td>"+
//               " <td>Cost Center	</td>"+
//               " <td>Requestor</td>"+
//               " <td>Budget line item</td>"+
//               " <td>	VENDOR </td>	"+
//               " <td>DESCRIPTION</td>	"+ 
//               "  <td>Amount Forecasted</td>	"+
//               " <td>Currency</td>	<td></td>" ;
//       
//       for(var i = 0 ; i<20; i++){
//            yearlyCntnt +="<tr>   <td>88821000</td>"+
//               " <td>B8004</td> <td>Requestor</td> <td>	Budget line item</td> <td>	FAST SHOP SA</td>  <td>	B8004 - Monitor Replacement</td>"+
//              "   <td>	3400</td> <td>	USD</td><td><button class='btn'><i class='icon-trash'></i></button></td>  "; 
//yearlyCntnt +="</tr>";
//       }
//       $("#tableContainer").append(yearlyCntnt);
//}
//function generateRequisitions(year){
//     $("#tableContainer").html("");
//    var yearlyCntnt = "  <table class='table table-bordered'>";
//    yearlyCntnt += "<tr> <td>   PR Number </td>  <td>	PR line	</td><td>PO Number	</td> <td>GL Account	</td>"+
//               " <td>Cost Center	</td>"+
//               " <td>Requestor</td>"+
//               " <td>Budget line item</td>"+
//               " <td>	VENDOR </td>	"+
//               " <td>DESCRIPTION</td>	"+
//              "  <td>STATUS </td>"	+
//               " <td>Amount Actual</td><td>Amount Planned</td>	"+
//               " <td>Currency</td>	"+
//              "  <td>Date approved"+
//
//               " </td> "+
//
//               " </td><td>Recurring?</td><td></td> </tr>";
//       
//       for(var i = 0 ; i<20; i++){
//            yearlyCntnt +="<tr>  <td>10401218</td> <td>10 </td>"+
//                "<td> 8200397379</td> <td>88821000</td>"+
//               " <td>B8004</td> <td>Requestor</td> <td>	Budget line item</td> <td>	FAST SHOP SA</td>  <td>	B8004 - Monitor Replacement</td>"+
//              "  <td>	Approved</td> <td>	4998</td><td>	3400</td> <td>	USD</td> <td>	10/07/2013</td> ";
//      if(i%3==0){
//      yearlyCntnt +="<td>Yes</td>";
//      }else{
//           yearlyCntnt +="<td>No</td>";
//      }
//yearlyCntnt +="<td><button class='btn'><i class='icon-pencil'></i></button><button class='btn'><i class='icon-trash'></i></button></td></tr>";
//       }
//       $("#tableContainer").append(yearlyCntnt);
//}
////generateRequisitions();