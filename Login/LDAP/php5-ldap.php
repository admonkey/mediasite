<?php

$ldap_server = "ldap.example.com";
$ldap_dc_domain = "example";
$ldap_dc_tld = "com";

$page_title = "PHP LDAP Authentication";
$require_ssl = true;

require_once('_resources/header.php');

echo "

  <h1>$page_title</h1>
  
  <div id='install_php5-ldap' class='well'>

    <h3>install php5-ldap</h3>

    <ol>

      <li>
	<p><kbd>sudo apt-get install php5-ldap</kbd></p>
      </li>

      <li>
	<p><kbd>sudo service apache2 restart</kbd></p>
      </li>

      <li>
	<p>Set these variables in the header of the login page:</p>
	<p><pre>".'
	
	$ldap_server = "ldap.example.com";
	$ldap_dc_domain = "example";
	$ldap_dc_tld = "com";
	'."</pre></p>
      </li>
      
      

      
    </ol>

  </div><!-- /#install_php5-ldap.well -->

  <div id='login' class='well'>
  
";

/**
 * Created by Joe of ExchangeCore.com
 */
if(isset($_POST['ldap_login_username']) && isset($_POST['ldap_login_password'])){

    $ldap_server = "ldap://$ldap_server";
	
    $ldap = ldap_connect($ldap_server);
    $username = $_POST['ldap_login_username'];
    $password = $_POST['ldap_login_password'];

    $ldaprdn = $ldap_dc_domain . "\\" . $username;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);


    if ($bind) {
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=$ldap_dc_domain,dc=$ldap_dc_tld",$filter);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
            echo "<p>You are accessing <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
            echo '<pre>';
            var_dump($info);
            echo '</pre>';
            $userDn = $info[$i]["distinguishedname"][0]; 
        }
        @ldap_close($ldap);
    } else {
        $msg = "Invalid email address / password";
        echo $msg;
    }

}else{
?>
	<h3>Print All LDAP Attributes for Username</h3>
    <form id="ldap_login_form" role="form" method="POST">
      <div class="form-group">
        <label for="ldap_login_username">Username:</label>
        <input id="ldap_login_username" type="text" name="ldap_login_username" class="form-control" required></input>
      </div>
      <div class="form-group">
        <label for="ldap_login_password">Password:</label>
        <input id="ldap_login_password" type="password" name="ldap_login_password" class="form-control" required></input>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<?php }

echo "</div><!-- /#login.well -->";

// footer
require_once('_resources/footer.php');

?>
