<?php
while ($row = mysql_fetch_assoc($result)){

		// newlines
		$message_text = str_replace("\n","<br/>",$row["message_text"]);

      echo "
      <div class='message_wrapper'>
      <div class='message_body_well well'><div class='row'>

	      <div class='col-md-9'>
		      <p class='message_text'>$message_text</p>
	      </div><!-- /.col-md-9 -->
	      
	      <div class='col-md-3'><div class='message_metadata'>
		      <message_data thread_id='$row[message_thread_id]' message_id='$row[message_id]'></message_data>
		      <p><label class='label label-primary'>message_author_user_id $row[message_author_user_id]</label></p>
		      <p><label class='label label-info'>$row[message_creation_time]</label></p>";
		      
		      // delete & edit button
		      if ($row["message_author_user_id"] == $_SESSION["user_id"]) echo "
		      <p><a href='javascript:void(0)' onclick='delete_message($row[message_id], $(this))'><label class='label label-danger'>Delete</label></a></p>
		      
		      <p><a href='javascript:void(0)' onclick='show_editor($(this), false)'><label class='label label-warning'>Edit</label></a></p>";
		      
	      echo "
	      </div><!-- /.message_metadata --></div><!-- /.col-md-3 -->
	      
      </div><!-- /.row --></div><!-- /.message_body_well -->
      
      <div class='message_editor_well well' style='display:none; background-color:#f2dede;'></div>
      
      </div><!-- /.message_wrapper -->\n
      ";
}
?>

