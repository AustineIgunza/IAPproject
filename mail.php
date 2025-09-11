<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/Plugins/PHPMailer/src/Exception.php';
require __DIR__ . '/Plugins/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/Plugins/PHPMailer/src/SMTP.php';

require 'conf.php'; //  load DB + SMTP settings

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password_raw = $_POST['password'] ?? '';

    //  Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ Invalid email address!");
    }

    //  Password validation
    if (strlen($password_raw) < 6) {
        die("❌ Password must be at least 6 characters long!");
    }

    //  Hash the password
    $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);

    //  DB connection (using $conf)
    $conn = new mysqli(
        $conf['db_host'], 
        $conf['db_user'], 
        $conf['db_pass'], 
        $conf['db_name']
    );

    if ($conn->connect_error) {
        die("DB Connection failed: " . $conn->connect_error);
    }

    //  Save user in DB
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password_hashed);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    //  Send email
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;               
        $mail->isSMTP();                                     
        $mail->Host       = $conf['smtp_host'];        
        $mail->SMTPAuth   = true;                            
        $mail->Username   = $conf['smtp_user'];        
        $mail->Password   = $conf['smtp_pass'];              
        $mail->SMTPSecure = $conf['smtp_secure'];  
        $mail->Port       = $conf['smtp_port'];                             

        $mail->setFrom($conf['smtp_user'], $conf['site_name']);
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = '🎉 Welcome to ' . $conf['site_name'] . '!';
        $mail->Body    = "Hello <b>" . htmlspecialchars($name) . "</b>,<br><br>
                          Welcome to <b>" . $conf['site_name'] . "</b>! 🎉<br>
                          We're glad to have you on board.";

        $mail->send();

        //  Redirect to user list after success
        header("Location: users.php?success=1");
        exit;
    } catch (Exception $e) {
        echo "❌ Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Please submit the form.";
}
