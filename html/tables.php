<?php
	$pageTitle = "Tables";
	require_once('header.php');
?>

<h1><?php echo $pageTitle;?></h1>

<script>
$(document).ready(function() 
    { 
        $(".tablesorter").tablesorter(); 
    } 
); 
</script>

<div class="table-responsive">
  
  <table class="table table-hover table-striped table-bordered table-condensed tablesorter">
	 
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

<?php require_once('footer.php');?>
