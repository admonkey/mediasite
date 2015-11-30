<?php
	include_once('../_resources/credentials.php');
	//$page_title = "Forms Home Page";
	$include_jquery_ui = true;
	require_once('../_resources/header.php');
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
    $( "#form1-autocomplete" ).autocomplete({
      source: autocomplete_data,
	  select: function(e,u){
		  $("#form1-autocomplete-id").val(u.item.id);
		  $("#form1-autocomplete").val(u.item.value);
		  
		  // automatically submit the form when item clicked
		  //$("#form1").submit();
	  }
    });
  });
</script>

<div id="form1-div">
	<h1>Form:</h1>
	<form id="form1" role="form">
		
		<!-- auto complete text -->
		<input id="form1-autocomplete-id" name="form1-autocomplete-id" type="hidden" value="<?php echo $_GET['form1-autocomplete-id']; ?>"></input>
		<div class="form-group">
			<label for="form1-autocomplete">Autocomplete:</label>
			<input id="form1-autocomplete" name="form1-autocomplete" type="text" class="form-control" value="<?php echo $_GET['form1-autocomplete']; ?>"></input>
		</div>
		
		
		<!-- date picker -->
		<div class="form-group">
			<label for="form1-date">Datepicker:</label>
			<input id="form1-date" name="form1-date" type="date" value="<?php echo $_GET["form1-date"]; ?>" class="form-control"/>
		</div>
		
		
		<!-- dropdown select list -->
		<div class="form-group">
			<label for="form1-select">Selectlist:</label>
			<select id="form1-select" name="form1-select" class="form-control">
				<?php
					// repopulate active option with last submitted, or default blank
					if(!empty($_GET["form1-select"]))
						echo "<option value='" . $_GET["form1-select"] . "' selected>" . $_GET["form1-select"] . "</option><option></option>";
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
				<option value="FirstValue">First Option</option>
				<option value="SecondValue">Second Option</option>
				<option value="ThirdValue">Third Option</option>
				<option value="FourthValue">Fourth Option</option>
				<option value="FifthValue">Fifth Option</option>
			</select>
		</div>
		
		
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

<?php require_once('../_resources/footer.php');?>
