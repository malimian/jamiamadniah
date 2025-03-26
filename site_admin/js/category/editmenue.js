// Utility function to process strings into URL-friendly format
function process(value) {
    return value == undefined ? '' : value.replace(/[^a-z0-9_]+/gi, '-').replace(/^-|-$/g, '').toLowerCase();
}

// Auto-generate URL from title
$('#page_title').on('input', function() {
    var result = process($('#page_title').val());
    $('#page_url').val(result);
    $('#meta_title').val($('#page_title').val());
});

// Form validation and submission
validateform(function() {
    // Collect form data
    var formData = new FormData();
    formData.append('page_title', $('#page_title').val());
    formData.append('page_url', $('#page_url').val());
    formData.append('menu_description', $('#menu_description').val());
    formData.append('ctname', $('#ctname option:selected').val());
    formData.append('showInNavBar', $('#showInNavBar option:selected').val());
    formData.append('CreateHierarchy', $('#CreateHierarchy option:selected').val());
    formData.append('is_active', $('#is_active option:selected').val());
    formData.append('submit', true);
    
    // For edit mode, include the menu ID
    if (typeof menu_id !== 'undefined' && menu_id !== '0') {
        formData.append('menue_id', menu_id);
    }
    
    // Append image file if selected
    var imageFile = $('#menu_image')[0].files[0];
    if (imageFile) {
        formData.append('menu_image', imageFile);
    }
    
    // Append remove_image flag if checked
    if ($('#remove_image').length && $('#remove_image').is(':checked')) {
        formData.append('remove_image', '1');
    }

    // Send data to server
    $.ajax({
        url: 'post/category/editmenue.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json', // Expect JSON response
        success: function(response) {
            console.log('Success:', response);
            
            $("#error_id").fadeIn(300).delay(1500);
            
            if (response.status === 'success') {
                // Show success message
                var successMessage = (action === 'edit') ? 
                    'Menu Item Updated Successfully' : 
                    'Menu Item Added Successfully';
                
                $('#error_id').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> ${successMessage}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
                
                // For add mode, clear form and redirect
                if (action === 'add') {
                    $('form')[0].reset();
                    $('#image-preview').hide();
                    $('.custom-file-label').text('Choose image file');
                    
                    setTimeout(function() {
                        location.href = 'categories.php';
                    }, 1500);
                }
            } else {
                showError(response.message || 'Something went wrong. Please try again.');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
            try {
                // Try to parse the error response if it's JSON
                var errorResponse = JSON.parse(xhr.responseText);
                showError(errorResponse.message || 'Server error occurred. Please try again later.');
            } catch (e) {
                showError('Server error occurred. Please try again later.');
            }
        }
    });
}, function() {
    // Validation failed callback
    showError('Please fill out all required fields correctly.', 'warning');
});

// Helper function to show error messages
function showError(message, type = 'danger') {
    $('#error_id').empty().html(`
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <strong>${type === 'danger' ? 'Error' : 'Warning'}!</strong> ${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `).fadeIn(300).delay(3000).fadeOut(500);
}

// Image file validation
$('#menu_image').on('change', function() {
    const file = this.files[0];
    if (file) {
        // Check file size (2MB max)
        if (file.size > 2 * 1024 * 1024) {
            showError('Image size must be less than 2MB.');
            $(this).val('');
            $('.custom-file-label').text('Choose image file');
            $('#image-preview').hide();
            return;
        }
        
        // Check file type
        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            showError('Please upload a valid image file (JPEG, PNG, GIF).');
            $(this).val('');
            $('.custom-file-label').text('Choose image file');
            $('#image-preview').hide();
            return;
        }
        
        // If we get here, file is valid
        if ($('#remove_image').length) {
            $('#remove_image').prop('checked', false);
        }
    }
});