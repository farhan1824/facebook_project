<?php
$servername ="mysql:host=localhost;dbname=facebook_like_project";
$dbname = "root";
$password = "";

try {
  $pdo = new PDO($servername, $dbname, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
<?php
// $servername ="mysql:host=localhost;dbname=signup_project" ;
// $databasename = "root";
// $databasepassword = "";

// try {
//   $pdo = new PDO($servername, $databasename, $databasepassword);
//   // set the PDO error mode to exception
//   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
// } catch(PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();
// }