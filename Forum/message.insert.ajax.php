<?php

if (empty($_POST["message_text"])){
  echo "<p class='bg-danger text-danger'>ERROR: No Message Text</p>";
  die();
} else {
  $message_text = $_POST["message_text"];
}

if ( ! (isset($_POST["message_thread_id"]) && is_numeric($_POST["message_thread_id"])) && empty($_POST["thread_name"]) ) {
  echo "<p class='bg-danger text-danger'>ERROR: Invalid Thread</p>";
  die();
} else {
  if (empty($_POST["thread_name"])){
    $thread_name = "NULL";
    $message_thread_id = $_POST["message_thread_id"];
  } else {
    $thread_name = $_POST["thread_name"];
    $message_thread_id = "NULL";
  }
}

session_start();
if (empty($_SESSION["user_id"])){
  echo "<p class='bg-danger text-danger'>ERROR: Not Logged In</p>";
  die();
} else {
  $message_author_user_id = $_SESSION["user_id"];
}

include_once('../_resources/credentials.php');
$include_mysql = true;
require_once('../_resources/header.php');

?>

<div>

<?php

if( !empty($mysql_connection) ){

	$message_text = mysql_real_escape_string(htmlentities($message_text));
    
    $sql="
		CALL Forum_proc_Insert_Message(
			'$message_text', $message_thread_id, $message_author_user_id, '$thread_name'
		)
    ";
    $result = mysql_query($sql) or die(mysql_error());

    // data
    while ($row = mysql_fetch_assoc($result)){
		echo "
		<div class='well'><div class='row'>

			<div class='col-md-9'>
				<p>$row[message_text]</p>
			</div><!-- /.col-md-9 -->
			
			<div class='col-md-3'><div class='message_metadata'>
				<message_data thread_id='$row[message_thread_id]'></message_data>
				<p><label class='label label-primary'>message_author_user_id $row[message_author_user_id]</label></p>
				<p><label class='label label-info'>$row[message_creation_time]</label></p>
			</div><!-- /.message_metadata --></div><!-- /.col-md-3 -->
			
		</div><!-- /.row --></div><!-- /.well -->\n
		";
	 }

} else {

    // help connecting to database
    echo "<p class='bg-danger text-danger'>ERROR: Not Connected to Database</p>";
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
