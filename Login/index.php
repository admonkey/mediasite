<?php

include_once('_resources/credentials.php');
//$require_ssl = true;
// $page_title = "Home Page";
require_once('_resources/header.php');

echo "

  <h1>$section_title</h1>

  <p class='lead'>From which source would you like to authenticate users?</p>
  
    <ul>

      <li>
	<p><a href='Database/' class='btn btn-primary'>MySQL Database Table</a></p>
      </li>

      <li>
	<p><a href='LDAP/' class='btn btn-primary'>LDAP</a></p>
      </li>

    </ul>
  
";

// footer
require_once('_resources/footer.php');

?>
