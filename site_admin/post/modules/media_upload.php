<?php
include '../../admin_connect.php';

// Validate required constants are defined
if (!defined('ABSOLUTE_IMAGEPATH') || !defined('BASE_URL')) {
    header('HTTP/1.1 500 Internal Server Error');
    die('Configuration constants not defined');
}

// Base path construction
$basePath = realpath(__DIR__ . '/../../../' . ABSOLUTE_IMAGEPATH);
if ($basePath === false) {
    header('HTTP/1.1 500 Internal Server Error');
    die('Invalid base image path');
}

// Handle path from POST or GET
$subPath = '';
if (isset($_REQUEST['path'])) {
    $subPath = trim($_REQUEST['path'], '/');
}

// Full path construction
$fullPath = $basePath . ($subPath ? '/' . $subPath : '')."/";

// Verify the directory exists and is writable (for uploads/deletes)
if (!is_dir($fullPath) || !is_writable($fullPath)) {
    header('HTTP/1.1 403 Forbidden');
    die('Directory not found or not writable');
}

// File Upload Handling
if (isset($_POST['upload_image'])) {
    try {
        // Validate file upload
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('No file uploaded or upload error');
        }

        // Check if upload_image function exists
        if (!function_exists('upload_image')) {
            throw new Exception('Upload function not available');
        }

        // Upload the file
        $file_name = upload_image($fullPath , 1200, 800, 500);
        if (!$file_name) {
            throw new Exception('File upload failed');
        }

        if(!empty($subPath)){
            $file_name = ($subPath ? '/' . $subPath : '') . '/' . $file_name;
        }

        // Prepare response
        $response = [
            'file_name' => $file_name,
            'file_path' => BASE_URL . ABSOLUTE_IMAGEPATH . 
                          ($subPath ? '/' . $subPath : '') . '/' . $file_name
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;

    } catch (Exception $e) {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}

// File Deletion Handling
if (isset($_POST['delete_file_submit'])) {
    try {
        if (empty($_POST['filename'])) {
            throw new Exception('Filename not provided');
        }

        $file_name = basename($_POST['filename']); // Sanitize filename
        $target_path = $fullPath . '/' . $file_name;

        // Additional security check
        if (strpos($target_path, $basePath) !== 0) {
            throw new Exception('Invalid file location');
        }

        if (!file_exists($target_path)) {
            throw new Exception('File not found');
        }

        if (!unlink($target_path)) {
            throw new Exception('Delete operation failed');
        }

        echo "1";
        exit;

    } catch (Exception $e) {
        header('HTTP/1.1 400 Bad Request');
        echo $e->getMessage();
        exit;
    }
}

// If neither upload nor delete, return error
header('HTTP/1.1 400 Bad Request');
echo 'Invalid request';