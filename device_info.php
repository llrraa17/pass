<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

// Sanitize data
$os = htmlspecialchars($data['os'] ?? 'Unknown');
$browser = htmlspecialchars($data['browser'] ?? 'Unknown');
$resolution = htmlspecialchars($data['resolution'] ?? 'Unknown');
$deviceType = htmlspecialchars($data['deviceType'] ?? 'Unknown');
$ip = htmlspecialchars($data['ip'] ?? 'Unknown');
$location = htmlspecialchars($data['location'] ?? 'Unknown');

// Save the information to a log file (or database)
$logEntry = sprintf(
    "[%s] OS: %s, Browser: %s, Resolution: %s, Device Type: %s, IP: %s, Location: %s\n",
    date('Y-m-d H:i:s'), $os, $browser, $resolution, $deviceType, $ip, $location
);

file_put_contents('device_info.log', $logEntry, FILE_APPEND);

// Respond with success
echo json_encode(['status' => 'success']);
?>

