<?php

include_once('_resources/credentials.inc.php');
$page_title = "Rules";
require_once('_resources/header.inc.php');

echo "<h1>$page_title</h1>";

?>

<ol><h3><li>Be respectful.</li></h3></ol>

<p class='lead'>This is intended to be a clean forum. Any profanity or harrassment will be removed, and the user banned.</p>

<div class='well'>
	<h2>HTML Style</h2>
	<p>The following HTML style tags are supported:</p>
	<ul>
		<li><u>underline</u> <code>&lt;u&gt;underline&lt;/u&gt;</code></li>
		<li><b>bold</b> <code>&lt;b&gt;bold&lt;/b&gt;</code></li>
		<li><i>italics</i> <code>&lt;i&gt;italics&lt;/i&gt;</code></li>
		<li><s>strike-through</s> <code>&lt;s&gt;strike-through&lt;/s&gt;</code></li>
	</ul>
	<p>Users will be <b><u>banned</u></b> for posting <code>&lt;script&gt;</code> tags.</p>
</div>

<?php echo "<a href='./' class='btn btn-default'>Go to the Forum</a>"; ?>

<?php require_once('_resources/footer.inc.php');?>
