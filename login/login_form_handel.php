<?php
require_once "../pdo.php";
//  require_once "../pdo.php";
require_once "../session.php";
require_once "../login/login_query.php";
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $user_email = $_POST["user_email"];
    $user_password = md5($_POST["user_password"]);
    try {
        if (empty_input($user_email, $user_password)) {
            $_SESSION["errors_login"] = "Invalid_Input=FILL THE FORM FIRST";
            header("Location:http://localhost/facebook_like_project/login/login.php");
        }
        if (email_validation($user_email)) {
            $_SESSION["errors_login"] = "invalid_emial=USERS EMAIL IS INVALID";
            header("Location:http://localhost/facebook_like_project/login/login.php");
        }

        if (login_user_input($pdo, $user_email, $user_password)) {
            $_SESSION["errors_login"] = "invalid_post=USER NOT FOUND";
            header("Location:http://localhost/facebook_like_project/login/login.php");
        }
        // if(information_input($pdo,$user_email,$user_password)){
        //     $_SESSION["errors_login"] = "invalid_post=USER NOT FOUND";
        //     header("Location:http://localhost/facebook_like_project/login/login.php");
        // }
        // user_available($pdo,$user_email,$user_password);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}