<?php

// validate user_id greater than zero
if ( !empty($_GET["user_id"]) && is_numeric($_GET["user_id"]) && $_GET["user_id"] > 0 ) {
  $user_id = $_GET["user_id"];
  require_once("profile.inc.php");
}

//$page_title = "Home Page";

require_once('_resources/header.inc.php');

echo "<h1>$section_title</h1>";

?>

<?php require_once('_resources/footer.inc.php');?>
