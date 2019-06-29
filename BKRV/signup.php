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
    $redirect = null;
        if($_POST['location'] != '') {
            $redirect = $_POST['location'];
        }

    if (empty($username) || empty($password) || empty($password_repeat)){
        //header("Location: register.php?error=emptyfields&username=".$username);
        $url = 'register.php?error=emptyfields&username='.$username;
        // if we have a redirect URL, pass it back to login.php so we don't forget it
        if(isset($redirect)) {
            $url .= '&location=' . urlencode($redirect);
        }
        header('Location: ' . $url);
        //exit();
        exit();

    }

    else if($password !== $password_repeat){
        //header("Location: register.php?error=passwordnotmatched&username=".$username);
        $url = 'register.php?error=passwordnotmatched&username='.$username;
        // if we have a redirect URL, pass it back to login.php so we don't forget it
        if(isset($redirect)) {
            $url .= '&location=' . urlencode($redirect);
        }
        header('Location: ' . $url);
        exit();
    }
    // get the user by username and password
    else if(isUserExisted($username)){
        //header("Location: register.php?error=userexisted");
        $url = 'register.php?error=userexisted';
        // if we have a redirect URL, pass it back to login.php so we don't forget it
        if(isset($redirect)) {
            $url .= '&location=' . urlencode($redirect);
        }
        header('Location: ' . $url);
        exit();
    }
    else if(isEmailExisted($email)){
        //header("Location: register.php?error=EmailExisted");
        $url = 'register.php?error=EmailExisted';
        // if we have a redirect URL, pass it back to login.php so we don't forget it
        if(isset($redirect)) {
            $url .= '&location=' . urlencode($redirect);
        }
        header('Location: ' . $url);
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

        //$_SESSION[$username] = array();
        $_SESSION["logged_in"] = 1;
        $_SESSION["username"] = $user["username"];
        $_SESSION["userid"] = $user["id"];
        //$_SESSION[$username][0] = $user["username"];
        //echo $_SESSION[$username][2]." ".$_SESSION[$username][0]; 
        //header("Location: index.php?username=".$user["username"]);
        //header("Location: index.php");
        if($redirect && $redirect != "/webservice/project_csdl/listing.php") {

            //header("Location: ". $redirect."&username=".$user["username"]);
            header("Location: ". $redirect);
        }
        else{
            //header("Location: index.php?username=".$user["username"]);
            header("Location: index.php");
        }
        //header("Location: index.html");
    }
}
mysqli_close($conn); 

?>
