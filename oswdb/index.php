<?php
?>
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>
            Auto MCG
        </title>
        <script src="includes/js/jquery.js" type="text/javascript"></script>
        <script src="includes/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="includes/js/bootstrap.file-input.js" type="text/javascript"></script>
        <script src="includes/js/graphData.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="includes/css/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="includes/css/common.css"></link>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
        </head>

    <body style="font-family: Arial;border: 0 none;"> 
        <form action="updateOswDatabase.php" method="post"
              enctype="multipart/form-data"> 
            <input type="file" name="file" title="Search for a file to Update Data" ></input>
            <button  class="btn btn-success" value="Upload">Upload</button>
        </form>
          <form action="exportDatabaseExcelSheet.php" method="post"
                              enctype="multipart/form-data">
              <input type="submit" name="submit" class="btn btn-info" value="Export to Excel"></input>
        </form>
    </body> 
</HTML>