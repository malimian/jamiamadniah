<?php
include '../../admin_connect.php';

// Helper function to send JSON responses
function sendJsonResponse($data, $http_code = 200) {
    header('Content-Type: application/json');
    http_response_code($http_code);
    echo json_encode($data);
    exit;
}

// Validate required constants are defined
if (!defined('ABSOLUTE_IMAGEPATH') || !defined('BASE_URL')) {
    $errorMessage = 'Configuration constants not defined';
    error_log($errorMessage, 0);
    sendJsonResponse(['error' => $errorMessage], 500);
}

// Base path construction
$basePath = realpath(__DIR__ . '/../../../' . ABSOLUTE_IMAGEPATH);
if ($basePath === false) {
    $errorMessage = 'Invalid base image path';
    error_log($errorMessage, 0);
    sendJsonResponse(['error' => $errorMessage], 500);
}

// Handle path from POST or GET
$subPath = '';
if (isset($_REQUEST['path'])) {
    $subPath = trim($_REQUEST['path'], '/');
}

// Full path construction
$fullPath = $basePath . ($subPath ? '/' . $subPath : '') . "/";

// Verify the directory exists and is writable (for uploads/deletes)
if (!is_dir($fullPath) || !is_writable($fullPath)) {
    $errorMessage = 'Directory not found or not writable';
    error_log($errorMessage, 0);
    sendJsonResponse(['error' => $errorMessage], 403);
}

// File Upload Handling
if (isset($_POST['upload_image'])) {
    try {
        // Validate file upload
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $uploadErrors = [
                UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
                UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
                UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded.',
                UPLOAD_ERR_NO_FILE => 'No file was uploaded.',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
                UPLOAD_ERR_EXTENSION => 'File upload stopped by extension.',
                UPLOAD_ERR_OK => 'File uploaded successfully.', //This should not be used here
            ];
            $errorMessage = isset($uploadErrors[$_FILES['file']['error']])
                ? $uploadErrors[$_FILES['file']['error']]
                : 'Unknown upload error'; // Provide a default
            error_log("File upload error: " . $errorMessage, 0);
            throw new Exception($errorMessage);
        }

        // Check if upload_image function exists
        if (!function_exists('upload_image')) {
            $errorMessage = 'Upload function not available';
            error_log($errorMessage, 0);
            throw new Exception($errorMessage);
        }

        // Upload the file
        $uploadResult = upload_image($fullPath,
            1920,   // max_width: Full HD width (good balance between quality and size)
            1080,  // max_height: Full HD height
            2048,   // max_size_kb: 2MB (enough for most web images)
            85      // quality: Good quality compression (for JPEG/WebP)
        );
        error_log("upload_image result: " . print_r($uploadResult, true), 0);

        // Check for errors from upload_image
        if (is_string($uploadResult)) {
            $decodedResult = json_decode($uploadResult, true); // Decode
            if (json_last_error() === JSON_ERROR_NONE && isset($decodedResult['filename'])) {
                // It's valid JSON and has 'filename'
                $fileName = $decodedResult['filename'];
            } else if (strpos($uploadResult, 'Error') !== false || strpos($uploadResult, 'Invalid') !== false || strpos($uploadResult, 'Failed') !== false) {
                // It's an error string
                error_log("upload_image function error: " . $uploadResult, 0);
                sendJsonResponse(['error' => $uploadResult], 400);
            }
             else {
                //handle the unexpected output
                 error_log("upload_image function unexpected result: " . $uploadResult, 0);
                 sendJsonResponse(['error' => "Unexpected result from upload_image"], 500);
            }
        }
         else {
            $fileName = $uploadResult;
        }

        if (empty($fileName)) {
            $errorMessage = 'File upload failed';
            error_log($errorMessage, 0);
            throw new Exception($errorMessage);
        }
       

        if (!empty($subPath)) {
            $fileName = ($subPath ? '/' . $subPath : '') . '/' . $fileName;
        }

        // Prepare response
        $response = [
            'file_name' => $fileName,
            'file_path' => BASE_URL . ABSOLUTE_IMAGEPATH .
                ($subPath ? '/' . $subPath : '') . '/' . basename($fileName) // Use basename for consistency
        ];

        sendJsonResponse($response);

    } catch (Exception $e) {
        sendJsonResponse(['error' => $e->getMessage()], 400);
    }
}

// File Deletion Handling
if (isset($_POST['delete_file_submit'])) {
    try {
        if (empty($_POST['filename'])) {
            $errorMessage = 'Filename not provided';
            error_log($errorMessage, 0);
            throw new Exception($errorMessage);
        }

        $fileName = basename($_POST['filename']); // Sanitize filename
        $targetPath = $fullPath . '/' . $fileName;

        // Security check - ensure we're not leaving the allowed directory
        $realTargetPath = realpath($targetPath);
        if ($realTargetPath === false) {
            $errorMessage = 'File not found: realpath() failed';
            error_log($errorMessage . " Target Path: " . $targetPath . " Base Path: " . $basePath, 0);
            sendJsonResponse(['error' => $errorMessage, 'details' => [
                'target_path' => $targetPath,
                'base_path' => $basePath
            ]], 404);
        }

        if (strpos($realTargetPath, $basePath) !== 0) {
            $errorMessage = 'Invalid file location';
             error_log($errorMessage . " Real Target Path: " . $realTargetPath . " Base Path: " . $basePath, 0);
            sendJsonResponse(['error' => $errorMessage, 'details' => [
                'real_target_path' => $realTargetPath,
                'base_path' => $basePath
            ]], 403);
        }


        if (!file_exists($targetPath)) {
            $errorMessage = 'File not found';
            error_log($errorMessage . " Target Path: " . $targetPath, 0);
            sendJsonResponse(['error' => $errorMessage, 'details' => [
                'target_path' => $targetPath,
                'file_exists_check' => false
            ]], 404);
        }

        if (!unlink($targetPath)) {
            $errorMessage = 'Delete operation failed';
            error_log($errorMessage . " Target Path: " . $targetPath, 0);
            sendJsonResponse(['error' => $errorMessage], 500);
        }

        sendJsonResponse(['success' => true]);

    } catch (Exception $e) {
        sendJsonResponse(['error' => $e->getMessage()], 400);
    }
}

// If neither upload nor delete, return error
$errorMessage = 'Invalid request';
error_log($errorMessage, 0);
sendJsonResponse(['error' => $errorMessage], 400);
?>
