<?php
// ==========================
// CONFIGURATION FILE
// AIMA INNOVATIONS SRL
// ==========================
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';  // Adjust path if you downloaded manually
// --------------------------
// CONFIGURATION EDIT AS YOU WISH
// --------------------------
$enforceHTTPS = true;
$siteTimezone = 'Europe/Bucharest';
$debugMode = true;
$dbConfig = [
    'host' => 'localhost',
    'name' => 'your_database',    // Change this
    'user' => 'your_username',    // Change this
    'pass' => 'your_password'     // Change this
];
$siteInfo = [
    'name' => 'AIMA INNOVATIONS SRL',
    'url'  => 'https://www.aimainnovations.ro/'
];
$smtpSettings = [
    'host'       => 'mail.strikes.ro',
    'port'       => 465,
    'username'   => 'admin@strikes.ro',
    'password'   => 'YOUR_SMTP_PASSWORD', // CHANGE THIS
    'fromEmail'  => 'admin@strikes.ro',
    'fromName'   => 'AIMA INNOVATIONS SRL',
    'encryption' => PHPMailer::ENCRYPTION_SMTPS, // Use SSL on port 465
];

// --------------------------
// EMAIL CONNECTION
// --------------------------

function sendMail($to, $subject, $body, $smtp = null) {
    global $smtpSettings;

    // Use custom SMTP settings if provided, else default
    $config = $smtp ?? $smtpSettings;

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $config['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['username'];
        $mail->Password   = $config['password'];
        $mail->SMTPSecure = $config['encryption'];
        $mail->Port       = $config['port'];

        // Recipients
        $mail->setFrom($config['fromEmail'], $config['fromName']);
        $mail->addAddress($to);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mail error: " . $mail->ErrorInfo);
        return false;
    }
}

// --------------------------
// ERROR REPORTING
// --------------------------

if ($debugMode) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
}

// --------------------------
// HTTPS ENFORCEMENT
// --------------------------
if ($enforceHTTPS) {
    if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
        header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        exit();
    }
}

// --------------------------
// SESSION SETTINGS
// --------------------------
session_start([
    'cookie_lifetime' => 86400,
    'cookie_httponly' => true,
    'cookie_secure' => true,
    'use_strict_mode' => true,
    'use_only_cookies' => true
]);

if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// --------------------------
// DATABASE CONFIGURATION
// --------------------------
define('DB_HOST', $dbConfig['host']);
define('DB_NAME', $dbConfig['name']);
define('DB_USER', $dbConfig['user']);
define('DB_PASS', $dbConfig['pass']);

ttry {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("A database error occurred. Please try again later.");
}

// --------------------------
// SITE METADATA / COPYRIGHT
// --------------------------
define('SITE_NAME', $siteInfo['name']);
define('SITE_URL', $siteInfo['url']);
define('COPYRIGHT_NOTICE', '© ' . date('Y') . ' ' . SITE_NAME . '. All rights reserved.');

// --------------------------
// SECURITY HEADERS
// --------------------------
header("Content-Security-Policy: 
  default-src 'self'; 
  script-src 'self' https://cdn.tailwindcss.com https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://ajax.googleapis.com https://code.jquery.com; 
  style-src 'self' 'unsafe-inline' https://unpkg.com https://fonts.googleapis.com https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://maxcdn.bootstrapcdn.com; 
  font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://maxcdn.bootstrapcdn.com https://unpkg.com; 
  img-src 'self' data: https:;
  connect-src 'self';
  object-src 'none';
  frame-ancestors 'self';");

header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");

// --------------------------
// TIMEZONE SETTING (Romania)
// --------------------------
date_default_timezone_set($siteTimezone);
?>
<!-- Created by Pelea Raul-Daniel - Do not remove -->