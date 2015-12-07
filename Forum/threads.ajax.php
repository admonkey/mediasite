<?php

/*
// kick out users unless they are logged in
session_start();
if (empty($_SESSION["user_id"])){
  echo "<p class='bg-danger text-danger'>ERROR: Not Logged In</p>";
  die();
}
*/

include_once('../_resources/credentials.php');
$include_mysql = true;
require_once('../_resources/header.php');


// list of threads
if( !empty($mysql_connection) ){
    
    $sql="
	SELECT t.thread_id, t.thread_name,
		mm.count_message_id,
		mm.max_message_id,
		m.message_creation_time,
		m.message_author_user_id
	FROM Forum_Threads t
	JOIN Forum_Messages m
		ON t.thread_id = m.message_thread_id
	JOIN (
	    SELECT message_thread_id,
		MAX(message_id) AS max_message_id,
		COUNT(message_id) AS count_message_id
	    FROM Forum_Messages
	    WHERE message_deleted = 0
	    GROUP BY message_thread_id
	) mm
		ON mm.max_message_id = m.message_id
	GROUP BY t.thread_id
	ORDER BY mm.max_message_id DESC;
    ";
    $result = mysql_query($sql) or die(mysql_error());
    $numfields = mysql_num_fields($result);

    // open table
    echo "
	<table border=1>
		<thead>
			<tr>
				    <th>Thread</th>
				    <th>Posts</th>
				    <th>Last Updated</th>
				    <th>Updated By</th>
			</tr>
		</thead>
		<tbody>
    ";

    // data
    while ($row = mysql_fetch_assoc($result))
	echo "
			<tr>
				<td><message_data thread_id='$row[thread_id]' thread_name='$row[thread_name]'></message_data>$row[thread_name]</td>
				<th>$row[count_message_id]</th>
				<td>$row[message_creation_time]</td>
				<td>message_author_user_id $row[message_author_user_id]</td>
			</tr>\n";
    
	// close table
	echo "
		</tbody>
	</table>
	
	<script>
	  $(hyperlink_row());
	</script>
    ";

} else {

    // help connecting to database
    echo "<p class='bg-danger text-danger'>ERROR: Not Connected to Database</p>";
    include("$path_real_relative_root/_resources/SQL/database.help.inc.html");

}
?>

<?php require_once('../_resources/footer.php');?>
