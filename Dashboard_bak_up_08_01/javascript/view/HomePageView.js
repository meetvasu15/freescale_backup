/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function getUserInfo(userID){
	var userid= UserModel.getInstance().user.userid;
	var UserInfoCommand = new DashboardGateWayCommand();
	UserInfoCommand.url=DashboardServices.getInstance().controllerUrl+'&id='+userid;
        UserInfoCommand.serviceName = 'getUserDetails';
	UserInfoCommand.error='Error during service call. Please try again';
	UserInfoCommand.caller =  createHomePage;
	UserInfoCommand.execute();
}

function createHomePage(){
    
}
