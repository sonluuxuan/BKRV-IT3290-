<?php
include "DB_functions.php";
$posterId = $_POST['posterId'];
$subscriberId = $_POST['subscriberId'];
$result = add_subscriber($posterId, $subscriberId);
echo json_encode($result);
// echo "worked";