<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    
</body>
</html>
<?php
require_once "../pdo.php";
require_once "../session.php";
require_once "./friend_request_query.php";
$send = $_SESSION["req_send_from"];
$query = "SELECT * FROM notifications WHERE notification_to=:notification_to;";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":notification_to",$send);

// echo $btn=$_POST["request_accpet"];
if ($stmt->execute()) {
    $rows = $stmt->rowCount();
    if($rows >0){
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $msg = $result['messages']."<br>";
            echo $msg;
        }
    }
   
    // if ($result) {
    //     $msg = $result['messages'];
    // }
}


?>
