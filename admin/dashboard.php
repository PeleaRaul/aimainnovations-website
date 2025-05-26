<?php
ob_start(); // Prevent header issues by buffering output

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
error_log($_SERVER['DOCUMENT_ROOT'] . '/logs/error.log');

require_once $_SERVER['DOCUMENT_ROOT'] . '/settings/config.php';
// Redirect to login if user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: /admin/auth/login.php');
    exit();
}

// Set the content file for the dashboard
$content = 'pages/dashboard-content.php';

// Include the main template
include 'template.php';
