<?php
session_start();
// test chay ok

require_once 'DB_functions.php';

if (isset($_POST['submit'])) {
    //echo "adfs";
        // receiving the post params
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $redirect = null;
    if($_POST['location'] != '') {
        $redirect = $_POST['location'];
    }

    if(empty($username) || empty($password)){
        $url = 'login.php?error=emptyfields';
        // if we have a redirect URL, pass it back to login.php so we don't forget it
        if(isset($redirect)) {
            $url .= '&location=' . urlencode($redirect);
        }
        header("Location: " . $url);
        exit();
        //header("Location: login.php?error=emptyfields&username=".$username);
        //exit();
    }

    // get the user by username and password
    $user = getUserByUsernameAndPassword($username, $password);

    if ($user != NULL) {
        //echo ("welcome!!1");
        $_SESSION["logged_in"] = 1;
        $_SESSION["username"] = $user["username"];
        $_SESSION["userid"] = $user["id"];
        //$_SESSION[$username][0] = $user["username"];
        if($redirect && $redirect != "/webservice/project_csdl/listing.php") {

            //header("Location: ". $redirect."&username=".$user["username"]);
            header("Location: ". $redirect);
        }
        else{
            //header("Location: index.php?username=".$user["username"]);
            header("Location: index.php");
        }
        exit();
        //echo $_SESSION[$username][2]." ".$_SESSION[$username][0]; 
        //header("Location: index.php?username=".$user["username"]);
        //echo $user["password"];
    }else {
       //header("Location: login.php?error=notfound&username=".$username);
        $url = 'login.php?error=notfound';
        // if we have a redirect URL, pass it back to login.php so we don't forget it
        if(isset($redirect)) {
            $url .= '&location=' . urlencode($redirect);
        }
        header('Location: ' . $url);
        exit();
    }
    }

?>
