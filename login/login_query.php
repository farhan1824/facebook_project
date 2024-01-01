<?php
declare(strict_types=1);
require_once "../pdo.php";
require_once "../session.php";
require_once "./login_form_handel.php";
function user_available(object $pdo, string $user_email, string $user_password) {
    $query = "INSERT INTO login (user_email, user_password) VALUES (:user_email, :user_password);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_email", $user_email);
    $stmt->bindParam(":user_password", $user_password);
    $stmt->execute();
    // Additional error handling if needed
    $query = null;
    $stmt = null;
}
function login_user_input(object $pdo, string $user_email, string $user_password) {
    $query = "SELECT * FROM signup WHERE user_email = :user_email AND user_password = :user_password;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_email", $user_email);
    $stmt->bindParam(":user_password", $user_password);
    if ($stmt->execute()) {
        $rows = $stmt->rowCount();
        if ($rows == 1) {
            // User exists in signup table
            // Insert into the login table
            $_SESSION["errors_login"] = "User  Available";
            user_available($pdo, $user_email, $user_password);
            // Perform login actions or redirect as needed
            // header("location:http://localhost/facebook_like_project/login_users/login_users.php");
            header("location:http://localhost/facebook_like_project/check.php");

        } else {
            $_SESSION["errors_login"] = "User Not Available";
            header("Location: http://localhost/facebook_like_project/login/login.php");
            exit();
        }
    }

    $query = null;
    $stmt = null;
    // return $user_email;
}
function mail_sent(object $pdo, string $user_email, string $user_password) {
    // Hash the password before comparing
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM signup WHERE user_email = :user_email AND user_password = :user_password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_email", $user_email);
    $stmt->bindParam(":user_password", $hashed_password);

    if ($stmt->execute()) {
        $rows = $stmt->rowCount();
        if ($rows == 1) {
            // User exists in signup table
            $_SESSION["login_status"] = "User available";
            // Insert any additional logic or function calls here

            // Perform login actions or redirect as needed
            header("Location: http://localhost/facebook_like_project/login_users/login_users.php?email=" . urlencode($user_email));
            exit();
        } else {
            // User does not exist in signup table
            $_SESSION["login_status"] = "User not available";
            header("Location: http://localhost/facebook_like_project/login/login.php");
            exit();
        }
    }

    // Handle any other scenarios or errors
    // ...

    return $user_email;
}

function empty_input(string $user_email, string $user_password){
if(empty($user_email) || empty($user_password)){
return true;
}
else{
    return false;
}
}
function email_validation(string $user_email){
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{
        return false;
    }
}




// function final_input($username, $user_email, $password)
// {
//     // Include your database connection logic (pdo.php, etc.)
//     include_once "pdo.php";

//     // Start a transaction
//     $pdo->beginTransaction();

//     try {
//         // Insert data into the signup table
//         $signupQuery = "INSERT INTO signup (username, user_email, user_password) VALUES (:username, :user_email, :	user_password)";
//         $signupStmt = $pdo->prepare($signupQuery);
//         $signupStmt->bindParam(':username', $username);
//         $signupStmt->bindParam(':user_email', $user_email);
//         $signupStmt->bindParam(':user_password', $user_password);
//         $signupStmt->execute();

//         // Insert data into the login table
//         $loginQuery = "INSERT INTO login (user_email, user_password) VALUES (:user_email, :user_password)";
//         $loginStmt = $pdo->prepare($loginQuery);
//         $loginStmt->bindParam(':user_email', $user_email);
//         $loginStmt->bindParam(':user_password', $user_password);
//         $loginStmt->execute();

//         // Insert data into the personal_info table using data from signup
//         $personalInfoQuery = "INSERT INTO personal_info (Full_Name, email, password)
//                               SELECT username, user_email, password FROM signup WHERE user_email = :user_email";
//         $personalInfoStmt = $pdo->prepare($personalInfoQuery);
//         $personalInfoStmt->bindParam(':user_email', $user_email);
//         $personalInfoStmt->execute();

//         // Commit the transaction
//         $pdo->commit();

//         echo "Data successfully inserted!";
//     } catch (PDOException $e) {
//         // An error occurred, rollback the transaction
//         $pdo->rollBack();
//         echo "Failed to insert data. Error: " . $e->getMessage();
//     }
// }

// function information_input(object $pdo, string $user_email, string $user_password){
//         $signup_query="SELECT * FROM signup WHERE user_email = :user_email AND user_password = :user_password;";
//         $stmt = $pdo->prepare($signup_query);
//         $stmt->bindParam(":user_email", $user_email);
//         $stmt->bindParam(":user_password", $user_password);
    
//         if ($stmt->execute()) {
//             $rows = $stmt->rowCount();
//             if ($rows == 1) {
//                 $personal_info_query="SELECT * FROM personal_info WHERE username=:Full_Name";
//                 $stmt = $pdo->prepare($personal_info_query);
//                 $stmt->bindParam(":user_email", $user_email);
//                 // $stmt->bindParam(":user_password", $user_password);
//                 if ($stmt->execute()) {
//                     $rows = $stmt->rowCount();
//                     if ($rows == 1) {
//                         // User exists in signup table
//                         // Insert into the login table
//                         $_SESSION["errors_login"] = "User  Available";
//                         user_available($pdo, $user_email, $user_password);
//                         // Perform login actions or redirect as needed
            
//                     } else {
//                         // User does not exist in signup table
//                         // Redirect to login page
//                         $_SESSION["errors_login"] = "User Not Available";
//                         header("Location: http://localhost/facebook_like_project/login/login.php");
//                         exit();
//                     }
//                 }
//             }
// }



// }






// function information_input(object $pdo, string $user_email, string $user_password)
// {
//     // Check if user exists in signup table
//     $signup_query = "SELECT * FROM signup WHERE user_email = :user_email AND user_password = :user_password;";
//     $stmt = $pdo->prepare($signup_query);
//     $stmt->bindParam(":user_email", $user_email);
//     $stmt->bindParam(":user_password", $user_password);

//     if ($stmt->execute()) {
//         $rows = $stmt->rowCount();
//         if ($rows == 1) {
//             // User exists in signup table
//             // Fetch corresponding information from personal_info table
//             $personal_info_query = "SELECT * FROM personal_info WHERE Full_Name = :full_name";
//             $stmt = $pdo->prepare($personal_info_query);
//             $stmt->bindParam(":full_name", $user_email); // Assuming Full_Name is the column to match

//             if ($stmt->execute()) {
//                 $rows = $stmt->rowCount();
//                 if ($rows == 1) {
//                     // User exists in personal_info table
//                     $personal_info = $stmt->fetch(PDO::FETCH_ASSOC);
//                     // Perform actions with $personal_info or redirect as needed
//                     $_SESSION["errors_login"] = "User Available";
//                     user_available($pdo, $user_email, $user_password);
//                     // Perform login actions or redirect as needed
//                 } else {
//                     // User does not exist in personal_info table
//                     $_SESSION["errors_login"] = "User Not Available";
//                     header("Location: http://localhost/facebook_like_project/login/login.php");
//                     exit();
//                 }
//             } else {
//                 // Handle the case where the personal_info query fails
//                 echo "Error executing personal_info query.";
//                 exit();
//             }
//         } else {
//             // User does not exist in signup table
//             $_SESSION["errors_login"] = "User Not Available";
//             header("Location: http://localhost/facebook_like_project/login/login.php");
//             exit();
//         }
//     } else {
//         // Handle the case where the signup query fails
//         echo "Error executing signup query.";
//         exit();
//     }
// }

// // Example usage
// $pdo = new PDO("your_database_connection_details");
// $user_email = "example@example.com";
// $user_password = "example_password";
// information_input($pdo, $user_email, $user_password);




