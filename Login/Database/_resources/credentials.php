<?php

// *** Must be first line in credentials file! ***
// recurse up the chain for all intermediary node credentials
$parent_section_credentials_file = dirname(dirname(__DIR__))."/_resources/credentials.php";
require_once($parent_section_credentials_file);


// section variables
$section_title = "Database";


// *** Must be last line in credentials file! ***
// section overrides
$section_credentials_local = (__DIR__) . "/credentials_local.php";
if (file_exists($section_credentials_local)) require_once($section_credentials_local);

?>