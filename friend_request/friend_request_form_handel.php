<?php
require_once "../pdo.php";
require_once "../session.php";
require_once "./friend_request_query.php";
require_once "../error_viewing.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userinfo = $_POST["searching_user"];
    $query = "SELECT * FROM personal_info WHERE username=:searching_user;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":searching_user", $userinfo);
    if ($stmt->execute()) {
        $rows = $stmt->rowCount();
        if ($rows == 1) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $results['id'];
            $_SESSION["req_send_to"]= $results['id'];
            $username = $results['username'];
            $birthdate = $results['birthdate'];
            $gender = $results['gender'];
            $mobile_number = $results['mobile_number'];
            $bio = $results['bio'];
            $profile_image = $results['profile_image'];
        }
    }
}
 else {
    $_SESSION["user_visiblity"]="USER NOT AVAILABLE";
    header("Location: http://localhost/facebook_like_project/login_users/login_users.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>friend request</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../login/login.css">
</head>
<body>
<form action="friend_request_form_handel.php" method="POST" class="shadow-xl login-container bg-black text-white gap-5" enctype="multipart/form-data">
    <?php  if (isset($profile_image)) {
            echo '<img src="../upload_images/' . $profile_image . '" class="shadow" alt=" " width="400px"> ';
    } ?>
    <h3>id: <?php echo $id; ?></h3>
    <h3>Username: <?php echo $username; ?></h3>
    <h3>Birthday: <?php echo $birthdate; ?></h3>
    <h3>Gender: <?php echo $gender; ?></h3>
    <h3>Mobile Number: <?php echo $mobile_number; ?></h3>
    <h3>Bio: <?php echo $bio; ?></h3>
<!-- !$friend_request && -->
    <?php
$friend_request = isFriendRequestSent($pdo, $_SESSION["req_send_from"], $_SESSION["req_send_to"]);
if (!$friend_request && $id !== $_SESSION["req_send_from"]) {
    ?><button type="submit" name="friend_request_submit" class="btn btn-info">Friend Request</button><?php
    }
    if($friend_request){
        ?>
        <!-- <button type="text" class="btn btn-info">Request Already Send</button> -->
        <p class="text-xl text-white bg-cyan-500 p-2 text-center">Request Already Send</p>
        <?php
    }
    ?>
    <!-- <form action="" method="POST" class="flex">
    <button type="submit" class="btn btn-error">Reject</button>
    <button type="submit"  class="btn btn-primary">Accept</button>
    </form> -->
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["friend_request_submit"])) {
    try {
       
        $send_to = $_SESSION["req_send_to"];
        $send_from = $_SESSION["req_send_from"];
        request_send($pdo, $send_from, $send_to);



        $request_from= name_collection($pdo, $send_from);
        $request_to= name_collection($pdo,$send_to);
    $acceptButton = '<button  class="btn btn-primary">Accept</button>';
    $rejectButton = '<button class="btn btn-error">Reject</button>';
$reqsend='<form action="" method="POST" class="flex">
<button type="submit" class="btn btn-error">Reject</button>
<button type="submit"  class="btn btn-primary">Accept</button>
</form>';

    // $message = "<p class='text-xl p-5 bg-gray-600 text-stone-50 inline'>$request_from has sent you a friend request  $acceptButton $rejectButton</p>";
    $message = "<p class='text-xl p-5 bg-gray-600 text-stone-50 inline'>$request_from has sent you a friend request  $reqsend</p>";
    notification_send($pdo, $send_from, $send_to,$message);
    } catch (PDOException $e) {
        header("Location: http://localhost/facebook_like_project/login_users/login_users.php");
        exit();
    }
}
?>
</body>
</html>
