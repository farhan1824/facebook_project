<?php
include_once "../pdo.php";
include_once "../session.php";

if(isset($_GET["id"])&&isset($_GET["profile_image"])){
    $id=$_GET["id"];
    $profile_image=$_GET["profile_image"];
    if($profile_image!=""){
        $path="../upload_images/".$profile_image;
        $remove=unlink($path);
        if(!$remove){
            $_SESSION["image_edit"]="image is not removed";
            // echo "iamge is not removed";
            header("location:http://localhost/facebook_like_project/users/users.php");
            die();
        }
    }
    $query="DELETE FROM personal_info
    WHERE id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    if($stmt ->execute()){
        $_SESSION["account_delete"]="account is deleted";
        header("location:http://localhost/facebook_like_project/signup/signup.php");
        die();
    }
}