<?php

$page_title = "Session Login via PHP LDAP Authentication";
$require_ssl = true;

$ldap_server = "ldap.example.com";
$ldap_dc_domain = "example";
$ldap_dc_tld = "com";

require_once('_resources/header.inc.php');

echo "

  <h1>$page_title</h1>
  
  <p><a href='php5-ldap.php' class='btn btn-danger'>Read First</a></p>

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
            $_SESSION["username"] = $info[$i]["samaccountname"][0];
            header("Location: $_SERVER[SCRIPT_NAME]");
        }
        @ldap_close($ldap);
    } else {
        $msg = "Invalid email address / password. <a href='" . $_SERVER["SCRIPT_NAME"] . "'>Try Again</a>";
        echo $msg;
    }

}else{
?>
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
require_once('_resources/footer.inc.php');

?>
