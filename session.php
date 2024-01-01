<?php
ini_set("session.use_only_cookies", 1);
ini_set("session.use_strict_mode", 1);

session_set_cookie_params([
    "lifetime" => 86400,  // 1 day in seconds
    "domain" => "localhost",
    "path" => "/",
    "secure" => true,
    "httponly" => true
]);

session_start();

if (!isset($_SESSION["last_regeneration"])) {
    session_regenerate_id();
    $_SESSION["last_regeneration"] = time();
} else {
    // time interval 
    $interval = 60 * 30; // 30 minutes
    if (time() - $_SESSION["last_regeneration"] >= $interval) {
        session_regenerate_id();
        $_SESSION["last_regeneration"] = time();
    }
}