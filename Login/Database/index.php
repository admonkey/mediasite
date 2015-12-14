<?php

include_once("_resources/credentials.php");
//$page_title = "Home Page";
$include_jquery_ui = true;
require_once("_resources/header.php");

if (isset($_GET["registration_success"]))
  echo "<p><label class='label label-success'>Registration Success! Now try logging in for the first time.</label></p>";

echo "<h1>Authenticate Users from a $section_title Table</h1>";

/* ajax original peredur index
<div id='peredur_wrapper' class='well'>
  <div id='peredur_div'></div><!-- /#peredur_div -->
</div><!-- /#peredur_wrapper.well -->
<script>
    $.ajax({
      url: "peredur/index.php", 
      success: function(result){
	    $("#peredur_div").html(result);
      },
      cache: false
    });
</script>
*/
?>

<?php
include_once (__DIR__).'/peredur/includes/db_connect.php';
include_once (__DIR__).'/peredur/includes/functions.php';
?>

<script type="text/JavaScript" src="peredur/js/sha512.js"></script>
<script type="text/JavaScript" src="peredur/js/forms.js"></script>



<?php
$login_help = "";
if (isset($_GET['error'])) {
    $login_help .= "<p><label class='label label-danger'>Error Logging In!</label></p>";
}

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
	<form action='peredur/process_login.php' method='post' name='login_form' role='form'>
	  <div class='form-group'>
	    <label for='email'>Email:</label>
	    <input id='email' name='email' type='email' class='form-control' required></input>
	  </div>
	  <div class='form-group'>
	    <label for='password'>Password:</label>
	    <input id='password' name='password' type='password' class='form-control' required></input>
	  </div>
	  <button type='submit' class='btn btn-primary' onclick='formhash(this.form, this.form.password);'>Submit</button>
	</form>
      </div><!-- /.well -->
      
    <?php
} // END if not logged in
?>

<div id='login_help_div' class='well'>
  <?php echo "$login_help";?>
</div><!-- /.well -->

<div id='registration_div' class='well' style='display:none'>
  <?php
    if (!empty($error_msg)) {
	echo $error_msg;
    }
  ?>

  <div class='well'>
  <h3>Constraints</h3>
  <ul>
      <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
      <li>Emails must have a valid email format</li>
      <li>Passwords must be at least 6 characters long</li>
      <li>Passwords must contain
	  <ul>
	      <li>At least one upper case letter (A..Z)</li>
	      <li>At least one lower case letter (a..z)</li>
	      <li>At least one number (0..9)</li>
	  </ul>
      </li>
      <li>Your password and confirmation must match exactly</li>
  </ul>
  </div>
  
  <form action='peredur/register.bounce.php' method='post' name='registration_form' role='form'>
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
    <button type='submit' class='btn btn-primary' 
      onclick='return regformhash(
	this.form,
	this.form.username,
	this.form.email,
	this.form.password,
	this.form.confirmpwd
      );'>Register
    </button>
  </form>
  
</div><!-- /.well -->


<?php require_once("_resources/footer.php");?>
