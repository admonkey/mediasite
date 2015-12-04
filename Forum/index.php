<?php

include_once('../_resources/credentials.php');
$include_jquery_ui = true;
$include_tablesorter = true;
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
<?php

if( !empty($mysql_connection) ){
    
    $sql="
	    SELECT *
	    FROM Forum_Threads;
    ";
    $result = mysql_query($sql) or die(mysql_error());
    $numfields = mysql_num_fields($result);

    // table
    echo "
	    <table border=1>
		    <thead>
			    <tr>
    ";
    // // header
    for ($i=0; $i < $numfields; $i++)
	    echo '<th>'.mysql_field_name($result, $i).'</th>';
    echo "
			    </tr>
		    </thead>
		    <tbody>
    ";
    // // data
    while ($row = mysql_fetch_assoc($result))
	    echo "<tr><td><message_data thread_id='$row[thread_id]' thread_name='$row[thread_name]'></message_data>".implode($row,'</td><td>')."</td></tr>\n";
    echo "
		    </tbody>
	    </table>
    ";

    ?>
    <!-- hyperlink whole row -->
    <script>
      $("tr").click( function() {
	  var row = $(this);
	  var thread_id = row.find("message_data").attr("thread_id");
	  var thread_name = row.find("message_data").attr("thread_name");
	  $.ajax({url: "Forum.messages.ajax.php?thread_id=" + thread_id, success: function(result){
	    $("#thread_div").html(result);
	    $("#thread_div").prepend("<h2>" + thread_name + "</h2>");
	  },cache: false});
      }).hover( function() {
	  $(this).toggleClass("hover");
      });
    </script>
    <style>
      tr.hover {
	cursor: pointer;
      }
    </style>
    <?php

} else {
    
    // help connecting to database
    echo "ERROR: not connected to MySQL";
    include("$path_real_relative_root/_resources/SQL/database.help.inc.html");

}

?>


<!-- thread of messages -->
<div id='thread_div' class='well'>
  <p>Click a thread to show messages.</p>
</div><!-- /#thread_div.well -->



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
