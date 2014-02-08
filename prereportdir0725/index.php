<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PRE PV Report</title>
    </head>
    <body>
        <div class="allFilesDivContainer">
            <ul>
        <?php
        require_once 'classes/createArchiveDb.class.php'; 

 

if ($handle = opendir('/proj/.web_webnpidev/html/prereport/archive/')) { 

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
       if (strpos($entry,'.dump.gz') !== false) {
           $param = str_replace(".dump.gz", "", $entry);
        echo "<li><a href='createDatabase.php?fileName=".$param."'>".$entry."</a><li>";
        }
    } 
    closedir($handle);
}
 
        ?>
            </ul>
        </div>
    </body>
</html>
