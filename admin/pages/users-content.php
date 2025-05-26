<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/settings/config.php';

session_start(); // Ensure session is started

$messages = [];

// Handle redirect message
if (isset($_SESSION['message'])) {
    $messages[] = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Handle new user creation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Username and password are required.'];
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);

            if ($stmt->fetch()) {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Username already taken.'];
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $insert = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");

                if ($insert->execute([':username' => $username, ':password' => $passwordHash])) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'User added successfully.'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Failed to add user.'];
                }
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Database error: ' . htmlspecialchars($e->getMessage())];
        }
    }

    // Redirect to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Handle user deletion
if (isset($_GET['delete'])) {
    $deleteId = (int)$_GET['delete'];

    try {
        $stmt = $pdo->prepare("SELECT username, role FROM users WHERE id = :id");
        $stmt->execute([':id' => $deleteId]);
        $userToDelete = $stmt->fetch();

        if ($userToDelete) {
            if ($userToDelete['role'] === 'root') {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Cannot delete root user.'];
            } else {
                $del = $pdo->prepare("DELETE FROM users WHERE id = :id");
                if ($del->execute([':id' => $deleteId])) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'User deleted successfully.'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Failed to delete user.'];
                }
            }
        } else {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'User not found.'];
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Database error: ' . htmlspecialchars($e->getMessage())];
    }

    // Redirect to avoid multiple deletions on refresh
    header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
    exit;
}

// Fetch all users
try {
    $users = $pdo->query("SELECT id, username, role FROM users ORDER BY id ASC")->fetchAll();
} catch (PDOException $e) {
    $messages[] = ['type' => 'error', 'text' => 'Database error: ' . htmlspecialchars($e->getMessage())];
    $users = [];
}
?>

<h1 class="text-3xl font-bold mb-6 text-blue-800">User Management</h1>

<?php foreach ($messages as $msg): ?>
    <div class="mb-4 px-4 py-2 rounded <?= $msg['type'] === 'success' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' ?>">
        <?= $msg['text'] ?>
    </div>
<?php endforeach; ?>

<div class="bg-white p-6 rounded-2xl shadow-md mb-6 fade-in">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">Add New User</h2>
  <form method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <input name="username" type="text" placeholder="Username" required
           class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 shadow-sm" />
    <input name="password" type="password" placeholder="Password" required
           class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 shadow-sm" />
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Add User</button>
  </form>
</div>

<div class="bg-white p-6 rounded-2xl shadow-md fade-in">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">Existing Users</h2>
  <table class="w-full table-auto text-left border-collapse">
    <thead>
      <tr class="bg-gray-100 text-gray-700">
        <th class="p-3 font-medium">Username</th>
        <th class="p-3 font-medium">Role</th>
        <th class="p-3 font-medium">Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php if (empty($users)): ?>
      <tr>
        <td colspan="3" class="p-3 text-gray-600 italic">No users found.</td>
      </tr>
    <?php else: ?>
      <?php foreach ($users as $user): ?>
        <tr class="border-t hover:bg-gray-50 transition">
          <td class="p-3 text-gray-800"><?= htmlspecialchars($user['username']) ?></td>
          <td class="p-3 text-gray-800"><?= htmlspecialchars($user['role']) ?></td>
          <td class="p-3">
            <?php if ($user['role'] !== 'root'): ?>
              <a href="?delete=<?= (int)$user['id'] ?>"
                 onclick="return confirm('Are you sure you want to delete user <?= htmlspecialchars($user['username']) ?>?');"
                 class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition inline-block">Delete</a>
            <?php else: ?>
              <span class="text-gray-400 italic">Protected</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
  </table>
</div>
