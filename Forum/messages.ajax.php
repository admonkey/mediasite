<div>
<?php

if ( ! (isset($_GET["thread_id"]) && is_numeric($_GET["thread_id"])) ) {
  echo "<p class='bg-danger text-danger'>ERROR: Invalid Thread</p>";
  die();
} else {
  $thread_id = $_GET["thread_id"];
}

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

?>

<?php

if( !empty($mysql_connection) ){
    
    $sql="CALL Forum_proc_Fetch_Messages($thread_id);";
    $result = mysql_query($sql) or die(mysql_error());

    echo "<h3>" . mysql_num_rows($result) . " Messages</h3>";

    include("message.read.inc.php");

} else {

    // help connecting to database
    echo "ERROR: not connected to MySQL";
    include("$path_real_relative_root/_resources/SQL/database.help.inc.html");

}

?>

<?php require_once('../_resources/footer.php');?>
</div>
