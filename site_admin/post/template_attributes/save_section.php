<?php
include '../../admin_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add-section') {
    $templateId = intval(clean($_POST['template_id']));
    $tabId = intval(clean($_POST['tab_id']));
    $sectionName = escape(clean($_POST['section_name']));
    
    if (empty($sectionName)) {
        echo json_encode(['success' => false, 'message' => 'Section name is required']);
        exit;
    }
    
    // Check if section already exists for this tab
    $checkSql = "SELECT COUNT(*) as count FROM page_attributes 
                 WHERE template_id = $templateId AND tab_id = $tabId AND section_name = '$sectionName'";
    $exists = return_single_row($checkSql);
    
    if ($exists['count'] > 0) {
        echo json_encode(['success' => false, 'message' => 'Section with this name already exists']);
        exit;
    }
    
    // Create a default attribute for the section
    $attributeName = escape('section_' . strtolower(str_replace(' ', '_', $sectionName)));
    $attributeLabel = escape($sectionName . ' Section');
    
    $insertSql = "INSERT INTO page_attributes (
        attribute_name, attribute_label, attribute_type, is_dynamic, 
        default_value, is_required, tab_id, section_name, 
        sort_order, template_id, isactive, soft_delete
    ) VALUES (
        '$attributeName', '$attributeLabel', 'text', 0, '', 0, $tabId, '$sectionName', 0, $templateId, 1, 0
    )";
    
    if (Insert($insertSql)) {
        echo json_encode(['success' => true, 'message' => 'Section created successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create section']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}