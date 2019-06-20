<?php
include "DB_functions.php";
include "function.php";
$review_id = $_POST['review_id'];
$cnt = $_POST['cnt'];
$results = add_subscriber($review_id, $cnt);
// echo json_encode($results);
$cntmore = count($results);
$response = array();
$cnt_received = 0;
foreach($results as $result){
	$result_user_commented = getUserById($result_comment_user[$i]["user_id"]);
	$user_commented = $result_user_commented[0];
	$profile_pic = get_profile_pic('profile_pics/user'.$result_comment_user[$i]["user_id"]);
	$response[$cnt_received]["profile_pic"] = $profile_pic;
	$response[$cnt_received]["username"] = $user_commented['username'];
	$response[$cnt_received]["summary"] = $result['summary'];
	$response[$cnt_received]["comment"] = $result['comment'];
}
$response["cntmore"] = $cntmore;
echo json_encode($response);
// echo "worked";