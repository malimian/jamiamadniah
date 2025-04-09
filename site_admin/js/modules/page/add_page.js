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
            $('#modalPageUrl').val(result + ".html");
        }
    });

    function handlePageSave(shouldEditAfterSave) {
        var form = $('#addPageForm')[0];
        
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return false;
        }
        
        var formData = new FormData();
        formData.append("page_title", $('#modalPageTitle').val());
        formData.append("page_url", $('#modalPageUrl').val());
        formData.append("ctname", $('#modalCtname').val());
        formData.append("template_page", $('#modalTemplatePage').val());
        formData.append("site_template", $('#modalSiteTemplate').val());
        formData.append("p_image", $('#modalPImage').val());
        formData.append("submit", true);

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
                            $('#addPageForm')[0].reset();
                            $('#addPageForm').removeClass('was-validated');
                            // Update the URL field with the final URL
                            $('#modalPageUrl').val(result.final_url);
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
        $('#modalPageUrl').attr('readonly', true);
        $('#message').empty();
    });
});