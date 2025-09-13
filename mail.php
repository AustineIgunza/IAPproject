<?php
// Show all errors during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/Plugins/PHPMailer/src/Exception.php';
require __DIR__ . '/Plugins/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/Plugins/PHPMailer/src/SMTP.php';

// --- Capture form input ---
$user_email = $_POST['email'] ?? null;
$user_name  = $_POST['name'] ?? null;

// --- Prevent direct access without form submission ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Please submit the form.");
}

// --- Validate inputs ---
if (!$user_email || !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address provided.");
}

if (!$user_name) {
    die("Name is required.");
}

$mail = new PHPMailer(true);

try {
    // Enable SMTP debugging (0 = off, 2 = detailed debug output)
    $mail->SMTPDebug  = 0; 
    $mail->Debugoutput = 'html';

    // SMTP settings for Gmail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'mmattaigunza@gmail.com';     // Gmail
    $mail->Password   = 'ovvelzultpptubuq';           // App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Email headers
    $mail->setFrom('mmattaigunza@gmail.com', 'IAPproject');
    $mail->addAddress($user_email, $user_name);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Welcome to Task App! Account Verification';
    $mail->Body    = "
        <p>Hello <b>{$user_name}</b>,</p>
        <p>You requested an account on Task App.</p>
        <p>To complete registration, please 
            <a href='http://localhost/IAPproject/verify.php?email=" . urlencode($user_email) . "'>click here</a>.
        </p>
        <br>
        <p>Regards,<br>Systems Admin<br>ICS 2.2</p>
    ";
    $mail->AltBody = "Hello {$user_name},\n\nYou requested an account on Task App.\nTo complete registration, visit: http://localhost/IAPproject/verify.php?email=" . urlencode($user_email) . "\n\nRegards,\nSystems Admin";

    // Send the email
    $mail->send();
    echo " Welcome email has been sent to {$user_email}";

} catch (Exception $e) {
    echo " Message could not be sent.<br>";
    echo "Error Info: " . $mail->ErrorInfo . "<br>";
    echo "Exception: " . $e->getMessage() . "<br>";
}
