<?php

$site_title = "Web Site";

// database connection
if ( ! $database_selected ){
	
	// database credentials

		// remote
		$database_server = "sql.example.com";
		// local
		$database_server = "localhost";

		$database_username = "username";
		$database_password = "p@55W0rd";
		$database_name = "example_database";

	/*
	// MySQL

		// connection
		$database_connection = mysql_connect($database_server, $database_username, $database_password)
		  or die("Unable to connect to MySQL");

		// use database
		$database_selected = mysql_select_db($database_name,$database_connection)
		  or die("Could not select database");
		
		$mysql_connection = true;
	*/
}

// overwrite values in credentials_local.php
// useful for automatic merging patch updates
if (file_exists((__DIR__) . '/credentials_local.php')) include_once((__DIR__) . '/credentials_local.php');

?>