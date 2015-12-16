<?php

$include_mysqli = true;

// if individual profile, then validate user_id greater than zero
if ( !empty($_GET["user_id"]) && is_numeric($_GET["user_id"]) && $_GET["user_id"] > 0 ) {
  $user_id = $_GET["user_id"];
  require_once("profile.inc.php");
} else {
  $user_id = false;
  $include_tablesorter = true;
}

require_once('_resources/header.inc.php');

$page_header = ( !empty($page_title) ? $page_title : $section_title );

echo "<h1>$page_header</h1>";

// print body of individual profile
if ( !empty($user_id) && !empty($array_profile) ) {

  if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] === $user_id) { 

    if ($array_profile["private"] === "1") { $class = "danger"; $privacy = "Private"; }
    else { $class = "success"; $privacy = "Public"; }
    echo "<div id='privacy_div_wrapper' style='float:right'><div id='privacy_div' class='well'><p><a href='javascript:privatize_profile($array_profile[private])' class='btn btn-$class'>$privacy</a></p></div></div>";

  ?>

  <script>
    function privatize_profile(current_privacy_value){
      if (current_privacy_value === 1) {
	      new_privacy_value = "0";
      } else  new_privacy_value = "1";
      $.ajax({url: "privatize.ajax.php?user_id=<?php echo $_SESSION["user_id"];?>&privatize=" + new_privacy_value, 
	success: function(result){
	    $("#privacy_div").html(result);
	}
      });
    }
  </script>

  <?php }

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

}
else // print list of profiles
{

  require_once("profiles.inc.php");

}

 ?>

<?php require_once('_resources/footer.inc.php');?>
