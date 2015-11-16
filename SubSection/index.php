<?php
	$pageTitle = "Sub Section";
	require_once('../resources/header.php');
?>

<h1>Git Subtree tips for a <?php echo $pageTitle;?></h1>

<div class="well">

<?php
  $tips = file('../README/git-subtree-notes.txt');
  foreach ($tips as $line_num => $line) {
    if ($line[0] == "g")
      echo "<pre>" . htmlspecialchars($line) . "</pre><br />\n";
    else echo htmlspecialchars($line) . "<br />\n";
  }
?>

</div><!-- /.well-->

<?php require_once('../resources/footer.php');?>
