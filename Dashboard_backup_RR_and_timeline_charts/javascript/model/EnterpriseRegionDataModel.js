/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 


var EnterpriseRegionDataModel = (function(){

  function Singleton(  ) {

  	// Define your global variables here
    this.name = 'EnterpriseDataModel';
	var myRef=this;
	this.enterpriseData = new Object(); 
        this.region ="AP";
        this.instantiated = false;
	this.createEnterpriseDataModel = function(){
            var GetEnterpriseDataCommand = new DashboardGateWayCommand();
            GetEnterpriseDataCommand.url = DashboardServices.getInstance().controllerUrl+'GetEnterpriseData&region='+this.region;
            GetEnterpriseDataCommand.error = 'GetEnterpriseData Service: Received error from server';
            GetEnterpriseDataCommand.caller = CreateEnterpriseView;
            GetEnterpriseDataCommand.execute();	
	};
         
	
}

 // this is our instance holder

  var instance;


 // this is an emulation of static variables and methods

  var _static = {

    name: 'EnterpriseDataModel',

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


