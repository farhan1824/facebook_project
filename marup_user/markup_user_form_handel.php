<?php
require_once "./marup_query.php";
require_once "../session.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $username = $_POST["username"];
    $mobile_number = $_POST["mobile_number"];
    $bio = $_POST["bio"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"] ?? "Not Specified";
    $selected = "Not Specified";
    if ($gender == "Male") {
        $selected = "Male";
    } elseif ($gender == "Female") {
        $selected = "Female";
    } elseif ($gender == "Other") {
        $selected = "Other";
    }
    $profile_image = "";
    if (isset($_FILES["profile_image"]["name"])) {
        $profile_image = $_FILES["profile_image"]["name"];
        $ext = pathinfo($profile_image, PATHINFO_EXTENSION);
        $profile_image = "Food_Category" . rand(0, 999) . "." . $ext;
        $source_path = $_FILES["profile_image"]["tmp_name"];
        $destination_path = "../upload_images/" . $profile_image;
        // $destination_path = "upload_images/" . $profile_image;
        $upload = move_uploaded_file($source_path, $destination_path);
        if (!$upload) {
            $_SESSION["upload"] = "The upload of the image failed.";
            header("location:http://localhost/facebook_like_project/marup_user/markup_user.php");
            exit();
        }
    }

    try {
        if (input_empty($username, $mobile_number, $bio, $birthdate, $gender, $profile_image)) {
            $_SESSION["user_input"] = "FILL ALL THE BOXES";
            header("Location:http://localhost/facebook_like_project/marup_user/markup_user.php");
            die();
        } 
            // personal_info_input($pdo, $username, $mobile_number, $bio, $birthdate, $gender, $profile_image);
            personal_info($pdo, $username, $mobile_number, $bio, $birthdate, $gender, $profile_image);
            id_get($pdo,$id);
    } catch (PDOException $e) {
        $_SESSION["user_input"] = "Database error: " . $e->getMessage();
        header("Location:http://localhost/facebook_like_project/marup_user/markup_user.php");
        exit();
    }
}
?>
