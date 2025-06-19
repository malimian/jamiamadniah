<?php
include '../../admin_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $attributeId = intval(clean($_POST['id']));
    
    // Get the original attribute
    $sql = "SELECT * FROM page_attributes WHERE id = $attributeId";
    $original = return_single_row($sql);
    
    if ($original) {
        // Create a copy with "Copy of" prefix
        $newLabel = escape('Copy of ' . $original['attribute_label']);
        $newName = escape($original['attribute_name'] . '_copy_' . time());
        $originalType = escape($original['attribute_type']);
        $originalDynamic = intval($original['is_dynamic']);
        $defaultValue = escape($original['default_value']);
        $isRequired = intval($original['is_required']);
        $tabId = intval($original['tab_id']);
        $sectionName = escape($original['section_name']);
        $sortOrder = intval($original['sort_order']) + 1;
        $iconClass = escape($original['icon_class']);
        $templateId = intval($original['template_id']);
        
        $insertSql = "INSERT INTO page_attributes (
            attribute_name, attribute_label, attribute_type, is_dynamic, 
            default_value, is_required, tab_id, section_name, 
            sort_order, icon_class, template_id, isactive, soft_delete
        ) VALUES (
            '$newName', '$newLabel', '$originalType', $originalDynamic, 
            '$defaultValue', $isRequired, $tabId, '$sectionName', 
            $sortOrder, '$iconClass', $templateId, 1, 0
        )";
        
        $newId = Insert($insertSql);
        
        if ($newId) {
            //copy options too
                $optionsSql = "SELECT * FROM attribute_options WHERE attribute_id = $attributeId";
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
            
            echo json_encode(['success' => true, 'message' => 'Attribute copied successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to copy attribute']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Attribute not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}