<?php

// get relative path definitions
$path_real_relative_root = dirname(__FILE__);
$path_real_relative_root = str_replace('/-resources', '', $path_real_relative_root);
$path_web_relative_root = str_replace($_SERVER['DOCUMENT_ROOT'], '', $path_real_relative_root);

// include global credentials
include_once($path_real_relative_root . '/-resources/credentials.php');
// trump with local
include_once('-resources/credentials.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title><?php
    if( !empty($page_title) )
      echo $page_title . " | ";
    if( !empty($section_title) )
      echo $section_title . " | ";
    echo $site_title;
  ?></title>
  
  <?php echo "
  
    <!-- favicon -->
    <link rel='icon' href='$path_web_relative_root/-resources/images/favicon.ico'></link>
  
    <!-- JQUERY -->
    <script src='$path_web_relative_root/-resources/jquery/jquery.1.11.2.min.js'></script>

    <!-- BOOTSTRAP -->
    <script src='$path_web_relative_root/-resources/bootstrap/bootstrap.3.3.4.min.js'></script>
    <link rel='stylesheet' href='$path_web_relative_root/-resources/bootstrap/bootstrap.3.3.4.min.css'></link>
    <link rel='stylesheet' href='$path_web_relative_root/-resources/bootstrap/bootstrap.custom.css'></link>
    <link rel='stylesheet' href='$path_web_relative_root/-resources/bootstrap/sidenav.css'></link>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
    
  ";?>

  <?php
    if ( $include_jquery_ui ) {
      echo "
	<!-- JQUERY-UI -->
	<script src='$path_web_relative_root/-resources/jquery-ui/jquery-ui.1.11.4.min.js'></script>
	<link rel='stylesheet' href='$path_web_relative_root/-resources/jquery-ui/jquery-ui.1.11.4.min.css'>
	<!-- official content delivery network -->
	<!-- <script src='//code.jquery.com/ui/1.11.4/jquery-ui.min.js'></script> -->
	<!-- <link rel='stylesheet' href='//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css'> -->
      ";
    }
  ?>

  <?php
    if ( $include_tablesorter ) {
      echo "
	<!-- TABLESORTER -->
	<script src='$path_web_relative_root/-resources/tablesorter/tablesorter.2.0.5b.min.js'></script>
	<link rel='stylesheet' href='$path_web_relative_root/-resources/tablesorter/tablesorter.css'>
      ";
    }
  ?>

  <?php
    if ( $include_chartist ) {
      echo "
	<!-- CHARTIST -->
	<script src='$path_web_relative_root/-resources/chartist/chartist.0.9.4.min.js'></script>
	<link rel='stylesheet' href='$path_web_relative_root/-resources/chartist/chartist.min.css'></link>
	<link rel='stylesheet' href='$path_web_relative_root/-resources/chartist/chartist.custom.css'></link>
      ";
    }
  ?>

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
	    <img src="<?php echo $path_web_relative_root;?>/-resources/images/favicon.ico"></img>
          </a>

          <?php // #site_title_brand
	    echo "<a id='site_title_brand' class='navbar-brand' href='$path_web_relative_root/'>$site_title</a>"; 
          ?>

          <?php // #section_title_brand
	    if(isset($section_title)) echo "<a id='section_title_brand' class='navbar-brand' href='./'>$section_title</a>";
          ?>

        </div><!-- /.navbar-header -->

	<div id="navbar" class="collapse navbar-collapse">

	    <ul class="nav navbar-nav navigation-menu">

		<?php

		  // use local navigation menu if exists
		  if (file_exists('-resources/navigation-menu.php'))
		    include('-resources/navigation-menu.php');
		  /*
		  // , else use global.
		  else
		    include($path_real_relative_root . '/-resources/navigation-menu.php');
		  */

		?>

	    </ul>

	</div><!--/#navbar.nav-collapse -->

      </div><!--/.container -->

    </nav>


	<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav navigation-menu">
                <!-- removed redundant sidebar brand
		  <li class="sidebar-brand">
		      <a href="<?php echo $path_web_relative_root;?>/"><?php echo $site_title; ?></a>
		  </li>
                -->
                <?php include($path_real_relative_root . '/-resources/navigation-menu.php'); ?>
            </ul>
            <script>
	      $('.navigation-menu').find('a').each(function(){
		    if ($(this).attr("href") == "<?php echo $_SERVER['SCRIPT_NAME'];?>")
		      $(this).parent().addClass("active");
	      });
	    </script>
        </div><!-- /#sidebar-wrapper -->


        <!-- Page Content -->
        <div id="page-content-wrapper">


		<div id="page-content-container" class="container">
		  
<!-- BEGIN BODY CONTENT -->
