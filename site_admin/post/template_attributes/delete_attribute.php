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
    $sql = "DELETE from page_attributes WHERE id = $attribute_id";
    $affected1 = Delete($sql);

    $sql = "DELETE from page_attribute_values WHERE attribute_id = $attribute_id";
    $affected = Delete($sql);

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