<?php
	include "DB_functions.php";
	include 'function.php';
	session_start();
	$flags = 0;
	$usernamePhp = "none";
	if(isset($_SESSION["logged_in"]))
	{
		$flags = $_SESSION["logged_in"];
		if($flags == 1)
			{
				$usernamePhp = $_SESSION['username'];
				$useridPhp = $_SESSION['userid'];
				$userProfilePic = get_profile_pic("profile_pics/".$useridPhp);
				$userDescription = get_user_description($useridPhp);
				$userEmail = get_user_email($useridPhp);
			}
		echo $useridPhp;
	}
	if($flags == 0){
		header('Location: index.php');
	}
	// $scope.sel['Username'] = $scope.Username;
	// $scope.sel['Email'] = $scope.Email;
	// $scope.sel['NewPassword'] = $scope.NewPassword;
	// $scope.sel['ConfirmPassword'] = $scope.ConfirmPassword;
	// $scope.sel['Description'] = $scope.Description;
	if(isset($_POST['Username'])){
		$Username = $_POST['Username'];
		echo $Username;
		if(isUserExisted($Username)){
	        //header("Location: register.php?error=userexisted");
	        $url = 'edit_profile.php?error=userexisted';        
	        header('Location: ' . $url);
	        exit();
	    }
	}
	else{
		$Username = $usernamePhp;
		echo $Username;
	}

	if(isset($_POST['Email'])){
		$Email = $_POST['Email'];
		if(isEmailExisted($Email)){
	        //header("Location: register.php?error=EmailExisted");
	        $url = 'edit_profile.php?error=EmailExisted';
	        header('Location: ' . $url);
	        exit();
	    }
	}
	else{
		$Email = $userEmail;
	}

	if(isset($_POST['Description'])){
		$Description = $_POST['Description'];
	}
	else{
		$Description = $userDescription;
	}

	if(isset($_POST['NewPassword']) && isset($_POST['ConfirmPassword'])){
		if($_POST['NewPassword'] == $_POST['ConfirmPassword']){
			$NewPassword = $_POST['NewPassword'];
			$ConfirmPassword = $_POST['ConfirmPassword'];
			$result = change_profile_and_password($useridPhp, $Username, $Email, $NewPassword ,$Description);
		}
		else{
			$url = 'edit_profile.php?error=passwordnotmatched';
	        // if(isset($redirect)) {
	        //     $url .= '&location=' . urlencode($redirect);
	        // }
	        header('Location: ' . $url);
	        exit();
		}
	}
	else{
		$result = change_profile($useridPhp, $Username, $Email, $Description);
		echo "after";
	}

	/*if ($username){
			$dir = "./myDir";
		if ( !file_exists($dir) ) {
	     	mkdir ($dir, 0777, true);
	 	}
		$myfile = fopen("myDir/test.txt", "a") or die("Unable to open file!");
		
		fwrite($myfile, $storeType);
		fwrite($myfile, $storeReview);
		fwrite($myfile, $storeRating);
		fwrite($myfile, $storeName);
		fwrite($myfile, $storeLocation);
		fwrite($myfile, $storeOpnTime);
		fwrite($myfile, $storeClsTime);
		fwrite($myfile, $username);
	}*/
	//bug here, no result received
	// $result = change_profile($Username, $Email, $NewPassword, $ConfirmPassword ,$Description);
	/*if($result){
		fwrite($myfile, $result);
	}else{
		fwrite($myfile, "no result received");
	}*/
	echo $result;
?>