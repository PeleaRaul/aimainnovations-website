<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/settings/config.php';

$messages = [];
$error = '';

// Handle deletion
if (isset($_GET['delete'])) {
    $deleteId = (int) $_GET['delete'];
    try {
        $stmt = $pdo->prepare("DELETE FROM contact_submissions WHERE id = :id");
        if ($stmt->execute([':id' => $deleteId])) {
            header("Location: email-content.php"); // Redirect to prevent resubmission
            exit;
        } else {
            $error = "Failed to delete the message.";
        }
    } catch (PDOException $e) {
        $error = "Delete error: " . htmlspecialchars($e->getMessage());
    }
}

// Fetch messages
try {
    $stmt = $pdo->query("SELECT id, name, email, country_code, phone, message, submitted_at FROM contact_submissions ORDER BY submitted_at DESC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Fetch error: " . htmlspecialchars($e->getMessage());
}
?>

<h1 class="text-3xl font-bold mb-6 text-blue-800">Contact Form Messages</h1>

<?php if (!empty($error)): ?>
  <p class="mb-6 text-red-600 font-semibold"><?= $error ?></p>
<?php endif; ?>

<?php if (empty($messages)): ?>
  <p class="bg-white p-6 rounded-2xl shadow-md text-gray-700">No messages found.</p>
<?php else: ?>
  <div class="overflow-x-auto bg-white p-6 rounded-2xl shadow-md">
    <table class="min-w-full table-auto border-collapse text-sm md:text-base">
      <thead>
        <tr class="bg-gray-100 text-gray-700">
          <th class="border px-4 py-2 text-left">Name</th>
          <th class="border px-4 py-2 text-left">Email</th>
          <th class="border px-4 py-2 text-left">Phone</th>
          <th class="border px-4 py-2 text-left">Message</th>
          <th class="border px-4 py-2 text-left">Submitted At</th>
          <th class="border px-4 py-2 text-left">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($messages as $msg): ?>
          <tr class="border-t hover:bg-gray-50 transition align-top">
            <td class="border px-4 py-2"><?= htmlspecialchars($msg['name']) ?></td>
            <td class="border px-4 py-2"><?= htmlspecialchars($msg['email']) ?></td>
            <td class="border px-4 py-2"><?= htmlspecialchars($msg['country_code']) . ' ' . htmlspecialchars($msg['phone']) ?></td>
            <td class="border px-4 py-2">
              <button
                class="view-message-btn text-blue-600 hover:underline focus:outline-none"
                data-message="<?= htmlspecialchars($msg['message'], ENT_QUOTES | ENT_SUBSTITUTE) ?>"
                type="button"
              >
                View
              </button>
            </td>
            <td class="border px-4 py-2"><?= htmlspecialchars($msg['submitted_at']) ?></td>
            <td class="border px-4 py-2">
              <a href="?delete=<?= (int)$msg['id'] ?>"
                 onclick="return confirm('Are you sure you want to delete this message?');"
                 class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition"
              >
                Delete
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<!-- Modal overlay -->
<div id="modal-overlay" class="fixed inset-0 bg-black bg-opacity-70 hidden z-40"></div>

<!-- Modal container -->
<div id="message-modal" class="fixed inset-0 flex items-center justify-center p-4 hidden z-50">
  <div class="bg-white rounded-xl max-w-lg w-full max-h-[80vh] overflow-auto p-6 relative shadow-lg">
    <button
      id="modal-close-btn"
      class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 focus:outline-none text-xl font-bold"
      aria-label="Close modal"
      type="button"
    >
      &times;
    </button>
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Message</h2>
    <div id="modal-message-content" class="whitespace-pre-wrap text-gray-700"></div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('message-modal');
    const overlay = document.getElementById('modal-overlay');
    const messageContent = document.getElementById('modal-message-content');
    const closeBtn = document.getElementById('modal-close-btn');

    // Open modal when clicking on any button with class 'view-message-btn'
    document.body.addEventListener('click', function(event) {
      if (event.target.classList.contains('view-message-btn')) {
        const message = event.target.getAttribute('data-message');
        messageContent.textContent = message;
        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');
      }
    });

    // Close modal function
    function closeModal() {
      modal.classList.add('hidden');
      overlay.classList.add('hidden');
      messageContent.textContent = '';
    }

    // Close modal on clicking close button or overlay
    closeBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);

    // Optional: close modal on ESC key press
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeModal();
      }
    });
  });
</script>