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

// Get tabs from the tab table
$tabs = return_multiple_rows("
    SELECT * FROM tab 
    WHERE isactive = 1 
    AND soft_delete = 0 
    AND (template_id IS NULL OR template_id = $template_id)
    ORDER BY sort_order
");

// Organize attributes by section_name within each tab
$section_attributes = [];
foreach ($attributes as $attr) {
    $tab_id = $attr['tab_id'];
    $section_name = $attr['section_name'] ?: 'General';
    
    if (!isset($section_attributes[$tab_id])) {
        $section_attributes[$tab_id] = [];
    }
    
    if (!isset($section_attributes[$tab_id][$section_name])) {
        $section_attributes[$tab_id][$section_name] = [];
    }
    
    $section_attributes[$tab_id][$section_name][] = $attr;
}

// Fetch existing attribute values for this page
$attribute_values = [];
$attribute_value_sets = [];
$dynamic_sets = [];

if ($page_id > 0) {
    // Get all attribute values grouped by attribute_id
    $values = return_multiple_rows("
        SELECT id, attribute_id, attribute_value 
        FROM page_attribute_values 
        WHERE page_id = $page_id
        ORDER BY attribute_id, id
    ");
    
    // Organize values by attribute_id and track set counts
    foreach ($values as $value) {
        if (!isset($attribute_value_sets[$value['attribute_id']])) {
            $attribute_value_sets[$value['attribute_id']] = [];
        }
        $attribute_value_sets[$value['attribute_id']][] = $value['attribute_value'];
    }
    
    // For backward compatibility with non-dynamic attributes
    foreach ($attribute_value_sets as $attrId => $values) {
        $attribute_values[$attrId] = $values[0] ?? '';
        
        // Track maximum sets needed for each dynamic attribute
        $attr = array_filter($attributes, function($a) use ($attrId) { return $a['id'] == $attrId; });
        $attr = reset($attr);
        if ($attr && $attr['is_dynamic']) {
            $section_name = $attr['section_name'] ?: 'General';
            if (!isset($dynamic_sets[$section_name])) {
                $dynamic_sets[$section_name] = 1;
            }
            $dynamic_sets[$section_name] = max($dynamic_sets[$section_name], count($values));
        }
    }
}


?>
<div class="container mt-5">
  
<?php if (!empty($tabs)): ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                You can manage the attributes of this template from 
                <a target="_blank"href="template_attributes.php?template_id=<?= htmlspecialchars($template_id) ?>" class="alert-link">
                    Template Attribute Management
                </a>.
            </div>
        </div>
    </div>
<?php endif; ?>


    
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="pageTabs" role="tablist">
        <?php foreach ($tabs as $index => $tab): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $index === 0 ? 'active' : ''; ?>" 
                   id="tab-<?php echo $tab['id']; ?>-nav" 
                   data-toggle="tab" 
                   href="#tab-<?php echo $tab['id']; ?>" 
                   role="tab" 
                   aria-controls="tab-<?php echo $tab['id']; ?>" 
                   aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                    <?php echo htmlspecialchars($tab['tab_name']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="pageTabsContent">
        <?php foreach ($tabs as $index => $tab): ?>
            <div class="tab-pane fade <?php echo $index === 0 ? 'show active' : ''; ?>" 
                 id="tab-<?php echo $tab['id']; ?>" 
                 role="tabpanel" 
                 aria-labelledby="tab-<?php echo $tab['id']; ?>-nav">
                
                <!-- Tab Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4><?php echo htmlspecialchars($tab['tab_name']); ?></h4>
                </div>

                <?php if (isset($section_attributes[$tab['id']])): ?>
                    <?php foreach ($section_attributes[$tab['id']] as $section_name => $section_attrs): ?>
                        <?php 
                        $is_section_dynamic = false;
                        foreach ($section_attrs as $attr) {
                            if ($attr['is_dynamic']) {
                                $is_section_dynamic = true;
                                break;
                            }
                        }
                        ?>
                        
                        <div class="section-container mb-5" data-section="<?php echo htmlspecialchars($section_name); ?>">
                            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                                <h5 class="mb-0"><?php echo htmlspecialchars($section_name); ?></h5>
                                <?php if ($is_section_dynamic): ?>
                                    <button type="button" class="btn btn-sm btn-success add-section-set" 
                                            data-section="<?php echo htmlspecialchars($section_name); ?>">
                                        <i class="fa fa-plus"></i> Add <?php echo htmlspecialchars($section_name); ?> Set
                                    </button>
                                <?php endif; ?>
                            </div>
                            
<div class="attribute-sets-container">
    <?php
    // Determine how many sets to create for this section
    $sets_count = isset($dynamic_sets[$section_name]) ? $dynamic_sets[$section_name] : 1;
    
    for ($set_index = 0; $set_index < $sets_count; $set_index++):
        $is_first_set = ($set_index === 0);
    ?>
    <div class="attribute-set card mb-4" data-set-index="<?php echo $set_index; ?>">
        <div class="card-body">
            <?php foreach ($section_attrs as $attribute):  
                $attribute_id = $attribute['id'];
                $current_value = '';
                
                // Get value for this set index if it exists
                if (isset($attribute_value_sets[$attribute_id][$set_index])) {
                    $current_value = $attribute_value_sets[$attribute_id][$set_index];
                } elseif ($is_first_set) {
                    $current_value = $attribute_values[$attribute_id] ?? $attribute['default_value'];
                }
                
                $required = $attribute['is_required'] ? 'required' : '';
                $icon_class = $attribute['icon_class'] ?? 'fa fa-circle';
            ?>
            <div class="form-group row">
                <label for="attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>" class="col-sm-2 col-form-label">
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
                                <input type="text" class="form-control" 
                                      id="attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>"
                                      attribute-id="<?php echo $attribute_id; ?>" 
                                       name="attribute[<?php echo $attribute_id; ?>][<?php echo $set_index; ?>]" 
                                       value="<?php echo htmlspecialchars($current_value); ?>" 
                                       <?php echo $required; ?>>
                                <?php break; ?>
                            
                        <?php   case 'textarea': ?>
                                <textarea class="form-control" attribute-id="<?php echo $attribute_id; ?>"  
                                          id="attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>" 
                                          name="attribute[<?php echo $attribute_id; ?>][<?php echo $set_index; ?>]" 
                                          <?php echo $required; ?> rows="3"><?php echo htmlspecialchars($current_value); ?></textarea>
                                <?php break; ?>
                                                            
                        <?php   case 'richtextarea':
                                $isrich_textarea = true;
                                ?>
                                <textarea class="form-control trumbowyg-editor" attribute-id="<?php echo $attribute_id; ?>" 
                                          id="attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>" 
                                          name="attribute[<?php echo $attribute_id; ?>][<?php echo $set_index; ?>]" 
                                          <?php echo $required; ?> rows="3"><?php echo htmlspecialchars($current_value); ?></textarea>
                                <?php break; ?>

                        <?php   case 'select': ?>
                                <select class="form-control" attribute-id="<?php echo $attribute_id; ?>" 
                                        id="attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>" 
                                        name="attribute[<?php echo $attribute_id; ?>][<?php echo $set_index; ?>]" <?php echo $required; ?>>
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
                            
                        <?php   case 'checkbox': ?>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" 
                                           id="attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>"
                                           attribute-id="<?php echo $attribute_id; ?>"
                                           name="attribute[<?php echo $attribute_id; ?>][<?php echo $set_index; ?>]" 
                                           value="1" <?php echo ($current_value == '1') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>">Yes</label>
                                </div>
                                <?php break; ?>
                            
                        <?php   case 'number': ?>
                                <input type="number" step="0.01" class="form-control" 
                                       id="attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>"
                                       attribute-id="<?php echo $attribute_id; ?>" 
                                       name="attribute[<?php echo $attribute_id; ?>][<?php echo $set_index; ?>]" 
                                       value="<?php echo htmlspecialchars($current_value); ?>" 
                                       <?php echo $required; ?>>
                                <?php break; ?>
                            
                        <?php   case 'date': ?>
                                <input type="date" class="form-control" id="attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>" 
                                       name="attribute[<?php echo $attribute_id; ?>][<?php echo $set_index; ?>]"
                                       attribute-id="<?php echo $attribute_id; ?>" 
                                       value="<?php echo htmlspecialchars($current_value); ?>" 
                                       <?php echo $required; ?>>
                                <?php break; ?>

                        <?php   case 'image': ?>
                                <div class="input-group">
                                    <input type="text" placeholder="Choose Image" 
                                           name="attribute[<?php echo $attribute_id; ?>][<?php echo $set_index; ?>]" 
                                           class="form-control" 
                                           id="attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>" 
                                           attribute-id="<?php echo $attribute_id; ?>"   
                                           value="<?php echo htmlspecialchars($current_value); ?>" 
                                           <?php echo $required; ?>>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" 
                                                onclick="OpenMediaGallery('attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>', 'page/attr')" 
                                                type="button">
                                            <i class="fa fa-picture-o"></i>&nbsp;Gallery
                                        </button>
                                    </div>
                                </div>
                                <?php break; ?>

                        <?php   case 'multiselect': 
                                $current_values = !empty($current_value) ? explode(',', $current_value) : []; ?>
                                <select class="form-control select2-multiple" 
                                        id="attr_<?php echo $attribute_id; ?>_<?php echo $set_index; ?>"
                                        attribute-id="<?php echo $attribute_id; ?>" 
                                        name="attribute[<?php echo $attribute_id; ?>][<?php echo $set_index; ?>]" 
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
            <?php if ($is_section_dynamic && !$is_first_set): ?>
                                <!-- Single Remove button placed here after all attributes -->
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2 text-right">
                                        <button type="button" class="btn btn-sm btn-danger remove-section-set">
                                            <i class="fa fa-trash"></i> Remove This Set
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <!-- End of section attributes -->

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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">

    // Track dynamic attributes
    const dynamicAttributes = {
        <?php foreach ($attributes as $attr): ?>
        <?php echo $attr['id']; ?>: <?php echo $attr['is_dynamic'] ? 'true' : 'false'; ?>,
        <?php endforeach; ?>
    };


$(document).ready(function() {

    // Initialize Select2
    $('.select2-multiple').select2({
        placeholder: "Select options",
        allowClear: true,
        width: '100%',
        closeOnSelect: false
    });

    // Fix input-group styling
    $('.input-group .select2-container').css({
        'flex': '1 1 auto',
        'width': '1%',
        'margin-bottom': '0'
    });

        $('.trumbowyg-editor').each(function () {
            if (!$(this).parent().hasClass('trumbowyg-box')) {
                $(this).trumbowyg();
            }
        });

   
    // Add section set
    $(document).on('click', '.add-section-set', function() {
        const sectionName = $(this).data('section');
    const $container = $(this).closest('.section-container').find('.attribute-sets-container');
    const $template = $container.find('.attribute-set').first().clone(true);
    
    // Generate a new set index based on existing sets
    const newSetIndex = $container.find('.attribute-set').length;
    
    // Clear values and update IDs/names
    $template.find('input, textarea, select').each(function() {
        const $this = $(this);
        const oldId = $this.attr('id');
        const oldName = $this.attr('name');
        
        // Clear values of the text feilds
        // if ($this.is('input[type="text"], input[type="number"], input[type="date"], textarea')) {
        //     $this.val('');
        // } else if ($this.is('input[type="checkbox"]')) {
        //     $this.prop('checked', false);
        // } else if ($this.is('select')) {
        //     $this.val('').trigger('change');
        // }
        
        // Update IDs and names
        if (oldId && oldId.startsWith('attr_')) {
            const newId = oldId.replace(/_(\d+)$/, '_' + newSetIndex);
            $this.attr('id', newId);
            
            // Update corresponding label's 'for' attribute
            const $label = $('label[for="' + oldId + '"]');
            if ($label.length) {
                $label.attr('for', newId);
            }
            
            // Special handling for image gallery buttons
            if ($this.attr('attribute-id') && $this.closest('.input-group').find('.btn').length) {
                const attributeId = $this.attr('attribute-id');
                const newGalleryId = `attr_${attributeId}_${newSetIndex}`;
                $this.closest('.input-group').find('.btn').attr('onclick', `OpenMediaGallery('${newGalleryId}', 'page/attr')`);
            }
        }
        
                //change name=
                // if (oldName && oldName.includes('attribute[')) {
                //     // Update name attribute to use the new set index
                //     const newName = oldName.replace(/\[(\d+)\]/, '[' + newSetIndex + ']');
                //     $this.attr('name', newName);
                // }

    });
        
        // Update data-set-index attribute
        $template.attr('data-set-index', newSetIndex);
        
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
            // Ensure the remove button is present in the template
            if ($template.find('.remove-section-set').length === 0) {
                $template.find('.card-body').append(`
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2 text-right">
                            <button type="button" class="btn btn-sm btn-danger remove-section-set">
                                <i class="fa fa-trash"></i> Remove This Set
                            </button>
                        </div>
                    </div>
                `);
            }
            
            $container.append($template);
            
            // Initialize editors and select2 for the new set
           $template.find('.trumbowyg-editor').each(function () {
                const $editor = $(this);

                // Only initialize if not already initialized (no trumbowyg wrapper)
                if (!$editor.parent().hasClass('trumbowyg-box')) {
                    $editor.trumbowyg();
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
            showAlert('No dynamic attributes available to duplicate in this section.');
        }
    });
    // Remove section set
    $(document).on('click', '.remove-section-set', function() {
        const $setsContainer = $(this).closest('.attribute-sets-container');
        if ($setsContainer.find('.attribute-set').length > 1) {
            $(this).closest('.attribute-set').remove();
        } else {
            showAlert('You must have at least one attribute set in this section.');
        }
    });
});



</script>