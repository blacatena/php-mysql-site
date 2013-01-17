<?php 

/**
 * 		This is not necessarily the best way to structure a site, but it's one that works and is in place now.
 * 
 * 		The page is divided into four sections; initialization, header, content, and footer.
 * 
 * 		For clarity, all of these have been created as includes, but in most pages, while the initialization, header and footer will be included,
 * 		the main content will be right here, in the page.
 */
	ini_set("display_errors", 1);

	include 'utilities/database.php';
	include 'utilities/session.php';
	
	$db = new Session;

	include 'head.php';
	include 'content.php';
	include 'foot.php';
	
?>