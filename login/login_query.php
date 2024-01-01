<?php
declare(strict_types=1);
require_once "../pdo.php";
require_once "../session.php";
require_once "./login_form_handel.php";
function user_available(object $pdo, string $user_email, string $user_password) {
    $query = "INSERT INTO login (user_email, user_password) VALUES (:user_email, :user_password);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_email", $user_email);
    $stmt->bindParam(":user_password", $user_password);
    $stmt->execute();
    // Additional error handling if needed
    $query = null;
    $stmt = null;
}
function login_user_input(object $pdo, string $user_email, string $user_password) {
    $query = "SELECT * FROM signup WHERE user_email = :user_email AND user_password = :user_password;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_email", $user_email);
    $stmt->bindParam(":user_password", $user_password);
    if ($stmt->execute()) {
        $rows = $stmt->rowCount();
        if ($rows == 1) {
            // User exists in signup table
            // Insert into the login table
            $_SESSION["errors_login"] = "User  Available";
            user_available($pdo, $user_email, $user_password);
            // Perform login actions or redirect as needed
            // header("location:http://localhost/facebook_like_project/login_users/login_users.php");
            header("location:http://localhost/facebook_like_project/check.php");

        } else {
            $_SESSION["errors_login"] = "User Not Available";
            header("Location: http://localhost/facebook_like_project/login/login.php");
            exit();
        }
    }

    $query = null;
    $stmt = null;
    // return $user_email;
}
// function mail_sent(object $pdo, string $user_email, string $user_password) {
//     // Hash the password before comparing
//     $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

//     $query = "SELECT * FROM signup WHERE user_email = :user_email AND user_password = :user_password";
//     $stmt = $pdo->prepare($query);
//     $stmt->bindParam(":user_email", $user_email);
//     $stmt->bindParam(":user_password", $hashed_password);

//     if ($stmt->execute()) {
//         $rows = $stmt->rowCount();
//         if ($rows == 1) {
//             // User exists in signup table
//             $_SESSION["login_status"] = "User available";
//             // Insert any additional logic or function calls here

//             // Perform login actions or redirect as needed
//             header("Location: http://localhost/facebook_like_project/login_users/login_users.php?email=" . urlencode($user_email));
//             exit();
//         } else {
//             // User does not exist in signup table
//             $_SESSION["login_status"] = "User not available";
//             header("Location: http://localhost/facebook_like_project/login/login.php");
//             exit();
//         }
//     }

//     // Handle any other scenarios or errors
//     // ...

//     return $user_email;
// }

function empty_input(string $user_email, string $user_password){
if(empty($user_email) || empty($user_password)){
return true;
}
else{
    return false;
}
}
function email_validation(string $user_email){
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}




