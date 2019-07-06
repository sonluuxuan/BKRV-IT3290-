<?php
session_start();
$flags = 0;
$usernamePhp = "none";
$useridPhp = -10;
if(isset($_SESSION["logged_in"]))
{
	$flags = $_SESSION["logged_in"];
	if($flags == 1)
		{
			$usernamePhp = $_SESSION['username'];
			$useridPhp = $_SESSION['userid'];
		}
}
date_default_timezone_set("Asia/Ho_Chi_Minh");
include 'DB_functions.php';
include 'function.php';

$cnt_post = $_POST['cnt_post'];
$type = $_POST['type'];
$cnt_received = 0;
$response = array();
if ($type == "latest"){
	//$return_arr = array('response'=>2);
	//echo json_encode($return_arr);
	$results = get_latest_review_view_more($cnt_post);

}

else if ($type == "subscribe"){
	//$return_arr = array('response'=>2);
	//echo json_encode($return_arr);
	$results = get_subscribe_review_view_more($useridPhp, $cnt_post);

}

else if ($type == "liked"){
	//$return_arr = array('response'=>2);
	//echo json_encode($return_arr);
	$results = get_liked_review_view_more($useridPhp, $cnt_post);

}

else if ($type == "disliked"){
	//$return_arr = array('response'=>2);
	//echo json_encode($return_arr);
	$results = get_disliked_review_view_more($useridPhp, $cnt_post);

}

else if ($type == "posted"){
	//$return_arr = array('response'=>2);
	//echo json_encode($return_arr);
	$results = get_posted_review_view_more($useridPhp, $cnt_post);

}

else if ($type == "posterpost"){
	$posterId = $_POST['posterId'];
	//$return_arr = array('response'=>2);
	//echo json_encode($return_arr);
	$results = get_posted_review_view_more($posterId, $cnt_post);

}

else if ($type == "popular"){
	$results = get_popular_review_view_more($cnt_post);
}
else if($type == "find"){
	$search_input = $_POST['search_input'];
	$search_input = "%".$search_input."%";
	$results = getReviewBySearchInputViewMore($cnt_post, $search_input);
}
else if($type == "filter"){
	$no_districts = $_POST['no_districts'];
	$no_prices = $_POST['no_prices'];
	$no_cates = $_POST['no_cates'];
	$districts = $_POST['districts'];
	$prices = $_POST['prices'];
	$cates = $_POST['cates'];
	$prices_arr = array();
	$price_arr = array();
	$exploded = array();
	if($prices != null){
		foreach ($prices as $price) {
			$exploded = explode(" ", $price);
			if(count($exploded)==3){
				$price_arr[0] = $exploded[0];
				$price_arr[1] = $exploded[2];
				$prices_arr[] = $price_arr;
			}
			else{
				$price_arr[0] = $exploded[1];
				$price_arr[1] = 10000000000;
				$prices_arr[] = $price_arr;
			}

		}
	}
	$results = filter_view_more($no_districts, $no_cates, $no_prices, $districts, $cates, $prices_arr, $cnt_post);
}
else if($type == 'an_vat_via_he'){
	$results = get_quick_search_view_more(1, $cnt_post);
}
else if($type == 'cafe_dessert'){
	$results = get_quick_search_view_more(2, $cnt_post);
}
else if($type == 'nhahang'){
	$results = get_quick_search_view_more(3, $cnt_post);
}
else {
	$results = get_quick_search_view_more(4, $cnt_post);
}

foreach($results as $result){
	//get loai
	$result_loai = get_loai($result["id"]);
	$result_username = getUserById($result["user_id"])[0]["username"];
	//get price range
	$result_price_range = get_price_range($result["id"]);
	$low = $result_price_range[0]["gia"];
	$high = $result_price_range[1]["gia"];
	//get time range
	$result_time_range = get_time_range($result["id"]);
	$time_low = $result_time_range[0]["time_open"];
	$time_high = $result_time_range[0]["time_close"];
	$time = date("H:i:s");
	if (strtotime($time) >= strtotime($time_low) && strtotime($time) <= strtotime($time_high)){
        $status = "OPEN NOW";
        $class_time = "open-now";
    }
    else{
    	$status = "CLOSE NOW";
    	$class_time = "closed-now";
    }
	//get number of likes
	$like_dislike_arr = get_num_of_like_dislike($result["id"]);
	$likes = $like_dislike_arr["likes"];
	//get number of comments
	$result_num_comment = get_number_of_comments($result["id"]);
	if(!empty($result_num_comment[0])) {
		$cnt_comment = $result_num_comment[0];
		$comments = $cnt_comment["cnt"];
	}
	else 
		$comments = 0;
	//count number of review fetched
	$cnt_received = $cnt_received +1;
	//get thumbnail for review
	$thumbnail = get_thumbnail("images/".$result["id"]);
	// class for rating color
	if($result['rating'] < 5){
		$class_rating = "featured-rating";
	}else if($result['rating'] >= 5 && $result['rating'] < 8){
		$class_rating = "featured-rating-orange";
	}else if($result['rating'] >= 8){
		$class_rating = "featured-rating-green";
	}

	//response array for json object
	$response[$cnt_received-1]['id'] = $result['id'];
	$response[$cnt_received-1]['rating'] = $result['rating'];
	$response[$cnt_received-1]['ten'] = $result['ten'];
	$response[$cnt_received-1]['dia_chi'] = $result['dia_chi'];
	$response[$cnt_received-1]['ten'] = $result['ten'];
	$response[$cnt_received-1]['loai'] = $result_loai[0]['loai'];
	$response[$cnt_received-1]['low'] = $low;
	$response[$cnt_received-1]['high'] = $high;
	$response[$cnt_received-1]['time_low'] = $time_low;
	$response[$cnt_received-1]['time_high'] = $time_high;
	$response[$cnt_received-1]['likes'] = $likes;
	$response[$cnt_received-1]['comments'] = $comments;
	$response[$cnt_received-1]['thumbnail'] = $thumbnail;
	$response[$cnt_received-1]['status'] = $status;
	$response[$cnt_received-1]['class_time'] = $class_time;
	$response[$cnt_received-1]['class_rating'] = $class_rating;
	$response[$cnt_received-1]['username'] = $result_username;
}
$response["cnt_received"] = $cnt_received;
echo json_encode($response);

