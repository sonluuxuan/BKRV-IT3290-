<?php

include 'DB_functions.php';

if (isset($_POST['post'])){
	echo "button received";
	$review = $_POST['review'];
	$username = $_POST['username'];
	$dia_chi = $_POST['dia_chi'];
	$quan = $_POST['quan'];
	$loai = $_POST['loai'];
	$district = $_POST['district'];

	if(empty($review) || empty($username) || empty($dia_chi) || empty($quan) ||empty($loai)){
		 header("Location: index.php?error=emptyfields");
        exit();
	}

	else{
		$search_input = "%".$search_input."%";
		echo "message_received";
		$review_content = getReviewBySearchInput($search_input);
		//echo $id;
	}
}