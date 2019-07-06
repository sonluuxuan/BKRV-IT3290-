<?php
	session_start();
	include "DB_functions.php";
	$userId = $_POST['UserId'];
	if(($_POST['Username'] != "")){
		$Username = $_POST['Username'];
		if(isUserExistedProfile($Username, $userId)){
	        $result = array();
			$result["message"] = "usernameExisted";
			$result["error"] = 1;
			// $result["userid"] = $userId;
			echo json_encode($result);
	        exit();
	    }
	}
	else{
		$Username = $_POST["OldUsername"];
	}

	if(($_POST['Email'] != "")){
		$Email = $_POST['Email'];
		if(isEmailExistedProfile($Email, $userId)){
	        $result = array();
			$result["message"] = "emailExisted";
			$result["error"] = 1;
			echo json_encode($result);
	        exit();
	    }
	}
	else{
		$Email = $_POST["OldEmail"];
	}

	if(($_POST['Description'] != "")){
		$Description = $_POST['Description'];
	}
	else{
		$Description = $_POST['OldDescription'];
	}

	if(($_POST['NewPassword'] != "") || ($_POST['ConfirmPassword'] != "")){
		if($_POST['NewPassword'] == $_POST['ConfirmPassword']){
			$NewPassword = $_POST['NewPassword'];
			$ConfirmPassword = $_POST['ConfirmPassword'];
			$results = change_profile_and_password($userId, $Username, $Email, $NewPassword ,$Description);
			$result = array();
			$result["results"] = $results;
			$_SESSION["username"] = $Username;
			echo json_encode($result);
	        exit();
		}
		else{
			$result = array();
			$result["message"] = "passwordsNotMatched";
			echo json_encode($result);
	        exit();
		}
	}
	else{
		$results = change_profile($userId, $Username, $Email, $Description);
        $result = array();
		$result["results"] = "here2";
		$_SESSION["username"] = $Username;
		echo json_encode($result);
        exit();
	}
?>