<?php
declare (strict_types=1);
// require_once "./signup/query.php";
require_once "signup/query.php";
require_once "pdo.php";
// require_once "./marup_user/markup_user_form_handel.php";
function useremail_validation(string $user_email){
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}
// function is_empty (string $username ,string $user_email,string $user_password){
//     if(empty($user_email)||empty($username)||empty($user_password)){
//         return true;
//     }
//     else{
//         return false;
//     }
// }
function is_empty(?string ...$values): bool {
    foreach ($values as $value) {
        if ($value === null || trim($value) === '') {
            return true;
        }
    }
    return false;
}

function username_validation (object $pdo,string $username ){
    if(username_input($pdo,$username)){
        return true;
    }
    else{
        return false;
    }
}
function is_email_already_registered (object $pdo,string $user_email ){
    if(user_email_validation($pdo,$user_email)){
        return true;
    }
    else{
        return false;
    }
}
// function input_empty(string $Full_Name, $mobile_number, string $bio, string $birthdate, string $gender)
// {
//     if (empty($Full_Name) || empty($mobile_number) || empty($bio) || empty($birthdate) || empty($gender)) {
//         return true;
//     } else {
//         return false;
//     }
// }