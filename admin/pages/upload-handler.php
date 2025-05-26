<?php
$uploadDir = __DIR__ . '/../../assets/public/uploads/';
$allowedTypes = ['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['project_image'])) {
    $file = $_FILES['project_image'];
    $mimeType = mime_content_type($file['tmp_name']);

    if (in_array($mimeType, $allowedTypes)) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $randomName = uniqid('img_', true) . '.' . $ext;
        $destination = $uploadDir . $randomName;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            // Redirect to projects page with success
            header("Location: /admin/projects.php?status=upload_success");
            exit;
        }
    }
}

// Redirect to projects page with failure (optional)
header("Location: /admin/projects.php?status=upload_success");
exit;
