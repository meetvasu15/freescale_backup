/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 


var NpiDataModel = (function(){

  function Singleton(  ) {

  	// Define your global variables here
    this.name = 'NpiDataModel';
	var myRef=this;
	this.npiData = new Object(); 
	this.createNpiDataModel = function(){
            var GetNpiDataCommand = new DashboardGateWayCommand();
            GetNpiDataCommand.url = DashboardServices.getInstance().controllerUrl+'GetNPIData';
            GetNpiDataCommand.error = 'GetNpiData Service: Received error from server';
            GetNpiDataCommand.caller = CreateNpiTableView;
            GetNpiDataCommand.execute();	
	};
         
	
}

 // this is our instance holder

  var instance;


 // this is an emulation of static variables and methods

  var _static = {

    name: 'NpiDataModel',

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


