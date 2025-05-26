<?php
$interface = 'eth0';

function getNetworkBytes($iface) {
    $data = file_get_contents("/proc/net/dev");
    if (!$data) return null;
    $lines = explode("\n", $data);
    foreach ($lines as $line) {
        if (strpos($line, $iface . ':') !== false) {
            $parts = preg_split('/\s+/', trim($line));
            // According to /proc/net/dev doc:
            // parts[1] = receive bytes, parts[9] = transmit bytes
            return [
                'rx' => (int)$parts[1],
                'tx' => (int)$parts[9],
            ];
        }
    }
    return null;
}

header('Content-Type: application/json');

$bytes = getNetworkBytes($interface);
if ($bytes === null) {
    echo json_encode(['rx' => 0, 'tx' => 0]);
    exit;
}

echo json_encode($bytes);
