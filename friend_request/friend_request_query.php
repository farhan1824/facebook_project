<?php
require_once "../pdo.php";
require_once "../session.php";
function request_send(object $pdo,int $send_from,int $send_to){
    $query="INSERT INTO requests (sending_form,send_to)
    VALUES (:sending_form,:send_to);";
    $stmt =$pdo->prepare($query);
    $stmt->bindparam(":sending_form", $send_from);
    $stmt->bindparam(":send_to", $send_to);
    $stmt->execute();
    header("location:http://localhost/facebook_like_project/login_users/login_users.php");
}
function notification_send(object $pdo,int $send_from,int $send_to,string $message){
    $query="INSERT INTO notifications (notification_from,notification_to,messages,readed)
    VALUES (:notification_from,:notification_to,:messages,'0');";
    $stmt =$pdo->prepare($query);
    $stmt->bindparam(":notification_from", $send_from);
    $stmt->bindparam(":notification_to", $send_to);
    $stmt->bindparam(":messages", $message);
    // $stmt->bindparam(":notification_to", $send_to);
    $stmt->execute();
    header("location:http://localhost/facebook_like_project/login_users/login_users.php");
}
function name_collection(object $pdo,int $user_id){
    $query="SELECT username FROM personal_info WHERE id=:user_id ";
    $stmt =$pdo->prepare($query);
    $stmt->bindparam(":user_id", $user_id);
    $stmt->execute();
    if ($stmt->execute()) {
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result['username'];
  } else {
      // Handle the error or return a default value
      header("location:http://localhost/facebook_like_project/login_users/login_users.php");
  }
  
}
function isFriendRequestSent(object $pdo, int $send_from, int $send_to)
{
    $query = "SELECT COUNT(*) FROM requests WHERE sending_form = :send_from AND send_to = :send_to";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":send_from", $send_from);
    $stmt->bindParam(":send_to", $send_to);
    $stmt->execute();
    $rows=$stmt->fetchColumn() ;
if( $rows> 0){
    return  true; 
}
  else{
    return false;
  }  
}