<?php
while ($row = mysql_fetch_assoc($result)){
      echo "
      <div class='message_wrapper'>
      <div class='well message_well'><div class='row'>

	      <div class='col-md-9'>
		      <p class='message_text'>$row[message_text]</p>
	      </div><!-- /.col-md-9 -->
	      
	      <div class='col-md-3'><div class='message_metadata'>
		      <message_data thread_id='$row[message_thread_id]' message_id='$row[message_id]'></message_data>
		      <p><label class='label label-primary'>message_author_user_id $row[message_author_user_id]</label></p>
		      <p><label class='label label-info'>$row[message_creation_time]</label></p>";
		      
		      // delete button
		      if ($row["message_author_user_id"] == $_SESSION["user_id"]) echo "
		      <p><a href='javascript:void(0)' onclick='delete_message($row[message_id], $(this))'><label class='label label-danger'>Delete</label></a></p>";
		      
		      // edit button
		      echo "<p><a href='javascript:void(0)' onclick='show_editor($(this), false)'><label class='label label-warning'>Edit</label></a></p>";
		      
	      echo "
	      </div><!-- /.message_metadata --></div><!-- /.col-md-3 -->
	      
      </div><!-- /.row --></div><!-- /.message_well -->
      
      <div class='message_editor well' style='display:none; background-color:#f2dede;'></div>
      
      </div><!-- /.message_wrapper -->\n
      ";
}
?>

<script>
  function show_editor(element, cancel){
    var editor_window = element.parents(".message_wrapper").find(".message_editor");
    var message_well = element.parents(".message_wrapper").find(".message_well");
    if (cancel) {
      editor_window.hide("slide", function(){message_well.show("slide")});
    } else {
      
      var editor = $("#message_editor").clone();
      editor.find("[name=message_id]").val(element.parents(".message_metadata").find("message_data").attr("message_id"));
      editor.find("textarea").val(element.parents(".message_well").find(".message_text").text());
      editor.show().appendTo(editor_window);
      element.parents(".message_well").hide("slide", function(){editor_window.show("slide")});
    }
  }
</script>