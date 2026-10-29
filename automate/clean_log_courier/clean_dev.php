<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

date_default_timezone_set('Asia/Jakarta');

$apiUrl = 'https://devapps.dsngroup.co.id/interface_gs/api/clean-log-courier';
// $downloadBaseUrl = 'https://devapps.dsngroup.co.id/interface_gs/secure-download/dev';
$dbHost = '192.168.202.118'; // set to your dev or prod host
$maxWaitSeconds = 600; // 10 minutes
$pollInterval = 10; // seconds

try {
    // Step 1: Trigger the backup
    $postData = [
        'db_host' => $dbHost,
    ];
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 600);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $verboseLog = fopen(__DIR__ . '/curl_verbose.log', 'w');
    curl_setopt($ch, CURLOPT_STDERR, $verboseLog);

    $response = curl_exec($ch);
    if ($response === false) {
        throw new Exception('cURL error: ' . curl_error($ch));
    }
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    fclose($verboseLog);

    $decodedResponse = json_decode($response, true);
    if ($httpCode !== 200 || !$decodedResponse || !isset($decodedResponse['success']) || !$decodedResponse['success']) {
        $msg = isset($decodedResponse['message']) ? $decodedResponse['message'] : 'Unknown error';
        throw new Exception('Failed to trigger backup. HTTP Code: ' . $httpCode . '. Message: ' . $msg);
    }

    // $filename = isset($decodedResponse['filename']) ? $decodedResponse['filename'] : null;
    // if (!$filename) {
    //     throw new Exception('No filename returned from backup API.');
    // }
    $env = (strpos($filename, 'dev') !== false) ? 'dev' : 'prod';
    // $downloadUrl = $downloadBaseUrl . "/$env/$filename";
    // $backupDir = __DIR__ . "/backups/$env/";
    // if (!is_dir($backupDir)) {
    //     if (!mkdir($backupDir, 0755, true)) {
    //         throw new Exception('Failed to create backups directory: ' . $backupDir);
    //     }
    // }
    // $localFilePath = $backupDir . $filename;

    // Step 2: Poll for file availability
    $waited = 0;
    $fileAvailable = false;
    // echo "Polling for backup file: $downloadUrl\n";
    // while ($waited < $maxWaitSeconds) {
    //     $ch = curl_init($downloadUrl);
    //     curl_setopt($ch, CURLOPT_NOBODY, true);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //     curl_exec($ch);
    //     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //     curl_close($ch);
    //     if ($httpCode === 200) {
    //         $fileAvailable = true;
    //         break;
    //     }
    //     echo "[" . date('H:i:s') . "] Not ready yet, waiting $pollInterval seconds...\n";
    //     sleep($pollInterval);
    //     $waited += $pollInterval;
    // }

    // if (!$fileAvailable) {
    //     throw new Exception("Timeout: Backup file was not available after $maxWaitSeconds seconds.");
    // }

    // Step 3: Download the file
    // echo "[" . date('H:i:s') . "] File available! Downloading...\n";
    // $ch = curl_init($downloadUrl);
    // $fp = fopen($localFilePath, 'w');
    // curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 600);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    fclose($fp);

    if ($httpCode !== 200) {
        throw new Exception('Failed to clean log courier. HTTP Code: ' . $httpCode);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Clean log courier successfully.',
        'filename' => $filename,
        'local_path' => $localFilePath,
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage(),
    ]);
} 