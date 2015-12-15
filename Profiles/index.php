<?php

// if individual profile, then validate user_id greater than zero
if ( !empty($_GET["user_id"]) && is_numeric($_GET["user_id"]) && $_GET["user_id"] > 0 ) {
  $user_id = $_GET["user_id"];
  require_once("profile.inc.php");
}

require_once('_resources/header.inc.php');

$page_header = ( !empty($page_title) ? $page_title : $section_title );

echo "<h1>$page_header</h1>";

if ( !empty($array_profile) ) {

  echo "
  <div class='well'>

    <label for='first_name'>First Name:</label>
    <p id='first_name'>$array_profile[first_name]</p>

    <label for='last_name'>Last Name:</label>
    <p id='last_name'>$array_profile[last_name]</p>

    <label for='email'>Email:</label>
    <p id='email'>$array_profile[email]</p>

  </div>
  ";

} else {

  echo "list of profiles";

}

?>

<?php require_once('_resources/footer.inc.php');?>
