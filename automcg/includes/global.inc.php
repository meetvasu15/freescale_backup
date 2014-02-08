<?php
//global.inc.php

require_once 'classes/User.class.php';
require_once 'classes/UserTools.class.php';
require_once 'classes/SingletonDb.class.php';

//connect to the database
//$db = new DB();
//$db->connect();
 
//initialize UserTools object
$userTools = new UserTools();

//start the session
session_start();
//refresh session variables if logged in
//if(isset($_SESSION['logged_in'])) {
//	$user = unserialize($_SESSION['user']); 
//        if(!empty($user->user_id))
//	$_SESSION['user'] = serialize($userTools->get($user->user_id));
//}
?>