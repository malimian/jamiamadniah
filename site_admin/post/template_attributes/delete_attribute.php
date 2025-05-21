<?php
include '../../admin_connect.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    if (empty($_POST['id'])) {
        throw new Exception('Attribute ID is required');
    }

    $attribute_id = intval(clean($_POST['id']));

    // Soft delete the attribute
    $sql = "UPDATE page_attributes SET soft_delete = 1 WHERE id = $attribute_id";
    $affected1 = Update($sql);

    $sql = "UPDATE page_attribute_values SET soft_delete = 1 WHERE attribute_id = $attribute_id";
    $affected = Update($sql);

    Delete("DELETE from attribute_options Where attribute_id = $attribute_id ");

    if ($affected === false || $affected1 === false ) {
        throw new Exception('Failed to delete attribute');
    }

    $response = [
        'success' => true,
        'message' => 'Attribute deleted'
    ];
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response);