<?php

//$page_title = "Home Page";
$include_tablesorter = true;
require_once('../-resources/header.php');

?>

<div class="table-responsive well">

  <h1>Sortable Table</h1>

  <?php // choose which table to load
  
    switch ($_GET['table']) {
    
      case "static":
	include_once('table.static.html');
	break;
	
      case "mysql":
	include_once('table.mysql.php');
	break;
	
      default:
	include_once('table.static.html');
	
    }
	
  ?>

</div>

<script>

  // add tablesorter
  $(document).ready(function() {
	  $("table").addClass("table table-hover table-striped table-bordered table-condensed tablesorter").tablesorter();
  }); 

  // hyperlink whole row
  $('tr').click( function() {
      window.location = "?query" + $(this).find('a').attr('href');
  }).hover( function() {
      $(this).toggleClass('hover');
  });
  
</script>

<style>
  tr.hover {
    cursor: pointer;
  }
</style>

<?php require_once('../-resources/footer.php');?>
