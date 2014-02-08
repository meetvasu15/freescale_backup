<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PRE PV Report</title>
    </head>
    <body>
        <?php
        require_once 'classes/createArchiveDb.class.php'; 
$obj = new createArchiveDb();
$obj->refreshArchiveDb("2013-07-16.dump.gz");
 
        ?>
        <form action ="getArchiveData.php">
            <input type="submit" />
        </form>
    </body>
</html>
