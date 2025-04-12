<?php
// Database connection and functions would be included here
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div id="error_id" style="display:none;"></div>
            
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dynamic Sections Manager</h4>
                </div>
                <div class="card-body">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="sectionTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="create-tab" data-toggle="tab" href="#create-section" role="tab">Create Section</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="manage-tab" data-toggle="tab" href="#manage-entries" role="tab">Manage Entries</a>
                        </li>
                    </ul>
                    
                    <!-- Tab Content -->
                    <div class="tab-content" id="sectionTabsContent">
                        <!-- Create Section Tab -->
                        <div class="tab-pane fade show active" id="create-section" role="tabpanel">
                            <form id="createSectionForm" class="mt-3">
                                <div class="form-group">
                                    <label>Section Name</label>
                                    <input type="text" id="section_name" name="section_name" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Template (optional)</label>
                                    <select id="template_id" name="template_id" class="form-control">
                                        <option value="0">Global Section</option>
                                        <?php 
                                        $templates = return_multiple_rows("SELECT id, name FROM templates WHERE isactive = 1");
                                        foreach ($templates as $template): ?>
                                            <option value="<?= $template['id'] ?>"><?= htmlspecialchars($template['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <h5 class="mt-4">Section Fields</h5>
                               <div id="fields-container">
                                        <div class="field-group card mb-3">
                                            <div class="card-body">
                                                <!-- Row 1: Name and Label -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label>Field Name</label>
                                                        <input type="text" name="fields[0][name]" placeholder="e.g., question" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Field Label</label>
                                                        <input type="text" name="fields[0][label]" placeholder="e.g., Question" class="form-control" required>
                                                    </div>
                                                </div>
                                                
                                                <!-- Row 2: Type and Tab Group -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label>Field Type</label>
                                                        <select name="fields[0][type]" class="form-control" required>
                                                            <option value="text">Text</option>
                                                            <option value="textarea">Textarea</option>
                                                            <option value="number">Number</option>
                                                            <option value="date">Date</option>
                                                            <option value="checkbox">Checkbox</option>
                                                            <option value="select">Select</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Tab Group</label>
                                                        <select name="fields[0][tab_group]" class="form-control">
                                                            <option value="basic">Basic</option>
                                                            <option value="details">Details</option>
                                                            <option value="shipping">Shipping</option>
                                                            <option value="flags">Flags</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <!-- Row 3: Order, Required, and Remove -->
                                                <div class="row align-items-end">
                                                    <div class="col-md-2">
                                                        <label>Order</label>
                                                        <input type="number" name="fields[0][order]" class="form-control" value="0">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-check mt-3">
                                                            <input type="checkbox" name="fields[0][required]" id="field0_required" class="form-check-input">
                                                            <label for="field0_required" class="form-check-label">Required Field</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 text-right">
                                                        <button type="button" class="btn btn-danger remove-field">
                                                            <i class="fas fa-trash"></i> Remove
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                <button type="button" id="add-field" class="btn btn-secondary mt-2">Add Field</button>
                                <button type="button" id="submit-section" class="btn btn-primary mt-2">Create Section</button>
                            </form>
                        </div>
                        
                        <!-- Manage Entries Tab -->
                        <div class="tab-pane fade" id="manage-entries" role="tabpanel">
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Section</label>
                                        <select id="section-select" class="form-control">
                                            <option value="">-- Select Section --</option>
                                            <?php 
                                            $sections = return_multiple_rows("SELECT id, section_name FROM dynamic_sections");
                                            foreach ($sections as $section): ?>
                                                <option value="<?= $section['id'] ?>"><?= htmlspecialchars($section['section_name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Page ID (optional)</label>
                                        <input type="number" id="page_id" class="form-control" value="0">
                                    </div>
                                </div>
                            </div>
                            
                            <div id="entries-container" class="mt-4">
                                <!-- Entries will be loaded here via AJAX -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
   // Updated JavaScript to handle the new structure
        $(document).ready(function() {
            let fieldCount = 1;
            
            $('#add-field').click(function() {
                const newField = `
                <div class="field-group card mb-3">
                    <div class="card-body">
                        <!-- Row 1: Name and Label -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Field Name</label>
                                <input type="text" name="fields[${fieldCount}][name]" placeholder="e.g., question" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>Field Label</label>
                                <input type="text" name="fields[${fieldCount}][label]" placeholder="e.g., Question" class="form-control" required>
                            </div>
                        </div>
                        
                        <!-- Row 2: Type and Tab Group -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Field Type</label>
                                <select name="fields[${fieldCount}][type]" class="form-control" required>
                                    <option value="text">Text</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="number">Number</option>
                                    <option value="date">Date</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="select">Select</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Tab Group</label>
                                <select name="fields[${fieldCount}][tab_group]" class="form-control">
                                    <option value="basic">Basic</option>
                                    <option value="details">Details</option>
                                    <option value="shipping">Shipping</option>
                                    <option value="flags">Flags</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Row 3: Order, Required, and Remove -->
                        <div class="row align-items-end">
                            <div class="col-md-2">
                                <label>Order</label>
                                <input type="number" name="fields[${fieldCount}][order]" class="form-control" value="${fieldCount}">
                            </div>
                            <div class="col-md-8">
                                <div class="form-check mt-3">
                                    <input type="checkbox" name="fields[${fieldCount}][required]" id="field${fieldCount}_required" class="form-check-input">
                                    <label for="field${fieldCount}_required" class="form-check-label">Required Field</label>
                                </div>
                            </div>
                            <div class="col-md-2 text-right">
                                <button type="button" class="btn btn-danger remove-field">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`;
                
                $('#fields-container').append(newField);
                fieldCount++;
            });

            $(document).on('click', '.remove-field', function() {
                $(this).closest('.field-group').remove();
            });
        });

    // Section creation
    $('#submit-section').click(function() {
        // Basic validation
        if ($('#section_name').val().trim() === '') {
            showAlert('Section name is required', 'danger');
            return;
        }

        // Check at least one field exists
        if ($('.field-group').length === 0) {
            showAlert('Please add at least one field', 'danger');
            return;
        }

        // Validate all fields
        let isValid = true;
        $('.field-group').each(function() {
            if ($(this).find('[name*="[name]"]').val().trim() === '' || 
                $(this).find('[name*="[label]"]').val().trim() === '') {
                isValid = false;
                return false; // break loop
            }
        });

        if (!isValid) {
            showAlert('Please fill out all field names and labels', 'danger');
            return;
        }

        // Collect form data
        const formData = {
            section_name: $('#section_name').val(),
            template_id: $('#template_id').val(),
            fields: [],
            submit_btn: true
        };

        // Collect all fields
        $('.field-group').each(function(index) {
            const field = {
                name: $(this).find('[name*="[name]"]').val(),
                label: $(this).find('[name*="[label]"]').val(),
                type: $(this).find('[name*="[type]"]').val(),
                tab_group: $(this).find('[name*="[tab_group]"]').val(),
                order: $(this).find('[name*="[order]"]').val(),
                required: $(this).find('[name*="[required]"]').is(':checked') ? 1 : 0
            };
            formData.fields.push(field);
        });

        // Send data
        senddata('post/modules/page/dynamic_sections/create_section.php', "POST", formData,
            function(result) {
                if(result.success) {
                    // Reset form
                    $('#section_name').val('');
                    $('#fields-container').html(`
                        <div class="field-group card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="text" name="fields[0][name]" placeholder="Field Name" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="fields[0][label]" placeholder="Field Label" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="fields[0][type]" class="form-control" required>
                                            <option value="text">Text</option>
                                            <option value="textarea">Textarea</option>
                                            <option value="number">Number</option>
                                            <option value="date">Date</option>
                                            <option value="checkbox">Checkbox</option>
                                            <option value="select">Select</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="fields[0][tab_group]" class="form-control">
                                            <option value="basic">Basic</option>
                                            <option value="details">Details</option>
                                            <option value="shipping">Shipping</option>
                                            <option value="flags">Flags</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" name="fields[0][order]" placeholder="Order" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input type="checkbox" name="fields[0][required]" id="field0_required" class="form-check-input">
                                            <label for="field0_required" class="form-check-label">Required</label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">×</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    fieldCount = 1;
                    
                    showAlert(result.message, 'success');
                    
                    // Refresh sections dropdown
                    refreshSectionsDropdown();
                } else {
                    showAlert(result.message || 'Failed to create section', 'danger');
                }
            },
            function(error) {
                showAlert(error.message || 'Something went wrong', 'danger');
            }
        );
    });

  // Load entries when section is selected
$('#section-select').change(function() {
    const section_id = $(this).val();
    const page_id = $('#page_id').val() || 0;
    
    if(section_id) {
        console.log('Loading entries for section:', section_id); // Debug log
        
        $('#entries-container').html('<div class="text-center my-4"><i class="fas fa-spinner fa-spin"></i> Loading entries...</div>');
        
        $.ajax({
            url: 'post/modules/page/dynamic_sections/load_entries.php',
            type: 'POST',
            dataType: 'json',
            data: { 
                section_id: section_id, 
                page_id: page_id 
            },
            success: function(result) {
                console.log('Received data:', result); // Debug log
                
                if(result.success && result.html) {
                    $('#entries-container').html(result.html);
                    
                    // Initialize any plugins for new content
                    if(typeof CKEDITOR !== 'undefined') {
                        CKEDITOR.replace('editor1');
                    }
                    
                    // Initialize tooltips if needed
                    $('[data-toggle="tooltip"]').tooltip();
                } else {
                    showAlert(result.message || 'No entries found', 'info');
                    $('#entries-container').html('<div class="alert alert-info">No entries found for this section</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                const errorMsg = xhr.responseJSON && xhr.responseJSON.message 
                    ? xhr.responseJSON.message 
                    : 'Failed to load entries. Please try again.';
                
                showAlert(errorMsg, 'danger');
                $('#entries-container').html(`
                    <div class="alert alert-danger">
                        ${errorMsg}
                        <button class="btn btn-sm btn-secondary ml-2" onclick="retryLoadEntries()">Retry</button>
                    </div>
                `);
            }
        });
    } else {
        $('#entries-container').empty();
    }
});

// Retry function
function retryLoadEntries() {
    $('#section-select').trigger('change');
}

   // Function to refresh sections dropdown using jQuery AJAX
function refreshSectionsDropdown() {
    $.ajax({
        url: 'post/modules/page/dynamic_sections/get_sections.php',
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            if(result.success) {
                const $select = $('#section-select');
                $select.empty().append('<option value="">-- Select Section --</option>');
                
                $.each(result.sections, function(index, section) {
                    $select.append($('<option>', {
                        value: section.id,
                        text: section.section_name
                    }));
                });
            } else {
                console.error('Failed to load sections:', result.message);
                showAlert('Failed to load sections: ' + (result.message || 'Unknown error'), 'danger');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            showAlert('Failed to load sections. Please try again.', 'danger');
        }
    });
}

});
</script>