// Delete Functions
function delete_image(id) {
    if (confirm('Are you sure you want to delete this image?')) {
        senddata(
            'post/modules/page/delete_photogallery.php',
            "POST", {
                id: id,
                delete: true
            },
            function(result) {
                if (result.success) {
                    showAlert('Image deleted successfully', 'success');
                    $("#dr_" + id).remove();
                } else {
                    showAlert(result.message || 'Failed to delete image', 'danger');
                }
            },
            function(error) {
                showAlert('Error deleting image: ' + error, 'danger');
            }
        );
    }
}

function delete_video(id) {
    if (confirm('Are you sure you want to delete this video?')) {
        senddata(
            'post/modules/page/delete_video.php',
            "POST", {
                id: id,
                delete: true
            },
            function(result) {
                if (result.success) {
                    showAlert('Video deleted successfully', 'success');
                    $("#dr_" + id).remove();
                } else {
                    showAlert(result.message || 'Failed to delete video', 'danger');
                }
            },
            function(error) {
                showAlert('Error deleting video: ' + error, 'danger');
            }
        );
    }
}

function delete_file(id) {
    if (confirm('Are you sure you want to delete this file?')) {
        senddata(
            'post/modules/page/delete_file.php',
            "POST", {
                id: id,
                delete: true
            },
            function(result) {
                if (result.success) {
                    showAlert('File deleted successfully', 'success');
                    $("#dr_" + id).remove();
                } else {
                    showAlert(result.message || 'Failed to delete file', 'danger');
                }
            },
            function(error) {
                showAlert('Error deleting file: ' + error, 'danger');
            }
        );
    }
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
            console.log('Media saved successfully');
            console.log(result);
            
            try {
                // Parse the response if it's JSON
                const response = typeof result === 'string' ? JSON.parse(result) : result;
                
                if (response.success || response > 0) {
                    showAlert(`${mediaType.charAt(0).toUpperCase() + mediaType.slice(1)} saved successfully!`, 'success');
                    clearForm(mediaType);
                    refreshMediaTable(mediaType);
                } else {
                    showAlert(response.message || `Failed to save ${mediaType}`, 'danger');
                }
            } catch (e) {
                // Handle non-JSON responses
                if (result > 0) {
                    showAlert(`${mediaType.charAt(0).toUpperCase() + mediaType.slice(1)} saved successfully!`, 'success');
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
            console.log('Media updated successfully');
            console.log(result);
            
            try {
                // Parse the response if it's JSON
                const response = typeof result === 'string' ? JSON.parse(result) : result;
                
                if (response.success || response > 0) {
                    showAlert(`${mediaType.charAt(0).toUpperCase() + mediaType.slice(1)} updated successfully!`, 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showAlert(response.message || `Failed to update ${mediaType}`, 'danger');
                }
            } catch (e) {
                // Handle non-JSON responses
                if (result > 0) {
                    showAlert(`${mediaType.charAt(0).toUpperCase() + mediaType.slice(1)} updated successfully!`, 'success');
                    setTimeout(() => {
                        window.location.reload();
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

function refreshMediaTable(mediaType) {
        location.reload();
}

// Helper Functions
function showAlert(message, type) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <strong>${type.charAt(0).toUpperCase() + type.slice(1)}!</strong> ${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;
    
    $("#alert-container").html(alertHtml).fadeIn(300).delay(3000).fadeOut(500);
}

// Event Listeners
$(document).ready(function() {
    // Save New Media handlers
    $('#saveImagesBtn').click(function(e) {
        e.preventDefault();
        saveImages();
    });
    
    $('#saveVideosBtn').click(function(e) {
        e.preventDefault();
        saveVideos();
    });
    
    $('#saveFilesBtn').click(function(e) {
        e.preventDefault();
        saveFiles();
    });
    
    // Update Existing Media handlers
    $('#updateImageBtn').click(function(e) {
        e.preventDefault();
        updateImage();
    });
    
    $('#updateVideoBtn').click(function(e) {
        e.preventDefault();
        updateVideo();
    });
    
    $('#updateFileBtn').click(function(e) {
        e.preventDefault();
        updateFile();
    });
    
    // Update file input labels to show selected file names
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        if ($(this)[0].files.length > 1) {
            fileName = $(this)[0].files.length + ' files selected';
        }
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
});



function moveUp(type, id, pid, currentSequence) {
    updateSequence(type, id, pid , currentSequence, 'up');
}

function moveDown(type, id, pid, currentSequence) {
    updateSequence(type, id,pid, currentSequence, 'down');
}

function updateSequence(mediaType, id,page_id, currentSequence, direction) {
   
    senddata(
        'post/modules/page/update_sequence.php',
        "POST", {
            media_type: mediaType,
            id: id,
            direction: direction,
            pid:page_id,
            current_sequence: currentSequence
        },
        function(result) {
            if (result.success) {
                showAlert('Sequence updated successfully', 'success');
                refreshMediaTable(mediaType);
            } else {
                showAlert(result.message || 'Failed to update sequence', 'danger');
            }
        },
        function(error) {
            showAlert('Error updating sequence: ' + error, 'danger');
        }
    );
    
}