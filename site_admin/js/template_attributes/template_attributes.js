$(document).ready(function() {
    // Store the original modal body content
    const originalModalBody = $('#attributeModal .modal-body').html();
    
    // Handle add/edit attribute modal
    $('#attributeModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const action = button.data('action');
        const modal = $(this);
        
        // Set form action
        $('#form-action').val(action);
        
        if (action === 'add') {
            // Add new attribute
            modal.find('.modal-title').text('Add New Attribute');
            modal.find('button[type="submit"]').text('Create Attribute');
            
            // Reset form
            $('#attribute-form')[0].reset();
            $('#attribute_id').val('');
            $('#option-container').empty();
            
            // Make sure we have the original form content
            modal.find('.modal-body').html(originalModalBody);
            
            // Set tab/section if coming from section button
            if (button.hasClass('add-attribute-to-section')) {
                const tabId = button.data('tab-id');
                const sectionName = button.data('section-name');
                
                // Set the tab value
                $('#tab_name').val(tabId);
                
                // Load sections for this tab and then set the section
                loadSectionsForTab(tabId, function() {
                    $('#section_name').val(sectionName);
                });
            }
        } 
        else if (action === 'edit') {
            // Edit existing attribute
            const attrId = button.data('id');
            modal.find('.modal-title').text('Edit Attribute');
            modal.find('button[type="submit"]').text('Update Attribute');
            
            // Show loading state
            modal.find('.modal-body').html(`
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p>Loading attribute details...</p>
                </div>
            `);
            
            // Load attribute data
            $.ajax({
                url: 'get/template_attributes/get_attribute_details.php',
                type: 'GET',
                data: { id: attrId },
                success: function(response) {
                    if (response.success) {
                        // Restore the original form content
                        modal.find('.modal-body').html(originalModalBody);
                        
                        // Populate the form
                        $('#attribute_id').val(response.data.id);
                        $('#attribute_label').val(response.data.attribute_label);
                        $('#attribute_name').val(response.data.attribute_name);
                        $('#attribute_type').val(response.data.attribute_type);
                        $('#is_dynamic').val(response.data.is_dynamic);
                        $('#icon_class').val(response.data.icon_class);
                        $('#default_value').val(response.data.default_value);
                        $('#is_required').val(response.data.is_required);
                        $('#sort_order').val(response.data.sort_order);
                        
                        // Set tab and load sections
                        $('#tab_name').val(response.data.tab_id);
                        loadSectionsForTab(response.data.tab_id, function() {
                            // Handle section name
                            const sectionSelect = $('#section_name');
                            const sectionName = response.data.section_name;
                            if (sectionName && sectionSelect.find('option[value="' + sectionName + '"]').length === 0) {
                                $('#new_section_name').val(sectionName);
                            } else {
                                sectionSelect.val(sectionName);
                                $('#new_section_name').val('');
                            }
                        });
                    }
                }
            });
        }
    });

    // Handle tab change to populate sections
    $(document).on('change', '#tab_name', function() {
        const tabId = $(this).val();
        loadSectionsForTab(tabId);
    });

    // Handle form submission
    $('#attribute-form').on('submit', function(e) {
        e.preventDefault();

        const newSectionName = $('#new_section_name').val();
        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalText = submitBtn.text();

        let formData = form.serializeArray(); // get form fields as array of name/value pairs

        // If newSectionName exists, override or inject 'section_name'
        if (newSectionName) {
            // Remove any existing section_name field (from select)
            formData = formData.filter(field => field.name !== 'section_name');

            // Add new value as section_name
            formData.push({ name: 'section_name', value: newSectionName });
        }

        console.log(formData);

        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: $.param(formData), // convert array back to query string
            success: function(response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    setTimeout(() => location.reload(), 1500);
                }
            },
            error: function() {
                showAlert('An error occurred. Please try again.', 'danger');
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });
    
    // Handle tab change to populate sections
    $(document).on('change', '#tab_name', function() {
        const tabId = $(this).val();
        const $sectionSelect = $('#section_name');
        
        console.log('Tab changed to:', tabId); // Debugging
        
        // Clear existing options except the first
        $sectionSelect.find('option').not(':first').remove();
        
        if (tabId) {
            // Show loading state
            $sectionSelect.prop('disabled', true);
            const $loadingOption = $('<option>').text('Loading sections...').val('');
            $sectionSelect.append($loadingOption);
            
            // Fetch sections for this tab
            $.ajax({
                url: 'get/template_attributes/get_sections_by_tab.php',
                method: 'GET',
                data: { tab_id: tabId },
                dataType: 'json',
                success: function(sections) {
                    console.log('Sections received:', sections); // Debugging
                    
                    // Remove loading option
                    $loadingOption.remove();
                    
                    // Add new options
                    if (sections && sections.length > 0) {
                        sections.forEach(function(section) {
                            $sectionSelect.append(
                                $('<option>', {
                                    value: section.section_name,
                                    text: section.section_name
                                })
                            );
                        });
                    } else {
                        $sectionSelect.append(
                            $('<option>', {
                                value: '',
                                text: 'No sections found'
                            })
                        );
                    }
                    
                    $sectionSelect.prop('disabled', false);
                    
                    // If we're adding from a section button, pre-select the section
                    const sectionName = $('.add-attribute-to-section').data('section-name');
                    if (sectionName) {
                        $sectionSelect.val(sectionName);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching sections:', error); // Debugging
                    $loadingOption.text('Error loading sections');
                    $sectionSelect.prop('disabled', false);
                }
            });
        } else {
            // No tab selected - clear sections
            $sectionSelect.find('option').not(':first').remove();
            $sectionSelect.prop('disabled', false);
        }
    });

    // Handle section name switching between select and input using delegated events
    $(document).on('change', '#section_name', function() {
        if ($(this).val()) {
            $('#new_section_name').val('');
        }
    });

    $(document).on('input', '#new_section_name', function() {
        if ($(this).val()) {
            $('#section_name').val('');
        }
    });

    // Function to load sections for a tab
    function loadSectionsForTab(tabId, callback) {
        const $sectionSelect = $('#section_name');
        
        // Clear existing options except the first
        $sectionSelect.find('option').not(':first').remove();
        
        if (tabId) {
            // Show loading state
            $sectionSelect.prop('disabled', true);
            const $loadingOption = $('<option>').text('Loading sections...').val('');
            $sectionSelect.append($loadingOption);
            
            // Fetch sections for this tab
            $.ajax({
                url: 'get/template_attributes/get_sections_by_tab.php',
                method: 'GET',
                data: { tab_id: tabId },
                dataType: 'json',
                success: function(sections) {
                    // Remove loading option
                    $loadingOption.remove();
                    
                    // Add new options
                    if (sections && sections.length > 0) {
                        sections.forEach(function(section) {
                            $sectionSelect.append(
                                $('<option>', {
                                    value: section.section_name,
                                    text: section.section_name
                                })
                            );
                        });
                    }
                    
                    $sectionSelect.prop('disabled', false);
                    
                    // Execute callback if provided
                    if (typeof callback === 'function') {
                        callback();
                    }
                },
                error: function(xhr, status, error) {
                    $loadingOption.text('Error loading sections');
                    $sectionSelect.prop('disabled', false);
                }
            });
        }
    }

    // Handle delete buttons for attributes NOT in use
    document.querySelectorAll('.delete-attribute').forEach(button => {
        button.addEventListener('click', function() {
            const attributeId = this.getAttribute('data-id');
            deleteAttribute(attributeId);
        });
    });
    
    // Handle delete buttons for attributes IN USE
    document.querySelectorAll('.delete-attribute-in-use').forEach(button => {
        button.addEventListener('click', function() {
            const attributeId = this.getAttribute('data-id');
            const usageCount = this.getAttribute('data-usage-count');
            
            const confirmDelete = confirm(`This attribute is being used in ${usageCount} page(s). Deleting it will remove the data and values for all pages that are using this attribute. Are you sure you want to delete it?`);
            
            if (confirmDelete) {
                deleteAttribute(attributeId);
            }
        });
    });
    
    function deleteAttribute(attributeId) {
        const url = 'post/template_attributes/delete_attribute.php';
        const parameters = { id: attributeId };

        senddata(
            url,
            'POST',
            parameters,
            function(response) {
                try {
                    var result = response;

                    console.log(result);
                    console.log(typeof response, response);

                    if (result.success) {
                        showAlert(result.message, "success");
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showAlert(result.message, "warning");
                    }
                } catch (e) {
                    showAlert('Invalid response from server', "danger");
                    console.error(e);
                }
            },
            function(error) {
                showAlert('Failed to delete attribute', "danger");
                console.error(error);
            }
        );
    }

    // Handle copy attribute button
    $(document).on('click', '.copy-attribute', function() {
        const attributeId = $(this).data('id');
        
        // Show confirmation dialog
        if (confirm('Are you sure you want to copy this attribute?')) {
            $.ajax({
                url: 'post/template_attributes/copy_attribute.php',
                type: 'POST',
                data: { id: attributeId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showAlert(response.message, 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showAlert(response.message, 'danger');
                    }
                },
                error: function() {
                    showAlert('Error copying attribute', 'danger');
                }
            });
        }
    });

    // Handle duplicate section button
    $(document).on('click', '.duplicate-section', function() {
        const tabId = $(this).data('tab-id');
        const sectionName = $(this).data('section-name');
        const attributes = $(this).data('attributes');
        
        const newSectionName = prompt('Enter name for the duplicated section:', sectionName + ' Copy');
        
        if (newSectionName && newSectionName.trim() !== '') {
            // Show loading indicator
            const originalButton = $(this);
            originalButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Duplicating...');
            
            $.ajax({
                url: 'post/template_attributes/duplicate_section.php',
                type: 'POST',
                data: {
                    tab_id: tabId,
                    original_section: sectionName,
                    new_section: newSectionName,
                    attributes: attributes,
                    template_id: template_id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showAlert(response.message, 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showAlert(response.message, 'danger');
                        originalButton.prop('disabled', false).html('<i class="fas fa-clone mr-1"></i> Duplicate');
                    }
                },
                error: function() {
                    showAlert('Error duplicating section', 'danger');
                    originalButton.prop('disabled', false).html('<i class="fas fa-clone mr-1"></i> Duplicate');
                }
            });
        }
    });

// Handle attribute options management
$(document).on('click', '.attribute-settings', function() {
    const attributeId = $(this).data('id');
    
    // Open a modal to manage attribute options
    const optionsModal = `
        <div class="modal fade" id="optionsModal" tabindex="-1" role="dialog" aria-labelledby="optionsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="optionsModalLabel">Manage Attribute Options</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="mb-3">
                            <button type="button" class="btn btn-primary" id="addNewOption">
                                <i class="fas fa-plus"></i> Add New Option
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="optionsTable">
                                <thead>
                                    <tr>
                                        <th>Option Value</th>
                                        <th>Option Label</th>
                                        <th>Sort Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="optionsTableBody">
                                    <!-- Options will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Add modal to DOM
    $('body').append(optionsModal);
    
    // Show modal
    const modal = $('#optionsModal');
    modal.modal('show');
    
    // Store attribute ID in modal data
    modal.data('attribute-id', attributeId);
    
    // Load options
    loadAttributeOptions(attributeId);
    
    // Handle modal close
    modal.on('hidden.bs.modal', function() {
        $(this).remove();
    });
    
    // Handle add new option
    $(document).on('click', '#addNewOption', function() {
        const modal = $('#optionsModal');
        const attributeId = modal.data('attribute-id');
        
        const optionForm = `
            <div class="card mb-4" id="optionFormCard">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add New Option</h5>
                </div>
                <div class="card-body">
                    <form id="optionForm">
                        <input type="hidden" name="attribute_id" value="${attributeId}">
                        <input type="hidden" name="action" value="add">
                        <div class="form-group">
                            <label for="option_value">Option Value</label>
                            <input type="text" class="form-control" name="option_value" id="option_value" required>
                            <small class="form-text text-muted">Internal value used in code</small>
                        </div>
                        <div class="form-group">
                            <label for="option_label">Option Label</label>
                            <input type="text" class="form-control" name="option_label" id="option_label" required>
                            <small class="form-text text-muted">Displayed to users</small>
                        </div>
                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" class="form-control" name="sort_order" id="sort_order" value="0">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Save Option</button>
                            <button type="button" class="btn btn-secondary" id="cancelOptionForm">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        `;
        
        modal.find('.modal-body').prepend(optionForm);
    });
    
  // Handle cancel option form
$(document).on('click', '#cancelOptionForm', function() {
    $('#optionFormCard').remove();
});

// Handle option form submission
$(document).on('submit', '#optionForm', function(e) {
    e.preventDefault();
    const form = $(this);
    const submitBtn = form.find('button[type="submit"]');
    const originalText = submitBtn.html();
    
    submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
    
    const formData = form.serialize();
    
    $.ajax({
        url: 'post/template_attributes/save_attribute_option.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showAlert(response.message, 'success');
                $('#optionFormCard').remove();
                // Reload options for the current attribute
                const modal = $('#optionsModal');
                const attributeId = modal.data('attribute-id');
                loadAttributeOptions(attributeId);
            } else {
                showAlert(response.message, 'danger');
            }
            submitBtn.prop('disabled', false).html(originalText);
        },
        error: function() {
            showAlert('Error saving option', 'danger');
            submitBtn.prop('disabled', false).html(originalText);
        }
    });
});

// Handle edit option
$(document).on('click', '.edit-option', function() {
    const optionId = $(this).data('id');
    const row = $(this).closest('tr');
    const optionValue = row.find('td:eq(0)').text();
    const optionLabel = row.find('td:eq(1)').text();
    const sortOrder = row.find('td:eq(2)').text();
    
    const optionForm = `
        <div class="card mb-4" id="optionFormCard">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Option</h5>
            </div>
            <div class="card-body">
                <form id="optionForm">
                    <input type="hidden" name="id" value="${optionId}">
                    <input type="hidden" name="action" value="edit">
                    <div class="form-group">
                        <label for="option_value">Option Value</label>
                        <input type="text" class="form-control" name="option_value" id="option_value" value="${optionValue}" required>
                    </div>
                    <div class="form-group">
                        <label for="option_label">Option Label</label>
                        <input type="text" class="form-control" name="option_label" id="option_label" value="${optionLabel}" required>
                    </div>
                    <div class="form-group">
                        <label for="sort_order">Sort Order</label>
                        <input type="number" class="form-control" name="sort_order" id="sort_order" value="${sortOrder}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update Option</button>
                        <button type="button" class="btn btn-secondary" id="cancelOptionForm">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    `;
    
    $('#optionsModal .modal-body').prepend(optionForm);
});

// Handle delete option
$(document).on('click', '.delete-option', function() {
    const optionId = $(this).data('id');
    
    if (confirm('Are you sure you want to delete this option?')) {
        const deleteBtn = $(this);
        const originalHtml = deleteBtn.html();
        
        deleteBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        
        $.ajax({
            url: 'post/template_attributes/delete_attribute_option.php',
            type: 'POST',
            data: { id: optionId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    // Reload options for the current attribute
                    const modal = $('#optionsModal');
                    const attributeId = modal.data('attribute-id');
                    loadAttributeOptions(attributeId);
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function() {
                showAlert('Error deleting option', 'danger');
            },
            complete: function() {
                deleteBtn.prop('disabled', false).html(originalHtml);
            }
        });
    }
});


});

function loadAttributeOptions(attributeId) {
    $.ajax({
        url: 'get/template_attributes/get_attribute_options.php',
        type: 'GET',
        data: { attribute_id: attributeId },
        dataType: 'json',
        success: function(response) {
            const tbody = $('#optionsTableBody');
            tbody.empty();
            
            if (response.success && response.data.length > 0) {
                response.data.forEach(option => {
                    tbody.append(`
                        <tr data-option-id="${option.id}">
                            <td>${option.option_value}</td>
                            <td>${option.option_label}</td>
                            <td>${option.sort_order}</td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-option" data-id="${option.id}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger delete-option" data-id="${option.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                });
            } else {
                tbody.append('<tr><td colspan="4" class="text-center">No options found</td></tr>');
            }
        },
        error: function() {
            showAlert('Error loading options', 'danger');
        }
    });
}

});