<?php

include_once('_resources/credentials.inc.php');
//$page_title = "Home Page";
require_once('_resources/header.inc.php');

echo "<h1>$section_title Tips</h1>";

?>

<div id="create_subtree" class="well">

	<h3>Create Sub Tree</h3>

	<ol>
		<li>
			<p>add new remote pointing to plugin repo</p>
			<p><kbd>git remote add plugin https://path.to/remotes/plugin.git</kbd></p>
		</li>
		<li>
			<p>create subtree specifying the new folder prefix</p>
			<p><kbd>git subtree add --prefix=plugins/demo plugin master</kbd></p>
		</li>
	</ol>

</div><!-- /#create_subtree -->

<div id="pull_subtree" class="well">

	<h3>Pull Sub Tree Updates</h3>

	<ol>
		<li>
			<p>pull normal commits made in plugin</p>
			<p><kbd>git subtree pull --prefix=plugins/demo plugin master</kbd></p>
		</li>
	</ol>

</div><!-- /#pull_subtree -->

<div id="backport_subtree" class="well">

	<h3>Backport Sub Tree Updates</h3>

	<ol>
		<li>
			<p>commits made in superproject to be backported</p>
			<p><kbd>git commit -am "new changes to be backported"</kbd></p>
		</li>
		<li>
			<p>checkout new branch for merging, set to track subtree repo</p>
			<p><kbd>git checkout -b backport plugin/master</kbd></p>
		</li>
		<li>
			<p>cherry-pick backports</p>
			<p><kbd>git cherry-pick -x --strategy=subtree master</kbd></p>
		</li>
		<li>
			<p>push changes back to plugin source</p>
			<p><kbd>git push plugin backport:master</kbd></p>
		</li>
	</ol>

</div><!-- /#backport_subtree -->

<div id="skipfile_subtree" class="well">

	<h3>Stop Tracking Changes On a File</h3>

	<ol>
		<li>
			<p>stop tracking changes for a file in repo</p>
			<p><kbd>git update-index --skip-worktree [path/to/file]</kbd></p>
		</li>
		<li>
			<p>start tracking changes for a file in repo again</p>
			<p><kbd>git update-index --no-skip-worktree [path/to/file]</kbd></p>
		</li>
	</ol>

</div><!-- /#skipfile_subtree -->

<a href="https://medium.com/@porteneuve/mastering-git-subtrees-943d29a798ec" class="btn btn-default" target="_blank">Read More About Subtrees @porteneuve</a>

<?php require_once('_resources/footer.inc.php');?>
