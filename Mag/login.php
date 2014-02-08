<?php
//login.php

 require_once 'loginService.php';
 session_start();
$error = "";
$username = "";
$password = ""; 
////check to see if they've submitted the login form
//echo "here2";
if(isset($_POST['submit-login']) && !empty($_POST['username'] )&& !empty($_POST['password'])) { 

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(authenticate($username, $password)){ 
		//successful login, redirect them to a page
            
            $_SESSION['username'] =$username  ;
		header("Location: index.php");
                //echo "here";
	}else{//echo "here1";
		$error = "Incorrect username or password. Please try again.";
	}
}

?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Login</title>
         <script src="includes/js/jquery.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="includes/css/bootstrap.min.css">
    <script src="includes/js/bootstrap.file-input.js"></script>
</head>
<body>

	<form action="login.php" method="post"> 
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="static"> 
  <div class="modal-header"> 
    <h3 id="myModalLabel">Login</h3>
  </div>
  <div class="modal-body">
      <?php
if($error != "")
{
    echo $error."<br/>";
}
?>
    <p>
        <table><tr><td>
	     </td><td>  <input type="text" name="username" placeholder="User Name" id="username" value="" /></td><td rowspan="2">
<!--                 <img src="http://www.bsquare.com/PublishingImages/Logos/Freescale.png" />-->
             </td></tr>
            <tr><td>
	      </td><td><input type="password" name="password" placeholder="Password" value="" /> </p></td></tr>
<!--            <tr>
                <a href="register.php">New User?</a>
            </tr>-->
        </table>
	    
	</p>
  </div>
  <div class="modal-footer"> 
      <input type="submit" class="btn" value="Login" name="submit-login" />
  </div>
</div>
            </form>
    <script>
        $('#myModal').modal("show")
        $('#myModal').modal({
  keyboard: false
})
    </script> 
</body>
</html>