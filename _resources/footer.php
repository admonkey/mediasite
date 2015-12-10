<?php

// if filename contains ajax or bounce, then don't print html footer
if ( ! ((strpos(basename($_SERVER["SCRIPT_NAME"]),'.ajax.') !== false) || (strpos(basename($_SERVER["SCRIPT_NAME"]),'.bounce.') !== false)) ) { ?>

<!-- BEGIN FOOTER INCLUDE -->

		</div><!-- /#page-content-container -->

	    </div><!-- /#page-content-wrapper -->


    </div><!-- /#wrapper -->


  </body>


  <?php
    if ( !empty($include_jquery_ui) ) {
      echo "
	<!-- JQUERY-UI -->
	<script src='$path_web_relative_root/_resources/jquery-ui/jquery-ui.1.11.4.min.js'></script>
	<link rel='stylesheet' href='$path_web_relative_root/_resources/jquery-ui/jquery-ui.1.11.4.min.css'>
	<!-- official content delivery network -->
	<!-- <script src='//code.jquery.com/ui/1.11.4/jquery-ui.min.js'></script> -->
	<!-- <link rel='stylesheet' href='//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css'> -->

	<!-- auto-expand textarea to fit content -->
	<script>
		function auto_expand_textarea( ta ){ ta.keyup(function(e) {
			while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css('borderTopWidth')) + parseFloat($(this).css('borderBottomWidth'))) {
				$(this).height($(this).height()+1);
			};
		})}

		$(function(){
			$('textarea').each(function(){
				var ta = $(this);
				auto_expand_textarea( ta );
			});
		});
		
	</script>
      ";
    }
  ?>

  <?php
    if ( !empty($include_chartist) ) {
      echo "
	<!-- CHARTIST -->
	<script src='$path_web_relative_root/_resources/chartist/chartist.0.9.4.min.js'></script>
	<link rel='stylesheet' href='$path_web_relative_root/_resources/chartist/chartist.min.css'></link>
	<link rel='stylesheet' href='$path_web_relative_root/_resources/chartist/chartist.custom.css'></link>
      ";
    }
  ?>

  <?php
    if ( !empty($include_fancybox) ) {
      echo "
	<!-- Add fancyBox -->
	<link rel='stylesheet' href='$path_web_relative_root/_resources/fancybox/fancybox.css' type='text/css' media='screen' />
	<script type='text/javascript' src='$path_web_relative_root/_resources/fancybox/fancybox.pack.js'></script>
	<!-- Optionally add helpers - button, thumbnail and/or media -->
	<link rel='stylesheet' href='$path_web_relative_root/_resources/fancybox/fancybox-buttons.css' type='text/css' media='screen' />
	<script type='text/javascript' src='$path_web_relative_root/_resources/fancybox/fancybox-buttons.js'></script>
	<script type='text/javascript' src='$path_web_relative_root/_resources/fancybox/fancybox-media.js'></script>

	<link rel='stylesheet' href='$path_web_relative_root/_resources/fancybox/fancybox-thumbs.css' type='text/css' media='screen' />
	<script type='text/javascript' src='$path_web_relative_root/_resources/fancybox/fancybox-thumbs.js'></script>
      ";
    }
  ?>

  <?php
    if ( !empty($include_tablesorter) ) {
      echo "
	<!-- TABLESORTER -->
	<script src='$path_web_relative_root/_resources/tablesorter/tablesorter.2.0.5b.min.js'></script>
	<link rel='stylesheet' href='$path_web_relative_root/_resources/tablesorter/tablesorter.css'>
	<script>
	  function apply_tablesorter() {
		  $('table').addClass('table table-hover table-striped table-bordered table-condensed tablesorter').tablesorter();
	  }
	  $(apply_tablesorter());
	</script>
      ";
    }
  ?>


</html>

<?php
} // end if not ajax/bounce


/*
  suppressed error message if no connection open
  probably not the best way to handle the situation
  http://stackoverflow.com/questions/3075116/php-how-to-determine-if-a-database-connection-is-open
*/

@mysql_close(); 

?>
