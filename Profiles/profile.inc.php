<?php

$include_mysqli = true;
require_once((__DIR__)."/_resources/resources.inc.php");

// get profile from database
$query_profile = "SELECT * FROM `Users` WHERE user_id = $user_id";
$result_profile = $mysqli_connection->query($query_profile);
$array_profile = $result_profile->fetch_array(MYSQLI_ASSOC);

$page_title = "$array_profile[username]";

?>