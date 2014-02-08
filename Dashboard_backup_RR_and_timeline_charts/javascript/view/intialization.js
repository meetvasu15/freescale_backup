/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function initializePage(){ 
   NpiDataModel.getInstance().createNpiDataModel();
     $('#myLoadDiv').hide();
  // floatTableHeaderInitialize();
 //  tableFloatingHeader();
}


//function dragTableLeft(){  
////     $('.allContentContainer').animate({
////    width: '+=25%'
////  }, 1000, function() {
////    // Animation complete.
////  });
//  $('#tableContainer').animate({
//    marginLeft: '-=20%'
//  }, 1000, function() {
//    // Animation complete.
//  });
//    $('#burnDownContainer').attr({"style":"display : block"});
//  $('#burnDownContainer').animate({
//    marginRight: '+=20%'
//  }, 1000, function() {
//    // Animation complete.
//  });  
//  $("#goButton").unbind('click', dragTableLeft)
//  $("#goButton").bind('click',dragTableRight );
//}
//
//function dragTableRight(){  
//  $('#tableContainer').animate({
//    marginLeft: '+=20%'
//   
//  }, 1000, function() {
//    // Animation complete.
//  }); 
////     $('.allContentContainer').animate({
////    width: '-=25%'
////  }, 1000, function() {
////    // Animation complete.
////  });
//   $('#burnDownContainer').animate({
//    marginRight: '-=20%'
//  }, 1000, function() {
//    // Animation complete.
//      $('#burnDownContainer').attr({"style":"display : none"});
//  });
//  $("#goButton").unbind('click', dragTableRight)
//  $("#goButton").bind('click',dragTableLeft );
//}
