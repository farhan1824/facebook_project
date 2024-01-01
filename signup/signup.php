<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup System</title>
    <link rel="stylesheet" href="../login/login.css">
</head>
<body>
<div class="login-container">
        <h2>Sign Up</h2>
        <form action="signup_form_handel.php" method="POST">
            <label for="username">UserName:</label>
            <input type="text" id="username" name="username" placeholder="Enter your Name" >
            <label for="username">Email:</label>
            <input type="text" id="user_email" name="user_email" placeholder="Enter your Email" >
            <label for="password">Password:</label>
            <input type="password" id="user_password" name="user_password" placeholder="Enter your password" >
            <!-- <input type="submit" class="btn" value="Sign UP"> -->
            <button type="submit">Sign Up</button>
        </form>
    </div>
    <?php 
    require_once "../error_viewing.php";
    error_output_signup();
    ?>
</body>
</html>