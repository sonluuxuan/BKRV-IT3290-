<?php
function get_subscribe_review($userId){
    include 'connection.php';
    require_once('work_around_func.php');
    // get id of users that current user subbed to
    // $query = "SELECT sub_to_id FROM User_subscribes WHERE user = ?";
    // $stmt = mysqli_prepare($conn, $query);
    // mysqli_stmt_bind_param($stmt, "i", $userId);
    // if(mysqli_stmt_execute($stmt)){
    //     $result = get_result($stmt);
    //     return $result;
    // }

    // get list of review from those users order by time of reviews

    $query = "SELECT * FROM Review WHERE user_id in (SELECT sub_to_id FROM User_subscribes WHERE user = ?) ORDER BY id DESC limit 3";
    $stmt = mysqli_prepare($conn, $query);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
$result = get_subscribe_review(45);
print_r($result);
