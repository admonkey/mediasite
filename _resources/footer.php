<?php

// if filename contains ajax or bounce, then don't print html footer
if ( ! ((strpos(basename($_SERVER["SCRIPT_NAME"]),'.ajax.') !== false) || (strpos(basename($_SERVER["SCRIPT_NAME"]),'.bounce.') !== false)) ) { ?>

<!-- BEGIN FOOTER INCLUDE -->

		</div><!-- /#page-content-container -->

	    </div><!-- /#page-content-wrapper -->


    </div><!-- /#wrapper -->


  </body>
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
