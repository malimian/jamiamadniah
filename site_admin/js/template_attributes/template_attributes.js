$(document).ready(function() {

    // Handle section name switching between select and input
    $('#section_name').on('change', function() {
        if ($(this).val()) {
            $('#new_section_name').val('');
        }
    });

    $('#new_section_name').on('input', function() {
        if ($(this).val()) {
            $('#section_name').val('');
        }
    });

     // Store the original modal body content
    const originalModalBody = $('#attributeModal .modal-body').html();
    
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

    // Handle section name switching between select and input
    $('#section_name').on('change', function() {
        if ($(this).val()) {
            $('#new_section_name').val('');
        }
    });

    $('#new_section_name').on('input', function() {
        if ($(this).val()) {
            $('#section_name').val('');
        }
    });

    // Handle form submission
    $('#attribute-form').on('submit', function(e) {
        e.preventDefault();

        // Use new section name if provided
        const newSectionName = $('#new_section_name').val();
        if (newSectionName) {
            $('#section_name').val(newSectionName);
        }

        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalText = submitBtn.text();
        
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    // Show success message and reload page
                    showNotification('success', response.message);
                    setTimeout(() => location.reload(), 1500);
                }
            },
            error: function() {
                showNotification('danger', 'An error occurred. Please try again.');
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });

    // Helper function to show notifications
    function showNotification(type, message) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show">
                ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        $('#attributes-container').prepend(alertHtml);
    }
    
});


    // Handle tab change to populate sections
   
   // Use event delegation in case the element is dynamically added
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
