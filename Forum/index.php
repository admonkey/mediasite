<?php

include_once('../_resources/credentials.php');
$include_jquery_ui = true;
$include_mysql = true;
require_once('../_resources/header.php');

echo "<h1>$section_title</h1>";

// default login
if (isset($_GET["default"])){
	$_SESSION["user_id"] = 0;
	$_SESSION["username"] = "Default";
}

?>

<!-- list of threads -->



<!-- thread of messages -->
<div id='thread_div' class='well'></div><!-- /#thread_div.well -->
<script>
$(function(){
  $.ajax({url: "Forum.messages.ajax.php?thread_id=1", success: function(result){
    $("#thread_div").html(result);
  },cache: false});
});
</script>



<!-- post message text area -->
<?php
if (!isset($_SESSION["username"]))
	echo "<p><a href='?default' class='btn btn-primary'>Login as 'Default'</a></p>";
else echo "
<div id='message_div' class='well'>
	
	<form id='message_form' method='post' role='form'>

		<input name='user_id' type='hidden' value='$_SESSION[user_id]'></input>

		<div class='form-group'>
			<label for='message_textarea'>Message (max 140 characters):</label>
			<textarea class='form-control' style='width:100%' maxlength='140' rows='3' id='message_textarea' name='message_textarea'></textarea>
		</div>

		<button type='submit' class='btn btn-primary'>Submit</button>

	</form>

</div>
";
?>

<?php require_once('../_resources/footer.php');?>
