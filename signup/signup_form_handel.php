<?php
    require_once "../pdo.php";
    require_once "../signup/query.php";
    require_once "../error_handel.php";
    require_once "../session.php";
if($_SERVER["REQUEST_METHOD"] === "POST"){
  
if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    $id = null;
}

if (isset($_POST['username'])) {
    $username = $_POST['username'];
} else {
    $username = null;
}

if (isset($_POST['user_email'])) {
    $user_email = $_POST['user_email'];
} else {
    $user_email = null;
}

if (isset($_POST['user_password'])) {
    $user_password =md5($_POST['user_password']);
} else {
    $user_password = null;
}
    try {
        $errors=[];
        if (is_empty($username, $user_email, $user_password)) {
            $errors[] = "invalid_post=FILL ALL THE REQUIREMENTS";
        }
        if (useremail_validation($user_email)) {
            $errors[] = "invalid_emial=USERS EMAIL IS INVALID";
        }
        if (username_validation($pdo,$username)) {
            $errors[] = "invalid_users=USERS NAME IS INVALID";
        }
        if (is_email_already_registered($pdo,$user_email)) {
            $errors[] = "email_register_already=USERS EMAIL IS ALREADY TAKEN";
        }
        $isUsernameAvailable = username_already_inserted($pdo, $username, $user_email);

        if ($isUsernameAvailable) {
            // The username is available, proceed with your logic
            user_input($pdo,$username,$user_email,$user_password);
        } else {
            // The username is not available, handle accordingly (e.g., show an error message)
            $errors[] = "invalid_users=USERS NAME IS ALREADY TAKEN";
        }
    if ($errors) {
        $_SESSION["errors_signup"] = $errors;
        header("Location:http://localhost/facebook_like_project/signup/signup.php");
        die();
    }
    //    error handel Ends  
            // user_input($pdo,$username,$user_email,$user_password);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}