<?php
	include "DB_functions.php";

	// $scope.sel['Username'] = $scope.Username;
	// $scope.sel['Email'] = $scope.Email;
	// $scope.sel['NewPassword'] = $scope.NewPassword;
	// $scope.sel['ConfirmPassword'] = $scope.ConfirmPassword;
	// $scope.sel['Description'] = $scope.Description;
	if(isset($_POST['Username'])){
		$Username = $_POST['Username'];
		$password = "124545";
		$email = "sdfkdsfj.23e2e2";
		$bio = "a bio";		
		storeUser($password, $Username, $email, $bio);
	}
	else{
		$Username = "fuckiet";
		$password = "124545";
		$email = "sdfkdsfj.23e2e2";
		$bio = "a bio";
		storeUser($password, $Username, $email, $bio);
	}
	// else{
	// 	$Username = $usernamePhp;
	// 	echo $Username;
	// }

	// if(isset($_POST['Email'])){
	// 	$Email = $_POST['Email'];
	// 	if(isEmailExisted($Email)){
	//         //header("Location: register.php?error=EmailExisted");
	//         $url = 'edit_profile.php?error=EmailExisted';
	//         header('Location: ' . $url);
	//         exit();
	//     }
	// }
	// else{
	// 	$Email = $userEmail;
	// }

	// if(isset($_POST['Description'])){
	// 	$Description = $_POST['Description'];
	// }
	// else{
	// 	$Description = $userDescription;
	// }

	// if(isset($_POST['NewPassword']) && isset($_POST['ConfirmPassword'])){
	// 	if($_POST['NewPassword'] == $_POST['ConfirmPassword']){
	// 		$NewPassword = $_POST['NewPassword'];
	// 		$ConfirmPassword = $_POST['ConfirmPassword'];
	// 		// $result = change_profile_and_password($useridPhp, $Username, $Email, $NewPassword ,$Description);
	// 	}
	// 	else{
	// 		$url = 'edit_profile.php?error=passwordnotmatched';
	//         // if(isset($redirect)) {
	//         //     $url .= '&location=' . urlencode($redirect);
	//         // }
	//         header('Location: ' . $url);
	//         exit();
	// 	}
	// }
	// else{
	// 	// $result = change_profile($useridPhp, $Username, $Email, $Description);
	// 	echo "after";
	// }
?>