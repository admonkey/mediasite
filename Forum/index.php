<?php

include_once('../_resources/credentials.php');
$include_jquery_ui = true;
$include_tablesorter = true;
$include_mysql = true;
require_once('../_resources/header.php');

echo "<h1>$section_title</h1>";

?>

<?php
// default login
if (isset($_GET["default"])){
	$_SESSION["user_id"] = -1;
	$_SESSION["username"] = "Default";
}
?>

<?php
if (!isset($_SESSION["username"])) { ?>

	<p><a href='?default' class='btn btn-primary'>Login as 'Default'</a></p>

<?php } else { ?>

<div id='page_controls' class='row'>
	<div class='col-xs-6'><p id='show_list_of_threads'><a href='javascript:void(0)' onclick='fetch_threads()' class='btn btn-primary'>Show/Hide Threads</a></p></div>
	<div class='col-xs-6'><p><a href='javascript:void(0)' onclick='create_thread()' class='btn btn-success'>Create New Thread</a></p></div>
</div><!-- /#page_controls.row -->


<div id='list_of_threads_div' class='table-responsive' style='display:none'>
</div><!-- /#list_of_threads_div.table-responsive -->


<div id='thread_div' class='well'>
  <h2 id='thread_name_h2'>Click a thread to show messages.</h2>
  <div id='thread_messages_div'></div>
</div><!-- /#thread_div.well -->

<!-- post message text area -->
<div id='message_div' class='well' style='display:none'>

	<form id='message_form' method='post' role='form' onsubmit='return message_submit()'>

		<input id='message_thread_id' name='message_thread_id' type='hidden'></input>
		
		<div id='thread_name_div' class='form-group' style='display:none'>
			<label for='thread_name'>Thread Name:</label>
			<input id='thread_name' name='thread_name' type='text' class='form-control' disabled required></input>
		</div>

		<div class='form-group'>
			<label for='message_text'>Message (max 140 characters):</label>
			<textarea class='form-control' style='width:100%' maxlength='140' rows='3' id='message_text' name='message_text' required></textarea>
		</div>

		<button type='submit' class='btn btn-primary'>Submit</button>

	</form>

	<script>

		function message_submit() {
			var serialized_data = $("#message_form").serialize();
			$.post('message.insert.ajax.php', serialized_data, function(result) {
				if ( $("#thread_name").val() !== "" ) {
					$("#thread_name_h2").text($("#thread_name").val());
				}
				$("#thread_div").show("blind");
				var new_div = $("<div style='display:none'></div>");
				new_div.html(result).appendTo("#thread_messages_div").show("slide");
				$("#message_text").val("");
				$("#message_thread_id").val(new_div.find("message_data").attr("thread_id"));
				disable_create_thread();
			});
			return false;
		}
		
		function create_thread() {
			$("#list_of_threads_div").hide("blind");
			$("#thread_div").hide("blind", function(){$("#thread_messages_div").html("")});
			$("#message_div").show("blind");
			$("#thread_name").prop("disabled",false);
			$("#thread_name_div").show("blind");
		}
		
		function disable_create_thread() {
			$("#thread_name_div").hide("blind");
			$("#thread_name").val("").prop("disabled",true);
		}
		
		function fetch_threads(){
			if ($("#list_of_threads_div").is(":hidden")) {
				$.ajax({url: "threads.ajax.php", 
					success: function(result){
						$("#list_of_threads_div").html(result);
						apply_tablesorter();
						$("#list_of_threads_div").show("blind");
					}
				});
			} else {
				$("#list_of_threads_div").hide("blind");
			}
		}
		
		function fetch_messages(thread_row,thread_id,thread_name,page_number){
			$.ajax({url: "messages.ajax.php?thread_id=" + thread_id + "&page_number=" + page_number, success: function(result){
				fetch_threads();
				$("#thread_div").hide("blind",function(){
					$("#thread_name_h2").text(thread_name);
					$("#thread_messages_div").html(result);
					$("#thread_div").show("blind", function(){$("#message_div").show("blind")});
				});
				thread_row.addClass("bg-primary").siblings().removeClass("bg-primary");
				$("#message_thread_id").val(thread_id);
			},cache: false});
		}

		function hyperlink_row(){
			$("tr").click( function() {
				disable_create_thread();
				var row = $(this);
				var thread_id = row.find("message_data").attr("thread_id");
				var thread_name = row.find("message_data").attr("thread_name");
				fetch_messages(row,thread_id,thread_name,1);
			}).hover( function() {
				$(this).toggleClass("hover");
			});
		}
		
		$(fetch_threads());
		
	</script>
	
	<style>
		tr.hover {
			cursor: pointer;
		}
	</style>

</div>

<?php } ?>

<?php require_once('../_resources/footer.php');?>
