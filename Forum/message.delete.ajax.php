<div>
<?php

if (empty($_GET["message_id"])){
  echo "<p class='bg-danger text-danger'>ERROR: No Message ID</p>";
  die();
} else {
  $message_id = $_GET["message_id"];
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

?>

<?php

if( !empty($mysql_connection) ){

    $sql="CALL Forum_proc_Delete_Message($user_id, $message_id)";
    $result = mysql_query($sql) or die(mysql_error());

    echo "<p class='bg-success text-success'>Message Deleted</p>";

} else {

    // help connecting to database
    echo "<p class='bg-danger text-danger'>ERROR: Not Connected to Database</p>";
    include("$path_real_relative_root/_resources/SQL/database.help.inc.html");

}

?>

<?php require_once('../_resources/footer.php');?>
</div>