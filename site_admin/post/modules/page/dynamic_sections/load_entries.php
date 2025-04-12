<?php
include '../../../../admin_connect.php';

// Get POST data
$section_id = (int)$_POST['section_id'];
$page_id = (int)$_POST['page_id'] ?? 0;

// Get section details
$section = return_single_row("SELECT * FROM dynamic_sections WHERE id = $section_id");
if (!$section) {
    die(json_encode(['success' => false, 'message' => 'Invalid section ID']));
}

// Get fields for this section (using naming convention)
$fields = return_multiple_rows("
    SELECT * FROM page_attributes 
    WHERE attribute_name LIKE '".strtolower($section['section_name'])."_%'
    AND isactive = 1
    AND (template_id IS NULL OR template_id = {$section['template_id']})
    ORDER BY sort_order
");

// Get existing entries
$entries = return_multiple_rows("
    SELECT * FROM section_entries 
    WHERE section_id = $section_id AND page_id = $page_id
    ORDER BY created_at DESC
");

// Start building HTML output
$html = '<div class="entry-management">';

// Add Entry Form
$html .= '<form id="addEntryForm" class="mb-4">';
$html .= '<input type="hidden" name="section_id" value="'.$section_id.'">';
$html .= '<input type="hidden" name="page_id" value="'.$page_id.'">';

foreach ($fields as $field) {
    $html .= '<div class="form-group row">';
    $html .= '<label class="col-sm-2 col-form-label">';
    $html .= htmlspecialchars($field['attribute_label']);
    if ($field['is_required']) {
        $html .= ' <span class="text-danger">*</span>';
    }
    $html .= '</label>';
    $html .= '<div class="col-sm-10">';
    
    switch ($field['attribute_type']) {
        case 'textarea':
            $html .= '<textarea name="'.htmlspecialchars($field['attribute_name']).'" class="form-control" ';
            $html .= $field['is_required'] ? 'required' : '';
            $html .= '></textarea>';
            break;
            
        case 'checkbox':
            $html .= '<div class="form-check">';
            $html .= '<input type="checkbox" name="'.htmlspecialchars($field['attribute_name']).'" ';
            $html .= 'class="form-check-input" value="1">';
            $html .= '<label class="form-check-label">Yes</label>';
            $html .= '</div>';
            break;
            
        case 'select':
            // Get options if this is a select field
            $options = return_multiple_rows("
                SELECT * FROM attribute_options 
                WHERE attribute_id = {$field['id']}
                ORDER BY sort_order
            ");
            
            $html .= '<select name="'.htmlspecialchars($field['attribute_name']).'" class="form-control" ';
            $html .= $field['is_required'] ? 'required' : '';
            $html .= '>';
            $html .= '<option value="">-- Select --</option>';
            foreach ($options as $option) {
                $html .= '<option value="'.htmlspecialchars($option['option_value']).'">';
                $html .= htmlspecialchars($option['option_label']);
                $html .= '</option>';
            }
            $html .= '</select>';
            break;
            
        default:
            $html .= '<input type="'.htmlspecialchars($field['attribute_type']).'" ';
            $html .= 'name="'.htmlspecialchars($field['attribute_name']).'" class="form-control" ';
            $html .= $field['is_required'] ? 'required' : '';
            $html .= '>';
    }
    
    $html .= '</div></div>';
}

$html .= '<button type="button" id="submit-entry" class="btn btn-primary">Add Entry</button>';
$html .= '</form>';

// Entries Table
if (!empty($entries)) {
    $html .= '<div class="table-responsive">';
    $html .= '<table class="table table-bordered">';
    $html .= '<thead><tr>';
    
    // Table headers
    foreach ($fields as $field) {
        $html .= '<th>'.htmlspecialchars($field['attribute_label']).'</th>';
    }
    $html .= '<th>Date</th><th>Actions</th>';
    $html .= '</tr></thead><tbody>';
    
    // Table rows
    foreach ($entries as $entry) {
        $data = json_decode($entry['entry_data'], true);
        $html .= '<tr data-entry-id="'.$entry['id'].'">';
        
        foreach ($fields as $field) {
            $html .= '<td>';
            $value = $data[$field['attribute_name']] ?? '';
            
            if ($field['attribute_type'] === 'checkbox') {
                $html .= !empty($value) ? 'Yes' : 'No';
            } else {
                $html .= htmlspecialchars($value);
            }
            
            $html .= '</td>';
        }
        
        $html .= '<td>'.$entry['created_at'].'</td>';
        $html .= '<td>';
        $html .= '<button class="btn btn-sm btn-warning edit-entry mr-2">Edit</button>';
        $html .= '<button class="btn btn-sm btn-danger delete-entry">Delete</button>';
        $html .= '</td></tr>';
    }
    
    $html .= '</tbody></table></div>';
} else {
    $html .= '<div class="alert alert-info">No entries found for this section.</div>';
}

$html .= '</div>'; // Close entry-management div

// JavaScript for handling form submission
$html .= '
<script>
$(document).ready(function() {
    // Add new entry
    $("#submit-entry").click(function() {
        validateform(function() {
            const formData = $("#addEntryForm").serializeArray();
            const data = {
                section_id: '.$section_id.',
                page_id: '.$page_id.',
                submit_btn: true
            };
            
            formData.forEach(item => {
                data[item.name] = item.value;
            });
            
            senddata("post/modules/page/dynamic_sections/add_entry.php", "POST", data,
                function(result) {
                    if(result.success) {
                        // Reload entries
                        $("#section-select").trigger("change");
                        $("#error_id").html(\'<div class="alert alert-success">\'+result.message+\'</div>\').fadeIn().delay(1500).fadeOut();
                    }
                },
                function(error) {
                    $("#error_id").html(\'<div class="alert alert-danger">\'+error.message+\'</div>\').fadeIn().delay(1500).fadeOut();
                }
            );
        }, function() {
            $("#error_id").html(\'<div class="alert alert-warning">Please fill out all required fields</div>\').fadeIn().delay(1500).fadeOut();
        });
    });
    
    // Edit entry
    $(".edit-entry").click(function() {
        const entryId = $(this).closest("tr").data("entry-id");
        // Implement edit functionality
    });
    
    // Delete entry
    $(".delete-entry").click(function() {
        if(confirm("Are you sure you want to delete this entry?")) {
            const entryId = $(this).closest("tr").data("entry-id");
            senddata("post/dynamic_sections/delete_entry.php", "POST", {entry_id: entryId},
                function(result) {
                    if(result.success) {
                        // Reload entries
                        $("#section-select").trigger("change");
                        $("#error_id").html(\'<div class="alert alert-success">\'+result.message+\'</div>\').fadeIn().delay(1500).fadeOut();
                    }
                },
                function(error) {
                    $("#error_id").html(\'<div class="alert alert-danger">\'+error.message+\'</div>\').fadeIn().delay(1500).fadeOut();
                }
            );
        }
    });
});
</script>';

// Return JSON response
echo json_encode([
    'success' => true,
    'html' => $html
]);