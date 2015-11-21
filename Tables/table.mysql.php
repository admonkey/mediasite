<?php
if( $mysql_connection ){
	
	$sql="
		SELECT *
		FROM Objects;
	";
	$result = mysql_query($sql) or die(mysql_error());
	$numfields = mysql_num_fields($result);

	// table
	echo "
		<table border=1>
			<thead>
				<tr>
	";
	// // header
	for ($i=0; $i < $numfields; $i++)
		echo '<th>'.mysql_field_name($result, $i).'</th>';
	echo "
				</tr>
			</thead>
			<tbody>
	";
	// // data
	while ($row = mysql_fetch_row($result))
		echo '<tr><td>'.implode($row,'</td><td>')."</td></tr>\n";
	echo "
			</tbody>
		</table>
	";
	
} else {
	
	// help connecting to database
	echo "
	<div id='mysql_help_div' class='well'>

		<p id='mysql_help_p'>
		
			Make sure that you have enabled a MySQL connection in the <code>credentials.php</code> file,
			located in either the root or section folder.
		
		</p><!-- /#mysql_help_p -->

	</div><!-- /#mysql_help_div.well -->
	";
	
}
?>

