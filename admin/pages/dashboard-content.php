<?php
// dashboard-content.php - Linux version
require_once $_SERVER['DOCUMENT_ROOT'] . '/settings/config.php';
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
error_log($_SERVER['DOCUMENT_ROOT'] . '/logs/error.log');
// System Uptime
$uptime = shell_exec('uptime -p'); // e.g. "up 6 days, 18 hours, 42 minutes"

// Load Average
$load = sys_getloadavg(); // [1min,5min,15min]

// RAM Usage
$meminfo = file_get_contents('/proc/meminfo');
preg_match('/MemTotal:\s+(\d+) kB/', $meminfo, $totalMatches);
preg_match('/MemAvailable:\s+(\d+) kB/', $meminfo, $availMatches);
$totalMem = $totalMatches ? (int)$totalMatches[1] : 0;
$availMem = $availMatches ? (int)$availMatches[1] : 0;
$usedMem = $totalMem - $availMem;
$memUsagePercent = $totalMem ? ($usedMem / $totalMem) * 100 : 0;

// CPU Cores count (used in JS for CPU % calc)
$cpuCores = trim(shell_exec("nproc"));
?>
<?php
// Fetch recent login logs with usernames
$sql = "
    SELECT ll.ip_address, ll.location, ll.login_time, u.username
    FROM login_logs ll
    LEFT JOIN users u ON ll.user_id = u.id
    ORDER BY ll.login_time DESC
    LIMIT 10
";
$stmt = $pdo->query($sql);
$recentLogins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<h1 class="text-4xl font-extrabold mb-8 text-blue-800">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">

  <!-- Left 2 columns: Gauges grid -->
  <div class="md:col-span-2 grid grid-cols-3 gap-6">
    
    <div style="width: 120px; height: 120px; position: relative; margin: 0 auto;">
      <h3 class="text-xl font-semibold text-gray-900 mb-2">CPU Usage</h3>
      <canvas id="cpuGauge" width="120" height="120"></canvas>
    </div>

    <div class="bg-white rounded-3xl shadow-md p-4 hover:shadow-xl transition-shadow duration-300 flex flex-col items-center justify-center" style="height: 150px;">
      <h3 class="text-xl font-semibold text-gray-900 mb-2">RAM Usage</h3>
      <canvas id="ramGauge" width="120" height="120" style="display:block; margin:0 auto;"></canvas>
    </div>

    <div class="bg-white rounded-3xl shadow-md p-4 hover:shadow-xl transition-shadow duration-300 flex flex-col items-center justify-center" style="height: 150px;">
      <h3 class="text-xl font-semibold text-gray-900 mb-2">Live Bandwidth</h3>
      <div id="bandwidthContent" class="text-gray-700 text-center text-lg select-none mt-3">
        Loading bandwidth...
      </div>
    </div>

  </div>

  <!-- Right column: Recent Logins -->
  <div class="bg-white rounded-3xl shadow-md p-8 hover:shadow-xl transition-shadow duration-300 overflow-auto max-h-[600px]">
    <!-- Recent Logins content unchanged -->
    <div class="flex items-center mb-4">
      <div class="text-blue-600 text-4xl mr-4">
        <i class='bx bx-history'></i>
      </div>
      <h2 class="text-2xl font-semibold text-gray-900 mb-4">Recent Logins</h2>
    </div>
    <?php if (!empty($recentLogins)): ?>
      <table class="w-full text-left text-gray-700 border-collapse">
        <thead>
          <tr class="border-b border-gray-300">
            <th class="pb-2">User</th>
            <th class="pb-2">IP Address</th>
            <th class="pb-2">Location</th>
            <th class="pb-2">Date & Time</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recentLogins as $login): ?>
            <tr class="border-b border-gray-100 hover:bg-gray-50">
              <td class="py-2 font-semibold"><?= htmlspecialchars($login['username']) ?></td>
              <td class="py-2"><?= htmlspecialchars($login['ip_address']) ?></td>
              <td class="py-2"><?= htmlspecialchars($login['location'] ?? 'Unknown') ?></td>
              <td class="py-2"><?= date('Y-m-d H:i:s', strtotime($login['login_time'])) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-gray-500">No recent login data available.</p>
    <?php endif; ?>
  </div>

</div>

<!-- Chart.js and JS scripts remain the same -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
  Chart.register(ChartDataLabels);

  function createGauge(ctx, usedPercent, colors) {
  return new Chart(ctx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [usedPercent, 100 - usedPercent],
        backgroundColor: colors,
        borderWidth: 0,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      layout: {
        padding: 0
      },
      plugins: {
        legend: { display: false },
        datalabels: {
          color: 'black', // Tailwind's gray-500 hex (#6b7280)
          font: { weight: 'bold', size: 32 },
          formatter: (val, ctx) => ctx.dataIndex === 0 ? Math.round(val) + '%' : '',
          anchor: 'center',
          align: 'center',
        }
      },
      animation: {
        animateRotate: true,
        animateScale: false
      }
    },
    plugins: [ChartDataLabels],
  });
}

  // RAM gauge (static)
  const ramCtx = document.getElementById('ramGauge').getContext('2d');
  let ramGauge = createGauge(ramCtx, <?= round($memUsagePercent, 2) ?>, ['#059669', '#d1fae5']);

  // CPU gauge (dynamic)
  const cpuCtx = document.getElementById('cpuGauge').getContext('2d');
  let cpuGauge = createGauge(cpuCtx, 0, ['#2563eb', '#dbeafe']);

  async function updateCpuGauge() {
    try {
      const res = await fetch('/admin/pages/scripts/cpu_load.php');
      const data = await res.json();

      let usagePercent = Math.min(100, Math.round(data.load1 * 100 / data.cores));
      cpuGauge.data.datasets[0].data[0] = usagePercent;
      cpuGauge.data.datasets[0].data[1] = 100 - usagePercent;
      cpuGauge.update();
    } catch (err) {
      console.error('Failed to update CPU gauge:', err);
    }
  }

  updateCpuGauge();
  setInterval(updateCpuGauge, 3000);

  // Bandwidth live update text (not gauge)
  let lastRx = 0;
  let lastTx = 0;
  let lastTime = Date.now();

  async function updateBandwidth() {
    try {
      const res = await fetch('/admin/pages/scripts/bandwidth.php');
      const data = await res.json();

      const now = Date.now();
      const dt = (now - lastTime) / 1000;

      if (lastRx === 0 && lastTx === 0) {
        lastRx = data.rx;
        lastTx = data.tx;
        lastTime = now;
        document.getElementById('bandwidthContent').innerHTML = 'Calculating...';
        return;
      }

      const rxRate = (data.rx - lastRx) / dt;
      const txRate = (data.tx - lastTx) / dt;

      lastRx = data.rx;
      lastTx = data.tx;
      lastTime = now;

      const rxMbps = (rxRate * 8) / 1_000_000;
      const txMbps = (txRate * 8) / 1_000_000;

      document.getElementById('bandwidthContent').innerHTML = `
        <p class="text-green-600 font-semibold">Download: ${rxMbps.toFixed(2)} Mbps</p>
        <p class="text-blue-600 font-semibold">Upload: ${txMbps.toFixed(2)} Mbps</p>
      `;
    } catch (err) {
      console.error('Failed to update bandwidth:', err);
      document.getElementById('bandwidthContent').innerHTML = 'Error loading bandwidth';
    }
  }

  updateBandwidth();
  setInterval(updateBandwidth, 1000);
</script>
