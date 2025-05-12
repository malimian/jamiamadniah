<?php
include '../../admin_connect.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    if (empty($_POST['id'])) {
        throw new Exception('Attribute ID is required');
    }

    $attribute_id = intval(clean($_POST['id']));

    // Check if attribute is in use
    $usage_sql = "SELECT COUNT(*) as count FROM page_attribute_values WHERE attribute_id = $attribute_id";
    $usage_count = return_single_ans($usage_sql);

    if ($usage_count > 0) {
        throw new Exception('Cannot delete attribute - it is currently in use');
    }

    // Soft delete the attribute
    $sql = "UPDATE page_attributes SET soft_delete = 1 WHERE id = $attribute_id";
    $affected = Update($sql);

    if ($affected === false) {
        throw new Exception('Failed to delete attribute');
    }

    $response = [
        'success' => true,
        'message' => 'Attribute deleted successfully'
    ];
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response);