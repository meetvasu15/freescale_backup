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
$region = "US";
if (isset($_GET["region"]) && !empty($_GET["region"])) {
    $region = $_GET["region"];
}
$archiveDataObj = new createArchiveDb();
$archivedData = $archiveDataObj->getArchiveDataComparison($region);
$allRegions = $archivedData["allRegions"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PRE PV Report</title>
    </head>


    <body>

        <div id="compareTableContainer">
    <strong>Region: </strong>        <select onchange='ChangeRegion()' id='regionSelectMenu'>
                <?php foreach ($allRegions as $oneRegion) { ?>
                    <option value="<?php echo $oneRegion; ?>"><?php echo $oneRegion; ?></option>
                <?php }
                ?> 
            </select>
        </div> 
        <script src="javascript/jquery.js" type="text/javascript"></script>
        <script src="javascript/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="javascript/util/CommonUtil.js" type="text/javascript"></script>
        <script src="javascript/GenerateComparisonTable.js" type="text/javascript"></script>

        <script type="text/javascript">
             var data = <?php echo json_encode($archivedData); ?>;
             //alert(data);
             $('#regionSelectMenu').val('<?php echo $region; ?>');
             createComaprisonTable(data);
        </script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/common.css" />
        <link rel="stylesheet" type="text/css" href="css/tableFilter.css" />  
    </body>
</html>
