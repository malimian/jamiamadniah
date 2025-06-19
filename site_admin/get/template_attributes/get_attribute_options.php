<?php
include '../../admin_connect.php';

if (isset($_GET['attribute_id'])) {
    $attributeId = intval(clean($_GET['attribute_id']));
    
    $sql = "SELECT * FROM attribute_options WHERE attribute_id = $attributeId ORDER BY sort_order, option_label";
    $options = return_multiple_rows($sql);
    
    if ($options) {
        echo json_encode(['success' => true, 'data' => $options]);
    } else {
        echo json_encode(['success' => true, 'data' => []]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Attribute ID not provided']);
}