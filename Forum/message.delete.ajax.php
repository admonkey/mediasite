<div>
<?php

if ( !empty($_GET["message_id"]) && is_numeric($_GET["message_id"]) ){
  $message_id = $_GET["message_id"];
} else {
  echo "<p class='bg-danger text-danger'>ERROR: Invalid Message ID</p>";
  die();
}

session_start();
if (empty($_SESSION["user_id"])){
  echo "<p class='bg-danger text-danger'>ERROR: Not Logged In</p>";
  die();
} else {
  $user_id = $_SESSION["user_id"];
}

if (isset($_GET["restore"])) $deleted = 0;
else $deleted = 1;

include_once('../_resources/credentials.php');
$include_mysql = true;
require_once('../_resources/header.php');

?>

<?php

if( !empty($mysql_connection) ){

    $sql="CALL Forum_proc_Delete_Message($user_id, $message_id, $deleted)";
    $result = mysql_query($sql) or die(mysql_error());

    if ($deleted == 0)
      include("message.read.inc.php");
    else
      echo "
      <div class='well message_well' style='background-color:#f2dede'>
	<p class='text-danger'>Message Deleted</p>
	<p><a href='javascript:void(0)' onclick='delete_message($message_id + \"&restore\", $(this))'><label class='label label-warning'>Undo</label></a></p>
      </div>";

} else {

    // help connecting to database
    echo "<p class='bg-danger text-danger'>ERROR: Not Connected to Database</p>";
    include("$path_real_relative_root/_resources/SQL/database.help.inc.html");

}

?>

<?php require_once('../_resources/footer.php');?>
</div>