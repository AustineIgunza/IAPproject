<?php
require 'LoadingClass.php';

// Create instances
$layout = new Layouts();

try {
    // Create DB connection
    $dsn = "mysql:host={$conf['db_host']};dbname={$conf['db_name']};charset=utf8";
    $pdo = new PDO($dsn, $conf['db_user'], $conf['db_pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch users sorted by name
    $stmt = $pdo->query("SELECT id, name, email FROM users ORDER BY name ASC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Render page
    echo $layout->header($conf);

    echo "<h2>Registered Users</h2>";
    if ($users) {
        echo "<ol>";
        foreach ($users as $user) {
            echo "<li>{$user['name']} ({$user['email']})</li>";
        }
        echo "</ol>";
    } else {
        echo "<p>No users found.</p>";
    }

    echo $layout->footer($conf);

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
