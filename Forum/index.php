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
<div id='thread_div' class='well'>
<?php

if( isset($mysql_connection) && $mysql_connection ){
    
    $sql="
		SELECT	message_id,
					message_creation_time,
					message_text,
					message_author_user_id
		FROM		Forum_Messages
    ";
    $result = mysql_query($sql) or die(mysql_error());

    echo "<h3>" . mysql_num_rows($result) . " Messages</h3>";

    // data
    while ($row = mysql_fetch_assoc($result)){
		echo "
		<div class='well'><div class='row'>

			<div class='col-md-6'>
				<p>$row[message_text]</p>
			</div><!-- /.col -->
			
			<div class='col-md-6'><div class='message_metadata'>
				<p><label class='label label-info'>$row[message_creation_time]</label></p>
				<p><label class='label label-primary'>message_author_user_id $row[message_author_user_id]</label></p>
			</div><!-- /.message_metadata --></div><!-- /.col -->
			
		</div><!-- /.row --></div><!-- /.well -->\n
		";
	 }

} else {

    // help connecting to database
    echo "ERROR: not connected to MySQL";
    include("$path_real_relative_root/_resources/SQL/database.help.inc.html");

}

?>
<style>
.message_metadata p {
	float: right;
}
</style>
</div><!-- /#thread_div.well -->

<?php
// post message text area
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
