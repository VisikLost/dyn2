<?php
include 'db.php';


$info = "Showing all users in the database.";
$count = 0;
$maxUsers = 100;
$active = true;


function cleanInput($data) {
    return htmlspecialchars(trim($data));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = cleanInput($_POST["name"]);
    $age = (int)$_POST["age"];

    
    if ($name && $age > 0 && $age < 120) {
        $sql = "INSERT INTO users (name, age) VALUES ('$name', $age)";
        $conn->query($sql);
    } else {
        $info = "Please enter a valid name and age.";
    }
}


$result = $conn->query("SELECT * FROM users");


$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
        $count++;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>User List Manager</h2>
    <p><?= $info ?></p>

    <form method="post" action="">
        <input type="text" name="name" placeholder="Enter name" required>
        <input type="number" name="age" placeholder="Enter age" required>
        <input type="submit" value="Add User">
    </form>

    <h3>Users (<?= $count ?>)</h3>
    <?php
    if ($count == 0) {
        echo "<p>No users found.</p>";
    } else {
        foreach ($users as $user) {
            echo "<div class='user'><strong>" . $user['name'] . "</strong>, Age: " . $user['age'] . "</div>";
        }
    }

    if ($count > $maxUsers) {
        echo "<p>Warning: User limit exceeded!</p>";
    }
    ?>
</div>
</body>
</html>