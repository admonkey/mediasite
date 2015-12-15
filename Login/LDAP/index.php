<?php

include_once('_resources/credentials.inc.php');
$require_ssl = true;
$ldap_server = "ldap.example.com";
// $page_title = "Home Page";
// $section_title = "Root Section";
require_once('_resources/header.inc.php');

echo "

  <h1>$section_title</h1>

    <ul>

      <li>
	<p>Lock individual pages with group content differentials.</p>
	<p><a href='php5-ldap.php' class='btn btn-primary'>PHP</a></p>
      </li>

      <li>
	<p>Lock entire folder using the Apache server.</p>
	<p><a href='apache.php' class='btn btn-primary'>.htaccess</a></p>
      </li>

    </ul>
  
";

// footer
require_once('_resources/footer.inc.php');

?>
