<?php
while ($row = mysql_fetch_assoc($result)){
      echo "
      <div class='well message_well'><div class='row'>

	      <div class='col-md-9'>
		      <p>$row[message_text]</p>
	      </div><!-- /.col-md-9 -->
	      
	      <div class='col-md-3'><div class='message_metadata'>
		      <message_data thread_id='$row[message_thread_id]' message_id='$row[message_id]'></message_data>
		      <p><label class='label label-primary'>message_author_user_id $row[message_author_user_id]</label></p>
		      <p><label class='label label-info'>$row[message_creation_time]</label></p>";
		      
		      // delete button
		      if ($row["message_author_user_id"] == $_SESSION["user_id"]) echo "
		      <p><a href='javascript:void(0)' onclick='delete_message($row[message_id], $(this))'><label class='label label-danger'>Delete</label></a></p>";
		      
	      echo "
	      </div><!-- /.message_metadata --></div><!-- /.col-md-3 -->
	      
      </div><!-- /.row --></div><!-- /.well -->\n
      ";
}
?>