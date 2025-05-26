<?php
header('Content-Type: application/json');

$load = sys_getloadavg();
$cores = (int)trim(shell_exec('nproc'));

echo json_encode([
  'load1' => $load[0],
  'cores' => $cores,
]);
