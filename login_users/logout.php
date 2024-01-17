<?php
// session_start();
require_once "../session.php";
session_unset();
session_destroy();
echo" you are not logged in ";
// header("location:../login/login.php");
header("location:http://localhost/facebook_like_project/");
exit();

