<!-- markup.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>markup_user</title>
    <link rel="stylesheet" href="../login/login.css">
    <!-- <link rel="stylesheet" href="./markup_user.css"> -->
</head>
<body>
    <div class="login-container">
        <h2>Personal Information</h2>
<form action="markup_user_form_handel.php" method="POST"  enctype="multipart/form-data">
        <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="username" placeholder="Full Name" >

    <label for="birthday">Birthday:</label>
    <input type="date" id="birthday" name="birthdate" >

    <label>Gender:</label>
    <label for="male">
        <input type="radio" id="male" name="gender" value="Male" > Male
    </label>
    <label for="female">
        <input type="radio" id="female" name="gender" value="Female" > Female
    </label>
    <label for="other">
        <input type="radio" id="other" name="gender" value="Other" > Other
    </label>

    <label for="mobile_number">Mobile Number:</label>
    <input type="tel" id="mobile_number" name="mobile_number" placeholder="Mobile Number"  >


    <label for="bio">Bio:</label>
    <textarea id="bio" name="bio" rows="10" placeholder="Enter Your Bio" ></textarea>



    <label for="file-input" class="file-input-label">Upload Profile picture:</label>
        <input type="file"  id="file-input" class="file-input" name="profile_image">
    <!-- <label for="file-input" class="file-input-label"></label> -->

<br><br><br>
<button type="submit">Submit</button>
        </form>
    </div>
    <?php
    require_once "./markup_user_form_handel.php";
require_once "../error_viewing.php";
?>

</body>
</html>