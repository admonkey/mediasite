<?php
	$pageTitle = "Tables";
	require_once('resources/header.php');
?>

<script>
$(document).ready(function() 
    { 
	$("table").addClass("table table-hover table-striped table-bordered table-condensed tablesorter").tablesorter();
    } 
); 
</script>

<div class="table-responsive well">
  <h1>Sortable Table:</h1>
  <table border=1>
	 
	 <thead>
		<tr>
		   <th>Column 1</th>
		   <th>Column 2</th>
		   <th>Column 3</th>
		</tr>
	 </thead>
	 
	 <tbody>
		 <tr>
			<td>value1a</td>
			<td>value2a</td>
			<td>value3a</td>
		 </tr>
		 <tr>
			<td>value1b</td>
			<td>value2b</td>
			<td>value3b</td>
		 </tr>
		 <tr>
			<td>value1c</td>
			<td>value2c</td>
			<td>value3c</td>
		 </tr>
	 </tbody>
	 
  </table>
  
</div>

<?php require_once('resources/footer.php');?>
