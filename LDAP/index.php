<?php
$require_ssl = true;
$ldap_server = "ldap.example.com";
// $page_title = "Home Page";
// $section_title = "Root Section";
require_once('../-resources/header.php');

echo "

  <h1>$section_title</h1>

    <ul>

      <li>
	<p><a href='php5-ldap.php' class='btn btn-primary'>Lock individual pages with group content differentials using PHP</a></p>
      </li>

      <li>
	<p><a href='apache.php' class='btn btn-primary'>Lock entire folder with Apache</a></p>
      </li>

    </ul>
  
";

// footer
require_once('../-resources/footer.php');

?>
