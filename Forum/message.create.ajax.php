<div>
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

include_once('_resources/credentials.inc.php');
$include_mysqlo = true;
require_once('_resources/header.inc.php');

sec_session_start();
if (empty($_SESSION["user_id"])){
  echo "<p class='bg-danger text-danger'>ERROR: Not Logged In</p>";
  die();
} else {
  $message_author_user_id = $_SESSION["user_id"];
}

?>

<?php

if( !empty($mysqlo_connected) ){

	$message_text = mysqlo_prepare_input($message_text);

    $sql="
		CALL Forum_proc_Insert_Message(
			'$message_text', $message_thread_id, $message_author_user_id, '$thread_name'
		)
    ";
    $result = mysql_query($sql) or die(mysql_error());

    include("message.read.inc.php");

} else {

    // help connecting to database
    echo "<p class='bg-danger text-danger'>ERROR: Not Connected to Database</p>";
    include("$path_real_root/_resources/SQL/database.help.inc.html");

}

?>

<?php require_once('_resources/footer.inc.php');?>
</div>
