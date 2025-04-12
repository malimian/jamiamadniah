<?php 
include '../../../../admin_connect.php';

// Initialize response
$response = ['success' => false, 'message' => ''];

try {
    // Validate required fields
    if (!isset($_POST['submit_btn']) {
        throw new Exception('Invalid request');
    }

    $section_id = (int)$_POST['section_id'];
    $page_id = (int)$_POST['page_id'] ?? 0;

    // Get section details
    $section = return_single_row("SELECT * FROM dynamic_sections WHERE id = $section_id");
    if (!$section) {
        throw new Exception('Invalid section ID');
    }

    // Get fields for this section
    $fields = return_multiple_rows("
        SELECT * FROM page_attributes 
        WHERE attribute_name LIKE '".strtolower($section['section_name'])."_%'
        AND isactive = 1
        AND (template_id IS NULL OR template_id = {$section['template_id']})
        ORDER BY sort_order
    ");

    // Prepare entry data
    $entry_data = [];
    foreach ($fields as $field) {
        $field_name = $field['attribute_name'];
        
        // Handle different field types
        if ($field['attribute_type'] === 'checkbox') {
            $value = isset($_POST[$field_name]) ? 1 : 0;
        } else {
            $value = $_POST[$field_name] ?? '';
            
            // Validate required fields
            if ($field['is_required'] && empty($value)) {
                throw new Exception("Field '{$field['attribute_label']}' is required");
            }
            
            // Sanitize based on field type
            switch ($field['attribute_type']) {
                case 'number':
                    $value = is_numeric($value) ? $value : 0;
                    break;
                case 'date':
                    if (!empty($value) && !strtotime($value)) {
                        throw new Exception("Invalid date format for '{$field['attribute_label']}'");
                    }
                    break;
                default:
                    $value = escape($value);
            }
        }
        
        $entry_data[$field_name] = $value;
    }

    // Insert the entry
    $json_data = json_encode($entry_data);
    $escaped_json = escape($json_data);
    
    $sql = "INSERT INTO section_entries 
            (section_id, page_id, entry_data) 
            VALUES ($section_id, $page_id, '$escaped_json')";
    
    $entry_id = Insert($sql);
    
    if ($entry_id) {
        $response = [
            'success' => true,
            'message' => 'Entry added successfully',
            'entry_id' => $entry_id
        ];
    } else {
        throw new Exception('Failed to add entry to database');
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
    
    // Log detailed error for debugging
    error_log("Error in add_entry.php: " . $e->getMessage());
    error_log("POST data: " . print_r($_POST, true));
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);