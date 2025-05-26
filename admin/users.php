<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: /admin/auth/login.php');
    exit();
}

$content = 'pages/users-content.php';

include 'template.php';