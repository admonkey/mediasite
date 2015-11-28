<?php

$site_title = "Web Site";

// database
  // remote
  $database_server = "sql.example.com";
  // local
  $database_server = "localhost";

  $database_username = "username";
  $database_password = "p@55W0rd";
  $database_name = "example_database";

// overwrite values in credentials_local.php
// useful for automatic merging patch updates
if (file_exists((__DIR__) . '/credentials_local.php')) include_once((__DIR__) . '/credentials_local.php');

?>