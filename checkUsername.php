<?php

require_once 'DB_functions.php';

if(isset($_POST["user_name"])){
	$username = $_POST["user_name"];
	$isExist = isUserExisted($username);

	if($isExist == false)
	{
		echo '<span style="font-size:10px;"><font color="blue">Username is available</font></span>';
	}
	else
		echo '<span style="font-size:10px;"><font color="red">Username existed</font></span>';
}

if(isset($_POST["email_ajax"])){
	$email = $_POST["email_ajax"];
	$isExist = isUserExisted($email);

	if($isExist == false)
	{
		echo '<span style="font-size:10px;"><font color="blue">Email is available</font></span>';
	}
	else
		echo '<span style="font-size:10px;"><font color="red">Email existed</font></span>';
}

?>