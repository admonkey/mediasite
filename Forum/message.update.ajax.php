<div>
<?php

if ( !empty($_POST["message_id"]) && is_numeric($_POST["message_id"]) ){
  $message_id = $_POST["message_id"];
} else {
  echo "<p class='bg-danger text-danger'>ERROR: Invalid Message ID</p>";
  die();
}

if (empty($_POST["message_text"])){
  echo "<p class='bg-danger text-danger'>ERROR: No Message Text</p>";
  die();
} else {
  $message_text = $_POST["message_text"];
}

include_once('_resources/credentials.inc.php');
$include_mysqlo = true;
require_once('_resources/header.inc.php');

sec_session_start();
if (empty($_SESSION["user_id"])){
  echo "<p class='bg-danger text-danger'>ERROR: Not Logged In</p>";
  die();
} else {
  $user_id = $_SESSION["user_id"];
}

if( !empty($mysqlo_connected) ){

	$message_text = mysqlo_prepare_input($message_text);

    $sql="CALL Forum_proc_Update_Message($user_id, $message_id, '$message_text')";
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
