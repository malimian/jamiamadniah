<?php
include '../../admin_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tab_id']) && isset($_POST['original_section']) && isset($_POST['new_section'])) {
    $tabId = intval(clean($_POST['tab_id']));
    $originalSection = escape(clean($_POST['original_section']));
    $newSection = escape(clean($_POST['new_section']));
    $templateId = intval(clean($_POST['template_id']));
    $attributes = $_POST['attributes'];
    
    if (!is_array($attributes)) {
        echo json_encode(['success' => false, 'message' => 'Invalid attributes data']);
        exit;
    }
    
    try {
        
        // Copy each attribute in the section
        foreach ($attributes as $attribute) {
            if ($attribute['section_name'] === $originalSection) {
                $newLabel = escape($attribute['attribute_label'] . ' (Copy)');
                $newName = escape($attribute['attribute_name'] . '_copy_' . time());
                $attributeType = escape($attribute['attribute_type']);
                $isDynamic = intval($attribute['is_dynamic']);
                $defaultValue = escape($attribute['default_value']);
                $isRequired = intval($attribute['is_required']);
                $sortOrder = intval($attribute['sort_order']);
                $iconClass = escape($attribute['icon_class']);
                
                $insertSql = "INSERT INTO page_attributes (
                    attribute_name, attribute_label, attribute_type, is_dynamic, 
                    default_value, is_required, tab_id, section_name, 
                    sort_order, icon_class, template_id, isactive, soft_delete
                ) VALUES (
                    '$newName', '$newLabel', '$attributeType', $isDynamic, 
                    '$defaultValue', $isRequired, $tabId, '$newSection', 
                    $sortOrder, '$iconClass', $templateId, 1, 0
                )";
                
                $newId = Insert($insertSql);
                
                if ($newId) {
                    // Copy options
                        $optionsSql = "SELECT * FROM attribute_options WHERE attribute_id = " . intval($attribute['id']);
                        $options = return_multiple_rows($optionsSql);
                        
                        if ($options) {
                            foreach ($options as $option) {
                                $optionValue = escape($option['option_value']);
                                $optionLabel = escape($option['option_label']);
                                $optionOrder = intval($option['sort_order']);
                                
                                $optionSql = "INSERT INTO attribute_options 
                                    (attribute_id, option_value, option_label, sort_order) 
                                    VALUES ($newId, '$optionValue', '$optionLabel', $optionOrder)";
                                Insert($optionSql);
                            }
                        }
                }
            }
        }
        
        echo json_encode(['success' => true, 'message' => 'Section duplicated successfully']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error duplicating section: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}