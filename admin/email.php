<?php
ob_start(); // Start output buffering to prevent header issues
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
error_log($_SERVER['DOCUMENT_ROOT'] . '/logs/error.log');
if (!isset($_SESSION['user_id'])) {

    // Not logged in - redirect to login page

    header('Location: /admin/auth/login.php');

    exit();

}



// Define which content page to include inside the template

$content = __DIR__ . '/pages/email-content.php';



// Include the main template

include __DIR__ . '/template.php';

?>