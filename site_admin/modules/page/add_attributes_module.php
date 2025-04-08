<style type="text/css">
/* Select2 Multiselect Styling */
.select2-container--default .select2-selection--multiple {
    min-height: 38px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    padding: 0 5px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: 3px;
    color: #495057;
    padding: 0 5px;
    margin-top: 5px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #6c757d;
    margin-right: 5px;
}

.select2-container--default .select2-selection--multiple .select2-selection__clear {
    margin-right: 10px;
}

/* Match the input group styling */
.input-group .select2-container--default .select2-selection--multiple {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-left: 0;
}

/* Error state styling */
.is-invalid ~ .select2-container--default .select2-selection--multiple {
    border-color: #dc3545;
}

.is-valid ~ .select2-container--default .select2-selection--multiple {
    border-color: #28a745;
}
</style>
<?php
// modules/add_product_module.php

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


$tabs = return_multiple_rows("Select * from page_attributes Where template_id = $template_id and isactive = 1 and soft_delete = 0 Group by tab_group");

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
            <?php foreach ($tabs as $index => $tab): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $index === 0 ? 'active' : ''; ?>" 
                       id="<?php echo $tab['tab_group']; ?>-tab" data-toggle="tab" href="#<?php echo $tab['tab_group']; ?>" 
                       role="tab" aria-controls="<?php echo $tab['tab_group']; ?>" 
                       aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                        <i class="<?php echo $tab['icon_class']; ?>"></i> <?php echo $tab['tab_name']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="productTabsContent">
        <?php foreach ($tabs as $index => $tab): ?>
            <div class="tab-pane fade <?php echo $index === 'basic' ? 'show active' : ''; ?>" 
                 id="<?php echo $tab['tab_group']; ?>" role="tabpanel" aria-labelledby="<?php echo $tab['tab_group']; ?>-tab">
                
                     <?php if (isset($tab_attributes[$tab['tab_group']])): ?>
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
                                                   name="attribute[<?php echo $attribute_id; ?>]" 
                                                   value="<?php echo htmlspecialchars($current_value); ?>" 
                                                   <?php echo $required; ?>>
                                            <?php break; ?>
                                        
                                     <?php   case 'textarea': ?>
                                            <textarea class="form-control" id="attr_<?php echo $attribute_id; ?>" 
                                                      name="attribute[<?php echo $attribute_id; ?>]" 
                                                      <?php echo $required; ?> rows="3"><?php echo htmlspecialchars($current_value); ?></textarea>
                                            <?php break; ?>
                                                                            
                                     <?php case 'richtextarea':
                                     $isrich_textarea = true;
                                      ?>
                                        <textarea class="form-control" id="attr_<?php echo $attribute_id; ?>" 
                                                      name="attribute[<?php echo $attribute_id; ?>]" 
                                                      <?php echo $required; ?> rows="3"><?php echo htmlspecialchars($current_value); ?></textarea>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                              $('#attr_<?php echo $attribute_id; ?>').trumbowyg();
                                            });
                                        </script>
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

                                        <?php case 'image': ?>
                                            <input type="text" placeholder="Choose Image" name="attribute[<?php echo $attribute_id; ?>]" class="form-control" id="attr_<?php echo $attribute_id; ?>" 
                                                   name="attribute[<?php echo $attribute_id; ?>]" 
                                                   value="<?php echo htmlspecialchars($current_value); ?>" 
                                                   <?php echo $required; ?>>
                                                    <button class="btn btn-primary form-control col-sm-2" onclick="OpenMediaGallery('attr_<?php echo $attribute_id; ?>' , 'page/attr')" type="button">
                                                    <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                                    </button>
                                            <?php break; ?>

                                          <?php  case 'multiselect': 
                                            $current_values = !empty($current_value) ? explode(',', $current_value) : []; ?>
                                            <select class="form-control select2-multiple" 
                                                    id="attr_<?php echo $attribute_id; ?>" 
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
<script>
$(document).ready(function() {
    // Initialize Select2 for multiselect elements if they exist
    if ($('.select2-multiple').length > 0) {
        $('.select2-multiple').select2({
            placeholder: "Select options",
            allowClear: true,
            width: '100%', // Make it full width
            closeOnSelect: false // Keep dropdown open for multiple selections
        });
        
        // Fix for input-group styling
        $('.input-group .select2-container').css({
            'flex': '1 1 auto',
            'width': '1%',
            'margin-bottom': '0'
        });
    }
});
</script>

<!-- Add these for Select2 multiselect -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
