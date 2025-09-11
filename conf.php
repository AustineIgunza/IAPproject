<?php
// Site timezone
$conf['site_timezone'] = 'Africa/Nairobi';

// Site information
$conf['site_name'] = 'Austine';
$conf['site_url'] = 'http://localhost/IAPproject';
$conf['admin_email'] = 'mmattaigunza@gmail.com';

// Site language
$conf['site_lang'] = 'en';

// Database configuration (mysqli)
$conf['db_host'] = 'localhost';
$conf['db_user'] = 'root';         // your phpMyAdmin username
$conf['db_pass'] = '';             // your phpMyAdmin password (empty by default on XAMPP/WAMP)
$conf['db_name'] = 'IAPproject';   //  

// Email configuration (PHPMailer + Gmail)
$conf['mail_type'] = 'smtp'; 
$conf['smtp_host'] = 'smtp.gmail.com';
$conf['smtp_user'] = 'yourgmail@gmail.com';      // your Gmail address
$conf['smtp_pass'] = 'xxxx xxxx xxxx xxxx';      // Gmail App Password (16 characters)
$conf['smtp_port'] = 587;                        // TLS port
$conf['smtp_secure'] = 'tls';                    // encryption
