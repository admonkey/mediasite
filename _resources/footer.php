<?php // if filename contains ajax, then don't print html header
if (!(strpos(basename($_SERVER["SCRIPT_NAME"]),'.ajax.') !== false)) { ?>

<!-- BEGIN FOOTER INCLUDE -->

		</div><!-- /#page-content-container -->

	    </div><!-- /#page-content-wrapper -->


    </div><!-- /#wrapper -->


  </body>
</html>

<?php
}
/*
  suppressed error message if no connection open
  probably not the best way to handle the situation
  http://stackoverflow.com/questions/3075116/php-how-to-determine-if-a-database-connection-is-open
*/

@mysql_close(); 

?>
