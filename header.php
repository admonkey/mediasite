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
		  
		  <ul class="nav navbar-nav">
			<li><a href="#menu-toggle" id="menu-toggle">Sidenav</a></li>
		  </ul>
		    <!-- Menu Toggle Script -->
			<script>
			$("#menu-toggle").click(function(e) {
				e.preventDefault();
				$("#wrapper").toggleClass("toggled");
			});
			</script>
		  
          <a class="navbar-brand" href="<?php echo $relative_webpath;?>"><?php echo $siteTitle; ?></a>
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

	
<style>
/*!
 * Start Bootstrap - Simple Sidebar HTML Template (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

/* Toggle Styles */

#wrapper {
    padding-left: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled {
    padding-left: 250px;
}

#sidebar-wrapper {
    z-index: 1000;
    position: fixed;
    left: 250px;
    width: 0;
    height: 100%;
    margin-left: -250px;
    overflow-y: auto;
    background: #000;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled #sidebar-wrapper {
    width: 250px;
}

#page-content-wrapper {
    width: 100%;
    position: absolute;
    padding: 15px;
}

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-right: -250px;
}

/* Sidebar Styles */

.sidebar-nav {
    position: absolute;
    top: 0;
    width: 250px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sidebar-nav li {
    text-indent: 20px;
    line-height: 40px;
}

.sidebar-nav li a {
    display: block;
    text-decoration: none;
    color: #999999;
}

.sidebar-nav li a:hover {
    text-decoration: none;
    color: #fff;
    background: rgba(255,255,255,0.2);
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
    text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
    height: 65px;
    font-size: 18px;
    line-height: 60px;
}

.sidebar-nav > .sidebar-brand a {
    color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
    color: #fff;
    background: none;
}

@media(min-width:768px) {
    #wrapper {
        padding-left: 250px;
    }

    #wrapper.toggled {
        padding-left: 0;
    }

    #sidebar-wrapper {
        width: 250px;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 0;
    }

    #page-content-wrapper {
        padding: 20px;
        position: relative;
    }

    #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 0;
    }
}
</style>
	
	
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
		

	
		<div class="container-fluid">
		  <div class="starter-template">
		  
<!-- BEGIN BODY CONTENT -->
