<?php

if ( !empty($require_ssl) ) {
	if(!isset($_SERVER['HTTPS'])) header('location: https://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING']); 
}

sec_session_start();

// FIX: bug when part of relative path duplicated in alias
$debug = false;

// get relative path definition from included header
$path_real_root = dirname(__DIR__);
if ($debug) echo '$path_real_root = ' . $path_real_root . '<br/>';

// get differences in case of Alias
if ($debug) echo '$_SERVER[SCRIPT_NAME] = ' . $_SERVER['SCRIPT_NAME'] . '<br/>';
$first_array = explode('/', $_SERVER['SCRIPT_NAME']);
if ($debug) echo '$_SERVER[SCRIPT_FILENAME] = ' . $_SERVER['SCRIPT_FILENAME'] . '<br/>';
$second_array = explode('/', $_SERVER['SCRIPT_FILENAME']);
$array_differences = array_diff($first_array, $second_array);

// if alias
if ($debug) echo "count differences = " . count($array_differences) . '<br/>';
if( count($array_differences) > 0 )
  $path_web_root = "/" . implode('/',$array_differences);
// else if nodes down from server root
else
  $path_web_root = str_replace($_SERVER['DOCUMENT_ROOT'], '', $path_real_root);
if ($debug) echo '$_SERVER[DOCUMENT_ROOT] = ' . $_SERVER['DOCUMENT_ROOT'] . '<br/>';
if ($debug) echo '$path_web_root = ' . $path_web_root . '<br/>';

// variable definitions
include_once((__DIR__) . '/credentials.php');


// custom functions
function prepare_sql_input($text){

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
if ( !empty($include_mysql) ) {
  // connection
  /*
	using deprecated mysql_connect()
	will need to upgrade to mysqli ASAP
	until then, silence server error notice
  */
  $mysql_connected = @mysql_connect($database_server, $database_username, $database_password);

  // use database
  $mysql_selected = mysql_select_db($database_name,$mysql_connected);
  
  if ($mysql_connected && $mysql_selected)
    $mysql_connection = true;
}


// if filename contains ".ajax." or ".bounce.", 
//   or $exclude_html = true; 
// then don't print html header
if ( ! ((strpos(basename($_SERVER["SCRIPT_NAME"]),'.ajax.') !== false) || (strpos(basename($_SERVER["SCRIPT_NAME"]),'.bounce.') !== false) || ( !empty($exclude_html) )) ) { ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>
    <?php
      if( !empty($page_title) )
        echo $page_title . " | ";
      if( !empty($section_title) )
        echo $section_title . " | ";
      echo $site_title;
    ?>
  </title>
  
  <?php echo "
  
    <!-- favicon -->
    <link rel='icon' href='$path_web_root/_resources/images/favicon.ico'></link>
  
    <!-- JQUERY -->
    <script src='$path_web_root/_resources/jquery/jquery.1.11.2.min.js'></script>

    <!-- BOOTSTRAP -->
    <script src='$path_web_root/_resources/bootstrap/bootstrap.3.3.4.min.js'></script>
    <link rel='stylesheet' href='$path_web_root/_resources/bootstrap/bootstrap.3.3.4.min.css'></link>
    <link rel='stylesheet' href='$path_web_root/_resources/bootstrap/bootstrap.custom.css'></link>
    <link rel='stylesheet' href='$path_web_root/_resources/bootstrap/sidenav.css'></link>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
    
  ";?>

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">

      <div class="container">

        <div class="navbar-header">

          <!-- Top Nav Toggle -->
          <button id='n' type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

	  <!-- Side Nav Toggle -->
          <a id="sidenav-toggle" href="javascript:void(0);" onclick="$('#wrapper').toggleClass('toggled')">
	    <img src="<?php echo $path_web_root;?>/_resources/images/favicon.ico"></img>
          </a>

          <?php // #site_title_brand
	    echo "<a id='site_title_brand' class='navbar-brand' href='$path_web_root/'>$site_title</a>"; 
          ?>

          <?php // #section_title_brand
	    if(isset($section_title)) echo "<a id='section_title_brand' class='navbar-brand' href='./'>$section_title</a>";
          ?>

        </div><!-- /.navbar-header -->

	<div id="navbar" class="collapse navbar-collapse">

	    <ul class="nav navbar-nav navigation-menu">

		<?php

		// recurse bottom-up the chain until first node with navigation menu
		$path_relative_section = str_replace($path_web_root, '', dirname($_SERVER["SCRIPT_NAME"]));
		// TODO: create rendered relative path for menu links that can be copied from html source
		// will need "../" substitutions for parent node menus

		do {
		  if(file_exists("$path_real_root$path_relative_section/_resources/navigation-menu.php")){
		    $path_rendered_relative = $path_web_root . $path_relative_section;
		    include("$path_real_root$path_relative_section/_resources/navigation-menu.php");
		    break;
		  }
		  $path_relative_section = dirname($path_relative_section);
		  if($path_relative_section == "/") $path_relative_section = "";
		} while (true);

		?>

	    </ul>
	    
	    <div id='login_nav_div' class="pull-right-md pull-left-xs">
		<ul class="nav navbar-nav navigation-menu">
		  <?php
		    if (isset($_SESSION["username"]))
		      echo "<li id='logout'><a href='?logout'>Logout $_SESSION[username]</a></li>";
		    else
		      echo "<li id='login'><a href='$path_web_root/Login/'>Login</a></li>";
		  ?>
	      
		</ul>
	   </div>

	</div><!--/#navbar.nav-collapse -->

      </div><!--/.container -->

    </nav>


	<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav navigation-menu">
                <!-- removed redundant sidebar brand
		  <li class="sidebar-brand">
		      <a href="<?php echo $path_web_root;?>/"><?php echo $site_title; ?></a>
		  </li>
                -->
                <?php include($path_real_root . '/_resources/navigation-menu.php'); ?>
            </ul>
            <script>
	      $('.navigation-menu').find('a').each(function(){
		    if ( $(this).attr("href") == "<?php echo $_SERVER['SCRIPT_NAME'];?>" || $(this).attr("href") == "<?php echo dirname($_SERVER['SCRIPT_NAME'])."/";?>" )
		      $(this).parent().addClass("active");
	      });
	    </script>
        </div><!-- /#sidebar-wrapper -->


        <!-- Page Content -->
        <div id="page-content-wrapper">


		<div id="page-content-container" class='container<?php if(!isset($no_well_container)) echo " well' style='background-color:white;"; ?>'>
		  
<!-- BEGIN BODY CONTENT -->
<?php
} // END if exclude html
?>
