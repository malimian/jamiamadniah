<?php
include '../../admin_connect.php';  // Adjust the path if needed

if (isset($_POST['template_id'])) {
    $template_id = intval($_POST['template_id']);
    $csrf_token = $_POST['csrf_token'] ?? '';

    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $csrf_token)) {
        echo json_encode(['error' => 'Invalid CSRF token']);
        exit;
    }

    // Fetch attributes for the selected template
$attributes_sql = "SELECT 
    pa.*,
    t.tab_name AS tab_display_name,
    t.tab_group,
    (SELECT COUNT(*) FROM page_attribute_values pav 
     WHERE pav.attribute_id = pa.id AND pav.page_id IN 
     (SELECT pid FROM pages WHERE template_id = $template_id)) AS usage_count
FROM 
    page_attributes pa
LEFT JOIN 
    tab t ON pa.tab_id = t.id
WHERE 
    (pa.template_id = $template_id OR pa.template_id IS NULL)
    AND pa.isactive = 1 
    AND pa.soft_delete = 0 
ORDER BY 
    t.tab_name ASC, 
    pa.section_name ASC, 
    pa.sort_order ASC";

                      echo $attributes_sql;
    
    $attributes_result = return_multiple_rows($attributes_sql);
    $attributes = [];
    
    if($attributes_result){
        foreach ($attributes_result as $row) {
            $tab_name = $row['tab_display_name'] ?: 'General';
            $section_name = $row['section_name'] ?: 'Main';
            $attributes[$tab_name][$section_name][] = $row;
        }
    }

    if (!empty($attributes)) {
        $html = '<div class="template-attributes-container">';
        
        foreach ($attributes as $tab_name => $sections) {
            $html .= '<div class="card mb-4">';
            $html .= '<div class="card-header bg-light">';
            $html .= '<h5 class="mb-0">' . htmlspecialchars($tab_name) . '</h5>';
            $html .= '</div>';
            $html .= '<div class="card-body">';
            
            foreach ($sections as $section_name => $section_attributes) {
                if (count($sections) > 1) {
                    $html .= '<h6 class="text-muted mb-3">' . htmlspecialchars($section_name) . '</h6>';
                }
                
                $html .= '<div class="row">';
                
                foreach ($section_attributes as $attribute) {
                    $html .= '<div class="col-md-6 col-lg-4 mb-3">';
                    $html .= '<div class="attribute-card p-3 border rounded">';
                    $html .= '<div class="d-flex justify-content-between align-items-start">';
                    $html .= '<div>';
                    $html .= '<h6 class="mb-1">' . htmlspecialchars($attribute['attribute_label']) . '</h6>';
                    $html .= '<small class="text-muted d-block">' . htmlspecialchars($attribute['attribute_name']) . '</small>';
                    
                    // Show attribute type and dynamic status
                    $html .= '<div class="mt-2">';
                    $html .= '<span class="badge badge-info mr-1">' . htmlspecialchars($attribute['attribute_type']) . '</span>';
                    if ($attribute['is_dynamic']) {
                        $html .= '<span class="badge badge-warning">Dynamic</span>';
                    }
                    if ($attribute['usage_count'] > 0) {
                        $html .= '<span class="badge badge-secondary ml-1">Used: ' . $attribute['usage_count'] . '</span>';
                    }
                    $html .= '</div>';
                    $html .= '</div>';
                    
                    // Action buttons
                    $html .= '<div class="btn-group btn-group-sm">';
                    $html .= '<button type="button" class="btn btn-outline-primary edit-attribute" 
                              data-id="'.$attribute['id'].'" 
                              data-toggle="modal" 
                              data-target="#editAttributeModal"
                              title="Edit Attribute">';
                    $html .= '<i class="fas fa-edit"></i>';
                    $html .= '</button>';
                    
                    $html .= '<button type="button" class="btn btn-outline-info attribute-settings" 
                              data-id="'.$attribute['id'].'"
                              title="Advanced Settings">';
                    $html .= '<i class="fas fa-cog"></i>';
                    $html .= '</button>';
                    
                    if ($attribute['usage_count'] == 0) {
                        $html .= '<button type="button" class="btn btn-outline-danger delete-attribute" 
                                  data-id="'.$attribute['id'].'" 
                                  title="Delete Attribute">';
                        $html .= '<i class="fas fa-trash-alt"></i>';
                        $html .= '</button>';
                    } else {
                        $html .= '<button type="button" class="btn btn-outline-secondary" 
                                  title="Cannot delete - in use" disabled>';
                        $html .= '<i class="fas fa-trash-alt"></i>';
                        $html .= '</button>';
                    }
                    $html .= '</div>'; // Close btn-group
                    $html .= '</div>'; // Close flex container
                    
                    // Additional attribute info
                    $html .= '<div class="attribute-meta mt-2 small text-muted">';
                    $html .= '<div>Tab: ' . htmlspecialchars($tab_name) . '</div>';
                    if ($section_name) {
                        $html .= '<div>Section: ' . htmlspecialchars($section_name) . '</div>';
                    }
                    $html .= '<div>Order: ' . $attribute['sort_order'] . '</div>';
                    $html .= '</div>';
                    
                    $html .= '</div>'; // Close attribute-card
                    $html .= '</div>'; // Close col
                }
                
                $html .= '</div>'; // Close row
            }
            
            $html .= '</div>'; // Close card-body
            $html .= '</div>'; // Close card
        }
        
        $html .= '</div>'; // Close container
        echo $html;
    } else {
        echo '<div class="alert alert-info">No attributes found for this template. Create new attributes in the "Create New Attribute" tab.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Invalid request. Please select a template.</div>';
}
?>

<script type="text/javascript">
    $(document).ready(function() {
    // Handle edit attribute button
    $(document).on('click', '.edit-attribute', function() {
        const attrId = $(this).data('id');
        
        // Show loading state
        $('#editAttributeModal .modal-body').html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p>Loading attribute details...</p>
            </div>
        `);
        
        $('#editAttributeModal').modal('show');
        
        // Load attribute data
        $.ajax({
            url: 'get_attribute_details.php',
            type: 'POST',
            data: {
                id: attrId,
                csrf_token: '<?= $_SESSION['csrf_token'] ?? '' ?>'
            },
            success: function(response) {
                if (response.success) {
                    // Populate the form
                    $('#edit_attribute_id').val(response.data.id);
                    $('#edit_attribute_label').val(response.data.attribute_label);
                    $('#edit_attribute_name').val(response.data.attribute_name);
                    $('#edit_attribute_type').val(response.data.attribute_type);
                    $('#edit_is_dynamic').val(response.data.is_dynamic);
                    $('#edit_tab_name').val(response.data.tab_name);
                    $('#edit_section_name').val(response.data.section_name);
                    $('#edit_sort_order').val(response.data.sort_order);
                    $('#edit_default_value').val(response.data.default_value);
                    $('#edit_is_required').val(response.data.is_required);
                    
                    // Show the form
                    $('#editAttributeModal .modal-body').html($('#editAttributeForm').show());
                } else {
                    $('#editAttributeModal .modal-body').html(`
                        <div class="alert alert-danger">
                            Error loading attribute: ${response.message}
                        </div>
                    `);
                }
            },
            error: function() {
                $('#editAttributeModal .modal-body').html(`
                    <div class="alert alert-danger">
                        Error loading attribute details. Please try again.
                    </div>
                `);
            }
        });
    });

    // Handle delete attribute button
    $(document).on('click', '.delete-attribute', function() {
        const attrId = $(this).data('id');
        
        if (!confirm('Are you sure you want to delete this attribute? This action cannot be undone.')) {
            return false;
        }
        
        $.ajax({
            url: 'delete_attribute.php',
            type: 'POST',
            data: {
                id: attrId,
                csrf_token: '<?= $_SESSION['csrf_token'] ?? '' ?>'
            },
            success: function(response) {
                if (response.success) {
                    // Reload the attribute list
                    $('#template_id').trigger('change');
                    showAlert('Attribute deleted successfully', 'success');
                } else {
                    showAlert('Error deleting attribute: ' + response.message, 'danger');
                }
            },
            error: function() {
                showAlert('Error deleting attribute. Please try again.', 'danger');
            }
        });
    });

    // Handle advanced settings button
    $(document).on('click', '.attribute-settings', function() {
        const attrId = $(this).data('id');
        // Implement advanced settings functionality
        window.location.href = 'attribute_settings.php?id=' + attrId;
    });
});

function showAlert(message, type) {
    const alert = $(`
        <div class="alert alert-${type} alert-dismissible fade show">
            ${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
    $('#notification-container').html(alert);
    setTimeout(() => alert.alert('close'), 5000);
}
</script>