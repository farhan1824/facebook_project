<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loged In users</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="viewing_table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <!-- <th>UserName</th> -->
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "../pdo.php";
                $query = "SELECT id,user_email FROM login;";
                $stmt = $pdo->prepare($query);
                if ($stmt->execute()) {
                    $num = 1;

                    while ($results = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $id = $results["id"];
                        // $username = $results["username"];
                        $user_email = $results["user_email"];
                        ?>
                        <tr>
                            <td><?php echo $num++; ?></td>
                            <td><?php echo $user_email; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    // Handle the case where the query execution fails
                    echo "<tr><td colspan='3'>Error fetching data.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
