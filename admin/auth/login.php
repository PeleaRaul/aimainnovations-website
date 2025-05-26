<?php
ob_start();
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/settings/config.php';

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $errors[] = "Please enter username and password.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE username = :username LIMIT 1");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Credentials valid - set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // --- BEGIN LOG LOGIN INFO ---

                // Helper function to get client IP (handles proxies)
                function getUserIP() {
                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                        return $_SERVER['HTTP_CLIENT_IP'];
                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                        return trim($ips[0]);
                    }
                    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
                }

                $ip_address = getUserIP();

                // Optional: use geoip or other service for location; here empty string
                $location = '';

                $login_time = date('Y-m-d H:i:s');

                $insertSql = "INSERT INTO login_logs (user_id, ip_address, location, login_time) VALUES (:user_id, :ip_address, :location, :login_time)";
                $insertStmt = $pdo->prepare($insertSql);
                $insertStmt->execute([
                    ':user_id' => $user['id'],
                    ':ip_address' => $ip_address,
                    ':location' => $location,
                    ':login_time' => $login_time,
                ]);
                // --- END LOG LOGIN INFO ---

                // Redirect to admin panel home (adjust path as needed)
                header('Location: /admin/index.php');
                exit();
            } else {
                $errors[] = "Invalid username or password.";
            }
        } catch (PDOException $e) {
            $errors[] = "Database error: " . htmlspecialchars($e->getMessage());
        }
    }
}
?>
<?php
$A=['YWltYWlubm92YXRpb25zLnJv','d3d3LmFpbWFpbm5vdmF0aW9ucy5ybw=='];
$D=array_map('base64_decode',$A);
$H=strtolower($_SERVER['HTTP_HOST']??'');
if(!in_array($H,$D,true)){
    $L=base64_decode('L3BhZ2UvZXJyb3IvbGljZW5zZV9lcnJvci5waHA=');
    header('Location: '.$L);
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login - Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; }
        .login-container { max-width: 400px; margin: 100px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
        input[type=text], input[type=password] { width: 100%; padding: 10px; margin: 6px 0 12px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #007bff; border: none; color: white; font-weight: bold; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if ($errors): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <div><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input id="username" name="username" type="text" required autofocus />
            <label for="password">Password:</label>
            <input id="password" name="password" type="password" required />
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
