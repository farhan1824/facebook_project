<?php
declare (strict_types=1);
require_once "../pdo.php";
require_once "signup_form_handel.php";
function user_input(object $pdo ,string $username,string $user_email,string $user_password){
    $query="INSERT INTO signup (username,user_email,user_password)
    VALUES (:username,:user_email,:user_password);";
    $stmt =$pdo->prepare($query);
    $stmt->bindparam(":username", $username);
    $stmt->bindparam(":user_email", $user_email);
    $stmt->bindparam(":user_password", $user_password);
    header("location:http://localhost/facebook_like_project/marup_user/markup_user.php");
    $stmt->execute();
    $query = null;
    $stmt = null;
}
// user_informations_input( $pdo,  $Full_Name, $mobile_number,  $bio,  $birthdate, $gender,  $profile_image, $username, $user_email, $user_password);
// user_input( $pdo , $username, $user_email, $user_password);
function username_input(object $pdo ,string $username){
    $query="SELECT username FROM signup WHERE username=:username ;";
    $stmt =$pdo->prepare($query);
    $stmt->bindparam(":username", $username);
    $stmt->execute();
    $query = null;
    $stmt = null;
}
function user_email_validation(object $pdo ,string $user_email){
    $query="SELECT user_email FROM signup WHERE user_email=:user_email ;";
    $stmt =$pdo->prepare($query);
    $stmt->bindparam(":user_email", $user_email);
    $stmt->execute();
    $query = null;
    $stmt = null;
}
function username_already_inserted(object $pdo, string $username, string $user_email) {
    // Check if the username is available
    $queryCheck = "SELECT COUNT(*) FROM signup WHERE username = :username AND user_email=:user_email";
    $stmtCheck = $pdo->prepare($queryCheck);
    $stmtCheck->bindParam(':username', $username);
    $stmtCheck->bindParam(':user_email', $user_email);
    $stmtCheck->execute();

    // If count is 0, the username is available; otherwise, it's not
    if ($stmtCheck->fetchColumn() == 0) {
        // Insert the record if the username is available
        return true;
    } else {
        // Return false if the username is not available
        return false;
    }
}


