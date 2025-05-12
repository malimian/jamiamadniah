<?php
include '../../admin_connect.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    // Validate action
    $action = isset($_POST['action']) ? clean($_POST['action']) : '';
    if (!in_array($action, ['add', 'edit'])) {
        throw new Exception('Invalid action');
    }

    // Common validation for both add and edit
    $required_fields = ['attribute_name', 'attribute_label', 'attribute_type', 'template_id'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Required field '$field' is missing");
        }
    }

    $template_id = intval(clean($_POST['template_id']));
    $attribute_name = clean($_POST['attribute_name']);
    $attribute_label = clean($_POST['attribute_label']);
    $attribute_type = clean($_POST['attribute_type']);
    $is_dynamic = isset($_POST['is_dynamic']) ? intval(clean($_POST['is_dynamic'])) : 0;
    $icon_class = isset($_POST['icon_class']) ? clean($_POST['icon_class']) : '';
    $default_value = isset($_POST['default_value']) ? clean($_POST['default_value']) : '';
    $is_required = isset($_POST['is_required']) ? intval(clean($_POST['is_required'])) : 0;
    $sort_order = isset($_POST['sort_order']) ? intval(clean($_POST['sort_order'])) : 0;
    $section_name = isset($_POST['section_name']) ? clean($_POST['section_name']) : 'Main';
    $tab_id = $_POST['tab_id'];
   

    if ($action === 'add') {
        // Insert new attribute
        $sql = "INSERT INTO page_attributes (
            attribute_name, attribute_label, attribute_type, is_dynamic, 
            icon_class, default_value, is_required, sort_order, 
            section_name, template_id, tab_id
        ) VALUES (
            '" . escape($attribute_name) . "',
            '" . escape($attribute_label) . "',
            '" . escape($attribute_type) . "',
            $is_dynamic,
            '" . escape($icon_class) . "',
            '" . escape($default_value) . "',
            $is_required,
            $sort_order,
            '" . escape($section_name) . "',
            $template_id,
            " . ($tab_id ? $tab_id : 'NULL') . "
        )";
        
        $attribute_id = Insert($sql);
        if (!$attribute_id) {
            throw new Exception('Failed to create attribute');
        }
        
        $response = [
            'success' => true,
            'message' => 'Attribute created',
            'attribute_id' => $attribute_id
        ];
    } 
    elseif ($action === 'edit') {
        // Update existing attribute
        if (empty($_POST['attribute_id'])) {
            throw new Exception('Attribute ID is required for edit');
        }
        
        $attribute_id = intval(clean($_POST['attribute_id']));
        
        $sql = "UPDATE page_attributes SET
            attribute_name = '" . escape($attribute_name) . "',
            attribute_label = '" . escape($attribute_label) . "',
            attribute_type = '" . escape($attribute_type) . "',
            is_dynamic = $is_dynamic,
            icon_class = '" . escape($icon_class) . "',
            default_value = '" . escape($default_value) . "',
            is_required = $is_required,
            sort_order = $sort_order,
            section_name = '" . escape($section_name) . "',
            tab_id = " . ($tab_id ? $tab_id : 'NULL') . "
            WHERE id = $attribute_id";
        
        $affected = Update($sql);
        if ($affected === false) {
            throw new Exception('Failed to update attribute');
        }
        
        $response = [
            'success' => true,
            'message' => 'Attribute updated',
            'attribute_id' => $attribute_id
        ];
    }
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

echo json_encode($response);