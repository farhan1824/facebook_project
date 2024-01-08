<?php
session_start();
session_unset();
session_destroy();
echo" you are not logged in ";
header("location:../login/login.php");
exit();

