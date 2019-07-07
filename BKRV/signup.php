<?php
session_start();

include 'DB_functions.php';
include 'connection.php';
if (isset($_POST['submit'])) {
    echo "in";
    // receiving the post params
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $password_repeat = $_POST['passwordRepeat'];
    $redirect = null;
    if($_POST['location'] != '') {
        $redirect = $_POST['location'];
    }
    if(empty($username) || empty($password) || empty($password_repeat)){
        $url = 'register.php?error=emptyfields&username='.$username;
        // if we have a redirect URL, pass it back to login.php so we don't forget it
        if(isset($redirect)) {
            $url .= '&location=' . urlencode($redirect);
        }
        header('Location: ' . $url);
        exit();

    }
    if($password != $password_repeat){
        $url = 'register.php?error=passwordnotmatched&username='.$username;
        // if we have a redirect URL, pass it back to login.php so we don't forget it
        if(isset($redirect)) {
            $url .= '&location=' . urlencode($redirect);
        }
        header('Location: ' . $url);
        exit();
    }

    // get the user by username and password
    if(isUserExisted($username)){
        $url = 'register.php?error=userexisted';
        // if we have a redirect URL, pass it back to login.php so we don't forget it
        if(isset($redirect)) {
            $url .= '&location=' . urlencode($redirect);
        }
        header('Location: ' . $url);
        exit();
    }
    if(isEmailExisted($email)){
        $url = 'register.php?error=EmailExisted';
        // if we have a redirect URL, pass it back to login.php so we don't forget it
        if(isset($redirect)) {
            $url .= '&location=' . urlencode($redirect);
        }
        header('Location: ' . $url);
        exit();
    }
    $bio = "";
    storeUser($password, $username, $email, $bio);
    $user = getUserByUsernameAndPassword($username, $password);
    // create default profile picture //
    $path = "profile_pics/".$user["id"]; // relative path //
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    } // create folder //

    // create default image //
    copy('profile_pics/default_avatar.jpg', $path.'/default_avatar.jpg');

    $_SESSION["logged_in"] = 1;
    $_SESSION["username"] = $user["username"];
    $_SESSION["userid"] = $user["id"];
    if($redirect && $redirect != "/BKRV-IT3290-/BKRV/listing.php") {
        header("Location: ". $redirect);
    }
    else{
        echo "here3";
        header("Location: index.php");
    }
}
mysqli_close($conn); 

?>
