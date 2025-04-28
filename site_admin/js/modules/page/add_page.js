$(document).ready(function() {
    // URL field handling
    $('#modalCheckUrl').click(function() {
        $("#modalPageUrl").attr("readonly", !this.checked);
    });
    
    // Auto-generate URL from title when typing
    $('#modalPageTitle').on('input', function() {
        if (!$('#modalCheckUrl').prop('checked')) {
            var result = $('#modalPageTitle').val()
                .toLowerCase()
                .replace(/[^a-z0-9_]+/g, '-')
                .replace(/^-|-$/g, '');
            $('#modalPageUrl').val(result);
        }
    });

    // Handle duplicate page click
    $('.duplicate-page').click(function(e) {
        e.preventDefault();
        var pageId = $(this).data('pageid');
        
        // Show loading state
        $('#message').html('<div class="alert alert-info">Loading page data...</div>');
        
        // Fetch page data using senddata function
        senddata(
            'post/page/getpagedata.php',
            "POST", 
            {
                page_id: pageId,
                get_data: true
            },
            function(result) {
                if(result.status === 'success') {
                    // Change modal title to indicate duplication
                    var originalTitle = result.data.page_title;
                    $('#addPageModalLabel')
                        .text('Duplicate Page: ' + originalTitle)
                        .attr('data-original-title', originalTitle);
                    
                    // Show duplicate indicator
                    $('#duplicateIndicator').removeClass('d-none');
                    $('#originalPageTitle').text(originalTitle);
                    
                    // Show duplicate options tab
                    $('#duplicateOptionsTab').removeClass('d-none');
                    $('#duplicateOptionsTab a').tab('show');
                    
                    // Populate the modal with the page data
                    $('#modalPageTitle').val(originalTitle + ' (Copy)');
                    $('#modalCtname').val(result.data.ctname).trigger('change');
                    
                    // Generate new URL based on copied title
                    var newUrl = result.data.page_url.replace('.html', '') + '-copy';
                    $('#modalPageUrl').val(newUrl);
                    
                    // Uncheck the URL lock checkbox
                    $('#modalCheckUrl').prop('checked', false);
                    $("#modalPageUrl").attr("readonly", false);
                    
                    // Set other fields
                    if(result.data.p_image) {
                        $('#modalPImage').val(result.data.p_image);
                    }
                    $('#modalSiteTemplate').val(result.data.site_template).trigger('change');
                    $('#modalTemplatePage').val(result.data.template_page).trigger('change');
                    
                    // Store original page ID for duplication
                    $('#addPageForm').data('original-page-id', pageId);
                    
                    // Show the modal
                    $('#addPageModal').modal('show');
                    $('#message').empty();
                } else {
                    showAlert('Error: ' + result.message, 'danger');
                }
            },
            function(error) {
                showAlert('Error fetching page data: ' + error, 'danger');
            }
        );
    });

    // Handle new page click (reset form)
    $('.add-new-page').click(function() {
        // Reset form and hide duplicate-specific elements
        $('#addPageForm')[0].reset();
        $('#addPageForm').removeClass('was-validated');
        $('#duplicateIndicator').addClass('d-none');
        $('#duplicateOptionsTab').addClass('d-none');
        $('#addPageModalLabel').text($('#addPageModalLabel').data('default-title'));
        $('#modalCheckUrl').prop('checked', false);
        $("#modalPageUrl").attr("readonly", false);
        
        // Reset select2 dropdowns
        $('#modalCtname, #modalSiteTemplate, #modalTemplatePage').val(null).trigger('change');
        
        // Show description tab by default
        $('.nav-tabs a[href="#modalDescriptionTab"]').tab('show');
    });

    function handlePageSave(shouldEditAfterSave) {
        var form = $('#addPageForm')[0];
        
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return false;
        }
        
        var formData = new FormData();
        formData.append("page_title", $('#modalPageTitle').val());
        formData.append("page_url", $('#modalPageUrl').val() + '.html'); // Add .html extension
        formData.append("ctname", $('#modalCtname').val());
        formData.append("template_page", $('#modalTemplatePage').val());
        formData.append("site_template", $('#modalSiteTemplate').val());
        formData.append("p_image", $('#modalPImage').val());
        formData.append("submit", true);

        // If duplicating a page, add duplicate options
        var originalPageId = $('#addPageForm').data('original-page-id');
        if (originalPageId) {
            formData.append("original_page_id", originalPageId);
            formData.append("copy_images", $('#copyImages').is(':checked') ? 1 : 0);
            formData.append("copy_videos", $('#copyVideos').is(':checked') ? 1 : 0);
            formData.append("copy_documents", $('#copyDocuments').is(':checked') ? 1 : 0);
            formData.append("copy_addons", $('#copyAddons').is(':checked') ? 1 : 0);
        }

        // Show loading state
        $('#message').html('<div class="alert alert-info">Saving page...</div>');

        senddata_file(
            'post/page/addpage.php',
            "POST",
            formData,
            function(response) {
                try {
                    var result = JSON.parse(response);
                    
                    if (result.status === 'success') {
                        var urlNotice = '';
                        if (result.original_url !== result.final_url) {
                            urlNotice = `<div class="alert alert-info mt-2">
                                <i class="fa fa-info-circle"></i> The page URL was changed due to similarity with an existing one. 
                                <div><strong>Original:</strong> ${result.original_url}</div>
                                <div><strong>Final:</strong> ${result.final_url}</div>
                            </div>`;
                        }

                        var successHtml = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Page "${result.details.page_title}" created
                                ${urlNotice}
                                <div class="mt-2">
                                    <a href="${result.links.view}" class="btn btn-sm btn-info mr-2" target="_blank">
                                        <i class="fa fa-eye"></i> View Page
                                    </a>
                                    <a href="${result.links.edit}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i> Edit Page
                                    </a>
                                </div>
                                <div class="mt-2 small">
                                    <strong>URL:</strong> ${result.final_url}<br>
                                    <strong>Template:</strong> ${result.details.page_template_name}
                                </div>
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                        `;
                        
                        $('#message').html(successHtml);
                        
                        if (shouldEditAfterSave) {
                            window.location.href = result.links.edit;
                        } else {
                            // For new pages, reset the form
                            if (!originalPageId) {
                                $('#addPageForm')[0].reset();
                                $('#addPageForm').removeClass('was-validated');
                                $('#modalCtname, #modalSiteTemplate, #modalTemplatePage').val(null).trigger('change');
                            }
                            // Update the URL field with the final URL (without .html)
                            $('#modalPageUrl').val(result.final_url.replace('.html', ''));
                        }
                    } else {
                        showAlert(result.message || 'Error creating page', 'danger');
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    showAlert('Invalid server response', 'danger');
                }
            },
            function(error) {
                showAlert('Server error: ' + error, 'danger');
            }
        );
    }

    // Button handlers
    $('#modalSaveAndStay').click(function() {
        handlePageSave(false);
    });
    
    $('#modalSaveAndEdit').click(function() {
        handlePageSave(true);
    });

    // Modal cleanup
    $('#addPageModal').on('hidden.bs.modal', function() {
        $('#addPageForm')[0].reset();
        $('#addPageForm').removeClass('was-validated');
        $('#modalPageUrl').attr('readonly', false);
        $('#message').empty();
        $('#duplicateIndicator').addClass('d-none');
        $('#duplicateOptionsTab').addClass('d-none');
        $('#addPageForm').removeData('original-page-id');
        $('.nav-tabs a[href="#modalDescriptionTab"]').tab('show');
    });
});