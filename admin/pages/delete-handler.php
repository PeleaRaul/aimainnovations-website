<?php
$uploadDir = __DIR__ . '/../../assets/public/uploads/';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filename'])) {
    $filename = basename($_POST['filename']); // Protect against directory traversal
    $filePath = $uploadDir . $filename;

    if (file_exists($filePath)) {
        unlink($filePath);
        header("Location: /admin/projects.php?status=delete_success");
        exit;
    }
}

// Redirect with failure (optional)
header("Location: /admin/projects.php?status=delete_failed");
exit;
