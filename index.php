<?php
	//Turning on error reporting
	ini_set("error_reporting",E_ALL);
	ini_set("display_errors",True);
	//Autoloading
	require_once('vendor/autoload.php');
	// rquet uri
	$request = $_SERVER['REQUEST_URI'];
	require_once('routes.php');

?>