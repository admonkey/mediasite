<?php

include_once('_resources/credentials.php');
//$page_title = "Home Page";
$include_fancybox = true;
require_once('_resources/header.php');

echo "<h1>$section_title</h1>"; ?>

<div class='well'>
	<a class='fancybox' href='_resources/images/blackberries.jpg' >Click here to see black berries in a fancy box.</a>
</div><!-- /.well -->

<script type="text/javascript">
	$(function() {
		$(".fancybox").fancybox();
	});
</script>

<?php require_once('_resources/footer.php');?>
