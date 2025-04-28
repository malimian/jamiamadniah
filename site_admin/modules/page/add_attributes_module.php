<?php

// Get the action and page data from the parameters
$action = isset($params['action']) ? $params['action'] : 'add';
$page_id = isset($page[0]['pid']) ? $page[0]['pid'] : 0;
$template_id = isset($page[0]['template_id']) ? $page[0]['template_id'] : 0;

$isrich_textarea = false;

// 1. First fetch just the attributes
$attributes = return_multiple_rows("
    SELECT pa.* 
    FROM page_attributes pa
    WHERE pa.isactive = 1 
    AND (pa.template_id IS NULL OR pa.template_id = $template_id)
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

// Get tabs from the new tab table
$tabs = return_multiple_rows("
    SELECT * FROM tab 
    WHERE isactive = 1 
    AND soft_delete = 0 
    AND (template_id IS NULL OR template_id = $template_id)
    ORDER BY sort_order
");

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

// Check for dynamic tabs and add UI controls if needed
$has_dynamic_tabs = false;
foreach ($tabs as $tab) {
    if ($tab['is_dynamic']) {
        $has_dynamic_tabs = true;
        break;
    }
}
?>
<div class="container mt-5">
    
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="productTabs" role="tablist">
        <?php foreach ($tabs as $index => $tab): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $index === 0 ? 'active' : ''; ?>" 
                   id="<?php echo $tab['tab_group']; ?>-tab" data-toggle="tab" href="#<?php echo $tab['tab_group']; ?>" 
                   role="tab" aria-controls="<?php echo $tab['tab_group']; ?>" 
                   aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                    <?php echo htmlspecialchars($tab['tab_name']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="productTabsContent">
        <?php foreach ($tabs as $index => $tab): ?>
            <div class="tab-pane fade <?php echo $index === 0 ? 'show active' : ''; ?>" 
                 id="<?php echo $tab['tab_group']; ?>" role="tabpanel" aria-labelledby="<?php echo $tab['tab_group']; ?>-tab">
                
                <!-- Tab Header with Controls -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4><?php echo htmlspecialchars($tab['tab_name']); ?></h4>
                    <?php if ($tab['is_dynamic']): ?>
                        <div>
                            <button type="button" class="btn btn-sm btn-success add-attribute-set mr-2">
                                <i class="fa fa-plus"></i> Add Attribute Set
                            </button>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($tab['is_dynamic']): ?>
                    <input type="hidden" name="dynamic_tabs[]" value="<?php echo $tab['tab_group']; ?>">
                <?php endif; ?>

                <?php if (isset($tab_attributes[$tab['tab_group']])): ?>
                    <div class="attribute-sets-container">
                        <div class="attribute-set card mb-4">
                            <div class="card-body">
                                <?php foreach ($tab_attributes[$tab['tab_group']] as $attribute): 
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
                                                          attribute-id="<?php echo $attribute_id; ?>" 
                                                           name="attribute[<?php echo $attribute_id; ?>][]" 
                                                           value="<?php echo htmlspecialchars($current_value); ?>" 
                                                           <?php echo $required; ?>>
                                                    <?php break; ?>
                                                
                                              <?php  case 'textarea': ?>
                                                    <textarea class="form-control" attribute-id="<?php echo $attribute_id; ?>"  id="attr_<?php echo $attribute_id; ?>" 
                                                              name="attribute[<?php echo $attribute_id; ?>][]" 
                                                              <?php echo $required; ?> rows="3"><?php echo htmlspecialchars($current_value); ?></textarea>
                                                    <?php break; ?>
                                                                            
                                            <?php    case 'richtextarea':
                                                    $isrich_textarea = true;
                                                    ?>
                                                    <textarea class="form-control trumbowyg-editor" attribute-id="<?php echo $attribute_id; ?>" id="attr_<?php echo $attribute_id; ?>" 
                                                              name="attribute[<?php echo $attribute_id; ?>][]" 
                                                              <?php echo $required; ?> rows="3"><?php echo htmlspecialchars($current_value); ?></textarea>
                                                    <?php break; ?>

                                             <?php   case 'select': ?>
                                                    <select class="form-control" attribute-id="<?php echo $attribute_id; ?>" id="attr_<?php echo $attribute_id; ?>" 
                                                            name="attribute[<?php echo $attribute_id; ?>][]" <?php echo $required; ?>>
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
                                                
                                            <?php    case 'checkbox': ?>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" 
                                                               id="attr_<?php echo $attribute_id; ?>"
                                                               attribute-id="<?php echo $attribute_id; ?>"
                                                               name="attribute[<?php echo $attribute_id; ?>][]" 
                                                               value="1" <?php echo ($current_value == '1') ? 'checked' : ''; ?>>
                                                        <label class="form-check-label" for="attr_<?php echo $attribute_id; ?>">Yes</label>
                                                    </div>
                                                    <?php break; ?>
                                                
                                            <?php    case 'number': ?>
                                                    <input type="number" step="0.01" class="form-control" 
                                                           id="attr_<?php echo $attribute_id; ?>"
                                                           attribute-id="<?php echo $attribute_id; ?>" 
                                                           name="attribute[<?php echo $attribute_id; ?>][]" 
                                                           value="<?php echo htmlspecialchars($current_value); ?>" 
                                                           <?php echo $required; ?>>
                                                    <?php break; ?>
                                                
                                            <?php    case 'date': ?>
                                                    <input type="date" class="form-control" id="attr_<?php echo $attribute_id; ?>" 
                                                           name="attribute[<?php echo $attribute_id; ?>][]"
                                                           attribute-id="<?php echo $attribute_id; ?>" 
                                                           value="<?php echo htmlspecialchars($current_value); ?>" 
                                                           <?php echo $required; ?>>
                                                    <?php break; ?>

                                            <?php    case 'image': ?>
                                                    <div class="input-group">
                                                        <input type="text" placeholder="Choose Image" name="attribute[<?php echo $attribute_id; ?>][]" class="form-control" id="attr_<?php echo $attribute_id; ?>" 
                                                               attribute-id="<?php echo $attribute_id; ?>"   
                                                               value="<?php echo htmlspecialchars($current_value); ?>" 
                                                               <?php echo $required; ?>>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" onclick="OpenMediaGallery('attr_<?php echo $attribute_id; ?>' , 'page/attr')" type="button">
                                                                <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <?php break; ?>

                                            <?php    case 'multiselect': 
                                                    $current_values = !empty($current_value) ? explode(',', $current_value) : []; ?>
                                                    <select class="form-control select2-multiple" 
                                                            id="attr_<?php echo $attribute_id; ?>"
                                                            attribute-id="<?php echo $attribute_id; ?>" 
                                                            name="attribute[<?php echo $attribute_id; ?>][]" 
                                                            multiple="multiple" <?php echo $required; ?>>
                                                        <?php if (isset($options_by_attribute[$attribute_id])): ?>
                                                            <?php foreach ($options_by_attribute[$attribute_id] as $option): ?>
                                                                <option value="<?php echo htmlspecialchars($option['option_value']); ?>" 
                                                                        <?php echo in_array($option['option_value'], $current_values) ? 'selected' : ''; ?>>
                                                                    <?php echo htmlspecialchars($option['option_label']); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <?php break; ?>
                                            <?php endswitch; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if ($tab['is_dynamic']): ?>
                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-sm btn-danger remove-attribute-set">
                                    <i class="fa fa-trash"></i> Remove This Set
                                </button>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">No attributes configured for this tab.</div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php 
if($isrich_textarea){
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.1/dist/ui/trumbowyg.min.css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.25.1/dist/trumbowyg.min.js"></script>';
}
?>

<!-- Add these for Select2 multiselect -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    // Create a JavaScript object to track dynamic attributes
    const dynamicAttributes = {
        <?php foreach ($attributes as $attr): ?>
        <?php echo $attr['id']; ?>: <?php echo $attr['is_dynamic'] ? 'true' : 'false'; ?>,
        <?php endforeach; ?>
    };

    // Initialize Select2 for multiselect elements
    $('.select2-multiple').select2({
        placeholder: "Select options",
        allowClear: true,
        width: '100%',
        closeOnSelect: false
    });

    // Fix for input-group styling
    $('.input-group .select2-container').css({
        'flex': '1 1 auto',
        'width': '1%',
        'margin-bottom': '0'
    });

    // Initialize Trumbowyg if richtextarea fields exist
    if ($('.trumbowyg-editor').length > 0) {
        $('.trumbowyg-editor').trumbowyg();
    }

    // Handle attribute set addition
    $(document).on('click', '.add-attribute-set', function() {
        const $container = $(this).closest('.tab-pane').find('.attribute-sets-container');
        const $template = $container.find('.attribute-set').first().clone(true);
        
        // Clear values in the new set
        $template.find('input[type="text"], input[type="number"], input[type="date"], textarea').val('');
        $template.find('input[type="checkbox"]').prop('checked', false);
        $template.find('select').val('').trigger('change');
        
        // Remove non-dynamic attributes from the cloned set
        $template.find('.form-group.row').each(function() {
            const $attributeField = $(this).find('[attribute-id]').first();
            if ($attributeField.length) {
                const attributeId = $attributeField.attr('attribute-id');
                if (!dynamicAttributes[attributeId]) {
                    $(this).remove();
                }
            }
        });

        // Only append if there are dynamic attributes left
        if ($template.find('.form-group.row').length > 0) {
            $container.append($template);
            
            // Initialize editors and select2 for the new set
            $template.find('.trumbowyg-editor').each(function() {
                if (!$(this).hasClass('trumbowyg-initialized')) {
                    $(this).trumbowyg();
                    $(this).addClass('trumbowyg-initialized');
                }
            });
            
            $template.find('.select2-multiple').each(function() {
                if (!$(this).hasClass('select2-initialized')) {
                    $(this).select2({
                        placeholder: "Select options",
                        allowClear: true,
                        width: '100%',
                        closeOnSelect: false
                    });
                    $(this).addClass('select2-initialized');
                }
            });
        } else {
            alert('No dynamic attributes available to duplicate in this tab.');
        }
    });

    // Handle attribute set removal
    $(document).on('click', '.remove-attribute-set', function() {
        const $setsContainer = $(this).closest('.attribute-sets-container');
        if ($setsContainer.find('.attribute-set').length > 1) {
            $(this).closest('.attribute-set').remove();
        } else {
            alert('You must have at least one attribute set.');
        }
    });
});
</script>