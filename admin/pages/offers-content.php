<?php
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/assets/public/img/';
$uploadDirWeb = '/assets/public/img/';
$uploadSuccess = false;
$messages = [];

$allowedTypes = [
    'png' => 'image/png',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'webp' => 'image/webp',
    'svg' => 'image/svg+xml',
    'gif' => 'image/gif',
];

$offerFiles = [
    'offer1' => 'offer1',
    'offer2' => 'offer2',
    'offer3' => 'offer3',
];

function deletePreviousFiles($dir, $baseName, $allowedExts) {
    foreach ($allowedExts as $ext => $_) {
        $file = $dir . $baseName . '.' . $ext;
        if (file_exists($file)) unlink($file);
    }
}

function findImageWebPath($baseName, $dir, $webDir, $allowedExts) {
    foreach ($allowedExts as $ext => $_) {
        $fullPath = $dir . $baseName . '.' . $ext;
        if (file_exists($fullPath)) {
            // Append filemtime() as a cache-buster query param
            return $webDir . $baseName . '.' . $ext . '?v=' . filemtime($fullPath);
        }
    }
    return null;
}

// Handle uploads and deletions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($offerFiles as $inputName => $baseName) {
        // Handle deletions
        if (isset($_POST['delete_image']) && $_POST['delete_image'] === $inputName) {
            deletePreviousFiles($uploadDir, $baseName, $allowedTypes);
            $uploadSuccess = true;
            continue;
        }

        // Handle uploads
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
            $tmpFile = $_FILES[$inputName]['tmp_name'];
            $origName = $_FILES[$inputName]['name'];
            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            $mimeType = mime_content_type($tmpFile);

            if (isset($allowedTypes[$ext]) && $allowedTypes[$ext] === $mimeType) {
                deletePreviousFiles($uploadDir, $baseName, $allowedTypes);
                $targetPath = $uploadDir . $baseName . '.' . $ext;

                if (move_uploaded_file($tmpFile, $targetPath)) {
                    chmod($targetPath, 0644);
                    $uploadSuccess = true;
                } else {
                    $messages[] = "Failed to move uploaded file for $inputName.";
                }
            } else {
                $messages[] = "File type not allowed or mismatch for $inputName.";
            }
        }
    }
}

// Get current image paths with cache-busting query param
$currentImages = [];
foreach ($offerFiles as $name => $baseName) {
    $currentImages[$name] = findImageWebPath($baseName, $uploadDir, $uploadDirWeb, $allowedTypes);
}
?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8 h-screen md:h-auto">
  <!-- Left Panel: Upload Form -->
  <div class="max-w-full md:max-w-[50vw] overflow-auto p-4 md:p-6 bg-white rounded-2xl shadow-lg">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">Manage Offers</h1>

    <?php if (!empty($messages)): ?>
      <div class="mb-4 text-red-600 font-semibold">
        <?php foreach ($messages as $msg) echo htmlspecialchars($msg) . "<br>"; ?>
      </div>
    <?php endif; ?>

    <?php if ($uploadSuccess): ?>
      <div id="success-popup" class="bg-green-100 text-green-800 font-semibold px-4 py-2 rounded shadow mb-4">
        Updated successfully!
      </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="space-y-6">
      <?php foreach ($offerFiles as $name => $label): ?>
        <div class="flex flex-col">
          <label class="font-semibold text-gray-700 mb-2 capitalize"><?= htmlspecialchars($label) ?></label>
          <?php if ($currentImages[$name]): ?>
            <img src="<?= htmlspecialchars($currentImages[$name]) ?>" alt="<?= htmlspecialchars($label) ?>" class="w-full max-w-xs h-28 object-cover border rounded mb-2 shadow-sm" id="preview-<?= htmlspecialchars($name) ?>" />
            <button
              type="submit"
              name="delete_image"
              value="<?= htmlspecialchars($name) ?>"
              class="mb-2 w-fit px-4 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200 transition"
              onclick="return confirm('Are you sure you want to delete <?= addslashes($label) ?>?')"
            >
              Delete Image
            </button>
          <?php else: ?>
            <img src="" class="w-full max-w-xs h-28 object-cover border rounded mb-2 hidden" id="preview-<?= htmlspecialchars($name) ?>" />
          <?php endif; ?>
          <input
            type="file"
            name="<?= htmlspecialchars($name) ?>"
            accept="image/*"
            onchange="previewImage(event, 'preview-<?= htmlspecialchars($name) ?>')"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
          />
        </div>
      <?php endforeach; ?>

      <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-400 transition">
          Save Changes
        </button>
      </div>
    </form>
  </div>

  <!-- Right Panel: Live Preview -->
  <div class="border border-gray-200 rounded-2xl shadow-lg overflow-hidden h-[50vh] md:h-screen">
    <div class="bg-black bg-opacity-50 text-white text-xs px-3 py-1 z-10 sticky top-0">
      Live Preview: <code>/page/offers.php</code>
    </div>
    <iframe
      id="offers-preview"
      src="/page/offers.php"
      class="w-full h-full"
      frameborder="0"
      style="height: calc(100% - 2.5rem);"
    ></iframe>
  </div>
</div>

<script>
  function previewImage(event, previewId) {
    const input = event.target;
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = e => {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
