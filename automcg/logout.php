<?php

require_once 'includes/global.inc.php';

$userTools = new UserTools();
$userTools->logout();

header("Location: login.php");

?>