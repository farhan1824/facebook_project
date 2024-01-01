<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Log In</title>
</head>
<body>
<div class="login-container">
        <h2>Login</h2>
        <form action="login_form_handel.php" method="POST">
            <label for="username">Email:</label>
            <input type="text" id="user_email" name="user_email" placeholder="Enter your Email" >
            <label for="password">Password:</label>
            <input type="password" id="password" name="user_password" placeholder="Enter your password" >
            <button type="submit">LOG IN</button>
            <a href="http://localhost/facebook_like_project/signup/signup.php"><h6>Don't Have Any Account?</h6></a>
        </form>
    </div>
    <?php 
    require_once "./login_form_handel.php";
    require_once "../error_viewing.php";
    ?>
</body>
</html>