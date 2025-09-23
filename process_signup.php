<?php
require 'LoadingClass.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/Plugins/PHPMailer/src/Exception.php';
require __DIR__ . '/Plugins/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/Plugins/PHPMailer/src/SMTP.php';

try {
    // Create DB connection
    $dsn = "mysql:host={$conf['db_host']};dbname={$conf['db_name']};charset=utf8";
    $pdo = new PDO($dsn, $conf['db_user'], $conf['db_pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Capture form input
    $name     = $_POST['name'] ?? null;
    $email    = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$name || !$email || !$password) {
        die("All fields are required.");
    }

    // Hash password before saving
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into DB
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$name, $email, $hashedPassword]);

    // ---- Send Welcome Email ----
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mmattaigunza@gmail.com';   // Your Gmail
        $mail->Password   = 'ovvelzultpptubuq';         // Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('mmattaigunza@gmail.com', 'Task App');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'Welcome to Task App!';
        $mail->Body    = "
            <p>Hello <b>{$name}</b>,</p>
            <p>Thank you for signing up on <b>Task App</b>.</p>
            <p>You can now log in and start using our platform.</p>
            <br>
            <p>Regards,<br>Task App Team</p>
        ";
        $mail->AltBody = "Hello {$name},\n\nThank you for signing up on Task App.\n\nRegards,\nTask App Team";

        $mail->send();
        $msg = " User registered and welcome email sent to {$email}";
    } catch (Exception $e) {
        $msg = " User registered, but email could not be sent. Error: {$mail->ErrorInfo}";
    }

    echo $msg . " <br><a href='list_users.php'>View Users</a>";

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
