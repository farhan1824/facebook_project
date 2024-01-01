<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signrd IN Users</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="viewing_table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full_Name</th>
                    <th>Birthdate</th>
                    <th>Gender</th>
                    <th>Bio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "../pdo.php";
                $query = "SELECT * FROM personal_info;";
                $stmt = $pdo->prepare($query);
                if ($stmt->execute()) {
                    $num = 1;

                    while ($results = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $id = $results["id"];
                        $Full_Name = $results["Full_Name"];
                        $birthdate = $results["birthdate"];
                        $gender = $results["gender"];
                        // $mobile_number= $results["mobile_number"];
                        $bio= $results["bio"];
                        ?>
                        <tr>
                            <td><?php echo $num++; ?></td>
                            <td><?php echo $Full_Name; ?></td>
                            <td><?php echo $birthdate; ?></td>
                            <td><?php echo $gender; ?></td>
                            <!-- <td><?php echo $mobile_number;?></td> -->
                            <td><?php echo $bio;?></td>
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
