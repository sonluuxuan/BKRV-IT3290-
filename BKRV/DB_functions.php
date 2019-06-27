<?php
// test chay ok


function hashSSHA($password) {
    echo"\nhasscalled";
    $salt = sha1(rand());
    $salt = substr($salt, 0, 10);
    $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
    $hash = array("salt" => $salt, "encrypted" => $encrypted);
    return $hash;
}


function checkhashSSHA($salt, $password) {

    $hash = base64_encode(sha1($password . $salt, true) . $salt);
    return $hash;
}

function storeUser($password, $username, $email){
    include 'connection.php';
    require_once('work_around_func.php');
    $hash = hashSSHA($password);
    $encrypted_password = $hash["encrypted"];
    $salt = $hash["salt"];
    $query = "INSERT INTO User (username, email, password, salt) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $encrypted_password, $salt);
    if(mysqli_stmt_execute($stmt))
    {
       
        $kq = TRUE;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


function isUserExisted($username) {
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM User WHERE username = ?";
    //$stmt = mysqli_stmt_init();
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        // user existed
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return true;
    } else {
        // user not existed
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
}

function isEmailExisted($email){
	include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM User WHERE email = ?";
    //$stmt = mysqli_stmt_init();
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        // user existed
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return true;
    } else {
        // user not existed
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
}

function getUserByUsernameAndPassword($username, $password) {
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM User WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);

    if(mysqli_stmt_execute($stmt)){
        //echo " get executed";
        $result = get_result($stmt);
        $user = $result[0];
        mysqli_stmt_close($stmt);

        $salt = $user["salt"];
        
        $encrypted_password = $user["password"];
        //verifying $passWord
        $hash = checkhashSSHA($salt, $password);

        if($encrypted_password == $hash){
            //echo "found_user";
            return $user;
        }
        else{
            return NULL;
        }

    }


    mysqli_close($conn);

}

function getReviewBySearchInput($search_input){
    /*if (!empty($search_input)){
        echo "function called with param";
    }*/
    include 'connection.php';
    require_once('work_around_func.php');
    $search_input1 = "% ".$search_input."%";
    $search_input2 = $search_input."%";
    $query = "SELECT * FROM Review WHERE id IN(
        SELECT id FROM Review WHERE dia_chi LIKE ?
        UNION
        SELECT id FROM Review WHERE ten LIKE ?
        UNION
        SELECT review_id FROM Review_mon_gia WHERE ten_mon LIKE ?
        UNION
        SELECT id FROM Review WHERE dia_chi LIKE ?
        UNION
        SELECT id FROM Review WHERE ten LIKE ?
        UNION
        SELECT review_id FROM Review_mon_gia WHERE ten_mon LIKE ?
        )";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $search_input1, $search_input1, $search_input1, $search_input2, $search_input2, $search_input2);

    if(mysqli_stmt_execute($stmt)){
        //echo " get executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        return $result;


    }
    mysqli_close($conn);
}

function getReviewBySearchInputViewMore($cnt_post, $search_input){
    include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * FROM `Review` WHERE `id`IN(
        SELECT id FROM Review WHERE dia_chi LIKE ?
        UNION
        SELECT id FROM Review WHERE ten LIKE ?
        UNION
        SELECT review_id FROM Review_mon_gia WHERE ten_mon LIKE ?
        ) LIMIT ?,3";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $search_input, $search_input, $search_input, $cnt_post);

    if(mysqli_stmt_execute($stmt)){
        //echo " get executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        return $result;


    }
    mysqli_close($conn);
}

function getFilter($cnt_post, $search_input){
    include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * FROM `Review` WHERE `id`IN(
        SELECT id FROM Review WHERE dia_chi LIKE ?
        UNION
        SELECT id FROM Review WHERE ten LIKE ?
        UNION
        SELECT review_id FROM Review_mon_gia WHERE ten_mon LIKE ?
        ) LIMIT ?,3";
    $stmt = mysqli_prepare($conn, $query);
    //echo $query;
    //echo var_dump($stmt);
    mysqli_stmt_bind_param($stmt, "sssi", $search_input, $search_input, $search_input, $cnt_post);

    if(mysqli_stmt_execute($stmt)){
        //echo " get executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        return $result;


    }
    mysqli_close($conn);
}

function filter($no_districts, $no_cates, $no_prices, $districts, $cates, $prices_arr){
    include 'connection.php';
    require_once('work_around_func.php');
    if($no_districts > 0 && $no_cates == 0 && $no_prices == 0){
        $type = "s";
        $query = "SELECT * FROM Review WHERE   district_id in ( SELECT id FROM District WHERE quan IN (?";
        for ($j=1; $j<$no_districts; $j++){
            $type .= "s";
            $query .= ",?";
        }
        $query .= "))";
        $stmt = mysqli_prepare($conn, $query);
        $a_params = array();
        $msbp_params = array();
        $a_params[] = & $type;
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_districts; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $a_params[] = &$districts[$i];
          $msbp_params[] = & $districts[$i];
        }
        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }

    }
    
    if($no_districts == 0 && $no_cates > 0 && $no_prices == 0){
        $type = "s";
        $query = "SELECT * FROM Review WHERE loai_id in ( SELECT id FROM Loai_quan WHERE loai IN (?";
        for ($j=1; $j<$no_cates; $j++){
            $type .= "s";
            $query .= ",?";
        }
        $query .= "))";
        $stmt = mysqli_prepare($conn, $query);
        //$a_params = array();
        $msbp_params = array();
        //$a_params[] = & $type;
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_cates; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          //$a_params[] = &$cates[$i];
          $msbp_params[] = & $cates[$i];
        }
        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }

    if($no_districts == 0 && $no_cates == 0 && $no_prices > 0){
        $type = "ii";
        $query = "SELECT * FROM Review WHERE id in ( SELECT DISTINCT review_id FROM Review_mon_gia WHERE (gia >= ? and gia <= ?)";
        for ($j=1; $j<$no_prices; $j++){
            $type .= "ii";
            $query .= "OR (gia >= ? AND gia <= ?)";
        }
        $query .= ")";
        $stmt = mysqli_prepare($conn, $query);
        //$a_params = array();
        $msbp_params = array();
        //$a_params[] = & $type;
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_prices; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          //$a_params[] = &$cates[$i];
          $msbp_params[] = & $prices_arr[$i][0];
          $msbp_params[] = & $prices_arr[$i][1];
        }
        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }

    if($no_districts > 0 && $no_cates > 0 && $no_prices == 0){
        $type1 = "s";
        $query1 = "SELECT * FROM Review WHERE   district_id in ( SELECT id FROM District WHERE quan IN (?";
        for ($j=1; $j<$no_districts; $j++){
            $type1 .= "s";
            $query1 .= ",?";
        }
        $query1 .= "))";
        $type2 = "s";
        $query2 = "SELECT * FROM Review WHERE loai_id in ( SELECT id FROM Loai_quan WHERE loai IN (?";
        for ($j=1; $j<$no_cates; $j++){
            $type2 .= "s";
            $query2 .= ",?";
        }
        $query2 .= "))";
        $query = "SELECT * FROM (".$query1.") a JOIN  (".$query2.") b ON a.id = b.id";
        $type = $type1.$type2;
        $stmt = mysqli_prepare($conn, $query);
        $msbp_params = array();
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_districts; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $districts[$i];
        }
        for($i = 0; $i < $no_cates; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $cates[$i];
        }

        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }

    if($no_districts > 0 && $no_cates == 0 && $no_prices > 0){
        $type1 = "s";
        $query1 = "SELECT * FROM Review WHERE   district_id in ( SELECT id FROM District WHERE quan IN (?";
        for ($j=1; $j<$no_districts; $j++){
            $type1 .= "s";
            $query1 .= ",?";
        }
        $query1 .= "))";
        $type2 = "ii";
        $query2 = "SELECT * FROM Review WHERE id in ( SELECT DISTINCT review_id FROM Review_mon_gia WHERE (gia >= ? and gia <= ?)";
        for ($j=1; $j<$no_prices; $j++){
            $type2 .= "ii";
            $query2 .= "OR (gia >= ? AND gia <= ?)";
        }
        $query2 .= ")";
        $query = "SELECT * FROM (".$query1.") a JOIN  (".$query2.") b ON a.id = b.id";
        $type = $type1.$type2;
        $stmt = mysqli_prepare($conn, $query);
        $msbp_params = array();
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_districts; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $districts[$i];
        }
        for($i = 0; $i < $no_prices; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          //$a_params[] = &$cates[$i];
          $msbp_params[] = & $prices_arr[$i][0];
          $msbp_params[] = & $prices_arr[$i][1];
        }

        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }

    if($no_districts == 0 && $no_cates > 0 && $no_prices > 0){
        $type1 = "s";
        $query1 = "SELECT * FROM Review WHERE loai_id in ( SELECT id FROM Loai_quan WHERE loai IN (?";
        for ($j=1; $j<$no_cates; $j++){
            $type1 .= "s";
            $query1 .= ",?";
        }
        $query1 .= "))";
        $type2 = "ii";
        $query2 = "SELECT * FROM Review WHERE id in ( SELECT DISTINCT review_id FROM Review_mon_gia WHERE (gia >= ? and gia <= ?)";
        for ($j=1; $j<$no_prices; $j++){
            $type2 .= "ii";
            $query2 .= "OR (gia >= ? AND gia <= ?)";
        }
        $query2 .= ")";
        $query = "SELECT * FROM (".$query1.") a JOIN  (".$query2.") b ON a.id = b.id";
        $type = $type1.$type2;
        $stmt = mysqli_prepare($conn, $query);
        $msbp_params = array();
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_cates; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $cates[$i];
        }
        for($i = 0; $i < $no_prices; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          //$a_params[] = &$cates[$i];
          $msbp_params[] = & $prices_arr[$i][0];
          $msbp_params[] = & $prices_arr[$i][1];
        }

        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }

    if($no_districts > 0 && $no_cates > 0 && $no_prices > 0){
        $type1 = "s";
        $query1 = "SELECT * FROM Review WHERE   district_id in ( SELECT id FROM District WHERE quan IN (?";
        for ($j=1; $j<$no_districts; $j++){
            $type1 .= "s";
            $query1 .= ",?";
        }
        $query1 .= "))";
        $type2 = "s";
        $query2 = "SELECT * FROM Review WHERE loai_id in ( SELECT id FROM Loai_quan WHERE loai IN (?";
        for ($j=1; $j<$no_cates; $j++){
            $type2 .= "s";
            $query2 .= ",?";
        }
        $query2 .= "))";
        $type3 = "ii";
        $query3 = "SELECT * FROM Review WHERE id in ( SELECT DISTINCT review_id FROM Review_mon_gia WHERE (gia >= ? and gia <= ?)";
        for ($j=1; $j<$no_prices; $j++){
            $type3 .= "ii";
            $query3 .= "OR (gia >= ? AND gia <= ?)";
        }
        $query3 .= ")";
        $query = "SELECT * FROM (".$query1.") a JOIN  (".$query2.") b JOIN  (".$query3.") c ON a.id = b.id and b.id = c.id and a.id = c.id";
        $stmt = mysqli_prepare($conn, $query);
        $type = $type1.$type2.$type3;
        $msbp_params = array();
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_districts; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $districts[$i];
        }
        for($i = 0; $i < $no_cates; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $cates[$i];
        }
        for($i = 0; $i < $no_prices; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          //$a_params[] = &$cates[$i];
          $msbp_params[] = & $prices_arr[$i][0];
          $msbp_params[] = & $prices_arr[$i][1];
        }

        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }


}

function filter_view_more($no_districts, $no_cates, $no_prices, $districts, $cates, $prices_arr, $cnt_post){
    include 'connection.php';
    require_once('work_around_func.php');

    if($no_districts > 0 && $no_cates == 0 && $no_prices == 0){
        $type = "s";
        $query = "SELECT * FROM Review WHERE   district_id in ( SELECT id FROM District WHERE quan IN (?";
        for ($j=1; $j<$no_districts; $j++){
            $type .= "s";
            $query .= ",?";
        }
        $query .= ")) LIMIT ?,3";
        $stmt = mysqli_prepare($conn, $query);
        $a_params = array();
        $msbp_params = array();
        $type .="i";
        $a_params[] = & $type;
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_districts; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $a_params[] = &$districts[$i];
          $msbp_params[] = & $districts[$i];
        }
        $msbp_params[] = & $cnt_post;
        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }

    }
    
    if($no_districts == 0 && $no_cates > 0 && $no_prices == 0){
        $type = "s";
        $query = "SELECT * FROM Review WHERE loai_id in ( SELECT id FROM Loai_quan WHERE loai IN (?";
        for ($j=1; $j<$no_cates; $j++){
            $type .= "s";
            $query .= ",?";
        }
        $query .= ")) LIMIT ?,3";
        $type .= "i";
        $stmt = mysqli_prepare($conn, $query);
        //$a_params = array();
        $msbp_params = array();
        //$a_params[] = & $type;
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_cates; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          //$a_params[] = &$cates[$i];
          $msbp_params[] = & $cates[$i];
        }
        $msbp_params[] = & $cnt_post;
        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }

    if($no_districts == 0 && $no_cates == 0 && $no_prices > 0){
        $type = "ii";
        $query = "SELECT * FROM Review WHERE id in ( SELECT DISTINCT review_id FROM Review_mon_gia WHERE (gia >= ? and gia <= ?)";
        for ($j=1; $j<$no_prices; $j++){
            $type .= "ii";
            $query .= "OR (gia >= ? AND gia <= ?)";
        }
        $query .= ") LIMIT ?,3";
        $type .= "i";
        $stmt = mysqli_prepare($conn, $query);
        //$a_params = array();
        $msbp_params = array();
        //$a_params[] = & $type;
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_prices; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          //$a_params[] = &$cates[$i];
          $msbp_params[] = & $prices_arr[$i][0];
          $msbp_params[] = & $prices_arr[$i][1];
        }
        $msbp_params[] = & $cnt_post;
        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }

    if($no_districts > 0 && $no_cates > 0 && $no_prices == 0){
        $type1 = "s";
        $query1 = "SELECT * FROM Review WHERE   district_id in ( SELECT id FROM District WHERE quan IN (?";
        for ($j=1; $j<$no_districts; $j++){
            $type1 .= "s";
            $query1 .= ",?";
        }
        $query1 .= "))";
        $type2 = "s";
        $query2 = "SELECT * FROM Review WHERE loai_id in ( SELECT id FROM Loai_quan WHERE loai IN (?";
        for ($j=1; $j<$no_cates; $j++){
            $type2 .= "s";
            $query2 .= ",?";
        }
        $query2 .= "))";
        $query = "SELECT * FROM (".$query1.") a JOIN  (".$query2.") b ON a.id = b.id limit ?,3";
        $type = $type1.$type2."i";
        $stmt = mysqli_prepare($conn, $query);
        $msbp_params = array();
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_districts; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $districts[$i];
        }
        for($i = 0; $i < $no_cates; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $cates[$i];
        }
        $msbp_params[] = & $cnt_post;
        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }

    if($no_districts > 0 && $no_cates == 0 && $no_prices > 0){
        $type1 = "s";
        $query1 = "SELECT * FROM Review WHERE   district_id in ( SELECT id FROM District WHERE quan IN (?";
        for ($j=1; $j<$no_districts; $j++){
            $type1 .= "s";
            $query1 .= ",?";
        }
        $query1 .= "))";
        $type2 = "ii";
        $query2 = "SELECT * FROM Review WHERE id in ( SELECT DISTINCT review_id FROM Review_mon_gia WHERE (gia >= ? and gia <= ?)";
        for ($j=1; $j<$no_prices; $j++){
            $type2 .= "ii";
            $query2 .= "OR (gia >= ? AND gia <= ?)";
        }
        $query2 .= ")";
        $query = "SELECT * FROM (".$query1.") a JOIN  (".$query2.") b ON a.id = b.id limit ?,3";
        $type = $type1.$type2."i";
        $stmt = mysqli_prepare($conn, $query);
        $msbp_params = array();
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_districts; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $districts[$i];
        }
        for($i = 0; $i < $no_prices; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          //$a_params[] = &$cates[$i];
          $msbp_params[] = & $prices_arr[$i][0];
          $msbp_params[] = & $prices_arr[$i][1];
        }
        $msbp_params[] = & $cnt_post;
        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }

    if($no_districts == 0 && $no_cates > 0 && $no_prices > 0){
        $type1 = "s";
        $query1 = "SELECT * FROM Review WHERE loai_id in ( SELECT id FROM Loai_quan WHERE loai IN (?";
        for ($j=1; $j<$no_cates; $j++){
            $type1 .= "s";
            $query1 .= ",?";
        }
        $query1 .= "))";
        $type2 = "ii";
        $query2 = "SELECT * FROM Review WHERE id in ( SELECT DISTINCT review_id FROM Review_mon_gia WHERE (gia >= ? and gia <= ?)";
        for ($j=1; $j<$no_prices; $j++){
            $type2 .= "ii";
            $query2 .= "OR (gia >= ? AND gia <= ?)";
        }
        $query2 .= ")";
        $query = "SELECT * FROM (".$query1.") a JOIN  (".$query2.") b ON a.id = b.id limit ?,3";
        $type = $type1.$type2."i";
        $stmt = mysqli_prepare($conn, $query);
        $msbp_params = array();
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_cates; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $cates[$i];
        }
        for($i = 0; $i < $no_prices; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          //$a_params[] = &$cates[$i];
          $msbp_params[] = & $prices_arr[$i][0];
          $msbp_params[] = & $prices_arr[$i][1];
        }
        $msbp_params[] = & $cnt_post;
        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }

    if($no_districts > 0 && $no_cates > 0 && $no_prices > 0){
        $type1 = "s";
        $query1 = "SELECT * FROM Review WHERE   district_id in ( SELECT id FROM District WHERE quan IN (?";
        for ($j=1; $j<$no_districts; $j++){
            $type1 .= "s";
            $query1 .= ",?";
        }
        $query1 .= "))";
        $type2 = "s";
        $query2 = "SELECT * FROM Review WHERE loai_id in ( SELECT id FROM Loai_quan WHERE loai IN (?";
        for ($j=1; $j<$no_cates; $j++){
            $type2 .= "s";
            $query2 .= ",?";
        }
        $query2 .= "))";
        $type3 = "ii";
        $query3 = "SELECT * FROM Review WHERE id in ( SELECT DISTINCT review_id FROM Review_mon_gia WHERE (gia >= ? and gia <= ?)";
        for ($j=1; $j<$no_prices; $j++){
            $type3 .= "ii";
            $query3 .= "OR (gia >= ? AND gia <= ?)";
        }
        $query3 .= ")";
        $query = "SELECT * FROM (".$query1.") a JOIN  (".$query2.") b JOIN  (".$query3.") c ON a.id = b.id and b.id = c.id and a.id = c.id limit ?,3";
        $stmt = mysqli_prepare($conn, $query);
        $type = $type1.$type2.$type3."i";
        $msbp_params = array();
        $msbp_params[] = & $stmt;
        $msbp_params[] = & $type;
        for($i = 0; $i < $no_districts; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $districts[$i];
        }
        for($i = 0; $i < $no_cates; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          $msbp_params[] = & $cates[$i];
        }
        for($i = 0; $i < $no_prices; $i++) {
          /* with call_user_func_array, array params must be passed by reference */
          //$a_params[] = &$cates[$i];
          $msbp_params[] = & $prices_arr[$i][0];
          $msbp_params[] = & $prices_arr[$i][1];
        }
        $msbp_params[] = & $cnt_post;
        call_user_func_array('mysqli_stmt_bind_param', $msbp_params);
        
        if(mysqli_stmt_execute($stmt)){
            //echo "executed";
            $result = get_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $result;
        }
    }
}

function get_quick_search($loai_id){
	include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * from Review where loai_id = ? order by likes DESC";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $loai_id);
    if(mysqli_stmt_execute($stmt)){
    	$result = get_result($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $result;
}

function get_quick_search_view_more($loai_id, $cnt_post){
	include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * from Review where loai_id = ? order by likes DESC limit ?,3";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $loai_id, $cnt_post);
    if(mysqli_stmt_execute($stmt)){
    	$result = get_result($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $result;
}

function get_popular_reviews_fancy(){
    include 'connection.php';
    require_once('work_around_func.php');

    //$query = "SELECT * FROM Review ORDER BY likes DESC LIMIT 10";
    $query = "SELECT * FROM (Review JOIN (SELECT COUNT(review_id) as cnt ,  review_id FROM  User_like_dislike GROUP BY  review_id )ava on id = review_id )ORDER BY cnt DESC";
    $stmt = mysqli_prepare($conn, $query);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
}

function get_popular_reviews(){
    include 'connection.php';
    require_once('work_around_func.php');

    //$query = "SELECT * FROM Review ORDER BY likes DESC LIMIT 10";
    $query = "SELECT * FROM Review order by likes DESC";
    $stmt = mysqli_prepare($conn, $query);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
}

function get_latest_review(){
    include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * FROM Review ORDER BY id DESC LIMIT 10";
    $stmt = mysqli_prepare($conn, $query);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }

}

function get_liked_reviews($userId){
    include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * FROM Review where id in (SELECT review_id from User_like_dislikes where user_id = ? and type = 1) ali ORDER BY id DESC LIMIT 3";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }

}

function get_liked_reviews_view_more($userId, $cnt){
    include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * FROM Review where id in (SELECT review_id from User_like_dislikes where user_id = ? and type = 1) ali ORDER BY id DESC LIMIT ?,3";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $userId, $cnt);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }

}

function get_subscribe_review($userId){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Review WHERE user_id in (SELECT sub_to_id FROM User_subscribes WHERE user = ?) ORDER BY id DESC limit 3";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $results = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $results;
    }

}

function get_subscribe_review_view_more($userId, $cnt_post){
    include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * FROM (SELECT * FROM Review WHERE user_id in (SELECT sub_to_id FROM User_subscribes WHERE user = ?) ORDER BY id DESC) AVA LIMIT ?,3"; // get 3 more reviews
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $userId, $cnt_post);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }

}

function get_latest_review_view_more($cnt_post){
    include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * FROM (SELECT * FROM Review ORDER BY id DESC) AVA LIMIT ?,3"; // get 3 more reviews
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $cnt_post);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }

}

function get_popular_review_view_more_fancy($cnt_post){
    include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * FROM (SELECT * FROM (Review JOIN (SELECT COUNT(review_id) as cnt ,  review_id FROM  User_like_dislike GROUP BY  review_id )ava on id = review_id )ORDER BY cnt DESC) ali LIMIT ?,3";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $cnt_post);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
}

function get_popular_review_view_more($cnt_post){
    include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * FROM Review order by likes DESC LIMIT ?,3";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $cnt_post);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
}

function get_popular_review_view_more_fixing($cnt_post){
    include 'connection.php';
    require_once('work_around_func.php');

    $query = "SELECT * FROM ((SELECT * FROM (Review JOIN (SELECT COUNT(review_id) as cnt ,  review_id FROM  User_like_dislike GROUP BY  review_id )ava on id = review_id )ORDER BY cnt DESC) ali UNION (Select * from Review order by likes ASC) ali2) LIMIT ?,3";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $cnt_post);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
}

function get_img_dir($review_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Review WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $review_id);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }

}

function get_gia($review_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Review_mon WHERE review_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $review_id);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }

}
function get_num_of_like_dislike($review_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query2 = "SELECT COUNT(*) AS cntLike FROM User_like_dislike WHERE type=1 and review_id=?";
        $stmt4 = mysqli_prepare($conn, $query2);
            mysqli_stmt_bind_param($stmt4, "i", $review_id);
            if (mysqli_stmt_execute($stmt4)){
                $status = 1;
                //echo "executed";
                $result4 = get_result($stmt4);
                mysqli_stmt_close($stmt4);
                $totalLikes = $result4[0]['cntLike'];
            }

    $query3 = "SELECT COUNT(*) AS cntUnlike FROM User_like_dislike WHERE type=0 and review_id=?";
        $stmt5 = mysqli_prepare($conn, $query3);
            mysqli_stmt_bind_param($stmt5, "i", $review_id);
            if (mysqli_stmt_execute($stmt5)){
                //echo "executed";
                $result5 = get_result($stmt5);
                mysqli_stmt_close($stmt5);
                $totalUnlikes = $result5[0]['cntUnlike'];
            }
            mysqli_close($conn);
            $return_arr = array("likes"=>$totalLikes,"dislikes"=>$totalUnlikes);
            return $return_arr;
}
function like_dislike($review_id, $user_id, $type){

    include 'connection.php';
    require_once('work_around_func.php');
    $status = 0;
    $query = "SELECT COUNT(*) AS cntpost FROM User_like_dislike WHERE review_id = ? and user_id = ?";
    $stmt1 = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt1, "ii", $review_id, $user_id);
    if (mysqli_stmt_execute($stmt1)){
        $status = 1;
        //echo "executed";
        $result = get_result($stmt1);
        mysqli_stmt_close($stmt1);
    }
    $count = $result[0]['cntpost'];
    // ok until here
    //return $count;
    $a = 0;
        if($count == 0){
            $insertquery = "INSERT INTO User_like_dislike values(?,?,?)";
            $stmt2 = mysqli_prepare($conn, $insertquery);
            mysqli_stmt_bind_param($stmt2, "iii", $user_id, $review_id, $type);
            if (mysqli_stmt_execute($stmt2)){
                //echo "executed";
                $a = 1;
            }
            mysqli_stmt_close($stmt2);
        }else {
            $updatequery = "UPDATE User_like_dislike SET type=? where user_id=? and review_id=?";
            $stmt3 = mysqli_prepare($conn, $updatequery);
            mysqli_stmt_bind_param($stmt3, "iii", $type, $user_id, $review_id);
            if (mysqli_stmt_execute($stmt3)){
                //echo "executed";
                $a = 1;
            }
            mysqli_stmt_close($stmt3);
        }

        // count numbers of like and unlike in post
        $query2 = "SELECT COUNT(*) AS cntLike FROM User_like_dislike WHERE type=1 and review_id=?";
        $stmt4 = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($stmt4, "i", $review_id);
        if (mysqli_stmt_execute($stmt4)){
            $status = 1;
            //echo "executed";
            $result4 = get_result($stmt4);
            $totalLikes = $result4[0]['cntLike'];
        }
       	mysqli_stmt_close($stmt4);
       	$query_update_like = "UPDATE Review SET likes = ? WHERE id = ?";
       	$stmt_update_like = mysqli_prepare($conn, $query_update_like);
       	mysqli_stmt_bind_param($stmt_update_like, "ii", $totalLikes, $review_id);
       	mysqli_stmt_execute($stmt_update_like);

        $query3 = "SELECT COUNT(*) AS cntUnlike FROM User_like_dislike WHERE type=0 and review_id=?";
        $stmt5 = mysqli_prepare($conn, $query3);
        mysqli_stmt_bind_param($stmt5, "i", $review_id);
        if (mysqli_stmt_execute($stmt5)){
            //echo "executed";
            $result5 = get_result($stmt5);
            $totalUnlikes = $result5[0]['cntUnlike'];
        }
        mysqli_stmt_close($stmt5);
        $query_update_dislike = "UPDATE Review SET dislikes = ? WHERE id = ?";
       	$stmt_update_dislike = mysqli_prepare($conn, $query_update_dislike);
       	mysqli_stmt_bind_param($stmt_update_dislike, "ii", $totalUnlikes, $review_id);
       	mysqli_stmt_execute($stmt_update_dislike);
        mysqli_close($conn);
        $return_arr = array("likes"=>$totalLikes,"dislikes"=>$totalUnlikes);
        return $return_arr;
}

function check_sub($posterId, $subscriberId){
    include 'connection.php';
    require_once('work_around_func.php');
    $find_query = "SELECT COUNT(*) as cntSub FROM User_subscribes WHERE user = ? and sub_to_id = ?";
    $find_stmt = mysqli_prepare($conn, $find_query);
    mysqli_stmt_bind_param($find_stmt, "ii", $subscriberId, $posterId);
    if(mysqli_stmt_execute($find_stmt)){
        $result = get_result($find_stmt);
        $count = $result[0]['cntSub'];
        return $count;
    }
    // if($count > 0){
    //     return array("result"=>1);
    // }
    // else{
    //     return array("result"=>0);
    // }
}

function add_subscriber($posterId, $subscriberId){
    include 'connection.php';
    require_once('work_around_func.php');
    $sub_no_query = "SELECT COUNT(*) as cntSub FROM(SELECT user * FROM User_subscribes WHERE sub_to_id = ?) ali";
    $sub_no_stmt = mysqli_prepare($conn, $sub_no_query);
    mysqli_stmt_bind_param($sub_no_stmt, "i", $posterId);
    if(mysqli_stmt_execute($sub_no_stmt)){
        $result = get_result($sub_no_stmt);
        $countSub = $result[0]['cntSub'];
    }
    $final_result = array();
    $final_result["countSub"] = $countSub;

    $query = "INSERT INTO User_subscribes (user, sub_to_id) VALUES (?,?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $subscriberId, $posterId);
    if(mysqli_stmt_execute($stmt)){
        $final_result["result"] = "success";
        return $final_result;
    }
    else{
        $final_result["result"] = "failed";
        return $final_result;
    }
}

function get_number_of_subscribers($userId){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT COUNT(*) as cntSub FROM(SELECT distinct user FROM User_subscribes WHERE sub_to_id = ?) ali";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    if(mysqli_stmt_execute($stmt)){
        $result = get_result($stmt);
        $countSub = $result[0]['cntSub'];
        return $countSub;
    }

}

function get_mon_gia($review_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Review_mon_gia WHERE review_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $review_id);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
}

function get_user($review_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM User WHERE id IN (SELECT user_id FROM Review WHERE id = ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $review_id);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
}

function get_comment_user($review_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Review_comments WHERE Review_id = ? limit 5";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $review_id);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }

}

function get_comment_user_view_more($review_id, $cnt){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Review_comments WHERE Review_id = ? order by id limit ?,3";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $review_id, $cnt);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }

}

function get_number_of_post_by_user($user_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT COUNT(*) as cnt FROM Review WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result[0]['cnt'];
    }
}

function get_number_of_like_of_user($user_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT count(*) as cnt from User_like_dislike where type = 1 and review_id in 
            (select id from Review where user_id = ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result[0]['cnt'];
    }
}

function get_number_of_dislike_of_user($user_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT count(*) as cnt from User_like_dislike where type = 0 and review_id in 
            (select id from Review where user_id = ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result[0]['cnt'];
    }
}

function get_number_of_comments($review_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT COUNT(review_id) AS cnt FROM Review_comments WHERE review_id = ? GROUP BY review_id";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $review_id);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }

}

function get_price_range($review_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM (SELECT * FROM Review_mon_gia WHERE review_id = ? ORDER BY gia ASC LIMIT 1) AS a
            UNION ALL SELECT * FROM (SELECT * FROM Review_mon_gia WHERE review_id = ? ORDER BY gia DESC LIMIT 1) AS b";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $review_id, $review_id);
    if (mysqli_stmt_execute($stmt)){
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
}

function get_time_range($review_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Review WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $review_id);
    if (mysqli_stmt_execute($stmt)){
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
}


function get_loai($review_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Loai_quan WHERE id IN (SELECT loai_id FROM Review WHERE id = ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $review_id);
    if (mysqli_stmt_execute($stmt)){
        //echo "executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
}

function getUserById($user_id) {
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM User WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);

    if(mysqli_stmt_execute($stmt)){
        //echo " get executed";
        $result = get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }
}

function get_rating($review_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Review WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $review_id);

    if(mysqli_stmt_execute($stmt)){
        //echo " get executed";
        $result = get_result($stmt);
        $rating = $result[0]["rating"];
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $rating;
    }
}

//function storeReview($){

function getReviewLikesOfUser($username){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Review WHERE id IN (SELECT review_id FROM User_review WHERE user_id IN 
        (SELECT id FROM User WHERE username = ?))";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    if (mysqli_stmt_execute($stmt)){
        echo "executed";
        mysqli_stmt_store_result($stmt);
        $result = get_result($stmt);
        $rows = mysqli_stmt_num_rows($stmt);
        echo $rows;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);    
    return $rows;
}

function get_user_id_by_username($username){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM User WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);

    if(mysqli_stmt_execute($stmt)){
        //echo " get executed";
        $result = get_result($stmt);
        $user_id = $result[0]["id"];
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $user_id;
    }
}

function get_district_id($district){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM District WHERE quan = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $district);

    if(mysqli_stmt_execute($stmt)){
        //echo " get executed";
        $result = get_result($stmt);
        $district_id = $result[0]["id"];
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $district_id;
    }
}

function get_type_id($type){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Loai_quan WHERE loai = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $type);

    if(mysqli_stmt_execute($stmt)){
        //echo " get executed";
        $result = get_result($stmt);
        $loai_id = $result[0]["id"];
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $loai_id;
    }
}

function get_review_id_for_posting($ten, $user_id){
    include 'connection.php';
    require_once('work_around_func.php');
    $query = "SELECT * FROM Review WHERE ten = ? and user_id = ? order by id DESC limit 1";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $ten, $user_id);

    if(mysqli_stmt_execute($stmt)){
        //echo " get executed";
        $result = get_result($stmt);
        $review_id = $result[0]["id"];
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $review_id;
    }
}

function post_review($storeName, $username, $storeReview, $storeRating ,$storeLocation, $storeType, $storeArea, $storeOpnTime, $storeClsTime, $mealName, $mealPrice){

	include "connection.php";
	require_once('work_around_func.php');

    $user_id = get_user_id_by_username($username);
    $district_id = get_district_id($storeArea);
    $loai_id = get_type_id($storeType);
    $query1 = "INSERT INTO review (ten, review, rating, time_open, time_close, user_id, loai_id, dia_chi, district_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt1 = mysqli_prepare($conn, $query1);
    mysqli_stmt_bind_param($stmt1, "ssissiisi", $storeName, $storeReview, $storeRating, $storeOpnTime, $storeClsTime, $user_id, $loai_id, $storeLocation, $district_id);
    if(mysqli_stmt_execute($stmt1)){
        $result = 'true';
        mysqli_stmt_close($stmt1);
        $query2 = "INSERT INTO review_mon_gia (review_id, ten_mon, gia) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query2);
        $review_id = get_review_id_for_posting($storeName, $user_id);
        $cnt_dish = count($mealName);
        for($i=0; $i<$cnt_dish; $i++){
            mysqli_stmt_bind_param($stmt, "isi", $review_id, $mealName[$i], $mealPrice[$i]);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);   
    }
    else 
        $result = 'false';
    return $result;
    
}

function store_comment($comment, $user_id, $review_id, $title){
    include "connection.php";
    require_once('work_around_func.php');

    $query = "INSERT INTO Review_comments (review_id, summary, comment, user_id) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "issi", $review_id, $title, $comment, $user_id);
    $result = 0;
    if(mysqli_stmt_execute($stmt)){
        $result = 1;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $result;

}