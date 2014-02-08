<?php
require_once 'classes/createArchiveDb.class.php';   
        try { 
            if (!function_exists('json_decode')) {

                function json_decode($content, $assoc = false) {
                    require_once 'classes/JSON.php';
                    if ($assoc) {
                        $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
                    } else {
                        $json = new Services_JSON;
                    }
                    return $json->decode($content);
                }

            }

            if (!function_exists('json_encode')) {

                function json_encode($content) {
                    require_once 'classes/JSON.php';
                    $json = new Services_JSON;
                    return $json->encode($content);
                }

            }
 
        } catch (Exception $e) {
            echo $e->getMessage();
        }  
        ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PRE PV Report</title>
    </head>
            <?php 
              echo "hell1";
        $archiveDataObj = new createArchiveDb(); 
          echo "hell2";
        $archivedData = $archiveDataObj->getArchiveData("IDC"); 
         echo "hell";
       echo print_r($archivedData);
?>
       
    <body>
 
        <script type="text/javascript">
       var allArchiveData = <?php  echo json_encode($archivedData);?>;
      //  alert(allArchiveData);
        </script>
        <form action ="getArchiveData.php">
            <input type="submit" />
        </form>
    </body>
</html>
