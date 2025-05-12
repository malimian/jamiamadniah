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
            
            // Set tab/section if coming from section button
            if (button.hasClass('add-attribute-to-section')) {
                $('#tab_name').val(button.data('tab-name'));
                $('#section_name').val(button.data('section-name'));
            }
            
            // Reset form
            $('#attribute-form')[0].reset();
            $('#attribute_id').val('');
            $('#option-container').empty();
            
            // Make sure we have the original form content
            modal.find('.modal-body').html(originalModalBody);
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
                    console.log(response);

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
                        $('#section_name').val(response.data.section_name);
                        $('#tab_name').val(response.data.tab_name);
                        
                    } else {
                        modal.find('.modal-body').html(`
                            <div class="alert alert-danger">
                                Error loading attribute: ${response.message}
                            </div>
                        `);
                    }
                },
                error: function() {
                    modal.find('.modal-body').html(`
                        <div class="alert alert-danger">
                            Error loading attribute details. Please try again.
                        </div>
                    `);
                }
            });
        }
    });

    // Handle form submission
    $('#attribute-form').on('submit', function(e) {
        e.preventDefault();
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
                } else {
                    showNotification('danger', response.message);
                    submitBtn.prop('disabled', false).text(originalText);
                }
            },
            error: function() {
                showNotification('danger', 'An error occurred. Please try again.');
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });

    // Handle delete attribute
    $(document).on('click', '.delete-attribute', function() {
        const attrId = $(this).data('id');
        if (confirm('Are you sure you want to delete this attribute?')) {
            $.ajax({
                url: 'post/template_attributes/delete_attribute.php',
                type: 'POST',
                data: { id: attrId },
                success: function(response) {
                    if (response.success) {
                        showNotification('success', response.message);
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showNotification('danger', response.message);
                    }
                },
                error: function() {
                    showNotification('danger', 'An error occurred while deleting the attribute');
                }
            });
        }
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