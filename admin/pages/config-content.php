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
];

// File base names
$carouselBaseNames = [
    'carousel_bg_1' => 'background1',
    'carousel_bg_2' => 'background2',
    'carousel_bg_3' => 'background3',
];

$otherBaseNames = [
    'background_image' => 'main_background',
    'logo_image' => 'logo',
    'contact_background' => 'contact-background',
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
            return $webDir . $baseName . '.' . $ext;
        }
    }
    return null;
}

// Handle delete requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_image'])) {
    $imageKey = $_POST['delete_image'];
    $allBaseNames = array_merge($carouselBaseNames, $otherBaseNames);
    if (array_key_exists($imageKey, $allBaseNames)) {
        deletePreviousFiles($uploadDir, $allBaseNames[$imageKey], $allowedTypes);
        $messages[] = "Image '$imageKey' deleted successfully.";
    } else {
        $messages[] = "Invalid image key for deletion.";
    }
}

// Handle uploads
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete_image'])) {
    foreach (array_merge($carouselBaseNames, $otherBaseNames) as $inputName => $baseName) {
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

// Get current image URLs
$carousel1Img = findImageWebPath('background1', $uploadDir, $uploadDirWeb, $allowedTypes);
$carousel2Img = findImageWebPath('background2', $uploadDir, $uploadDirWeb, $allowedTypes);
$carousel3Img = findImageWebPath('background3', $uploadDir, $uploadDirWeb, $allowedTypes);
$mainBgImg = findImageWebPath('main_background', $uploadDir, $uploadDirWeb, $allowedTypes);
$logoImg = findImageWebPath('logo', $uploadDir, $uploadDirWeb, $allowedTypes);
$contactBgImg = findImageWebPath('contact-background', $uploadDir, $uploadDirWeb, $allowedTypes);
?>

<h1 class="text-3xl font-bold mb-6 text-blue-800">Configuration</h1>

<?php if ($uploadSuccess): ?>
<div id="success-popup" class="fixed top-20 right-5 bg-green-100 text-green-800 px-6 py-3 rounded-lg shadow-lg font-semibold opacity-0 transition-opacity duration-500">
  Images uploaded successfully!
</div>
<?php endif; ?>

<?php if (!empty($messages)): ?>
<div class="mb-4 text-red-600 font-semibold">
  <?php foreach ($messages as $msg): echo htmlspecialchars($msg) . "<br>"; endforeach; ?>
</div>
<?php endif; ?>

<script>
  const popup = document.getElementById('success-popup');
  if (popup) {
    popup.style.opacity = '1';
    popup.style.transform = 'translateY(-20px)';
    setTimeout(() => {
      popup.style.opacity = '0';
      popup.style.transform = 'translateY(0)';
    }, 3500);
  }

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

<div class="flex flex-col md:flex-row h-[100vh] bg-gray-50">

  <!-- Left: Upload Form -->
  <div class="w-full md:w-1/3 overflow-y-auto p-4 md:p-10 bg-white/90 backdrop-blur-md rounded-b-3xl md:rounded-r-3xl md:rounded-bl-none shadow-xl ring-1 ring-gray-200 border border-gray-100">

    <h1 class="text-3xl font-bold mb-8 text-blue-800">Configuration</h1>

    <?php if ($uploadSuccess): ?>
    <div id="success-popup" class="mb-6 bg-green-100 text-green-800 px-6 py-3 rounded-lg shadow-lg font-semibold animate-fadeIn">
      Images uploaded successfully!
    </div>
    <?php endif; ?>

    <?php if (!empty($messages)): ?>
    <div class="mb-6 text-red-600 font-semibold">
      <?php foreach ($messages as $msg): echo htmlspecialchars($msg) . "<br>"; endforeach; ?>
    </div>
    <?php endif; ?>

    <form class="space-y-10" enctype="multipart/form-data" method="post">
      <?php
      $imageFields = [
        'carousel_bg_1' => ['label' => 'Carousel Background 1', 'icon' => 'bx bx-image', 'img' => $carousel1Img],
        'carousel_bg_2' => ['label' => 'Carousel Background 2', 'icon' => 'bx bx-image-add', 'img' => $carousel2Img],
        'carousel_bg_3' => ['label' => 'Carousel Background 3', 'icon' => 'bx bx-images', 'img' => $carousel3Img],
        'contact_background' => ['label' => 'Contact Background', 'icon' => 'bx bx-phone-call', 'img' => $contactBgImg],
        'logo_image' => ['label' => 'Logo', 'icon' => 'bx bx-id-card', 'img' => $logoImg],
      ];

      foreach ($imageFields as $name => $data):
      ?>
        <div class="flex flex-col space-y-3">
          <label class="flex items-center font-semibold text-gray-800 text-lg tracking-wide">
            <i class="<?= $data['icon'] ?> mr-3 text-blue-500 text-3xl"></i>
            <?= $data['label'] ?>
          </label>

          <div class="flex flex-col md:flex-row items-start md:items-center space-y-3 md:space-y-0 md:space-x-5">
            <?php if ($data['img']): ?>
              <div class="relative group">
                <img src="<?= htmlspecialchars($data['img']) ?>" alt="<?= $data['label'] ?>" class="w-full max-w-xs h-32 object-cover rounded-xl border border-gray-300 shadow-md transition-transform group-hover:scale-105" id="preview-<?= $name ?>" />
                
                <button
                  type="submit"
                  name="delete_image"
                  value="<?= $name ?>"
                  class="absolute top-1 right-1 bg-red-600 text-white text-xs px-2 py-1 rounded-full shadow-md hover:bg-red-700 transition focus:outline-none focus:ring-2 focus:ring-red-400"
                  onclick="return confirm('Are you sure you want to delete <?= addslashes($data['label']) ?>?')"
                >✕</button>
              </div>
            <?php else: ?>
              <img src="" alt="No image" class="w-full max-w-xs h-32 object-cover rounded-xl border border-dashed border-gray-300 shadow-sm hidden" id="preview-<?= $name ?>" />
            <?php endif; ?>

            <input
              type="file"
              name="<?= $name ?>"
              class="w-full max-w-md border border-gray-300 rounded-xl px-5 py-3 bg-gray-50 text-gray-700 shadow-inner hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 file:hover:bg-blue-200"
              onchange="previewImage(event, 'preview-<?= $name ?>')"
            />
          </div>
        </div>
      <?php endforeach; ?>

      <div class="flex justify-end mt-8">
        <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-bold px-10 py-3 rounded-xl hover:from-blue-700 hover:to-indigo-800 transition-all duration-300 shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300">
          Save Settings
        </button>
      </div>
    </form>
  </div>

  <!-- Right: Live Preview -->
  <div id="live-preview" class="w-full md:w-2/3 h-64 md:h-screen border-t md:border-t-0 md:border-l border-gray-300">
    <div class="bg-black bg-opacity-50 text-white text-xs px-3 py-1 z-10 sticky top-0">
      Live Preview: <code>/index.php</code>
    </div>
    <iframe
      src="/index.php"
      class="w-full h-full"
      sandbox="allow-same-origin allow-scripts allow-popups allow-forms"
      frameborder="0"
      loading="lazy"
      title="Live Preview"
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

<style>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
  animation: fadeIn 0.6s ease forwards;
}
</style>
