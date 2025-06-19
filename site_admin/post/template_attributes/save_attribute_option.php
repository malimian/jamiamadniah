<?php
include '../../admin_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = clean($_POST['action']);
    $attributeId = intval(clean($_POST['attribute_id']));
    $optionValue = escape(clean($_POST['option_value']));
    $optionLabel = escape(clean($_POST['option_label']));
    $sortOrder = intval(clean($_POST['sort_order']));
    
    if ($action === 'add') {
        $sql = "INSERT INTO attribute_options 
                (attribute_id, option_value, option_label, sort_order) 
                VALUES ($attributeId, '$optionValue', '$optionLabel', $sortOrder)";
        
        if (Insert($sql)) {
            echo json_encode(['success' => true, 'message' => 'Option added successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add option']);
        }
    } 
    elseif ($action === 'edit' && isset($_POST['id'])) {
        $optionId = intval(clean($_POST['id']));
        $sql = "UPDATE attribute_options SET 
                option_value = '$optionValue', 
                option_label = '$optionLabel', 
                sort_order = $sortOrder 
                WHERE id = $optionId";
        
        if (Update($sql)) {
            echo json_encode(['success' => true, 'message' => 'Option updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update option']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}