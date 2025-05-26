<?php
// ==========================
// CONFIGURATION FILE
// AIMA INNOVATIONS SRL
// ==========================

// --------------------------
// MANUAL CONFIGURATION VALUES
// --------------------------

// Database config
define('DB_HOST', 'yourhost');       // e.g. 'localhost'
define('DB_NAME', 'yourname');  // your DB name
define('DB_USER', 'youruser');  // your DB user
define('DB_PASS', 'yourpass');  // your DB password

// Site info
define('SITE_NAME', 'YourSiteName');  // your site name
define('SITE_URL', 'http://yoururl/'); // your site URL

// Timezone
date_default_timezone_set('Europe/Bucharest'); // manual timezone

// Root user credentials
$rootUsername = 'root';
$rootPasswordPlain = 'RootPassword';  // root password, will be hashed

// Debug and HTTPS settings (enable/disable)
$debugMode = false;      // set to true to enable error reporting and display errors
// $enforceHTTPS = true;   // set to true to force HTTPS

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
// if ($enforceHTTPS) {
//     if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
//         header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
//         exit();
//     }
// }

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
// DATABASE CONNECTION
// --------------------------
try {
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
    if ($debugMode) {
        die("Database connection failed: " . htmlspecialchars($e->getMessage()));
    } else {
        error_log("Database connection failed: " . $e->getMessage());
        die("A database error occurred. Please try again later.");
    }
}

// --------------------------
// SITE METADATA / COPYRIGHT
// --------------------------
define('COPYRIGHT_NOTICE', '© ' . date('Y') . ' ' . SITE_NAME . '. All rights reserved.');

// --------------------------
// SECURITY HEADERS
// --------------------------
header("Content-Security-Policy: 
  default-src 'self'; 
  script-src 'self' https://cdn.tailwindcss.com https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; 
  style-src 'self' https://fonts.googleapis.com https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; 
  font-src 'self' https://fonts.gstatic.com; 
  img-src 'self' data: https:; 
  connect-src 'self'; 
  object-src 'none'; 
  frame-ancestors 'self';
");

// --------------------------
// CREATE USERS TABLE & ROOT USER (if not exists)
// --------------------------
try {
    // Check if table exists
    $result = $pdo->query("SHOW TABLES LIKE 'users'")->fetch();

    if (!$result) {
        // Create table
        $createTableSQL = "
            CREATE TABLE users (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                role VARCHAR(50) DEFAULT 'user',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        $pdo->exec($createTableSQL);

        // Insert root user
        $rootPasswordHash = password_hash($rootPasswordPlain, PASSWORD_DEFAULT);

        $insertUserSQL = "INSERT INTO users (username, password, role) VALUES (:username, :password, 'root')";
        $stmt = $pdo->prepare($insertUserSQL);
        $stmt->execute([
            ':username' => $rootUsername,
            ':password' => $rootPasswordHash,
        ]);
    }
} catch (PDOException $e) {
    if ($debugMode) {
        echo "Table creation or user insertion failed: " . htmlspecialchars($e->getMessage());
    } else {
        error_log("Table creation or user insertion failed: " . $e->getMessage());
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

<!-- Created by Pelea Raul-Daniel - Do not remove -->
