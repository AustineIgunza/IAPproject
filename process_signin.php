<?php
require 'ClassAutoLoad.php';

try {
    $dsn = "mysql:host={$conf['db_host']};dbname={$conf['db_name']};charset=utf8";
    $pdo = new PDO($dsn, $conf['db_user'], $conf['db_pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Capture input
    $email    = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$email || !$password) {
        die("Email and password are required.");
    }

    // Check if user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        echo "✅ Login successful! Welcome, {$user['name']}.";
        echo "<br><a href='list_users.php'>View Users</a>";
    } else {
        echo "❌ Invalid email or password.";
        echo "<br><a href='signin.php'>Try Again</a>";
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
