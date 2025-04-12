<?php 
include '../../../../admin_connect.php';

// Initialize response
$response = ['success' => false, 'message' => ''];

try {
    // Validate required fields
    if (!isset($_POST['submit_btn'])) {
        throw new Exception('Invalid request');
    }

    $section_name = escape($_POST['section_name']);
    $template_id = isset($_POST['template_id']) ? (int)$_POST['template_id'] : 0;

    // Validate section name
    if (empty($section_name)) {
        throw new Exception('Section name is required');
    }

    // Check if section already exists
    $existing = return_single_row("SELECT id FROM dynamic_sections WHERE section_name = '$section_name'");
    if ($existing) {
        throw new Exception('Section with this name already exists');
    }

    // Create new section
    $section_id = Insert("INSERT INTO dynamic_sections (section_name, template_id) VALUES ('$section_name', $template_id)");
    
    if (!$section_id) {
        throw new Exception('Failed to create section');
    }

    // Process fields
    if (!empty($_POST['fields'])) {
        foreach ($_POST['fields'] as $field) {
            $attribute_name = escape(strtolower($section_name)) . '_' . escape(strtolower($field['name']));
            $attribute_label = escape($field['label']);
            $attribute_type = escape($field['type']);
            $is_required = isset($field['required']) ? 1 : 0;
            $sort_order = (int)$field['order'];
            $tab_group = escape($field['tab_group'] ?? 'basic');
            $tab_name = escape($field['tab_name'] ?? $section_name);

            $sql = "INSERT INTO page_attributes (
                attribute_name, attribute_type, attribute_label, 
                is_required, sort_order, template_id, 
                tab_group, tab_name, isactive
            ) VALUES (
                '$attribute_name', '$attribute_type', '$attribute_label',
                $is_required, $sort_order, $template_id,
                '$tab_group', '$tab_name', 1
            )";

            if (!Insert($sql)) {
                // Rollback section creation if field insertion fails
                Delete("DELETE FROM dynamic_sections WHERE id = $section_id");
                throw new Exception("Failed to create field '{$field['label']}'");
            }
        }
    }

    $response = [
        'success' => true,
        'message' => 'Section created successfully',
        'section_id' => $section_id,
        'section_name' => $section_name
    ];

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
    
    // Log detailed error for debugging
    error_log("Error in create_section.php: " . $e->getMessage());
    error_log("POST data: " . print_r($_POST, true));
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);