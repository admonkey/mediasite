<?php

// SSL redirect
if ( !empty($require_ssl) ) {
	if(!isset($_SERVER['HTTPS'])) header('location: https://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING']); 
}

// paths
$path_real_root = dirname(__DIR__);
$path_real_difference = str_replace($path_real_root, '', $_SERVER['SCRIPT_FILENAME']);
$path_web_root = str_replace($path_real_difference, '', $_SERVER['SCRIPT_NAME']);

// variable definitions
include_once((__DIR__) . '/credentials.inc.php');


// custom functions
function mysqlo_prepare_input($text){

	$text = htmlentities($text);

 	// bold
	$text = str_replace("&lt;b&gt;","<b>",$text);
	$text = str_replace("&lt;/b&gt;","</b>",$text);
	// italics
	$text = str_replace("&lt;i&gt;","<i>",$text);
	$text = str_replace("&lt;/i&gt;","</i>",$text);
	// underline
	$text = str_replace("&lt;u&gt;","<u>",$text);
	$text = str_replace("&lt;/u&gt;","</u>",$text);
	// strikethrough
	$text = str_replace("&lt;s&gt;","<s>",$text);
	$text = str_replace("&lt;/s&gt;","</s>",$text);

	return mysql_real_escape_string($text);

}

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name 

    if(empty($require_ssl))
      $secure = false;
    else
      $secure = true;

    // This stops JavaScript being able to access the session id.
    $httponly = true;

    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        //header("Location: error.php?err=Could not initiate a safe session (ini_set)");
        //exit();
        die("ERROR: Could not initiate a safe session (ini_set)");
    }

    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

    // Sets the session name to the one set above.
    //session_name($session_name);
    
    /*
    removed for backwards compatibility with php <=5.4.0
    if (session_status() == PHP_SESSION_NONE) {
	session_start();
    }
    */
    if (!isset($_SESSION)) {
      session_start();            // Start the PHP session 
      session_regenerate_id();    // regenerated the session, delete the old one. 
    }

    if (isset($_GET["logout"])){
      // Unset all session values 
      $_SESSION = array();

      // get session parameters 
      $params = session_get_cookie_params();

      // Delete the actual cookie. 
      setcookie(session_name(),'', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

      // Destroy session 
      session_destroy();
      unset($_GET["logout"]);
      header("Location: $_SERVER[SCRIPT_NAME]");
    }

}


// MySQL
if ( !empty($include_mysqli) ) {

  $mysqli_connection = new mysqli($database_server, $database_username, $database_password, $database_name);
  if ($mysqli_connection->connect_error) {
      die($mysqli_connection->error());
  } else $mysqli_connected = true;

} elseif ( !empty($include_mysqlo) ) {

  // connection
  /*
	using deprecated mysql_connect()
	will need to upgrade to mysqli ASAP
	until then, silence server error notice
  */
  $mysqlo_connection = @mysql_connect($database_server, $database_username, $database_password);

  // use database
  $mysqlo_selected = mysql_select_db($database_name,$mysqlo_connection);
  
  if ($mysqlo_connection && $mysqlo_selected)
    $mysqlo_connected = true;

}
?>
