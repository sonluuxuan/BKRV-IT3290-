<?php
	include "DB_functions.php";

	$storeReview = $_POST['storeReview'];
	$storeRating = $_POST['storeRating'];
	$storeName = $_POST['storeName'];
	$storeLocation = $_POST['storeLocation'];
	$storeType = $_POST['storeType'];
	$storeArea = $_POST['storeArea'];
	$storeOpnHour = $_POST['storeOpnHour'];
	$storeOpnMin = $_POST['storeOpnMin'];
	$storeClsHour = $_POST['storeClsHour'];
	$storeClsMin = $_POST['storeClsMin'];
	$mealName = $_POST['mealName'];
	$mealPrice = $_POST['mealPrice'];
	$username = $_POST['username'];
	// echo $storeReview;

	//get time
	$storeOpnTime = $storeOpnHour.":".$storeOpnMin.":"."00";
	$storeClsTime = $storeClsHour.":".$storeClsMin.":"."00";
	

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
	$result = post_review($storeName, $username, $storeReview, $storeRating ,$storeLocation, $storeType, $storeArea, $storeOpnTime, $storeClsTime, $mealName, $mealPrice);
	/*if($result){
		fwrite($myfile, $result);
	}else{
		fwrite($myfile, "no result received");
	}*/
	echo $result;
?>