<?php

include_once('_resources/credentials.inc.php');
//$page_title = "Home Page";
$include_jquery_ui = true;
//$require_ssl = true;
require_once("_resources/header.inc.php");

echo "<h1>$section_title</h1>";

?>

<script>
  $(function() {
    var autocomplete_data = [
	
	<?php
		/*
		// populate autocomplete list from MySQL result set
		$query_autocomplete = " SELECT `id`, `column` FROM `db`.`schema`.`table` ORDER BY `column`; ";
		$result_autocomplete = mysql_query($query_autocomplete) or die( 'Invalid query: ' . mysql_error() );
		while ( $row = mysql_fetch_assoc($result_autocomplete) ) {
			if($next)
				echo ",
			";
			echo '{label:"' . $row["column"]
				. '",value:"' . $row["column"]
				. '",id:"' . $row["id"] . '"}';
			$next = true;
		}
		*/
	?>
	
	
		// hard coded autocomplete list
		{label:"First Label",value:"First Value",id:"1"},
		{label:"Second Label",value:"Second Value",id:"2"},
		{label:"Third Label",value:"Third Value",id:"3"},
		{label:"Fourth Label",value:"Fourth Value",id:"4"},
		{label:"Fifth Label",value:"Fifth Value",id:"5"}
		
		
    ];
    $( "#form_autocomplete" ).autocomplete({
      source: autocomplete_data,
	  select: function(e,u){
		  $("#form_autocomplete_id").val(u.item.id);
		  $("#form_autocomplete").val(u.item.value);
		  
		  // automatically submit the form when item clicked
		  //$("#form1").submit();
	  }
    });
  });
</script>

<div id='form_div' class='well'>
	
	<form id='form1' role='form'>


		<!-- date picker -->
		<div class='form-group'>
			<label for='form_date'>Date Picker:</label>
			<input id='form_date' name='form_date' type='date' class='form-control'
				<?php
					if(isset($_GET["form_date"]))
						echo "value='$_GET[form_date]'";
				?>
			></input>
		</div>


		<!-- dropdown select list -->
		<div class='form-group'>
			<label for='form_select'>Select List:</label>
			<select id='form_select' name='form_select' class='form-control'>
				<?php
					// repopulate active option with last submitted, or default blank
					if(!empty($_GET["form_select"]))
						echo "<option value='$_GET[form_select]' selected>$_GET[form_select]</option><option></option>";
					else
						echo "<option selected></option>";
				?>
				
				<?php
					/*
					// populate select list from MySQL result set
					// if using value different than label, such as an ID, then can't repopulate active option with submitted label
					$query_selectlist = " SELECT DISTINCT `column` FROM `db`.`schema`.`table` ORDER BY `column`; ";
					$result_selectlist = mysql_query($query_selectlist) or die( 'Invalid query: ' . mysql_error() );
					while ( $row = mysql_fetch_assoc($result_selectlist) ) {
						echo '<option value="' . $row["column"] . '">' . $row["column"] . '</option>';
					}
					*/
				?>
				
				<!-- hard coded select list -->
				<option value='FirstValue'>First Option</option>
				<option value='SecondValue'>Second Option</option>
				<option value='ThirdValue'>Third Option</option>
				<option value='FourthValue'>Fourth Option</option>
				<option value='FifthValue'>Fifth Option</option>
			</select>
		</div>


		<!-- auto-complete text box -->
		<div class='form-group'>
			<label for='form_autocomplete'>Auto-Complete Text Box:</label>
			<input id='form_autocomplete_id' name='form_autocomplete_id' type='hidden'
				<?php
					if(isset($_GET["form_autocomplete_id"]))
						echo "value='$_GET[form_autocomplete_id]'";
				?>
			></input>
			<input id='form_autocomplete' name='form_autocomplete' type='text' class='form-control' 
				<?php
					if(isset($_GET["form_autocomplete"]))
						echo "value='$_GET[form_autocomplete]'";
				?>
			></input>
		</div>


		<!-- auto-expanding textarea -->
		<div class='form-group'>
			<label for='form_textarea'>Auto-Expanding Text Area (max 140 characters):</label>
			<textarea class='form-control' style='width:100%' maxlength='140' rows='3' id='form_textarea' name='form_textarea'></textarea>
		</div>


		<button type='submit' class='btn btn-primary'>Submit</button>
	</form>
</div>

<?php require_once("_resources/footer.inc.php");?>
