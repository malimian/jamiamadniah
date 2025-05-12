<?php
include '../../admin_connect.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    if (empty($_GET['id'])) {
        throw new Exception('Attribute ID is required');
    }

    $attribute_id = intval(clean($_GET['id']));

    $sql = "SELECT 
        pa.*, 
        t.tab_name,
        t.tab_group
    FROM 
        page_attributes pa
    LEFT JOIN 
        tab t ON pa.tab_id = t.id
    WHERE 
        pa.id = $attribute_id";

    $attribute = return_single_row($sql);

    if (!$attribute) {
        throw new Exception('Attribute not found');
    }

    $response = [
        'success' => true,
        'data' => $attribute
    ];
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response);