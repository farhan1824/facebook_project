<?php
// markup_query.php
declare (strict_types=1);
require_once "../pdo.php";
require_once "./markup_user_form_handel.php";
// require_once "../signup/query.php";
// require_once "../signup/signup_form_handel.php";
function personal_info_input(object $pdo,string $username, $mobile_number,string $bio,string $birthdate, $gender,string $profile_image){
    $query="INSERT INTO personal_info (username,mobile_number,bio,birthdate,gender,profile_image)
    VALUES (:username,:mobile_number,:bio,:birthdate,:gender,:profile_image);";

    $stmt =$pdo->prepare($query);
    $stmt->bindparam(":username", $username);
    $stmt->bindparam(":mobile_number", $mobile_number);
    $stmt->bindparam(":bio", $bio);
    $stmt->bindparam(":birthdate", $birthdate);
    $stmt->bindparam(":gender", $gender);
    $stmt->bindparam(":profile_image", $profile_image);
    $stmt->execute();
    $query = null;
    $stmt = null;
    header("location:http://localhost/facebook_like_project/users/users.php");
}

function personal_info(object $pdo,string $username, $mobile_number,string $bio,string $birthdate, $gender,string $profile_image) {
  $query = "SELECT * FROM signup WHERE username=:username;";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(":username", $username);
  // $stmt->bindParam(":user_password", $user_password);

  if ($stmt->execute()) {
      $rows = $stmt->rowCount();
      if ($rows == 1) {
          // User exists in signup table
          // Insert into the login table
          $_SESSION["signup_error"] = "User  Available";
          personal_info_input( $pdo, $username, $mobile_number, $bio, $birthdate, $gender, $profile_image);
          // Perform login actions or redirect as needed

      } else {
          // User does not exist in signup table
          // Redirect to login page
          $_SESSION["signup_error"] = "User Not Available";
          header("Location: http://localhost/facebook_like_project/login/login.php");
          exit();
      }
  }

  $query = null;
  $stmt = null;
}
function input_empty(string $username, $mobile_number, string $bio, string $birthdate,  $gender, string $profile_image)
{
    return empty($username) || $mobile_number==0 || empty($bio) || empty($birthdate) || empty($gender) || empty($profile_image);
}
function id_get(object $pdo,int $id){
    $query="SELECT *
    FROM personal_info;";
    // $query="SELECT *
    // FROM signup;";
    $stmt = $pdo->prepare($query);
    // $stmt->bindparam();
   if( $stmt->execute()){
    $rows=$stmt->rowCount();
    if($rows>0){
      while($results= $stmt->fetch(PDO::FETCH_ASSOC) ){
        $id=$results["id"];}
      }
}

}


// function user_informations_input(object $pdo, string $username, $mobile_number, string $bio, string $birthdate, $gender, string $profile_image, $username, $user_email, $user_password)
// {
//   personal_info_input( $pdo, $username, $mobile_number, $bio, $birthdate, $gender, $profile_image);
//   user_input( $pdo , $username, $user_email, $user_password);
//     $query = "INSERT INTO user_informations (Full_Name, mobile_number, bio, birthdate, gender, profile_image, username, user_email, user_password)
//               VALUES (:Full_Name, :mobile_number, :bio, :birthdate, :gender, :profile_image, :username, :user_email, :user_password);";
//     $stmt = $pdo->prepare($query);
//     $stmt->bindParam(":Full_Name", $username);
//     $stmt->bindParam(":mobile_number", $mobile_number);
//     $stmt->bindParam(":bio", $bio);
//     $stmt->bindParam(":birthdate", $birthdate);
//     $stmt->bindParam(":gender", $gender);
//     $stmt->bindParam(":profile_image", $profile_image);
//     $stmt->bindParam(":username", $username);
//     $stmt->bindParam(":user_email", $user_email);
//     $stmt->bindParam(":user_password", $user_password);
//     $stmt->execute();
    
//     // No need to redirect here, as the redirection is handled in the user_input function
// }