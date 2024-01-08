<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_users</title>
    <link rel="stylesheet" href="../users/users.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
require_once "../pdo.php";
require_once "../session.php";
// session_start();
require_once "../error_viewing.php";
// require_once "../something.php";
$login_query = "SELECT user_email FROM login WHERE id = (SELECT MAX(id) FROM login)";
$login_stmt = $pdo->prepare($login_query);
if ($login_stmt->execute()) {
    while( $login_results = $login_stmt->fetch(PDO::FETCH_ASSOC) ){
        $login_user_email = $login_results['user_email'];
    }
    }
$signup_query = "SELECT username,user_email FROM signup WHERE user_email=:user_email";
$signup_stmt = $pdo->prepare($signup_query);
if ($signup_stmt->execute([':user_email' => $login_user_email])) {
    while( $signup_results = $signup_stmt->fetch(PDO::FETCH_ASSOC) ){
        $signup_user_email = $signup_results['user_email'];
        $signup_user_name = $signup_results['username'];
    }
    }
    if($login_user_email == $signup_user_email){

        $personalifo_username_query = "SELECT username FROM personal_info WHERE username=:username";
        $personalifo_username_stmt = $pdo->prepare($personalifo_username_query);
        if ($personalifo_username_stmt->execute([':username' => $signup_user_name])) {
            while( $personal_info_results = $personalifo_username_stmt->fetch(PDO::FETCH_ASSOC) ){
                $personalifo_username = $personal_info_results['username'];
        }
    }
    if ($signup_user_name == $personalifo_username) {
        // Fetch all information from personal_info where the username matches
        $query = "SELECT * FROM personal_info WHERE username = :username";
        $stmt = $pdo->prepare($query);

        if ($stmt->execute([':username' => $signup_user_name])) {
            $rows = $stmt->rowCount();
            if ($rows==1){
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $results['id'];
              $_SESSION["req_send_from"] = $results['id'];;
                $username = $results['username'];
                // $_SESSION["logout_username"]= $results['username'];
                $birthdate = $results['birthdate'];
                $gender = $results['gender'];
                $mobile_number = $results['mobile_number'];
                $bio = $results['bio'];
                $profile_image = $results['profile_image'];
            }
        }
    }

}
?>
<div role="tablist" class="tabs tabs-lifted bg-white">
    <!-- Tab 1 -->
    <input type="radio" name="my_tabs_2" role="tab" class="tab text-[#C76D47]" aria-label="User Info" checked/>
    <div role="tabpanel" class="tab-content bg-black border-base-300 rounded-box width_fix p-6 background">
    <!-- <button class="btn btn-primary">
  Notification
  <div class="badge">+2</div>
</button> -->
<a href="../friend_request/friend_request_notification.php" class="btn btn-primary">
Notification
  <div class="badge">+2</div>
</a>

        <section>
            <div class="personal_pic_and_bio ">
                <?php
                // Ensure $profile_image is defined with a default value
                $profile_image = isset($profile_image) ? $profile_image : '';
                if ($profile_image != "") {
                    echo '<img src="../upload_images/' . $profile_image . '" class="shadow" alt="" height="150px" width="200px">';
                }
                ?>
                <div class="bio">
                    <p><?php echo $username ?></p>
                    <h4><?php echo $bio ?></h4>
                    <!-- <h4 hidden name="sending_user_id"><?php echo $id ?></h4> -->
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
           
<!-- searching for users -->


  <form action="../friend_request/friend_request_form_handel.php" method="POST" class="flex items-center pt-5 text-black">
            <input type="text" placeholder="Search for users" name="searching_user" class="p-2 border rounded mr-2">
            <!-- <a href="friend_request_form_handel.php?id=<?php echo $id ?>" hidden></a> -->
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer">Search</button>
</form>
<!-- <form action="logout.php" method="POST">
    <button type="submit" class="btn btn-primary">Logout</button>
</form> -->
<a href="logout.php" class="btn btn-primary">Logout</a>

<?php


?>
    </section>


    </div>
</div>
</body>
</html>









