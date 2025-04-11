$(document).ready(function() {
    initializeSwitches();

    $(document).on("change", ".js-switch", function() {
        var id = $(this).data("id");
        var mediaType = $(this).data("type"); // Get media type from data attribute
        var isChecked = $(this).is(':checked');
        
        // Send AJAX request to update status
        senddata(
            'post/modules/page/update_media.php', // Your endpoint
            "POST", {
                id: id,
                media_type: mediaType,
                is_active: isChecked ? 1 : 0,
                change_status: true
            },
            function(result) {
                console.log("Status updated", result);
                // Update the status badge immediately
                $('#status_' + id)
                    .removeClass()
                    .addClass('badge ' + (isChecked ? 'badge-success' : 'badge-danger'))
                    .html(isChecked ? 'Active' : 'Inactive');
            },
            function(error) {
                console.error("Error updating status:", error);
                // Revert the switch if error occurs
                $(this).prop('checked', !isChecked).trigger('change');
            }
        );
    });
});


// Common delete function
function deleteMedia(mediaType, id) {
    const mediaNames = {
        image: 'image',
        video: 'video',
        file: 'file'
    };
    
    const mediaName = mediaNames[mediaType];
    
    if (confirm(`Are you sure you want to delete this ${mediaName}?`)) {
        senddata(
            'post/modules/page/delete_media.php',
            "POST", {
                id: id,
                media_type: mediaType,
                delete: true
            },
            function(result) {
                if (result.success) {
                    showAlert(`${mediaName.charAt(0).toUpperCase() + mediaName.slice(1)} deleted `, 'success');
                    $("#dr_" + id).remove();
                } else {
                    showAlert(result.message || `Failed to delete ${mediaName}`, 'danger');
                }
            },
            function(error) {
                showAlert(`Error deleting ${mediaName}: ` + error, 'danger');
            }
        );
    }
}


// Keep original functions for backward compatibility
function delete_image(id) {
    deleteMedia('image', id);
}

function delete_video(id) {
    deleteMedia('video', id);
}

function delete_file(id) {
    deleteMedia('file', id);
}

// Save New Media Functions
function saveImages() {

    const formData = new FormData();
    formData.append("page_id", page_id);
    formData.append("submit_media", true);
    formData.append("media_type", 'images');
    
    // Append image metadata
    formData.append("i_title", $('#image_title').val());
    formData.append("i_caption", $('#image_caption').val());
    formData.append("i_alttext", $('#image_alttext').val());
    formData.append("i_description", $('#image_description').val());
    
    // Validate files
    if ($('#images')[0].files.length === 0) {
        showAlert('Please select at least one image to upload', 'warning');
        return;
    }
    
    // Append files
    const images = $('#images')[0].files;
    for (let i = 0; i < images.length; i++) {
        formData.append("images[]", images[i]);
    }
    
    saveMedia(formData, 'images');
}

function saveVideos() {
    const formData = new FormData();
    formData.append("page_id", page_id);
    formData.append("submit_media", true);
    formData.append("media_type", 'videos');
    
    // Append video metadata
    formData.append("v_title", $('#video_title').val());
    formData.append("v_description", $('#video_description').val());
    
    // Validate files
    if ($('#videos')[0].files.length === 0) {
        showAlert('Please select at least one video to upload', 'warning');
        return;
    }
    
    // Append files
    const videos = $('#videos')[0].files;
    for (let i = 0; i < videos.length; i++) {
        formData.append("videos[]", videos[i]);
    }
    
    // Append thumbnail if selected
    if ($('#video_thumbnail')[0].files.length > 0) {
        formData.append("v_thumbnail", $('#video_thumbnail')[0].files[0]);
    }
    
    saveMedia(formData, 'videos');
}

function saveFiles() {
    const formData = new FormData();
    formData.append("page_id", page_id);
    formData.append("submit_media", true);
    formData.append("media_type", 'files');
    
    // Append file metadata
    formData.append("f_title", $('#file_title').val());
    formData.append("f_download_link", $('#file_download_link').val());
    formData.append("f_description", $('#file_description').val());
    
    // Validate files
    if ($('#page_files')[0].files.length === 0) {
        showAlert('Please select at least one file to upload', 'warning');
        return;
    }
    
    // Append files
    const files = $('#page_files')[0].files;
    for (let i = 0; i < files.length; i++) {
        formData.append("page_files[]", files[i]);
    }
    
    saveMedia(formData, 'files');
}

// Update Existing Media Functions
function updateImage() {
    const formData = new FormData();
    const imageId = $('#edit_image_id').val();
    
    formData.append("page_id", page_id);
    formData.append("media_type", 'image');
    formData.append("action", 'update');
    formData.append("media_id", imageId);
    
    // Append image metadata
    formData.append("i_title", $('#image_title').val());
    formData.append("i_caption", $('#image_caption').val());
    formData.append("i_alttext", $('#image_alttext').val());
    formData.append("i_description", $('#image_description').val());
    
    // Append new image file if selected
    if ($('#images')[0].files.length > 0) {
        formData.append("image", $('#images')[0].files[0]);
    }
    
    updateMedia(formData, 'image');
}

function updateVideo() {
    const formData = new FormData();
    const videoId = $('#edit_video_id').val();
    
    formData.append("page_id", page_id);
    formData.append("media_type", 'video');
    formData.append("action", 'update');
    formData.append("media_id", videoId);
    
    // Append video metadata
    formData.append("v_title", $('#video_title').val());
    formData.append("v_description", $('#video_description').val());
    
    // Append new video file if selected
    if ($('#videos')[0].files.length > 0) {
        formData.append("video", $('#videos')[0].files[0]);
    }
    
    // Append new thumbnail if selected
    if ($('#video_thumbnail')[0].files.length > 0) {
        formData.append("thumbnail", $('#video_thumbnail')[0].files[0]);
    }
    
    updateMedia(formData, 'video');
}

function updateFile() {
    const formData = new FormData();
    const fileId = $('#edit_file_id').val();
    
    formData.append("page_id", page_id);
    formData.append("media_type", 'file');
    formData.append("action", 'update');
    formData.append("media_id", fileId);
    
    // Append file metadata
    formData.append("f_title", $('#file_title').val());
    formData.append("f_download_link", $('#file_download_link').val());
    formData.append("f_description", $('#file_description').val());
    
    // Append new file if selected
    if ($('#page_files')[0].files.length > 0) {
        formData.append("file", $('#page_files')[0].files[0]);
    }
    
    updateMedia(formData, 'file');
}

// Generic Media Handling Functions
function saveMedia(formData, mediaType) {
    const $btn = $(`#save${mediaType.charAt(0).toUpperCase() + mediaType.slice(1)}Btn`);
    const btnText = $btn.html();
    
    // Disable button and show loading state
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
    
    senddata_file(
        'post/modules/page/module_media_tab.php',
        "POST",
        formData,
        function(result) {
            console.log('Media saved ');
            console.log(result);
            
            try {
                // Parse the response if it's JSON
                const response = typeof result === 'string' ? JSON.parse(result) : result;
                
                if (response.success || response > 0) {
                    showAlert(`${mediaType.charAt(0).toUpperCase() + mediaType.slice(1)} saved!`, 'success');
                    clearForm(mediaType);
                    refreshMediaTable(mediaType);
                } else {
                    showAlert(response.message || `Failed to save ${mediaType}`, 'danger');
                }
            } catch (e) {
                // Handle non-JSON responses
                if (result > 0) {
                    showAlert(`${mediaType.charAt(0).toUpperCase() + mediaType.slice(1)} saved!`, 'success');
                    clearForm(mediaType);
                    refreshMediaTable(mediaType);
                } else {
                    showAlert(`Failed to save ${mediaType}`, 'danger');
                }
            }
        },
        function(error) {
            console.log('Failed to save media');
            console.log(error);
            showAlert(`Error saving ${mediaType}: ${error}`, 'danger');
        }
    ).always(function() {
        $btn.prop('disabled', false).html(btnText);
    });
}

function updateMedia(formData, mediaType) {
    const $btn = $(`#update${mediaType.charAt(0).toUpperCase() + mediaType.slice(1)}Btn`);
    const btnText = $btn.html();
    
    // Disable button and show loading state
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
    
    senddata_file(
        'post/modules/page/update_media.php',
        "POST",
        formData,
        function(result) {
            console.log('Media updated');
            console.log(result);
            
            try {
                // Parse the response if it's JSON
                const response = typeof result === 'string' ? JSON.parse(result) : result;
                
                if (response.success || response > 0) {
                    showAlert(`${mediaType.charAt(0).toUpperCase() + mediaType.slice(1)} updated!`, 'success');
                    setTimeout(() => {
                        refreshMediaTable(mediaType);
                    }, 1500);
                } else {
                    showAlert(response.message || `Failed to update ${mediaType}`, 'danger');
                }
            } catch (e) {
                // Handle non-JSON responses
                if (result > 0) {
                    showAlert(`${mediaType.charAt(0).toUpperCase() + mediaType.slice(1)} updated!`, 'success');
                    setTimeout(() => {
                        refreshMediaTable(mediaType);
                    }, 1500);
                } else {
                    showAlert(`Failed to update ${mediaType}`, 'danger');
                }
            }
        },
        function(error) {
            console.log('Failed to update media');
            console.log(error);
            showAlert(`Error updating ${mediaType}: ${error}`, 'danger');
        }
    ).always(function() {
        $btn.prop('disabled', false).html(btnText);
    });
}

function clearForm(mediaType) {
    switch(mediaType) {
        case 'images':
            $('#images').val('');
            $('#image_title, #image_caption, #image_alttext').val('');
            $('#image_description').val('');
            $('.custom-file-label').html('<i class="fa fa-upload"></i> Choose Images');
            break;
        case 'videos':
            $('#videos, #video_thumbnail').val('');
            $('#video_title').val('');
            $('#video_description').val('');
            $('.custom-file-label').html('<i class="fa fa-upload"></i> Choose Videos');
            break;
        case 'files':
            $('#page_files').val('');
            $('#file_title, #file_download_link').val('');
            $('#file_description').val('');
            $('.custom-file-label').html('<i class="fa fa-upload"></i> Choose Files');
            break;
    }
}

/**
 * Refreshes the media table while preserving all GET parameters
 * @param {string} mediaType - The type of media being refreshed
 */
function refreshMediaTable(mediaType) {

    if(mediaType == "images")
        mediaType = "image";

    if(mediaType == "videos")
        mediaType = "video";

    if(mediaType == "files")
        mediaType = "file";

    // Get current URL object
    const url = new URL(window.location.href);
    
    // Update or add media_type parameter
    url.searchParams.set('media_type', mediaType);
    
    // Preserve all existing GET parameters
    const params = new URLSearchParams(window.location.search);
    params.forEach((value, key) => {
        if (key !== 'media_type') { // Skip if already set above
            url.searchParams.set(key, value);
        }
    });
    
    // Add cache busting parameter to prevent stale content
    url.searchParams.set('_', Date.now());
    
    // Reload the page while maintaining scroll position
    window.location.href = url.toString();
}


// Event Listeners - Improved Version
$(document).ready(function() {
    // Save Media handlers - More specific targeting
    $('button#saveImagesBtn').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation(); // Prevent event bubbling
        saveImages();
    });
    
    $('button#saveVideosBtn').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        saveVideos();
    });
    
    $('button#saveFilesBtn').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        saveFiles();
    });
    
    // Update Media handlers
    $('button#updateImageBtn').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        updateImage();
    });
    
    $('button#updateVideoBtn').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        updateVideo();
    });
    
    $('button#updateFileBtn').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        updateFile();
    });
    
    // File input handling - More specific selector
    $('input.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        if (this.files.length > 1) {
            fileName = this.files.length + ' files selected';
        }
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    
    // Prevent form submission on Enter key in text inputs
    $('form input[type="text"]').on('keypress', function(e) {
        if (e.which === 13) { // Enter key
            e.preventDefault();
            return false;
        }
    });
});


  // Handle all move buttons with a single event listener
$(document).on('click', '.move-btn', function(e) {
    e.preventDefault();
    
    const $btn = $(this);
    const type = $btn.data('type');
    const id = $btn.data('id');
    const pid = $btn.data('pid');
    const currentSequence = $btn.data('sequence');
    const direction = $btn.data('direction');
    
    updateSequence(type, id, pid, currentSequence, direction);
});

function updateSequence(mediaType, id, page_id, currentSequence, direction) {
    // Validate inputs
    if (!mediaType || !id || !page_id || currentSequence === undefined || !direction) {
        showAlert('Invalid parameters for sequence update', 'danger');
        return;
    }

    senddata(
        'post/modules/page/update_sequence.php',
        "POST", 
        {
            media_type: mediaType,
            id: id,
            direction: direction,
            pid: page_id,
            current_sequence: currentSequence
        },
        function(result) {
            try {
                // Parse the result if it's a string
                const parsedResult = typeof result === 'string' ? JSON.parse(result) : result;
                
                if (parsedResult.success) {
                    showAlert('Sequence updated ', 'success');
                    // Refresh the page with the current parameters
                    window.location = "?id=" + page_id + "&media_type=" + mediaType;
                } else {
                    showAlert(parsedResult.message || 'Failed to update sequence', 'danger');
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                showAlert('Invalid response from server', 'danger');
            }
        },
        function(error) {
            console.error('Update sequence error:', error);
            showAlert('Error updating sequence: ' + (error.message || error), 'danger');
        }
    );
}

