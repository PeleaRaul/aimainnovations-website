<?php
ob_start();  // Start output buffering
session_start();

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
error_log($_SERVER['DOCUMENT_ROOT'] . '/logs/error.log');

if (!isset($_SESSION['user_id'])) {
    header('Location: /admin/auth/login.php');
    exit();
}

$content = 'pages/dashboard-content.php';
include 'template.php';
?>