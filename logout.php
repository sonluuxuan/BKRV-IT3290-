<?php
session_start();
if(isset($_GET['username']))
{
	$username = $_GET['username'];
	//$key = array_search($username, haystack)
	unset($_SESSION[$username][0]);
	unset($_SESSION[$username][1]);
	if(isset($_GET['location'])) {
		$redirect = urldecode($_GET['location']);
		header("Location: ". $redirect);
	}else{
		header("Location: index.php");
	}
}