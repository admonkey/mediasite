<?php

//$page_title = "Home Page";
require_once('../-resources/header.php');

echo "<h1>$section_title Tips</h1>";

?>

<div class="well">

<?php
  $tips = file('git-subtree-notes.txt');
  foreach ($tips as $line_num => $line) {
    if ($line[0] == "g")
      echo "<kbd>" . htmlspecialchars($line) . "</kbd><br />\n";
    else echo $line . "<br />\n";
  }
?>

</div><!-- /.well-->

<?php require_once('../-resources/footer.php');?>
