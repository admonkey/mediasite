<?php

// validate user_id greater than zero
if ( !empty($_GET["user_id"]) && is_numeric($_GET["user_id"]) && $_GET["user_id"] > 0 ) {
  $user_id = $_GET["user_id"];
} else die("<label class='label label-danger'>Invalid User ID</label>");

// privacy value
if ( isset($_GET["privatize"]) && ($_GET["privatize"] === "0" || $_GET["privatize"] === "1") ) {
  $privacy_value = $_GET["privatize"];
} else die("<label class='label label-danger'>Invalid Privacy Value</label>");

// resources
$include_mysqli = true;
require_once("_resources/resources.inc.php");

// require same user or admin
if ( !( (isset($_SESSION["user_id"]) && $_SESSION["user_id"] === $user_id) || isset($_SESSION["user_groups"]["ADMIN"]) ) )
  die("<label class='label label-danger'>You can only privatize your own profile.</label>");

// sql
$query_privatize = "UPDATE `Users` SET private = $privacy_value WHERE user_id = $user_id";
if (!$mysqli_connection->query($query_privatize))
  die("<label class='label label-danger'>". $mysqli_connection->error ."</label>");
else {
  if ($privacy_value === "1") { $class = "danger"; $privacy = "Private"; }
  else { $class = "success"; $privacy = "Public"; }
  echo "<p>This profile is <a href='javascript:privatize_profile($privacy_value)' class='btn btn-$class'>$privacy</a></p>";
}
?>