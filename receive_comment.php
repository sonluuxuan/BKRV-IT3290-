<?php

include 'DB_functions.php';
include 'function.php';

if (isset($_POST['user_id']) && isset($_POST['title']) && isset($_POST['comment']) &&isset($_POST['review_id_comment'])){
	//echo "button received";
	$comment = $_POST['comment'];
	$user_id = $_POST['user_id'];
	$review_id = $_POST['review_id_comment'];
	$title = $_POST['title'];
	
	$result = store_comment($comment, $user_id, $review_id, $title);
	$return_arr = array();
	$return_arr['profile_picture'] = get_profile_pic("profile_pics/user".$user_id);
	$return_arr['title'] = $title;
	$return_arr['comment'] = $comment;
	if($result == 1){
		echo json_encode($return_arr);
	}

}