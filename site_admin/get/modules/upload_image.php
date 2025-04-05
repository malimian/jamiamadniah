<?php
include '../../admin_connect.php';
$file_arr = [];
$basePath = __DIR__ . '/../../../' . ABSOLUTE_IMAGEPATH;

// Sanitize and validate input path
$subPath = '';
if (isset($_GET['path'])) {
    $subPath = trim($_GET['path'], '/');    
    $fullPath = $basePath . $subPath;
} else {
    $fullPath = $basePath;
}

// Verify the directory exists and is readable
if (!is_dir($fullPath) || !is_readable($fullPath)) {
    header('HTTP/1.1 404 Not Found');
    die('Directory not found or inaccessible');
}

try {
    $handle = opendir($fullPath);
    if ($handle === false) {
        throw new Exception('Could not open directory');
    }

    while (($file = readdir($handle)) !== false) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $filePath = $fullPath . '/' . $file;
        
        // Skip if not a file or empty
        if (!is_file($filePath) || filesize($filePath) === 0) {
            continue;
        }

        // Verify it's an image
        if (!exif_imagetype($filePath)) {
            continue;
        }

        $imageInfo = getimagesize($filePath);
        if ($imageInfo === false) {
            continue;
        }

        // Build file data
        $fileData = [
            'file_name' => $file,
            'file_info' => $imageInfo,
            'file_path' => BASE_URL . ABSOLUTE_IMAGEPATH . 
                          ($subPath ? $subPath . '/' : '') . $file
        ];

        $file_arr[] = $fileData;
    }
    closedir($handle);

    // Set proper JSON header
    header('Content-Type: application/json');
    echo json_encode($file_arr, JSON_UNESCAPED_SLASHES);

} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    die('Error processing request: ' . $e->getMessage());
}