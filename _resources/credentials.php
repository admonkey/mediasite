<?php

/*
	There are 5 ways to set site variables,
	starting with #1, then overridden with each option thereafter.
	
		1) global definitions in "/_resources/credentials.php"
		2) global overrides in "/_resources/credentials_local.php"
		3) section definitions in "_resources/credentials.php"
		4) section overrides in "_resources/credentials_local.php"
		5) page definitions *must include global credentials file first, then header*
	
	So anything defined in a section credentials file will override global definitions.
	And anything defined on the page before the header include, and after credentials include,
	will trump all other definitions. If you do not include the global credentials file before
	defining variables on the page, then they will be overridden by the global and section
	definitions included in the header.
	
	For example, this should be at the top of the page:
	
		<?php
			// include global credentials file first
			include_once('../_resources/credentials.php');

			// override ldap server name, from section variables, in page header
			$ldap_server = "ldap.example.com";

			// then include global header
			require_once('../_resources/header.php');
		?>
	
	The credentials_local.php files are useful for automatic merging patch updates.
*/

$site_title = "Web Site";

// database
  // remote
  $database_server = "sql.example.com";
  // local
  $database_server = "localhost";

  $database_username = "username";
  $database_password = "p@55W0rd";
  $database_name = "example_database";

  
// global overrides
if (file_exists((__DIR__) . '/credentials_local.php')) include_once((__DIR__) . '/credentials_local.php');
// section definitions
if (file_exists('_resources/credentials.php')) include_once('_resources/credentials.php');
// section overrides
if (file_exists('_resources/credentials_local.php')) include_once('_resources/credentials_local.php');

?>