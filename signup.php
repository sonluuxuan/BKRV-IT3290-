<?php
session_start();

include 'DB_functions.php';
include 'connection.php';

if (isset($_POST['submit'])) {

    // receiving the post params
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $password_repeat = $_POST['passwordRepeat'];
    //echo $username;

    if (empty($username) || empty($password) || empty($password_repeat)){
        header("Location: register.php?error=emptyfields&username=".$username);
        exit();

    }

    else if($password !== $password_repeat){
        header("Location: register.php?error=passwordnotmatched&username=".$username);
        exit();
    }
    // get the user by username and password
    else if(isUserExisted($username)){
        header("Location: register.php?error=userexisted");
        exit();
    }
    else if(isEmailExisted($email)){
        header("Location: register.php?error=EmailExisted");
        exit();
    }

    else {
        storeUser($password, $username, $email);
        $user = getUserByUsernameAndPassword($username, $password);
        // create default profile picture //
        $path = "profile_pics/user".$user["id"]; // relative path //
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        } // create folder //

        // create default image //
        copy('profile_pics/default_avatar.jpg', $path.'/default_avatar.jpg');

        $_SESSION[$username] = array();
        $_SESSION[$username][1] = $user["password"];
        $_SESSION[$username][2] = $user["id"];
        $_SESSION[$username][0] = $user["username"];
        //echo $_SESSION[$username][2]." ".$_SESSION[$username][0]; 
        header("Location: index.php?username=".$user["username"]);
        //header("Location: index.html");
    }
}
mysqli_close($conn); 

?>
