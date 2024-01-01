<?php
declare(strict_types=1);
require_once "session.php";
// require_once "./marup_user/markup_user_form_handel.php";
function error_output_signup(){
    if(isset($_SESSION["errors_signup"])){
        $errors=$_SESSION["errors_signup"];
        echo"<br>";
        foreach($errors as $error){
            echo "<p>".$error."<br>"."</p>";
        }
        unset($_SESSION["errors_signup"]);
    }
}

if (isset($_SESSION["user_input"])) {
    echo '<p style="color: red;">' . $_SESSION["user_input"] . '</p>';
    unset($_SESSION["user_input"]);
}
if (isset($_SESSION["signup_error"])) {
    echo '<p style="color: red;">' . $_SESSION["signup_error"] . '</p>';
    unset($_SESSION["signup_error"]);
}
if (isset($_SESSION["Update"])) {
    echo '<p style="color: red;">' . $_SESSION["Update"] . '</p>';
    unset($_SESSION["Update"]);
}
if (isset($_SESSION["account_delete"])) {
    echo '<p style="color: red;">' . $_SESSION["account_delete"] . '</p>';
    unset($_SESSION["account_delete"]);
}
if (isset($_SESSION["image_edit"])) {
    echo '<p style="color: red;">' . $_SESSION["image_edit"] . '</p>';
    unset($_SESSION["image_edit"]);
}
if (isset($_SESSION["delete_user"])) {
    echo '<p style="color: red;">' . $_SESSION["delete_user"] . '</p>';
    unset($_SESSION["delete_user"]);
}
if (isset($_SESSION["upload"])) {
    echo '<p style="color: red;">' . $_SESSION["upload"] . '</p>';
    unset($_SESSION["upload"]);
}
if (isset($_SESSION["errors_login"])) {
    echo "<p>{$_SESSION["errors_login"]}</p>";
    unset($_SESSION["errors_login"]);
}
// if (isset($_SESSION["image_edit"])) {
//     echo "<p>{$_SESSION["image_edit"]}</p>";
//     unset($_SESSION["image_edit"]);
// }