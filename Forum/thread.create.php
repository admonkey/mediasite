<?php

include_once('../_resources/credentials.php');
$include_jquery_ui = true;
$page_title = "Create Thread";
require_once('../_resources/header.php');

echo "

<h1>$page_title</h1>

<!-- thread of messages -->
<div id='thread_div' class='well'>
  <p>Create a new message thread.</p>
</div><!-- /#thread_div.well -->

";

// default login
if (isset($_GET["default"])){
	$_SESSION["user_id"] = -1;
	$_SESSION["username"] = "Default";
}

// post message text area
if (!isset($_SESSION["username"])) { ?>

	<p><a href='?default' class='btn btn-primary'>Login as 'Default'</a></p>

<?php } else { include("message.input.inc.html"); } ?>

<script>
  $(function(){
    $("#message_div").show();
    $("#thread_name_div").show();
    $("#thread_name").prop("disabled",false);
  });
</script>

<?php require_once('../_resources/footer.php');?>
