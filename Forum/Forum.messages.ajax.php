<?php

if ( ! (isset($_GET["thread_id"]) && is_numeric($_GET["thread_id"])) ) {
  echo "<p class='bg-danger text-danger'>ERROR: Invalid Thread</p>";
  die();
} else {
  $thread_id = $_GET["thread_id"];
}

include_once('../_resources/credentials.php');
$include_mysql = true;
require_once('../_resources/header.php');

?>

<div>

<?php

if( !empty($mysql_connection) ){
    
    $sql="
		SELECT	message_id,
					message_creation_time,
					message_text,
					message_author_user_id
		FROM		Forum_Messages
		WHERE		message_thread_id = $thread_id
    ";
    $result = mysql_query($sql) or die(mysql_error());

    echo "<h3>" . mysql_num_rows($result) . " Messages</h3>";

    // data
    while ($row = mysql_fetch_assoc($result)){
		echo "
		<div class='well'><div class='row'>

			<div class='col-md-9'>
				<p>$row[message_text]</p>
			</div><!-- /.col-md-9 -->
			
			<div class='col-md-3'><div class='message_metadata'>
				<p><label class='label label-primary'>message_author_user_id $row[message_author_user_id]</label></p>
				<p><label class='label label-info'>$row[message_creation_time]</label></p>
			</div><!-- /.message_metadata --></div><!-- /.col-md-3 -->
			
		</div><!-- /.row --></div><!-- /.well -->\n
		";
	 }

} else {

    // help connecting to database
    echo "ERROR: not connected to MySQL";
    include("$path_real_relative_root/_resources/SQL/database.help.inc.html");

}

?>

<style>
.message_metadata p {
	float: right;
}
</style>

</div>

<?php require_once('../_resources/footer.php');?>
