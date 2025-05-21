<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
session_start();
require 'vendor/autoload.php'; // for PHPMailer
require 'config.php';          // your config with sendMail() function

// Helper: sanitize input
function clean_input($data) {
    return htmlspecialchars(trim($data));
}

// 1. Check CSRF token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('Invalid CSRF token. Please try again.');
}

// 2. Validate and sanitize inputs
$name        = clean_input($_POST['name'] ?? '');
$email       = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$countryCode = clean_input($_POST['countryCode'] ?? '');
$phone       = preg_replace('/\D+/', '', $_POST['phone'] ?? ''); // keep digits only
$message     = clean_input($_POST['message'] ?? '');

if (!$name || !$email || !$countryCode || !$phone || !$message) {
    die('Please fill in all required fields with valid information.');
}

// Validate name pattern (letters, spaces, hyphens)
if (!preg_match('/^[A-Za-z\- ]+$/', $name)) {
    die('Invalid name format.');
}

// Validate phone length (7-20 digits)
if (strlen($phone) < 7 || strlen($phone) > 20) {
    die('Invalid phone number length.');
}

// Compose email content
$emailSubject = "New Contact Form Submission from $name";
$emailBody = "
    <h2>New message from your website contact form</h2>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone:</strong> $countryCode $phone</p>
    <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
";

// Recipient email (change if needed)
$recipient = 'contact@aimainnovations.ro'; // or your preferred contact email

// Send email
if (sendMail($recipient, $emailSubject, $emailBody)) {
    echo 'Thank you for contacting us! We will get back to you shortly.';
} else {
    echo 'Oops! Something went wrong while sending your message. Please try again later.';
}
?>
<!-- Created by Pelea Raul-Daniel - Do not remove -->