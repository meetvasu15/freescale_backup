<?php
require_once 'classes/updateAPVData.class.php'; 
require_once 'classes/generateGraphData.class.php';
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
 // echo "here 1"; 
  try{
  $read = new updateAPVData($fileName, 'Auto PV Data');
  $read->apvResourceUpdate();
  echo "<p><br>Successfully uploaded see <a href='generateGraphDataController.php'>graph now</a></p>";
  }catch(Exception $e)
    { 
    echo "<p><br>Upload failed! <a href='index.php'>Go Back</a></p>";
    } 
//  echo "here 2";
// 
//  echo "here 3";
  
?>
