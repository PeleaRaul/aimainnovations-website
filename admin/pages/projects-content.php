<!-- pages/projects-content.php -->
<h1 class="text-3xl font-bold mb-6 text-blue-800">Projects</h1>

<?php if (isset($_GET['upload']) && $_GET['upload'] === 'success'): ?>
  <div id="uploadSuccess" class="absolute -top-16 right-0 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg opacity-0 translate-y-2 transition-all duration-700">
    ✅ Image uploaded successfully!
  </div>
<?php endif; ?>

<?php if (isset($deleteSuccess) && $deleteSuccess): ?>
  <div id="deleteSuccess" class="absolute -top-16 right-0 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg opacity-0 translate-y-2 transition-all duration-700">
    🗑️ Image deleted successfully!
  </div>
<?php endif; ?>

<!-- Add New Project -->
<div class="bg-white p-6 rounded-2xl shadow-md mb-6 fade-in">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">Add New Project</h2>
  <form action="/admin/pages/upload-handler.php" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Existing inputs here... -->

    <input type="file" name="project_image" accept=".png,.jpg,.jpeg,.webp,.svg"
      class="md:col-span-2 w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 shadow-sm" />

      <div class="md:col-span-2 text-right">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
          Save Project
        </button>
      </div>
  </form>
</div>

<!-- Existing Projects -->
<div class="bg-white p-6 rounded-2xl shadow-md fade-in">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">Uploaded Images</h2>
  <table class="w-full table-auto text-left border-collapse">
    <thead>
      <tr class="bg-gray-100 text-gray-700">
        <th class="p-3 font-medium">Image</th>
        <th class="p-3 font-medium">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $uploadDir = __DIR__ . '/../../assets/public/uploads/';
        $webPath = '/assets/public/uploads/';
        $imageExtensions = ['png', 'jpg', 'jpeg', 'webp', 'svg'];
        $images = [];

        foreach ($imageExtensions as $ext) {
          $images = array_merge($images, glob($uploadDir . "*.$ext"));
        }

        foreach ($images as $imgPath):
          $filename = basename($imgPath);
          $imageUrl = $webPath . $filename;
      ?>
      <tr class="border-t hover:bg-gray-50 transition">
        <td class="p-3">
          <img src="<?= $imageUrl ?>" alt="<?= $filename ?>" class="h-12 rounded shadow" />
        </td>
        <td class="p-3">
          <form action="/admin/pages/delete-handler.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
            <input type="hidden" name="filename" value="<?= htmlspecialchars($filename) ?>">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
              Delete
            </button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    const successMsg = document.getElementById('uploadSuccess');
    if (successMsg) {
      // Trigger transition
      setTimeout(() => {
        successMsg.classList.remove('opacity-0', 'translate-y-2');
        successMsg.classList.add('opacity-100', '-translate-y-2');
      }, 100); // slight delay to allow CSS to apply

      // Auto-hide after 3 seconds
      setTimeout(() => {
        successMsg.classList.remove('opacity-100', '-translate-y-2');
        successMsg.classList.add('opacity-0', '-translate-y-6');
      }, 3000);
    }
  });
</script>
