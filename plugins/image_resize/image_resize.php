<?php
require_once 'ImageResizer.class.php';

ob_start();

$path = $_GET['path'] ?? '';
$width = isset($_GET['width']) && is_numeric($_GET['width']) ? (int)$_GET['width'] : null;
$height = isset($_GET['height']) && is_numeric($_GET['height']) ? (int)$_GET['height'] : null;
$extension = strtolower($_GET['ext'] ?? '');

if (!$extension || !in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
    http_response_code(400);
    exit('Invalid extension');
}

$projectRoot = str_replace('\\', '/', realpath(__DIR__ . '/../../'));
$originalImagePath = $projectRoot . '/' . $path . '.' . $extension;

if (!file_exists($originalImagePath)) {
    http_response_code(404);
    header('Content-Type: text/plain');
    echo 'Image not found at: ' . $originalImagePath;
    exit;
}

try {
    ob_clean(); // clear buffer again just in case
    $resizer = new ImageResizer($originalImagePath);
    $resizer->resize($width, $height);
    ob_clean();
    $resizer->output($extension);
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: text/plain');
    echo 'Resize error: ' . $e->getMessage();
    exit;
}
