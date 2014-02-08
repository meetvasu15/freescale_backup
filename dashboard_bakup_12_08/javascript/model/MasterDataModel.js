/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var MasterDataModel = (function(){

  function Singleton(  ) {

  	// Define your global variables here
    this.name = 'MasterDataModel';
	var myRef=this;
	this.masterData=new Object();
	this.masterDataUrl='/dashboard/getmasterdata';
	this.createMasterDataModel=function(masterdata){
//	for(var i=0;i<masterdata.response[0].serversinfo[0].length;i++){
//	var id=masterdata.response[0].serversinfo[0][i].serverShortName;
//	myRef.masterData[id]=masterdata.response[0].serversinfo[0][i];
//	}
//	 
//	var scenarioid = UserModel.getInstance().user.scenarioid;
	
	 
	
	}	
	
}

 // this is our instance holder

  var instance;


 // this is an emulation of static variables and methods

  var _static = {

    name: 'MasterDataModel',

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
