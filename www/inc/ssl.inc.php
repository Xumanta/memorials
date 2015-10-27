<?php
// Cheks for using SSL
if ($require_ssl) {
	// Redirect to SSL
	if($_SERVER['SERVER_PORT'] != 443)
	{
	  header('Location: https://'
	    . $_SERVER['HTTP_HOST']
	    . $_SERVER['REQUEST_URI']
	    . $_SERVER['QUERY_STRING']
	  );
	  exit;
	}
}
?>