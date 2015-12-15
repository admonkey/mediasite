<?php

include_once("_resources/credentials.inc.php");
//$page_title = "Home Page";
$include_tablesorter = true;
$include_mysqlo = true;
require_once("_resources/header.inc.php");

echo "<h1>Sortable $section_title</h1>";

?>

<div class='table-responsive'>

  <?php // choose which table to load
  
	$table_type = ( !empty($_GET["table"]) ? $_GET["table"] : "static" );
   switch ($table_type) {
    
   case "static":
		include_once("table.static.inc.html");
		break;
	
	case "mysql":
		include_once("table.mysql.inc.php");
		break;
	
	default:
		include_once("table.static.inc.html");
	
	}
	
  ?>

</div>

<!-- hyperlink whole row -->
<script>
  $("tr").click( function() {
      window.location = "?query" + $(this).find("a").attr("href");
  }).hover( function() {
      $(this).toggleClass("hover");
  });
</script>
<style>
  tr.hover {
    cursor: pointer;
  }
</style>

<?php require_once("_resources/footer.inc.php");?>
