<?php

// get profile from database
$query_profile = "SELECT * FROM `Users` WHERE user_id = $user_id";
$result_profile = $mysqli_connection->query($query_profile);
$array_profile = $result_profile->fetch_array(MYSQLI_ASSOC);

echo "<h1>$array_profile[username] $section_title</h1>";

var_dump($array_profile);

?>