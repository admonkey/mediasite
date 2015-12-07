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

session_start();
if (empty($_SESSION["user_id"])){
  echo "<p class='bg-danger text-danger'>ERROR: Not Logged In</p>";
  die();
} else {
  $user_id = $_SESSION["user_id"];
}

include_once('../_resources/credentials.php');
$include_mysql = true;
require_once('../_resources/header.php');

if( !empty($mysql_connection) ){

	$message_text = prepare_sql_input($message_text);

    $sql="CALL Forum_proc_Update_Message($user_id, $message_id, '$message_text')";
    $result = mysql_query($sql) or die(mysql_error());

    include("message.read.inc.php");

} else {

    // help connecting to database
    echo "<p class='bg-danger text-danger'>ERROR: Not Connected to Database</p>";
    include("$path_real_relative_root/_resources/SQL/database.help.inc.html");

}

?>

<?php require_once('../_resources/footer.php');?>
</div>
