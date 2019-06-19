<?php
session_start();

//$key = array_search($username, haystack)
unset($_SESSION["logged_in"]);
unset($_SESSION["username"]);
unset($_SESSION["userid"]);

if(isset($_GET['location'])) {
	$redirect = urldecode($_GET['location']);
	header("Location: ". $redirect);
}else{
	header("Location: index.php");
}
