/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 


var PurchaseReqModel = (function(){

  function Singleton(  ) {

  	// Define your global variables here
        this.name = 'PurchaseReqDataModel'; 
	this.purchaseReqData = new Object(); 
        this.year=""; 
	this.createPurchaseReqDataModel = function(){
            var GetPurchaseReqDataCommand = new OssGateWayCommand();
            GetPurchaseReqDataCommand.url = OssServices.getInstance().controllerUrl+'GetPurchaseReq&year='+this.year;
            GetPurchaseReqDataCommand.error = 'GetPurchaseReqData Service: Received error from server';
            GetPurchaseReqDataCommand.caller = CreatePurchaseReqTableView;
            GetPurchaseReqDataCommand.execute();	
	};
        
        this.createPurchaseForcastDataModel = function(){
            var GetPurchaseForecastDataCommand = new OssGateWayCommand();
            GetPurchaseForecastDataCommand.url = OssServices.getInstance().controllerUrl+'GetPurchaseReq&year='+this.year;
            GetPurchaseForecastDataCommand.error = 'GetPurchaseReqData Service: Received error from server';
            GetPurchaseForecastDataCommand.caller = CreateForecastPurchaseReqTableView;
            GetPurchaseForecastDataCommand.execute();	
	};
         
	
}

 // this is our instance holder

  var instance;


 // this is an emulation of static variables and methods

  var _static = {

    name: 'PurchaseReqModel',

   // This is a method for getting an instance

   // It returns a singleton instance of a singleton object
 getInstance: function (  ){
	 if (instance === undefined) {

        instance = new Singleton(  );
      }
	  return instance;
    }
  };
  return _static;

})();


