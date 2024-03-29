<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user view</title>
    <link rel="stylesheet" href="users.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
    require_once "../pdo.php";
    require_once "../session.php";
    $query_01 = "SELECT * FROM personal_info WHERE id = (SELECT MAX(id) FROM personal_info)";
    $stmt_01 = $pdo->prepare($query_01);
    if ($stmt_01->execute()) {
        while ($results = $stmt_01->fetch(PDO::FETCH_ASSOC)) {
            $id = $results['id'];
            $username = $results['username'];
            $mobile_number = $results['mobile_number'];
            $bio = $results['bio'];
            $birthdate = $results['birthdate'];
            $gender = $results['gender'];
            $profile_image = $results['profile_image'];
    
            // echo $id,$full_name,$mobile_number,$bio,$birthdate,$gender,$profile_image;
        }
    } 
    $query_02 = "SELECT * FROM signup WHERE username=:username";
    $stmt_02 = $pdo->prepare($query_02);
    $stmt_02->bindParam(':username', $username);
    if ($stmt_02->execute()) {
        while ($final = $stmt_02->fetch(PDO::FETCH_ASSOC)) {
            $signupid = $final["id"];
            $_SESSION["signup_id"]=$signupid;
        }
    }



    ?>
<div role="tablist" class="tabs tabs-lifted bg-white">
    <!-- Tab 1 -->
    <input type="radio" name="my_tabs_2" role="tab" class="tab text-[#C76D47]" aria-label="User Info" checked/>
    <div role="tabpanel" class="tab-content bg-black border-base-300 rounded-box width_fix p-6 background">
        <section>
            <div class="personal_pic_and_bio ">
                <?php
                // Ensure $profile_image is defined with a default value
                $profile_image = isset($profile_image) ? $profile_image : '';
                if ($profile_image != "") {
                    // Add a directory separator before $profile_image
                    echo '<img src="../upload_images/' . $profile_image . '" class="shadow" alt=" " width="400px"> ';
                }
                ?>
                <div class="bio">
                    <p><?php echo $username ?></p>
                    <h4><?php echo $bio ?></h4>
                </div>
            </div>
        </section>

        <section class="shadow">
             <h1 class="pl-5 text-2xl">Personal Information</h1>
            <div class="general_information">
                <h4>Mobile Number:<?php echo $mobile_number ?></h4>
                <h4>Birthday:<?php echo $birthdate ?></h4>
                <h4>Gender:<?php echo $gender ?></h4>
            </div>
        </section>
        <!-- <a href="http://localhost/facebook_like_project/login/login.php" class="link link-success">To Delete Or Update plz login</a> -->
        <!-- <a href=""class="btn btn-active btn-secondary">Delete</a> -->
        <a href="users_delete.php?id=<?php echo $id ?>&profile_image=<?php echo $profile_image;?>"class="btn btn-active btn-secondary" >Delete</a>
        <a href="users_update.php?id=<?php echo $id ?>&profile_image=<?php echo $profile_image;?>"class="btn btn-active btn-secondary">Update</a>
        <br>
        <a href="?signout" class="btn btn-danger mt-5">signout</a>
        </div>
        <?php
    // require_once "../session.php";
    // echo "<p class='text-black'>" . $_SESSION["signup_id"] . "</p>";
  
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../session.php";
// echo "<p class='text-black'>" . $signupid . "</p>";
if (isset($_SESSION["signup_id"])) {
    echo "<p class='text-black'>" . $_SESSION["signup_id"] . "</p>";
    echo "<p class='text-black'>" . $_SESSION["signin_username"] . "</p>";

} else {
    echo "<p class='text-black'>No signup ID found in session</p>";
}

    ?>
<?php
  session_start(); // Start the session if not already started

  // Perform session unset and destroy when the user clicks on the logout link
  if(isset($_GET['signout'])) {
    session_unset();
    session_destroy();
    header("Location:http://localhost/facebook_like_project/signup/signup.php"); // Redirect to the login page after logout
    exit();
  }
?>



</div>

<section>
    <?php
    require_once "users_delete.php";
    require_once "../error_viewing.php";
    ?>
</section>
</body>
</html>