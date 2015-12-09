<?php

include_once('../_resources/credentials.php');
//$page_title = "Home Page";
require_once('../_resources/header.php');

echo "<h1>Responsive $section_title</h1>"; ?>

<p class='lead'>Some excellent YouTube videos on web application development.</p>

<div class='well'>
<h2>16:9 aspect ratio</h2>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Ytux4IOAR_s?list=PLAwxTw4SYaPk8_-6IGxJtD3i2QAu5_s_p" allowfullscreen></iframe>
</div>
</div><!-- /.well -->

<div class='well'>
<h2>4:3 aspect ratio</h2>
<p>Because this video is not natively 4:3, it is letter-boxed, although you get the picture it would fit one.</p>
<div class="embed-responsive embed-responsive-4by3">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/18MP17wq54E?list=PLK9sPEYTATw8Mgl2UecilwXujPnDr8DDX"></iframe>
</div>
</div><!-- /.well -->

<?php require_once('../_resources/footer.php');?>
