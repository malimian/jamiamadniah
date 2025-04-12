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
                            <a class="nav-link" id="manage-tab" data-toggle="tab" href="#manage-sections" role="tab">Manage Sections</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="entries-tab" data-toggle="tab" href="#manage-entries" role="tab">Manage Entries</a>
                        </li>
                    </ul>
                    
                    <!-- Tab Content -->
                    <div class="tab-content" id="sectionTabsContent">
                        <!-- Create Section Tab -->
                        <div class="tab-pane fade show active" id="create-section" role="tabpanel">
                            <form id="createSectionForm" class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Section Name</label>
                                            <input type="text" id="section_name" name="section_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Page ID</label>
                                            <input type="number" id="page_id" name="page_id" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <h5 class="mt-4">Section Fields</h5>
                                <div id="fields-container">
                                    <div class="field-group card mb-3">
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label>Field Name</label>
                                                    <input type="text" name="fields[0][name]" placeholder="e.g., weight" class="form-control" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Field Label</label>
                                                    <input type="text" name="fields[0][label]" placeholder="e.g., Weight" class="form-control" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Field Type</label>
                                                    <select name="fields[0][type]" class="form-control" required>
                                                        <?php
                                                        $fieldTypes = return_multiple_rows("SELECT DISTINCT field_type FROM dynamic_fields");
                                                        foreach ($fieldTypes as $type): ?>
                                                            <option value="<?= $type['field_type'] ?>"><?= ucfirst($type['field_type']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label>Tab Group</label>
                                                    <select name="fields[0][tab_group]" class="form-control">
                                                        <?php
                                                        $tabGroups = return_multiple_rows("SELECT DISTINCT tab_group FROM dynamic_fields WHERE tab_group IS NOT NULL");
                                                        foreach ($tabGroups as $group): ?>
                                                            <option value="<?= $group['tab_group'] ?>"><?= ucfirst($group['tab_group']) ?></option>
                                                        <?php endforeach; ?>
                                                        <option value="new">+ Create New Group</option>
                                                    </select>
                                                    <input type="text" name="fields[0][new_tab_group]" class="form-control mt-2" placeholder="New Group Name" style="display:none;">
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Order</label>
                                                    <input type="number" name="fields[0][order]" class="form-control" value="0">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check mt-4">
                                                        <input type="checkbox" name="fields[0][required]" id="field0_required" class="form-check-input">
                                                        <label for="field0_required" class="form-check-label">Required Field</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <button type="button" class="btn btn-danger remove-field mt-4">
                                                        <i class="fas fa-trash"></i> Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="button" id="add-field" class="btn btn-secondary mt-2">
                                    <i class="fas fa-plus"></i> Add Field
                                </button>
                                <button type="button" id="submit-section" class="btn btn-primary mt-2">
                                    <i class="fas fa-save"></i> Create Section
                                </button>
                            </form>
                        </div>
                        
                        <!-- Manage Sections Tab -->
                        <div class="tab-pane fade" id="manage-sections" role="tabpanel">
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-striped" id="sections-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Section Name</th>
                                            <th>Page ID</th>
                                            <th>Fields Count</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sections = return_multiple_rows("
                                            SELECT ds.id, ds.section_name, ds.page_id, ds.isactive, 
                                                   COUNT(df.id) as fields_count
                                            FROM dynamic_sections ds
                                            LEFT JOIN dynamic_fields df ON ds.id = df.section_id
                                            GROUP BY ds.id
                                            ORDER BY ds.id DESC
                                        ");
                                        
                                        foreach ($sections as $section):
                                        ?>
                                        <tr data-id="<?= $section['id'] ?>">
                                            <td><?= $section['id'] ?></td>
                                            <td><?= htmlspecialchars($section['section_name']) ?></td>
                                            <td><?= $section['page_id'] ?></td>
                                            <td><?= $section['fields_count'] ?></td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input js-switch" 
                                                        id="active_<?= $section['id'] ?>" 
                                                        data-id="<?= $section['id'] ?>"
                                                        <?= $section['isactive'] ? 'checked' : '' ?>>
                                                    <label class="custom-control-label" for="active_<?= $section['id'] ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-section" 
                                                    data-id="<?= $section['id'] ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-info view-fields" 
                                                    data-id="<?= $section['id'] ?>">
                                                    <i class="fas fa-list"></i> Fields
                                                </button>
                                                <button class="btn btn-sm btn-danger delete-section" 
                                                    data-id="<?= $section['id'] ?>">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Manage Entries Tab -->
                        <div class="tab-pane fade" id="manage-entries" role="tabpanel">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Section</label>
                                        <select id="section-select" class="form-control">
                                            <option value="">-- Select Section --</option>
                                            <?php 
                                            $sections = return_multiple_rows("SELECT id, section_name, page_id FROM dynamic_sections");
                                            foreach ($sections as $section): ?>
                                                <option value="<?= $section['id'] ?>">
                                                    <?= htmlspecialchars($section['section_name']) ?> 
                                                    (Page <?= $section['page_id'] ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="entries-container" class="mt-4">
                                <div class="alert alert-info">
                                    Please select a section to view its entries
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Section Modal -->
<div class="modal fade" id="editSectionModal" tabindex="-1" role="dialog" aria-labelledby="editSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit-section-content">
                <!-- Content loaded via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-section-changes">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- View Fields Modal -->
<div class="modal fade" id="viewFieldsModal" tabindex="-1" role="dialog" aria-labelledby="viewFieldsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewFieldsModalLabel">Section Fields</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="view-fields-content">
                <!-- Content loaded via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let fieldCount = 1;
    
    // Initialize functions on page load
    initializePage();

    function initializePage() {
        // Load initial sections table
        loadSectionsTable();
        
        // Initialize switches if any exist
        if ($('.js-switch').length > 0) {
            initializeSwitches();
        }
    }

    // Add new field
    $('#add-field').click(function() {
        const newField = createFieldHtml(fieldCount);
        $('#fields-container').append(newField);
        fieldCount++;
    });

    // Helper function to create field HTML
    function createFieldHtml(index, fieldData = {}) {
        const fieldTypes = <?php echo json_encode(array_column($fieldTypes, 'field_type')); ?>;
        const tabGroups = <?php echo json_encode(array_column($tabGroups, 'tab_group')); ?>;
        
        const fieldName = fieldData.name || '';
        const fieldLabel = fieldData.label || '';
        const fieldType = fieldData.type || 'text';
        const tabGroup = fieldData.tab_group || '';
        const fieldOrder = fieldData.order || index;
        const isRequired = fieldData.required || false;
        const isNewTabGroup = tabGroup && !tabGroups.includes(tabGroup);

        return `
        <div class="field-group card mb-3" ${fieldData.id ? `data-field-id="${fieldData.id}"` : ''}>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Field Name</label>
                        <input type="text" name="fields[${index}][name]" value="${fieldName}" placeholder="e.g., weight" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Field Label</label>
                        <input type="text" name="fields[${index}][label]" value="${fieldLabel}" placeholder="e.g., Weight" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Field Type</label>
                        <select name="fields[${index}][type]" class="form-control" required>
                            ${fieldTypes.map(type => 
                                `<option value="${type}" ${type === fieldType ? 'selected' : ''}>${type.charAt(0).toUpperCase() + type.slice(1)}</option>`
                            ).join('')}
                        </select>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Tab Group</label>
                        <select name="fields[${index}][tab_group]" class="form-control">
                            <option value="">-- Select Group --</option>
                            ${tabGroups.map(group => 
                                `<option value="${group}" ${group === tabGroup && !isNewTabGroup ? 'selected' : ''}>${group.charAt(0).toUpperCase() + group.slice(1)}</option>`
                            ).join('')}
                            <option value="new" ${isNewTabGroup ? 'selected' : ''}>+ Create New Group</option>
                        </select>
                        <input type="text" name="fields[${index}][new_tab_group]" 
                               class="form-control mt-2" 
                               placeholder="New Group Name" 
                               value="${isNewTabGroup ? tabGroup : ''}"
                               style="${isNewTabGroup ? '' : 'display:none;'}"
                               ${isNewTabGroup ? 'required' : ''}>
                    </div>
                    <div class="col-md-2">
                        <label>Order</label>
                        <input type="number" name="fields[${index}][order]" class="form-control" value="${fieldOrder}">
                    </div>
                    <div class="col-md-4">
                        <div class="form-check mt-4">
                            <input type="checkbox" name="fields[${index}][required]" 
                                   id="field${index}_required" 
                                   class="form-check-input" 
                                   ${isRequired ? 'checked' : ''}>
                            <label for="field${index}_required" class="form-check-label">Required Field</label>
                        </div>
                    </div>
                    <div class="col-md-2 text-right">
                        <button type="button" class="btn btn-danger remove-field mt-4">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>`;
    }

    // Toggle new tab group input
    $(document).on('change', 'select[name*="[tab_group]"]', function() {
        const newGroupInput = $(this).closest('.row').find('input[name*="[new_tab_group]"]');
        if($(this).val() === 'new') {
            newGroupInput.show().attr('required', true);
        } else {
            newGroupInput.hide().removeAttr('required');
        }
    });

    // Remove field
    $(document).on('click', '.remove-field', function() {
        $(this).closest('.field-group').remove();
    });
    
    // Section creation
    $('#submit-section').click(function() {
        // Basic validation
        if ($('#section_name').val().trim() === '') {
            showAlert('Section name is required', 'danger');
            return;
        }

        if ($('#page_id').val().trim() === '' || $('#page_id').val() <= 0) {
            showAlert('Valid Page ID is required', 'danger');
            return;
        }

        // Check at least one field exists
        if ($('.field-group').length === 0) {
            showAlert('Please add at least one field', 'danger');
            return;
        }

        // Validate all fields
        let isValid = true;
        $('.field-group').each(function(index) {
            if ($(this).find('[name*="[name]"]').val().trim() === '' || 
                $(this).find('[name*="[label]"]').val().trim() === '') {
                isValid = false;
                return false; // break loop
            }
            
            // Validate new tab group if selected
            const tabGroupSelect = $(this).find('[name*="[tab_group]"]');
            if (tabGroupSelect.val() === 'new') {
                const newTabGroup = $(this).find('[name*="[new_tab_group]"]').val().trim();
                if (newTabGroup === '') {
                    isValid = false;
                    return false;
                }
            }
        });

        if (!isValid) {
            showAlert('Please fill out all required field information', 'danger');
            return;
        }

        // Collect form data
        const formData = {
            section_name: $('#section_name').val(),
            page_id: $('#page_id').val(),
            fields: [],
            submit_btn: true
        };

        // Collect all fields
        $('.field-group').each(function(index) {
            const tabGroup = $(this).find('[name*="[tab_group]"]').val() === 'new' 
                ? $(this).find('[name*="[new_tab_group]"]').val()
                : $(this).find('[name*="[tab_group]"]').val();
                
            const field = {
                name: $(this).find('[name*="[name]"]').val(),
                label: $(this).find('[name*="[label]"]').val(),
                type: $(this).find('[name*="[type]"]').val(),
                tab_group: tabGroup,
                order: $(this).find('[name*="[order]"]').val(),
                required: $(this).find('[name*="[required]"]').is(':checked') ? 1 : 0
            };
            
            // Include field ID if editing existing field
            const fieldId = $(this).data('field-id');
            if (fieldId) {
                field.id = fieldId;
            }
            
            formData.fields.push(field);
        });

        // Send data
        senddata('post/modules/page/dynamic_sections/create_section.php', "POST", formData,
            function(result) {
                if(result.success) {
                    // Reset form
                    resetSectionForm();
                    showAlert(result.message, 'success');
                    
                    // Refresh sections dropdown and table
                    refreshSectionsDropdown();
                    loadSectionsTable();
                    
                    // Switch to manage sections tab
                    $('#manage-tab').tab('show');
                } else {
                    showAlert(result.message || 'Failed to create section', 'danger');
                }
            },
            function(error) {
                showAlert(error.message || 'Something went wrong', 'danger');
            }
        );
    });
    
    function resetSectionForm() {
        $('#section_name').val('');
        $('#page_id').val('');
        $('#fields-container').html(createFieldHtml(0));
        fieldCount = 1;
    }
    
    // Load entries when section is selected
    $('#section-select').change(function() {
        const section_id = $(this).val();
        
        if(section_id) {
            loadSectionEntries(section_id);
        } else {
            $('#entries-container').html('<div class="alert alert-info">Please select a section</div>');
        }
    });
    
    function loadSectionEntries(section_id) {
        $('#entries-container').html('<div class="text-center my-4"><i class="fas fa-spinner fa-spin"></i> Loading entries...</div>');
        
        $.ajax({
            url: 'post/modules/page/dynamic_sections/load_entries.php',
            type: 'POST',
            dataType: 'json',
            data: { section_id: section_id },
            success: function(result) {
                if(result.success && result.html) {
                    $('#entries-container').html(result.html);
                    initializeEntryComponents();
                } else {
                    showAlert(result.message || 'No entries found', 'info');
                    $('#entries-container').html('<div class="alert alert-info">No entries found for this section</div>');
                }
            },
            error: handleAjaxError
        });
    }
    
    function initializeEntryComponents() {
        // Initialize any plugins for new content
        if(typeof CKEDITOR !== 'undefined') {
            $('.rich-text-editor').each(function() {
                CKEDITOR.replace(this.id);
            });
        }
        
        // Initialize tooltips if needed
        $('[data-toggle="tooltip"]').tooltip();
        
        // Initialize datepickers if any
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    }
    
    // Load sections table
    function loadSectionsTable() {
        $.ajax({
            url: 'post/modules/page/dynamic_sections/load_sections_table.php',
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if(result.success && result.html) {
                    $('#sections-table tbody').html(result.html);
                    initializeSwitches();
                } else {
                    showAlert(result.message || 'Failed to load sections', 'danger');
                }
            },
            error: handleAjaxError
        });
    }
    
    // Initialize switches for active/inactive
    function initializeSwitches() {
        $('.js-switch').each(function() {
            const switchery = new Switchery(this, {
                size: 'small',
                color: '#1AB394',
                secondaryColor: '#ED5565'
            });
            
            $(this).on('change', function() {
                const sectionId = $(this).data('id');
                const isActive = $(this).is(':checked') ? 1 : 0;
                
                $.ajax({
                    url: 'post/modules/page/dynamic_sections/update_section_status.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        section_id: sectionId,
                        is_active: isActive
                    },
                    success: function(result) {
                        if(!result.success) {
                            showAlert(result.message || 'Failed to update status', 'danger');
                            // Revert the switch
                            $(this).prop('checked', !isActive).trigger('change');
                        }
                    },
                    error: handleAjaxError
                });
            });
        });
    }
    
    // Edit section
    $(document).on('click', '.edit-section', function() {
        const sectionId = $(this).data('id');
        
        $('#editSectionModal').modal('show');
        $('#edit-section-content').html('<div class="text-center my-4"><i class="fas fa-spinner fa-spin"></i> Loading section data...</div>');
        
        $.ajax({
            url: 'post/modules/page/dynamic_sections/load_section_edit.php',
            type: 'POST',
            dataType: 'json',
            data: { section_id: sectionId },
            success: function(result) {
                if(result.success && result.html) {
                    $('#edit-section-content').html(result.html);
                } else {
                    $('#edit-section-content').html('<div class="alert alert-danger">' + (result.message || 'Failed to load section data') + '</div>');
                }
            },
            error: handleAjaxError
        });
    });
    
    // View fields
    $(document).on('click', '.view-fields', function() {
        const sectionId = $(this).data('id');
        
        $('#viewFieldsModal').modal('show');
        $('#view-fields-content').html('<div class="text-center my-4"><i class="fas fa-spinner fa-spin"></i> Loading fields...</div>');
        
        $.ajax({
            url: 'post/modules/page/dynamic_sections/load_section_fields.php',
            type: 'POST',
            dataType: 'json',
            data: { section_id: sectionId },
            success: function(result) {
                if(result.success && result.html) {
                    $('#view-fields-content').html(result.html);
                } else {
                    $('#view-fields-content').html('<div class="alert alert-danger">' + (result.message || 'Failed to load fields') + '</div>');
                }
            },
            error: handleAjaxError
        });
    });
    
    // Save edited section
    $('#save-section-changes').click(function() {
        const sectionId = $('#edit_section_id').val();
        const formData = {
            section_id: sectionId,
            section_name: $('#edit_section_name').val(),
            page_id: $('#edit_page_id').val(),
            fields: [],
            deleted_fields: []
        };
        
        // Validate
        if(formData.section_name.trim() === '') {
            showAlert('Section name is required', 'danger', '#edit-section-content');
            return;
        }
        
        if(formData.page_id <= 0) {
            showAlert('Valid Page ID is required', 'danger', '#edit-section-content');
            return;
        }
        
        // Collect deleted fields
        $('input[name="deleted_fields[]"]').each(function() {
            formData.deleted_fields.push($(this).val());
        });
        
        // Collect fields
        $('.edit-field-group').each(function(index) {
            const tabGroup = $(this).find('[name*="[tab_group]"]').val() === 'new' 
                ? $(this).find('[name*="[new_tab_group]"]').val()
                : $(this).find('[name*="[tab_group]"]').val();
                
            const field = {
                id: $(this).data('field-id') || 0,
                name: $(this).find('[name*="[name]"]').val(),
                label: $(this).find('[name*="[label]"]').val(),
                type: $(this).find('[name*="[type]"]').val(),
                tab_group: tabGroup,
                order: $(this).find('[name*="[order]"]').val(),
                required: $(this).find('[name*="[required]"]').is(':checked') ? 1 : 0
            };
            formData.fields.push(field);
        });
        
        // Send data
        senddata('post/modules/page/dynamic_sections/update_section.php', "POST", formData,
            function(result) {
                if(result.success) {
                    showAlert(result.message, 'success');
                    $('#editSectionModal').modal('hide');
                    loadSectionsTable();
                    refreshSectionsDropdown();
                    
                    // Reload entries if viewing this section
                    const currentSection = $('#section-select').val();
                    if (currentSection == sectionId) {
                        loadSectionEntries(sectionId);
                    }
                } else {
                    showAlert(result.message || 'Failed to update section', 'danger', '#edit-section-content');
                }
            },
            function(error) {
                showAlert(error.message || 'Something went wrong', 'danger', '#edit-section-content');
            }
        );
    });
    
    // Delete section
    $(document).on('click', '.delete-section', function() {
        const sectionId = $(this).data('id');
        
        if(confirm('Are you sure you want to delete this section? All associated fields and data will also be deleted.')) {
            $.ajax({
                url: 'post/modules/page/dynamic_sections/delete_section.php',
                type: 'POST',
                dataType: 'json',
                data: { section_id: sectionId },
                success: function(result) {
                    if(result.success) {
                        showAlert(result.message, 'success');
                        loadSectionsTable();
                        refreshSectionsDropdown();
                        
                        // Clear entries if viewing this section
                        const currentSection = $('#section-select').val();
                        if (currentSection == sectionId) {
                            $('#entries-container').html('<div class="alert alert-info">Please select a section</div>');
                            $('#section-select').val('');
                        }
                    } else {
                        showAlert(result.message || 'Failed to delete section', 'danger');
                    }
                },
                error: handleAjaxError
            });
        }
    });
    
    // Add new field in edit modal
    $(document).on('click', '#add-edit-field', function() {
        const fieldCount = $('.edit-field-group').length;
        const newField = createFieldHtml(fieldCount);
        $('#edit-fields-container').append(newField);
    });
    
    // Remove field in edit modal
    $(document).on('click', '.remove-edit-field', function() {
        const fieldId = $(this).closest('.edit-field-group').data('field-id');
        if(fieldId && fieldId > 0) {
            // Add to deleted fields list
            $('#deleted_fields').append(`<input type="hidden" name="deleted_fields[]" value="${fieldId}">`);
        }
        $(this).closest('.edit-field-group').remove();
    });

    // Function to refresh sections dropdown
    function refreshSectionsDropdown() {
        $.ajax({
            url: 'post/modules/page/dynamic_sections/get_sections.php',
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if(result.success) {
                    const $select = $('#section-select');
                    const currentValue = $select.val();
                    $select.empty().append('<option value="">-- Select Section --</option>');
                    
                    $.each(result.sections, function(index, section) {
                        $select.append($('<option>', {
                            value: section.id,
                            text: section.section_name + ' (Page ' + section.page_id + ')'
                        }));
                    });
                    
                    // Restore selected value if still available
                    if (currentValue && $select.find('option[value="' + currentValue + '"]').length) {
                        $select.val(currentValue);
                    }
                } else {
                    console.error('Failed to load sections:', result.message);
                }
            },
            error: handleAjaxError
        });
    }
    
    // Common error handler
    function handleAjaxError(xhr, status, error) {
        console.error('AJAX Error:', status, error);
        const errorMsg = xhr.responseJSON && xhr.responseJSON.message 
            ? xhr.responseJSON.message 
            : 'Failed to complete the operation. Please try again.';
        
        showAlert(errorMsg, 'danger');
        return errorMsg;
    }
    
    // Retry function for entries loading
    window.retryLoadEntries = function() {
        const sectionId = $('#section-select').val();
        if (sectionId) {
            loadSectionEntries(sectionId);
        }
    };
});
</script>