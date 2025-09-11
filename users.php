<?php
$servername = "localhost";
$username = "root";       // change if needed
$password = "";           // change if needed
$dbname = "task_app";     // your DB name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, email FROM users ORDER BY name ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
</head>
<body>
    <h2>Registered Users</h2>

    <?php
    if (isset($_GET['success'])) {
        echo "<p style='color:green;'>✅ Signup successful! Welcome email sent.</p>";
    }

    if ($result && $result->num_rows > 0) {
        echo "<ol>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($row['name']) . 
                 " (" . htmlspecialchars($row['email']) . ")</li>";
        }
        echo "</ol>";
    } else {
        echo "No users found.";
    }

    $conn->close();
    ?>
</body>
</html>
