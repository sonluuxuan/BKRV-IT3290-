<?php
include "DB_functions.php";
$posterId = $_POST['posterId'];
$subscriberId = $_POST['subscriberId'];
$sub_status = $_POST['sub_status'];
if($sub_status == 0){
	$result = add_subscriber($posterId, $subscriberId);
}
else{
	$result = remove_subscriber($posterId, $subscriberId);
}
echo json_encode($result);
// echo "worked";