<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'classes/createArchiveDb.class.php'; 
   // echo $_GET['fileName'];
if(isset($_GET['fileName']) && !empty($_GET['fileName'])){ 
 $obj = new createArchiveDb();
 $fileName = $_GET['fileName'].".dump.gz"; 
 $obj->refreshArchiveDb($fileName);
    echo "<p>Please wait while we create an archive database for you. You will be automatically redirected to the comparison page in two minutes</p>";
}
?>
<html>
    <script type="text/JavaScript"> 
redirectTime = "60000";
redirectURL = "getArchiveData.php?region=US"; 
	setTimeout("location.href = redirectURL;",redirectTime); 
</script>
</html>