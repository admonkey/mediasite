<?php

if( isset($mysql_connection) && $mysql_connection ){
    
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
    while ($row = mysql_fetch_assoc($result))
	    echo "<tr><td><a href='&object_id=$row[object_id]'></a>".implode($row,'</td><td>')."</td></tr>\n";
    echo "
		    </tbody>
	    </table>
    ";
    
} else {
    
    // help connecting to database
    echo "ERROR: not connected to MySQL";
    include("$path_real_relative_root/_resources/SQL/database.help.inc.html");

}

?>
