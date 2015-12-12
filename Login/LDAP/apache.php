<?php

$page_title = "Apache LDAP Basic Authentication";

require_once('_resources/header.php');

echo "

  <h1>$page_title</h1>
  
  <div id='enable_authnz_ldap' class='well'>

    <h3>enable module</h3>

    <ol>

      <li>
	<p><kbd>sudo a2enmod authnz_ldap</kbd></p>
      </li>

      <li>
	<p><kbd>sudo service apache2 restart</kbd></p>
      </li>
      
      <li>
	<p>modify the <code>.htaccess</code> file in the secured-folder to match your settings:</p>
	<pre>"
	   . file_get_contents('apache-secured/.htaccess') .
	"</pre>
      </li>

    </ol>

  </div><!-- /#enable_authnz_ldap.well -->

";

// footer
require_once('_resources/footer.php');

?>
