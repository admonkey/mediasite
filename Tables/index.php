<?php
	$pageTitle = "Tables";
	require_once('../resources/header.php');
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
$(document).ready(function() {
	$("table").addClass("table table-hover table-striped table-bordered table-condensed tablesorter").tablesorter();
}); 
</script>

<?php require_once('../resources/footer.php');?>
