/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 


var IpDataModel = (function(){

  function Singleton(  ) {

  	// Define your global variables here
    this.name = 'IpDataModel';
	var myRef=this;
        this.hasData = false;
	this.ipData = new Object(); 
	this.createIpDataModel = function(){
            var GetIpDataCommand = new DashboardGateWayCommand();
            GetIpDataCommand.url = DashboardServices.getInstance().controllerUrl+'GetIpDataPv';
            GetIpDataCommand.error = 'GetIpData Service: Received error from server';
            GetIpDataCommand.caller = CreateIpTableView;
            GetIpDataCommand.execute();	
             this.hasData = true;
	};
         
	
}

 // this is our instance holder

  var instance;


 // this is an emulation of static variables and methods

  var _static = {

    name: 'IpDataModel',

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


