<?php
declare (strict_types=1);
require_once "signup/query.php";
require_once "pdo.php";

function useremail_validation(string $user_email){
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}

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
