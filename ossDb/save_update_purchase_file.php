<?php
require_once 'classes/PurchaseRequisitionIngestion.class.php';  
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
//            echo "Upload: " . $_FILES["file"]["name"] . "<br>";
//            echo "Type: " . $_FILES["file"]["type"] . "<br>";
//            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

//            if (file_exists("upload/" . $_FILES["file"]["name"]))
//              {
//                    echo $_FILES["file"]["name"] . " already exists. ";
//              }
//            else
//              {
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                     $_FILES["file"]["name"]);
                   // echo "Stored in: " . $_FILES["file"]["name"];
//              }
      }
  }
else
  {
  echo "Invalid file";
  return;
  }
 // echo "here 1";
  $read = new PurchaseRequisitionIngestion($fileName);
  $read->saveUpdatePurchases();
//  echo "here 2";
// 
//  echo "here 3";
 // echo "<p><br>Successfully uploaded see <a href='generateGraphDataController.php'>graph now</a></p>"
?>
