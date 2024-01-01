<?php
require_once "../pdo.php";
require_once "../session.php";
$login_query = "SELECT user_email FROM login WHERE id = (SELECT MAX(id) FROM login)";
$login_stmt = $pdo->prepare($login_query);
if ($login_stmt->execute()) {
    while( $login_results = $login_stmt->fetch(PDO::FETCH_ASSOC) ){
        $login_user_email = $login_results['user_email'];
    }
    }
echo $login_user_email ;
echo "<br>";
$signup_query = "SELECT username,user_email FROM signup WHERE user_email=:user_email";
$signup_stmt = $pdo->prepare($signup_query);
if ($signup_stmt->execute([':user_email' => $login_user_email])) {
    while( $signup_results = $signup_stmt->fetch(PDO::FETCH_ASSOC) ){
        $signup_user_email = $signup_results['user_email'];
        $signup_user_name = $signup_results['username'];
    }
    }
    echo $signup_user_email;
    echo "<br>";

// echo "<br>";
    if($login_user_email == $signup_user_email){
        $personalifo_username_query = "SELECT username FROM personal_info WHERE username=:username";
        $personalifo_username_stmt = $pdo->prepare($personalifo_username_query);
        
        if ($personalifo_username_stmt) {
            if ($personalifo_username_stmt->execute([':username' => $signup_user_name])) {
                while ($personal_info_results = $personalifo_username_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $personal_ifo_username = $personal_info_results['username'];
                }
            } else {
                // Handle execute error
                echo "Error executing statement: " . print_r($personalifo_username_stmt->errorInfo(), true);
            }
        } else {
            // Handle prepare error
            echo "Error preparing statement: " . print_r($pdo->errorInfo(), true);
        }



        if ($personal_ifo_username==$signup_user_name) {

        // Fetch all information from personal_info where the username matches
        $query = "SELECT * FROM personal_info WHERE username = :username";
        $stmt = $pdo->prepare($query);

        if ($stmt->execute([':username' => $signup_user_name])) {
    $rows = $stmt->rowCount();
    if ($rows == 1) {
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $results['id'];
        $username = $results['username'];
        $birthdate = $results['birthdate'];
        $gender = $results['gender'];
        $mobile_number = $results['mobile_number'];
        $bio = $results['bio'];
        $profile_image = $results['profile_image'];

        // Output or process the retrieved information as needed
        echo "ID: $id, Username: $username, Birthdate: $birthdate, Gender: $gender, Mobile Number: $mobile_number, Bio: $bio, Profile Image: $profile_image";
    } else {
        // Handle case where no or multiple rows are found
        echo "Unexpected number of rows: $rows";
    }
} else {
    // Handle execute error
    echo "Error executing statement: " . print_r($stmt->errorInfo(), true);
}

    }
}