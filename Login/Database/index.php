<?php

include_once("_resources/credentials.inc.php");
//$page_title = "Home Page";
$include_jquery_ui = true;
require_once("_resources/header.inc.php");

echo "<h1>Authenticate Users from a $section_title Table</h1>";

?>

<?php
include_once (__DIR__).'/peredur/_resources/peredur.inc.php';
?>

<script type="text/JavaScript" src="peredur/_resources/js/sha512.js"></script>
<script type="text/JavaScript" src="peredur/_resources/js/forms.js"></script>


<?php
$login_help = "";
if (login_check($mysqli) == true) {
    $login_help .= "
      <p><label class='label label-success'>You are currently logged in as '$_SESSION[username]'.</label></p>
      <p>If you are done, please <a href='?logout' class='btn btn-danger'>log out</a></p>
    ";
} else {
    $login_help .= "
      <p><label class='label label-danger'>You are currently logged out.</label></p>
      <p>If you don't have a login, please <a onclick='$(\"#registration_div\").show(\"blind\")' href='javascript:void(0)' class='btn btn-primary'>register</a></p>
    ";
    ?>

      <div class='well'>
      <?php
	if (isset($_GET['error'])) {
	    echo "<p><label class='label label-danger'>Error Logging In!</label></p>";
	}
      ?>
	<form action='peredur/login.bounce.php' method='post' name='login_form' role='form'>
	  <div class='form-group'>
	    <label for='email'>Email:</label>
	    <input id='email' name='email' type='email' class='form-control' required></input>
	  </div>
	  <div class='form-group'>
	    <label for='password'>Password:</label>
	    <input id='password' name='password' type='password' class='form-control'></input>
	  </div>
	  <button type='submit' class='btn btn-primary' onclick='formhash(this.form);'>Submit</button>
	</form>
      </div><!-- /.well -->
      
    <?php
} // END if not logged in
?>

<div id='login_help_div' class='well'>
  <?php echo "$login_help";?>
</div><!-- /.well -->

<div id='registration_callback_messages' class='well' style='display:none'>
</div><!-- /#registration_callback_messages.well -->

<div id='registration_div' class='well' style='display:none'>

  <div id='registration_constraints' class='well'>
    <h3>Constraints</h3>
    <ul>
	<li>Usernames may contain only digits, upper and lower case letters and underscores.</li>
	<li>Emails must have a valid email format.</li>
	<li>Passwords must be at least 6 characters long.</li>
	<li>Passwords must contain:
	    <ul>
		<li>At least one upper case letter (A..Z)</li>
		<li>At least one lower case letter (a..z)</li>
		<li>At least one number (0..9)</li>
	    </ul>
	</li>
	<li>Your password and confirmation must match exactly.</li>
    </ul>
  </div><!-- /#registration_constraints.well -->
  
  <form id='registration_form' onsubmit='return false' role='form'>
    <div class='form-group'>
      <label for='first_name'>First Name:</label>
      <input id='first_name' name='first_name' type='text' class='form-control' required></input>
    </div>
    <div class='form-group'>
      <label for='last_name'>Last Name:</label>
      <input id='last_name' name='last_name' type='text' class='form-control' required></input>
    </div>
    <div class='form-group'>
      <label for='username'>Username:</label>
      <input id='username' name='username' type='text' class='form-control' required></input>
    </div>
    <div class='form-group'>
      <label for='email'>Email:</label>
      <input id='email' name='email' type='email' class='form-control' required></input>
    </div>
    <div class='form-group'>
      <label for='password'>Password:</label>
      <input id='password' name='password' type='password' class='form-control' required></input>
    </div>
    <div class='form-group'>
      <label for='confirmpwd'>Confirm Password:</label>
      <input id='confirmpwd' name='confirmpwd' type='password' class='form-control' required></input>
    </div>
    <button onclick='submit_registration(this.form)' type='submit' class='btn btn-primary'>Submit</button>
  </form>
  
</div><!-- /.well -->


<?php require_once("_resources/footer.inc.php");?>

