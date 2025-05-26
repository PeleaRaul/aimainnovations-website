
<?php
session_start();

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Database connection parameters
$servername = "191.96.94.5";   // usually localhost
$username = "aimainno1_root";  // your DB username
$password = "AIMAInnovations12#$";  // your DB password
$dbname = "aimainno1_website";    // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // Validate inputs
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $country_code = trim($_POST['countryCode'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!preg_match('/^[A-Za-z\- ]+$/', $name)) {
        $errors[] = "Invalid name format.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }
    if (!preg_match('/^\+\d+$/', $country_code)) {
        $errors[] = "Invalid country code.";
    }
    if (!preg_match('/^\d{7,20}$/', $phone)) {
        $errors[] = "Invalid phone number.";
    }
    if (empty($message)) {
        $errors[] = "Message cannot be empty.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO contact_submissions (name, email, country_code, phone, message, submitted_at) VALUES (?, ?, ?, ?, ?, NOW())");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("sssss", $name, $email, $country_code, $phone, $message);

        if ($stmt->execute()) {
            $success = true;
            // clear form or give success message
        } else {
            $errors[] = "Database error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!-- DO NOT EDIT THESE -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/header_module.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/loading_screen.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/cookies_module.php'; ?>

<!-- Body Landing-Page -->
<body>
<main class="font-sans text-gray-800">
<section class="bg-white py-20">
  <div class="container mx-auto px-6 max-w-6xl grid grid-cols-1 md:grid-cols-2 gap-12">
    <!-- Left: Company Info + Map -->
    <div class="space-y-8">
      <div>
        <h2 class="text-3xl font-bold text-blue-700 mb-4">Company Information</h2>
        <p class="text-gray-700 mb-2"><strong>Company Name:</strong> AIMA INNOVATIONS SRL</p>
        <p class="text-gray-700 mb-2"><strong>Address:</strong> Luna de Sus, Cluj, Romania 407281</p>
        <p class="text-gray-700 mb-2"><strong>Phone:</strong> +40 731 657 460</p>
        <p class="text-gray-700 mb-2"><strong>Email:</strong> contact@aimainnovations.ro</p>
      </div>

      <div>
        <h3 class="text-xl font-semibold text-blue-600 mb-4">Find us on the map</h3>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2820.729899128986!2d23.57314281582106!3d46.77121097911154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47490ca5cc6c3a35%3A0x9b63db6f22c9ef0b!2sCluj-Napoca%2C%20Romania!5e0!3m2!1sen!2sus!4v1695154852000!5m2!1sen!2sus"
          width="100%"
          height="300"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>
    </div>

    <!-- Right: Contact Form -->
    <div>
      <h2 class="text-4xl font-bold text-blue-700 mb-4 text-center md:text-left">Contact Us</h2>
      <div class="mb-12 h-1 w-24 bg-blue-600 rounded"></div>

      <form method="POST" class="space-y-6">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

        <div>
          <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
          <input
            type="text"
            id="name"
            name="name"
            required
            pattern="^[A-Za-z\- ]+$"
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
            placeholder="Your full name"
          />
        </div>

        <div>
          <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            required
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
            placeholder="you@example.com"
          />
        </div>

        <div>
          <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone Number</label>
          <div class="flex">
            <select
              id="countryCode"
              name="countryCode"
              style="width: 90px;"
              class="rounded-l-md border border-r-0 border-gray-300 bg-white px-2 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
              aria-label="Country code"
            >
              <option value="+1">🇺🇸 +1 United States/Canada (NANP)</option>
                    <option value="+7">🇷🇺 +7 Russia</option>
                    <option value="+20">🇪🇬 +20 Egypt</option>
                    <option value="+27">🇿🇦 +27 South Africa</option>
                    <option value="+30">🇬🇷 +30 Greece</option>
                    <option value="+31">🇳🇱 +31 Netherlands</option>
                    <option value="+32">🇧🇪 +32 Belgium</option>
                    <option value="+33">🇫🇷 +33 France</option>
                    <option value="+34">🇪🇸 +34 Spain</option>
                    <option value="+36">🇭🇺 +36 Hungary</option>
                    <option value="+39">🇮🇹 +39 Italy</option>
                    <option value="+40">🇷🇴 +40 Romania</option>
                    <option value="+41">🇨🇭 +41 Switzerland</option>
                    <option value="+43">🇦🇹 +43 Austria</option>
                    <option value="+44">🇬🇧 +44 United Kingdom</option>
                    <option value="+45">🇩🇰 +45 Denmark</option>
                    <option value="+46">🇸🇪 +46 Sweden</option>
                    <option value="+47">🇳🇴 +47 Norway</option>
                    <option value="+48">🇵🇱 +48 Poland</option>
                    <option value="+49">🇩🇪 +49 Germany</option>
                    <option value="+51">🇵🇪 +51 Peru</option>
                    <option value="+52">🇲🇽 +52 Mexico</option>
                    <option value="+53">🇨🇺 +53 Cuba</option>
                    <option value="+54">🇦🇷 +54 Argentina</option>
                    <option value="+55">🇧🇷 +55 Brazil</option>
                    <option value="+56">🇨🇱 +56 Chile</option>
                    <option value="+57">🇨🇴 +57 Colombia</option>
                    <option value="+58">🇻🇪 +58 Venezuela</option>
                    <option value="+60">🇲🇾 +60 Malaysia</option>
                    <option value="+61">🇦🇺 +61 Australia</option>
                    <option value="+62">🇮🇩 +62 Indonesia</option>
                    <option value="+63">🇵🇭 +63 Philippines</option>
                    <option value="+64">🇳🇿 +64 New Zealand</option>
                    <option value="+65">🇸🇬 +65 Singapore</option>
                    <option value="+66">🇹🇭 +66 Thailand</option>
                    <option value="+81">🇯🇵 +81 Japan</option>
                    <option value="+82">🇰🇷 +82 South Korea</option>
                    <option value="+84">🇻🇳 +84 Vietnam</option>
                    <option value="+86">🇨🇳 +86 China</option>
                    <option value="+90">🇹🇷 +90 Turkey</option>
                    <option value="+91">🇮🇳 +91 India</option>
                    <option value="+92">🇵🇰 +92 Pakistan</option>
                    <option value="+93">🇦🇫 +93 Afghanistan</option>
                    <option value="+94">🇱🇰 +94 Sri Lanka</option>
                    <option value="+95">🇲🇲 +95 Myanmar (Burma)</option>
                    <option value="+98">🇮🇷 +98 Iran</option>
                    <option value="+211">🇸🇸 +211 South Sudan</option>
                    <option value="+212">🇲🇦 +212 Morocco</option>
                    <option value="+213">🇩🇿 +213 Algeria</option>
                    <option value="+216">🇹🇳 +216 Tunisia</option>
                    <option value="+218">🇱🇾 +218 Libya</option>
                    <option value="+220">🇬🇲 +220 Gambia</option>
                    <option value="+221">🇸🇳 +221 Senegal</option>
                    <option value="+222">🇲🇷 +222 Mauritania</option>
                    <option value="+223">🇲🇱 +223 Mali</option>
                    <option value="+224">🇬🇳 +224 Guinea</option>
                    <option value="+225">🇨🇮 +225 Côte d'Ivoire</option>
                    <option value="+226">🇧🇫 +226 Burkina Faso</option>
                    <option value="+227">🇳🇪 +227 Niger</option>
                    <option value="+228">🇹🇬 +228 Togo</option>
                    <option value="+229">🇧🇯 +229 Benin</option>
                    <option value="+230">🇲🇺 +230 Mauritius</option>
                    <option value="+231">🇱🇷 +231 Liberia</option>
                    <option value="+232">🇸🇱 +232 Sierra Leone</option>
                    <option value="+233">🇬🇭 +233 Ghana</option>
                    <option value="+234">🇳🇬 +234 Nigeria</option>
                    <option value="+235">🇹🇩 +235 Chad</option>
                    <option value="+236">🇨🇫 +236 Central African Republic</option>
                    <option value="+237">🇨🇲 +237 Cameroon</option>
                    <option value="+238">🇨🇻 +238 Cape Verde</option>
                    <option value="+239">🇸🇹 +239 São Tomé and Príncipe</option>
                    <option value="+240">🇬🇶 +240 Equatorial Guinea</option>
                    <option value="+241">🇬🇦 +241 Gabon</option>
                    <option value="+242">🇨🇬 +242 Republic of the Congo</option>
                    <option value="+243">🇨🇩 +243 Democratic Republic of the Congo</option>
                    <option value="+244">🇦🇴 +244 Angola</option>
                    <option value="+245">🇬🇼 +245 Guinea-Bissau</option>
                    <option value="+246">🇧🇱 +246 British Indian Ocean Territory</option>
                    <option value="+247">🇦🇸 +247 Ascension Island</option>
                    <option value="+248">🇸🇨 +248 Seychelles</option>
                    <option value="+249">🇸🇩 +249 Sudan</option>
                    <option value="+250">🇷🇼 +250 Rwanda</option>
                    <option value="+251">🇪🇹 +251 Ethiopia</option>
                    <option value="+252">🇸🇴 +252 Somalia</option>
                    <option value="+253">🇩🇯 +253 Djibouti</option>
                    <option value="+254">🇰🇪 +254 Kenya</option>
                    <option value="+255">🇹🇿 +255 Tanzania</option>
                    <option value="+256">🇺🇬 +256 Uganda</option>
                    <option value="+257">🇧🇮 +257 Burundi</option>
                    <option value="+258">🇲🇿 +258 Mozambique</option>
                    <option value="+260">🇿🇲 +260 Zambia</option>
                    <option value="+261">🇲🇬 +261 Madagascar</option>
                    <option value="+262">🇷🇪 +262 Réunion</option>
                    <option value="+263">🇿🇼 +263 Zimbabwe</option>
                    <option value="+264">🇳🇦 +264 Namibia</option>
                    <option value="+265">🇲🇼 +265 Malawi</option>
                    <option value="+266">🇱🇸 +266 Lesotho</option>
                    <option value="+267">🇧🇼 +267 Botswana</option>
                    <option value="+268">🇸🇿 +268 Eswatini</option>
                    <option value="+269">🇰🇲 +269 Comoros</option>
                    <option value="+290">🇸🇭 +290 Saint Helena</option>
                    <option value="+291">🇪🇷 +291 Eritrea</option>
                    <option value="+297">🇦🇼 +297 Aruba</option>
                    <option value="+298">🇫🇴 +298 Faroe Islands</option>
                    <option value="+299">🇬🇱 +299 Greenland</option>
                    <option value="+350">🇬🇮 +350 Gibraltar</option>
                    <option value="+351">🇵🇹 +351 Portugal</option>
                    <option value="+352">🇱🇺 +352 Luxembourg</option>
                    <option value="+353">🇮🇪 +353 Ireland</option>
                    <option value="+354">🇮🇸 +354 Iceland</option>
                    <option value="+355">🇦🇱 +355 Albania</option>
                    <option value="+356">🇲🇹 +356 Malta</option>
                    <option value="+357">🇨🇾 +357 Cyprus</option>
                    <option value="+358">🇫🇮 +358 Finland</option>
                    <option value="+359">🇧🇬 +359 Bulgaria</option>
                    <option value="+370">🇱🇹 +370 Lithuania</option>
                    <option value="+371">🇱🇻 +371 Latvia</option>
                    <option value="+372">🇪🇪 +372 Estonia</option>
                    <option value="+373">🇲🇩 +373 Moldova</option>
                    <option value="+374">🇦🇲 +374 Armenia</option>
                    <option value="+375">🇧🇾 +375 Belarus</option>
                    <option value="+376">🇦🇩 +376 Andorra</option>
                    <option value="+377">🇲🇨 +377 Monaco</option>
                    <option value="+378">🇸🇲 +378 San Marino</option>
                    <option value="+379">🇻🇦 +379 Vatican City</option>
                    <option value="+380">🇺🇦 +380 Ukraine</option>
                    <option value="+381">🇷🇸 +381 Serbia</option>
                    <option value="+382">🇲🇪 +382 Montenegro</option>
                    <option value="+383">🇽🇰 +383 Kosovo</option>
                    <option value="+385">🇭🇷 +385 Croatia</option>
                    <option value="+386">🇸🇮 +386 Slovenia</option>
                    <option value="+387">🇧🇦 +387 Bosnia and Herzegovina</option>
                    <option value="+389">🇲🇰 +389 North Macedonia</option>
                    <option value="+420">🇨🇿 +420 Czech Republic</option>
                    <option value="+421">🇸🇰 +421 Slovakia</option>
                    <option value="+423">🇱🇮 +423 Liechtenstein</option>
                    <option value="+500">🇫🇰 +500 Falkland Islands</option>
                    <option value="+501">🇧🇿 +501 Belize</option>
                    <option value="+502">🇬🇹 +502 Guatemala</option>
                    <option value="+503">🇸🇻 +503 El Salvador</option>
                    <option value="+504">🇭🇳 +504 Honduras</option>
                    <option value="+505">🇳🇮 +505 Nicaragua</option>
                    <option value="+506">🇨🇷 +506 Costa Rica</option>
                    <option value="+507">🇵🇦 +507 Panama</option>
                    <option value="+508">🇧🇱 +508 Saint Pierre and Miquelon</option>
                    <option value="+509">🇭🇹 +509 Haiti</option>
                    <option value="+590">🇬🇵 +590 Guadeloupe</option>
                    <option value="+591">🇧🇴 +591 Bolivia</option>
                    <option value="+592">🇬🇾 +592 Guyana</option>
                    <option value="+593">🇪🇨 +593 Ecuador</option>
                    <option value="+594">🇬🇫 +594 French Guiana</option>
                    <option value="+595">🇵🇾 +595 Paraguay</option>
                    <option value="+596">🇲🇶 +596 Martinique</option>
                    <option value="+597">🇸🇷 +597 Suriname</option>
                    <option value="+598">🇺🇾 +598 Uruguay</option>
                    <option value="+599">🇨🇼 +599 Curaçao</option>
                    <option value="+670">🇹🇱 +670 Timor-Leste</option>
                    <option value="+672">🇦🇶 +672 Australian External Territories</option>
                    <option value="+673">🇧🇳 +673 Brunei Darussalam</option>
                    <option value="+674">🇳🇷 +674 Nauru</option>
                    <option value="+675">🇵🇬 +675 Papua New Guinea</option>
                    <option value="+676">🇹🇴 +676 Tonga</option>
                    <option value="+677">🇸🇧 +677 Solomon Islands</option>
                    <option value="+678">🇻🇺 +678 Vanuatu</option>
                    <option value="+679">🇫🇯 +679 Fiji</option>
                    <option value="+680">🇵🇼 +680 Palau</option>
                    <option value="+681">🇼🇫 +681 Wallis and Futuna</option>
                    <option value="+682">🇨🇰 +682 Cook Islands</option>
                    <option value="+683">🇳🇿 +683 Niue</option>
            </select>

            <input
              type="tel"
              id="phone"
              name="phone"
              pattern="[0-9]{7,20}"
              title="Please enter a valid phone number"
              class="w-full rounded-r-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 px-4 py-3"
              placeholder="1234567890"
            />
          </div>
        </div>

        <div>
          <label for="message" class="block text-gray-700 font-semibold mb-2">Message</label>
          <textarea
            id="message"
            name="message"
            rows="5"
            required
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
            placeholder="Write your message here..."
          ></textarea>
        </div>
        <?php if ($success): ?>
  <div class="text-green-600 font-semibold mb-4">Thank you! Your message has been sent.</div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
  <div class="text-red-600 font-semibold mb-4">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
        <div class="text-center md:text-left">
          <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded shadow-lg transition">
            Send Message
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
</main>
</body>
<script>
textarea.addEventListener('keydown', (e) => {
  const allowedKeys = ['Backspace', 'ArrowLeft', 'ArrowRight', 'Delete', 'Tab', 'Enter', ' '];
  const isAllowedChar = e.key.match(/^[a-zA-Z0-9 ]$/);
  
  if (!allowedKeys.includes(e.key) && !isAllowedChar) {
    e.preventDefault();
  }
});

const phoneInput = document.getElementById('phone');

  phoneInput.addEventListener('input', () => {
    // Remove any character that's not a digit
    phoneInput.value = phoneInput.value.replace(/\D/g, '');
  });

const nameInput = document.getElementById('name');

  nameInput.addEventListener('input', () => {
    // Allow only letters, spaces, and hyphens
    nameInput.value = nameInput.value.replace(/[^A-Za-z\- ]/g, '');
  });

document.querySelectorAll('img').forEach(img => {
    img.addEventListener('dragstart', e => e.preventDefault());
  });

document.addEventListener('keydown', function(e) {
  if (e.ctrlKey) {
    const blockedKeys = ['s', 'p', 'i', 'u', 'c'];  // add keys to block (lowercase)
    const key = e.key.toLowerCase();

    if (blockedKeys.includes(key)) {
      e.preventDefault();
    }
    
    if (e.shiftKey && key === 'i') {  // block Ctrl+Shift+I (Dev Tools)
      e.preventDefault();
    }
  }
});

document.addEventListener('contextmenu', event => event.preventDefault());
</script>
<!-- DO NOT EDIT THESE -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/back_to_top_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/faq_modal_module.php'?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/modules/footer_module.php'?>
</html>