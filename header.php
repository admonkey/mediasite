<?php

$relative_realpath = dirname(__FILE__) . "/";
$relative_webpath = str_replace($_SERVER[DOCUMENT_ROOT], '', $relative_realpath);

include_once($relative_realpath . 'credentials.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo $relative_webpath;?>img/favicon.ico">
	<title><?php
    		if( !empty($pageTitle) )
	    		echo $pageTitle . " | ";
		    	echo $siteTitle;
	?></title>

	<!-- JQUERY --><script src="<?php echo $relative_webpath;?>jquery/jquery.1.11.2.min.js"></script>

	<!-- BOOTSTRAP -->
		<script src="<?php echo $relative_webpath;?>bootstrap/bootstrap.3.3.4.min.js"></script>
		<link rel="stylesheet" href="<?php echo $relative_webpath;?>bootstrap/bootstrap.3.3.4.min.css"></link>
		<link rel="stylesheet" href="<?php echo $relative_webpath;?>bootstrap/bootstrap.custom.css"></link>
		<link rel="stylesheet" href="<?php echo $relative_webpath;?>bootstrap/sidenav.css"></link>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	<!-- JQUERY-UI -->
		<script src="<?php echo $relative_webpath;?>jquery-ui/jquery-ui.1.11.4.min.js"></script>
		<link rel="stylesheet" href="<?php echo $relative_webpath;?>jquery-ui/jquery-ui.1.11.4.min.css">
		<!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
		<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css"> -->

	<!-- TABLESORTER -->
		<script src="<?php echo $relative_webpath;?>tablesorter/tablesorter.2.0.5b.min.js"></script>
		<link rel="stylesheet" href="<?php echo $relative_webpath;?>tablesorter/tablesorter.css">

	<!-- CHARTIST 
		<script src="<?php echo $relative_webpath;?>chartist/chartist.0.9.4.min.js"></script>
		<link rel="stylesheet" href="<?php echo $relative_webpath;?>chartist/chartist.min.css"></link>
		<link rel="stylesheet" href="<?php echo $relative_webpath;?>chartist/chartist.custom.css"></link>
	-->

</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
	
      <div class="container">
	  
        <div class="navbar-header">
		
          <button id='n' type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  
	  <!-- Sidenav Toggle -->
          <a  id="sidenav-toggle" class="navbar-brand" href="#"><?php echo $siteTitle; ?></a>
	  <script>
	  $("#sidenav-toggle").click(function(e) {
		  e.preventDefault();
		  $("#wrapper").toggleClass("toggled");
	  });
	  </script>
        </div><!-- end navbar-header -->
		
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo $relative_webpath;?>forms.php">Forms</a></li>
				<li><a href="<?php echo $relative_webpath;?>tables.php">Tables</a></li>
			</ul>
			<script>
			  $('.navbar-nav').find('a').each(function(){
				if ($(this).attr("href") == "<?php echo $_SERVER['SCRIPT_NAME'];?>")
				  $(this).parent().addClass("active");
			  });
			</script>
		</div><!--/.nav-collapse -->
	
      </div><!--/.container -->
	  
    </nav>

	
	<div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Start Bootstrap
                    </a>
                </li>
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
		

	
		<div class="container container-fluid">
		  <div class="starter-template">
		  
<!-- BEGIN BODY CONTENT -->
