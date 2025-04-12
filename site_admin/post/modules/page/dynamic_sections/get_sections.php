<?php 
include '../../../../admin_connect.php';

/**
 * Fetches all active dynamic sections with optional template filtering
 */
function get_all_sections($template_id = null) {
    $where = "WHERE isactive = 1";
    if ($template_id !== null) {
        $where .= " AND (template_id IS NULL OR template_id = " . (int)$template_id . ")";
    }
    
    return return_multiple_rows("
        SELECT id, section_name, template_id, created_at 
        FROM dynamic_sections 
        $where
        ORDER BY section_name
    ");
}

// Handle request
$response = ['success' => false, 'sections' => []];
$template_id = isset($_GET['template_id']) ? (int)$_GET['template_id'] : null;

try {
    $sections = get_all_sections($template_id);
    
    $response = [
        'success' => true,
        'sections' => $sections,
        'count' => count($sections)
    ];
    
} catch (Exception $e) {
    $response['message'] = 'Failed to load sections: ' . $e->getMessage();
    error_log("Error in get_sections.php: " . $e->getMessage());
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);