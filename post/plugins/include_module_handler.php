<?php
include '../../front_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modulePath'])) {
    $modulePath = $_POST['modulePath'];
    $variables = $_POST['variables'] ?? [];
    $print = filter_var($_POST['print'] ?? false, FILTER_VALIDATE_BOOLEAN);
    
    // Sanitize inputs if needed
    // ...
    
     echo include_module("../../".$modulePath, $variables, $print);
    exit;
}

http_response_code(400);
echo 'Invalid request';