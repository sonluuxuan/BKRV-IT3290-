<?php

        include "DB_functions.php";

        $user_id = $_POST['userid'];
        $poster_id = $_POST['posterid'];
        $postid = $_POST['postid'];
        $type = $_POST['type'];
        $message = "wrong answer";
        //echo "<script type='text/javascript'>alert('$postid');</script>";
        // Check entry within table
        $return_arr = like_dislike($postid, $user_id, $type);
        $return_arr["writer_likes"] = get_number_of_like_of_user($poster_id);
        $return_arr["writer_dislikes"] = get_number_of_dislike_of_user($poster_id);
        // initalizing array
        //$return_arr = array("likes"=>$totalLikes,"unlikes"=>$totalUnlikes);
        //echo $return_arr;
        //echo "ok";
        //echo var_dump($return_arr);
        echo json_encode($return_arr);
        flush();