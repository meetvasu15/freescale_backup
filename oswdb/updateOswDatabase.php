<?php
require_once 'authentication.php';
require_once 'classes/IngestDatabase.class.php';  
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$allowedExts = array("xls", "xlsx", "xlsm");
$fileName = $_FILES["file"]["name"];
$fileNameArr =  explode(".", $_FILES["file"]["name"]);
$extension = end( $fileNameArr);
if (  in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
      {
            echo "There was some error reading your file Return Code: " . $_FILES["file"]["error"] . ".<br> Please look <a href='http://php.net/manual/en/features.file-upload.errors.php'>here</a> for detail on return code. ";
      }
    else
      { 
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                     $_FILES["file"]["name"]);  
      }
  }
else
  {
  echo "Invalid file";
  return;
  } 
  $read = new IngestDatabase($fileName);
  $read->ingestWorkbook(); 
  echo "<p><br>Successfully uploaded, go <a href='index.php'> back </a> </p>"
?>
