<?php

include_once('_resources/credentials.inc.php');
//$page_title = "Home Page";
$include_mysqli = true;
require_once('_resources/header.inc.php');

if ( is_numeric($_GET["user_id"]) && $_GET["user_id"] > 0 ) {
  $user_id = $_GET["user_id"];
} elseif (!empty($_SESSION["user_id"])) {
  $user_id = $_SESSION["user_id"];
}

include_once("profile.inc.php");

?>

<?php require_once('_resources/footer.inc.php');?>
