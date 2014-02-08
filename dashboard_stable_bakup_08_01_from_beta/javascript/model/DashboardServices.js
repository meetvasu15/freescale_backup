/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var DashboardServices = (function(){

  function Singleton(  ) {

  	// Define your global variables herer
    this.name = 'DashboardServices';
    this.serviceName = '';
    this.controllerUrl = '/dashboard/service.php?service=';

	this.sampleFunc=function (obj){
		myRef.sampleUsableObj=obj;
	}; 
}

 // this is our instance holder

  var instance;


 // this is an emulation of static variables and methods

  var _static = {

    name: 'DashboardServices',

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