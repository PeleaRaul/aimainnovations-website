<?php
// config.php

// Error reporting and logging (hide notices and warnings from display)
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', $_SERVER['DOCUMENT_ROOT'] . '/logs/error.log');

// Start output buffering to avoid header issues
ob_start();

// Start session if none exists yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: /admin/auth/login.php');
    exit();
}

// Define the content page to include
$content = 'pages/config-content.php';

// Include the main template
include 'template.php';
