<?php include_once('credentials.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="img/favicon.ico">
	<title><?php
    		if( !empty($pageTitle) )
	    		echo $pageTitle . " | ";
		    	echo $siteTitle;
	?></title>

	<!-- JQUERY --><script src="jquery/jquery.1.11.2.min.js"></script>

	<!-- BOOTSTRAP -->
		<script src="bootstrap/bootstrap.3.3.4.min.js"></script>
		<link rel="stylesheet" href="bootstrap/bootstrap.3.3.4.min.css"></link>
		<link rel="stylesheet" href="bootstrap/bootstrap.custom.css"></link>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	<!-- JQUERY-UI -->
		<script src="jquery-ui/jquery-ui.1.11.4.min.js"></script>
		<link rel="stylesheet" href="jquery-ui/jquery-ui.1.11.4.min.css">
		<!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
		<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css"> -->

	<!-- TABLESORTER -->
		<script src="tablesorter/tablesorter.2.0.5b.min.js"></script>
		<link rel="stylesheet" href="tablesorter/tablesorter.css">

	<!-- CHARTIST 
		<script src="chartist/chartist.0.9.4.min.js"></script>
		<link rel="stylesheet" href="chartist/chartist.min.css"></link>
		<link rel="stylesheet" href="chartist/chartist.custom.css"></link>
	-->

	<!-- MINIMAL <link rel="stylesheet" href="css/minimal.css"> -->
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
          <a class="navbar-brand" href="index.php"><?php echo $siteTitle; ?></a>
        </div><!-- end navbar-header -->
	<div id="navbar" class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="forms.php">Forms</a></li>
			<li><a href="tables.php">Tables</a></li>
		</ul>
	</div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <div class="starter-template">
