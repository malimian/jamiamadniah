<?php
// modules/add_product_module.php

// Get the action and page data from the parameters
$action = isset($params['action']) ? $params['action'] : 'add';
$page_id = isset($page[0]['pid']) ? $page[0]['pid'] : 0;
$site_template_id = isset($page[0]['site_template_id']) ? $page[0]['site_template_id'] : 0;

// 1. First fetch just the attributes
$attributes = return_multiple_rows("
    SELECT pa.* 
    FROM page_attributes pa
    WHERE pa.is_active = 1 
    AND (pa.site_template_id IS NULL OR pa.site_template_id = $site_template_id)
    ORDER BY pa.sort_order
");

// 2. Then fetch all options in one query
$all_options = return_multiple_rows("
    SELECT attribute_id, option_value, option_label 
    FROM attribute_options 
    ORDER BY attribute_id, sort_order
");

// Group options by attribute_id
$options_by_attribute = [];
foreach ($all_options as $option) {
    $options_by_attribute[$option['attribute_id']][] = $option;
}

// Define tabs structure
$tabs = [
    'basic' => ['name' => 'Basic Info', 'icon' => 'fa fa-info-circle'],
    'details' => ['name' => 'Details', 'icon' => 'fa fa-list-alt'],
    'shipping' => ['name' => 'Shipping & Policies', 'icon' => 'fa fa-truck'],
    'flags' => ['name' => 'Flags', 'icon' => 'fa fa-flag']
];

// Organize attributes by tab
$tab_attributes = [];
foreach ($attributes as $attr) {
    $tab_attributes[$attr['tab_group']][] = $attr;
}

// Fetch existing attribute values for this product
$attribute_values = [];
if ($page_id > 0) {
    $values = return_multiple_rows("
        SELECT attribute_id, attribute_value 
        FROM page_attribute_values 
        WHERE page_id = $page_id
    ");
    foreach ($values as $value) {
        $attribute_values[$value['attribute_id']] = $value['attribute_value'];
    }
}
?>

<div class="container mt-5">
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="productTabs" role="tablist">
        <?php foreach ($tabs as $tab_id => $tab): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $tab_id === 'basic' ? 'active' : ''; ?>" 
                   id="<?php echo $tab_id; ?>-tab" data-toggle="tab" href="#<?php echo $tab_id; ?>" 
                   role="tab" aria-controls="<?php echo $tab_id; ?>" 
                   aria-selected="<?php echo $tab_id === 'basic' ? 'true' : 'false'; ?>">
                    <i class="<?php echo $tab['icon']; ?>"></i> <?php echo $tab['name']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="productTabsContent">
        <?php foreach ($tabs as $tab_id => $tab): ?>
            <div class="tab-pane fade <?php echo $tab_id === 'basic' ? 'show active' : ''; ?>" 
                 id="<?php echo $tab_id; ?>" role="tabpanel" aria-labelledby="<?php echo $tab_id; ?>-tab">
                
                <?php if (isset($tab_attributes[$tab_id])): ?>
                    <?php foreach ($tab_attributes[$tab_id] as $attribute): 
                        $attribute_id = $attribute['id'];
                        $current_value = isset($attribute_values[$attribute_id]) ? $attribute_values[$attribute_id] : $attribute['default_value'];
                        $required = $attribute['is_required'] ? 'required' : '';
                        $icon_class = $attribute['icon_class'] ?? 'fa fa-circle';
                    ?>
                        <div class="form-group row">
                            <label for="attr_<?php echo $attribute_id; ?>" class="col-sm-2 col-form-label">
                                <?php echo htmlspecialchars($attribute['attribute_label']); ?>
                                <?php if ($required): ?>
                                    <span class="text-danger">*</span>
                                <?php endif; ?>
                            </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <?php if ($icon_class): ?>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="<?php echo $icon_class; ?>"></i></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php switch($attribute['attribute_type']):
                                        case 'text': ?>
                                            <input type="text" class="form-control" id="attr_<?php echo $attribute_id; ?>" 
                                                   name="attribute[<?php echo $attribute_id; ?>]" 
                                                   value="<?php echo htmlspecialchars($current_value); ?>" 
                                                   <?php echo $required; ?>>
                                            <?php break; ?>
                                        
                                     <?php   case 'textarea': ?>
                                            <textarea class="form-control" id="attr_<?php echo $attribute_id; ?>" 
                                                      name="attribute[<?php echo $attribute_id; ?>]" 
                                                      <?php echo $required; ?> rows="3"><?php echo htmlspecialchars($current_value); ?></textarea>
                                            <?php break; ?>
                                        
                                    <?php    case 'select': ?>
                                            <select class="form-control" id="attr_<?php echo $attribute_id; ?>" 
                                                    name="attribute[<?php echo $attribute_id; ?>]" <?php echo $required; ?>>
                                                <option value="">-- Select --</option>
                                                <?php if (isset($options_by_attribute[$attribute_id])): ?>
                                                    <?php foreach ($options_by_attribute[$attribute_id] as $option): ?>
                                                        <option value="<?php echo htmlspecialchars($option['option_value']); ?>" 
                                                            <?php echo ($current_value == $option['option_value']) ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($option['option_label']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php break; ?>
                                        
                                      <?php  case 'checkbox': ?>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" 
                                                       id="attr_<?php echo $attribute_id; ?>" 
                                                       name="attribute[<?php echo $attribute_id; ?>]" 
                                                       value="1" <?php echo ($current_value == '1') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="attr_<?php echo $attribute_id; ?>">Yes</label>
                                            </div>
                                            <?php break; ?>
                                        
                                      <?php  case 'number': ?>
                                            <input type="number" step="0.01" class="form-control" 
                                                   id="attr_<?php echo $attribute_id; ?>" 
                                                   name="attribute[<?php echo $attribute_id; ?>]" 
                                                   value="<?php echo htmlspecialchars($current_value); ?>" 
                                                   <?php echo $required; ?>>
                                            <?php break; ?>
                                        
                                       <?php case 'date': ?>
                                            <input type="date" class="form-control" id="attr_<?php echo $attribute_id; ?>" 
                                                   name="attribute[<?php echo $attribute_id; ?>]" 
                                                   value="<?php echo htmlspecialchars($current_value); ?>" 
                                                   <?php echo $required; ?>>
                                            <?php break; ?>
                                    <?php endswitch; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info">No attributes configured for this tab.</div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>