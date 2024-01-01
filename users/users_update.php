
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="../login/login.css">
</head>
<body>
<?php
include_once "../pdo.php";
include_once "../session.php";
require_once "../error_viewing.php";

// Check if ID and image_name are set
if (isset($_GET["id"]) && isset($_GET["profile_image"])) {
    $id = $_GET["id"];
    $current_img = $_GET["profile_image"];

    $query_1 = "SELECT * FROM personal_info WHERE id=:id;";
    $stmt = $pdo->prepare($query_1);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        $rows = $stmt->rowCount();
        if ($rows == 1) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $results["id"];
            $username = $results['username'];
            $mobile_number = $results['mobile_number'];
            $bio = $results['bio'];
            $birthdate = $results['birthdate'];
            $gender = $results['gender'];
            $current_img = $results["profile_image"];
       
        } 
        else {
            header("location:http://localhost/facebook_like_project/users/users.php");
        }
    }
} else {
    header("location:http://localhost/facebook_like_project/users/users.php");
}
?>

  <div class="login-container">
        <h2>Personal Information</h2>
        <form action="" method="POST"  enctype="multipart/form-data">
        <label for="username">Full Name:</label>
    <input type="text" id="username" name="username" placeholder="Full Name" value="<?php echo $username ?>">

    <label for="birthday">Birthday:</label>
    <input type="date" id="birthday" name="birthdate" value="<?php echo $birthdate ?>">

    <label>Gender:</label>
<label for="male">
    <input type="radio" <?php if ($gender == "Male") echo "checked" ?> id="male" name="gender" value="Male"> Male
</label>
<label for="female">
    <input type="radio" <?php if ($gender == "Femal") echo "checked" ?> id="female" name="gender" value="Female"> Female
</label>
<label for="other">
    <input type="radio" <?php if ($gender == "Other") echo "checked" ?> id="other" name="gender" value="Other"> Other
</label>


    <label for="mobile_number">Mobile Number:</label>
    <input type="tel" id="mobile_number" name="mobile_number" placeholder="Mobile Number" value="<?php echo $mobile_number ?>" >


<label for="bio">Bio:</label>
    <textarea id="bio" name="bio" rows="10" placeholder="Enter Your Bio" value="<?php echo $bio ?>"></textarea>


    <h3>Current IMAGE :</h3>
    <?php
                // Ensure $profile_image is defined with a default value
                $current_img = isset($current_img) ? $current_img : '';
                if ($current_img != "") {
                    // Add a directory separator before $profile_image
                    echo '<img src="../upload_images/'. $current_img .'" class="shadow" alt=" " width="400px"> ';
                }
                ?>  
         <input type="hidden" class="" name="current_img" value="<?php echo $current_img ?>">  
         
         
   <label for="file-input" class="file-input-label">Update Profile picture:</label>
   <input type="file" id="file-input" class="file-input" name="profile_image">
   
        <input type="hidden" name="id" value="<?php echo $id; ?>">
     
<button type="submit">Update</button>
        </form>
    </div>     
</body>
</html> 
<?php
 include_once "../pdo.php";
include_once "../session.php";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $id = $_POST["id"];
        $username = $_POST["username"];
        $birthdate = $_POST["birthdate"];
        $gender = $_POST["gender"];
        $mobile_number = $_POST["mobile_number"];
        $bio =$_POST["bio"];
        $current_img =$_POST["current_img"];
       
     
    
        // Check if a new image is uploaded
        // if (isset($_FILES["profile_image"]["name"])){
        if (isset($_FILES["profile_image"]["name"])){
            $profile_image = $_FILES["profile_image"]["name"];
            if ($profile_image != "") {
                // Upload the new image
                $ext = pathinfo($profile_image, PATHINFO_EXTENSION);
                $profile_image = "sigup_users" . rand(0, 999) . "." . $ext;
                $source_path = $_FILES["profile_image"]["tmp_name"];
                $destination_path = "../upload_images/".$profile_image;
                $upload = move_uploaded_file($source_path, $destination_path);
                // Remove the existing image
                $path = "./upload_images/" . $current_img;
                $remove = unlink($path);
                if (!$remove &&!$upload) {
                    $_SESSION["failed_remove"] = "Image removal failed.";
                    header("location:http://localhost/facebook_like_project/users/users_update.php");
                    exit();
                }
            }
        } 
        else {
            // If no new file is uploaded, use the current image name
            $profile_image=$_POST["current_img"];
            // $current_img=$profile_image;
        }
    
        // Prepare and execute the update query
        $query = "UPDATE personal_info
        SET username=:username, birthdate=:birthdate, gender=:gender, mobile_number=:mobile_number, bio=:bio, profile_image=:profile_image
        WHERE id=:id";
        $stmt =$pdo->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":birthdate", $birthdate);
            $stmt->bindParam(":gender", $gender);
            $stmt->bindParam(":mobile_number", $mobile_number);
            $stmt->bindParam(":bio", $bio);
            $stmt->bindParam(":profile_image", $profile_image);

            



        if ($stmt->execute()) {
            $_SESSION["Update"] = "Successfully updated";
            header("Location:http://localhost/facebook_like_project/users/users.php");
            // header("Location:http://localhost/facebook_like_project/check.php");
            exit();
        } else {
            $_SESSION["update"] = "Failed to update";
            header("Location: http://localhost/facebook_like_project/users/users_update.php?id=$id");
            exit();
        }
    } else {
        // Redirect if the form is not submitted
        // header("location:http://localhost/facebook_like_project/users/users.php");
        exit();
    }    

