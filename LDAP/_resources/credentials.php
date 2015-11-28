<?php

$section_title = "LDAP";

$ldap_server = "ldap.example.com";
$ldap_dc_domain = "example";
$ldap_dc_tld = "com";

// overwrite values in credentials_local.php
// useful for automatic merging patch updates
if (file_exists((__DIR__) . '/credentials_local.php')) include_once((__DIR__) . '/credentials_local.php');

?>
