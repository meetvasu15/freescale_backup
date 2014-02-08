/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function DashboardGateWayCommand(){
	    if(false === (this instanceof DashboardGateWayCommand))
	    {
         return new DashboardGateWayCommand();
	    }
	  
		this.data = {};
		this.url = "";
		this.timeOut = 300000;
		this.type = "POST";
		this.error="";
		this.async = false;
		this.caller = function(){
		}; 
		/*
		*	
		*
		*/
		this.execute=function() 
		{
			var myRef = this; 
			myRef.showLoader();
			  $.ajax(
					{
						url: myRef.url,
						async   : myRef.async,
						cache   : false,
						contentType:"application/json; charset=utf-8",
						timeout : myRef.timeOut,
						type    : myRef.type,
						dataType : 'json',
						
						error   : function(data)
						{
							myRef.hideLoader();
							myRef.faultHandler(data);
						},
						success : function(data) 
						{
							myRef.hideLoader();
							if(data!=null)
							{
								// alert(data.response);
								if(data.response!=undefined)
								{
									 
										
										myRef.caller(data);
									 
								}
								else
								{
									alert("JSON format not valid");
								}
							
							
							//myRef.UpdateServiceLoader();
							
							}
							else// service is not responding
							{
								alert("Error received while making AJAX call from the server");
							}
						}
					});
		}
		
		this.faultHandler= function(data){
			
				alert("Error received from the server");
				
		}
		this.hideLoader = function()
		{
			$("#loaderDivID").hide();
			
		}
		this.showLoader = function()
		{
			$("#loaderDivID").show();
		}
}

