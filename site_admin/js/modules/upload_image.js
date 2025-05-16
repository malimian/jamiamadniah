// Global variables
var datatable_id = 'datatable_list_gallery_plugin';
var image_count_ = 0;
var html_gallery_ = "";
var currentMediaPath = null; // Global variable to store the path
var loadedImages = []; // Track loaded images
var initialLoadComplete = false; // Track if initial load is done

/* ==========================================
    MEDIA GALLERY FUNCTIONS
    ========================================== */

function OpenMediaGallery(textbox_id, path) {
    $('#textcopied').val('');

    // Store the path in the hidden field
    $('#mediaGalleryPath').val(path || '');

    if (path != "") {
        currentMediaPath = path;
    }

    if (typeof textbox_id !== 'undefined') {
        $('#textcopied').val(textbox_id);
    }

    $('#MediaGalleryModal').modal('toggle');
    
    // Load initial set of images (20)
    loadInitialImages();
}

function loadInitialImages() {
    // Use the global path variable
    var sendData = currentMediaPath ? {
        path: currentMediaPath,
        limit: 20,
        initial_load: true
    } : {
        limit: 20,
        initial_load: true
    };

    senddata('get/modules/upload_image.php', "GET", sendData,
        function (result) {
            try {
                var response = result;
                if (response.error) {
                    console.error('Error loading images:', response.error);
                    $('#get_images').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> ' + response.error + '</div>');
                    return;
                }

                html_gallery_ = '';
                loadedImages = []; // Reset loaded images
                image_count_ = 0;

                $.each(response, function (i, item) {
                    if (currentMediaPath && currentMediaPath != null && currentMediaPath !== '') {
                        item.file_name = currentMediaPath + "/" + item.file_name;
                    }

                    html_gallery_ += show_images_gallery(item.file_name, item.file_path, i);
                    loadedImages.push(item.file_name); // Track loaded images
                    image_count_ = i;
                });

                $('#get_images').empty().html(html_gallery_);
                initialLoadComplete = true;
                
                // Show load more button if there might be more images
                if (response.length >= 20) {
                    $('.module_loadimg_btn').show();
                } else {
                    $('.module_loadimg_btn').hide();
                }

            } catch (e) {
                console.error('Error parsing JSON response:', e);
                $('#get_images').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> Error parsing server response.</div>');
            }
        },
        function (error) {
            console.error('Request failed:', error);
            $('#get_images').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> Failed to load images.</div>');
        }
    );
}

function load_images() {
    // Use the global path variable
    var sendData = currentMediaPath ? {
        path: currentMediaPath,
        exclude: loadedImages // Send already loaded images to avoid duplicates
    } : {
        exclude: loadedImages
    };

    senddata('get/modules/upload_image.php', "GET", sendData,
        function (result) {
            try {
                var response = result;
                if (response.error) {
                    console.error('Error loading images:', response.error);
                    return;
                }

                var newImagesLoaded = false;
                
                $.each(response, function (i, item) {
                    if (currentMediaPath && currentMediaPath != null && currentMediaPath !== '') {
                        item.file_name = currentMediaPath + "/" + item.file_name;
                    }
                    
                    // Only add if not already loaded
                    if (loadedImages.indexOf(item.file_name) === -1) {
                        $('#get_images').append(show_images_gallery(item.file_name, item.file_path, image_count_));
                        loadedImages.push(item.file_name);
                        image_count_++;
                        newImagesLoaded = true;
                    }
                });

                // Hide load more button if no more images
                if (response.length === 0 || !newImagesLoaded) {
                    $('.module_loadimg_btn').hide();
                }

            } catch (e) {
                console.error('Error parsing JSON response:', e);
            }
        },
        function (error) {
            console.error('Request failed:', error);
        }
    );
}

function filterGallery() {
    var searchTerm = $('#gallery_search').val().toLowerCase();
    if (!searchTerm) {
        $('.media-gallery-item-custom').show();
        return;
    }
    
    $('.media-gallery-item-custom').each(function() {
        var imgName = $(this).find('input[type="text"]').val().toLowerCase();
        if (imgName.includes(searchTerm)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

/* ==========================================
    IMAGE UPLOAD AND DISPLAY FUNCTIONS
    ========================================== */

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imageResult').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $('#files').on('change', function () {
        readURL(this);
    });
});

var input = document.getElementById('files');
var infoArea = document.getElementById('upload-label');

input.addEventListener('change', showFileName);
function showFileName(event) {
    var input = event.srcElement;
    var fileName = input.files[0].name;
    infoArea.textContent = 'File name: ' + fileName;
}

/* ==========================================
    COPY AND USE IMAGE FUNCTIONS
    ========================================== */

function Copy_image_url(copy_id) {
    var copyText = document.getElementById("media_gallery_url_" + copy_id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    
    // Show feedback
    var originalText = $(copyText).next().html();
    $(copyText).next().html('<i class="fa fa-check"></i> Copied!');
    setTimeout(function() {
        $(copyText).next().html(originalText);
    }, 2000);
}

function Use_image_url(url) {
    $('#' + $('#textcopied').val()).val(url);
    $('#MediaGalleryModal').modal('toggle');
}

function Use_image_id(id) {
    var url = $('#media_gallery_url_' + id).val();
    Use_image_url(url);
}

/* ==========================================
    IMAGE UPLOAD HANDLER
    ========================================== */

$('.upload_image_module_btn').click(function () {
    var file_data = $('#files').prop('files')[0];
    if (!file_data) {
        $('#error_id_upload_module').html('<div class="alert alert-danger">Please select a file first</div>');
        return;
    }
    
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('upload_image', true);

    // Include the current path when uploading
    if (currentMediaPath) {
        form_data.append('path', currentMediaPath);
    }

    senddata_file('post/modules/media_upload.php', "POST", form_data,
        function (result) {
            $('#error_id_upload_module').empty();
            try {
                var response = JSON.parse(result);
                if (response.error) {
                    $('#error_id_upload_module').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert!</strong> ' + response.error + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    return;
                }

                var obj = response;
                var file_name = obj.file_name;

                if (file_name) {
                    $('#error_id_upload_module').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Image Uploaded Successfully<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                    // Add to gallery
                    image_count_++;
                    var html_gallery = show_images_gallery(obj.file_name, obj.file_path, image_count_);
                    $('#get_images').prepend(html_gallery);
                    loadedImages.push(obj.file_name);

                    // Clear upload
                    $('#files').val('');
                    $('#imageResult').attr('src', '#');
                    infoArea.textContent = 'Choose file';
                }
            } catch (e) {
                console.error('Error parsing upload response:', e);
                $('#error_id_upload_module').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert!</strong> An unexpected error occurred during upload.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
        },
        function (error) {
            console.error('Upload request failed:', error);
            let errorMessage = "Network error during upload. Please try again.";
            if (error && error.responseJSON && error.responseJSON.error) {
                errorMessage = error.responseJSON.error;
            }
            $("#error_id_upload_module").empty().html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert!</strong> ' + errorMessage + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    );
});

/* ==========================================
    IMAGE DELETE FUNCTION
    ========================================== */

function delete_file(file_name, Continer_id) {
    if (!confirm('Are you sure you want to delete this image?')) {
        return;
    }
    
    var deleteData = {
        filename: file_name,
        delete_file_submit: true
    };

    // Include the current path when deleting
    if (currentMediaPath) {
        deleteData.path = currentMediaPath;
    }

    senddata('post/modules/media_upload.php', "POST", deleteData,
        function (result) {
            try {
                var response = result;
                if (response.success) {
                    $('#imgContiner_' + Continer_id).remove();
                    
                    // Remove from loadedImages array
                    var index = loadedImages.indexOf(file_name);
                    if (index !== -1) {
                        loadedImages.splice(index, 1);
                    }
                } else if (response.error) {
                    console.error('Delete failed:', response.error);
                    alert('Error deleting file: ' + response.error);
                }
            } catch (e) {
                console.error('Error parsing delete response:', e);
            }
        },
        function (error) {
            console.error('Delete request failed:', error);
        }
    );
}

/* ==========================================
    IMAGE DISPLAY TEMPLATE
    ========================================== */

function show_images_gallery(img, img_link, count) {
    return `
    <div class="media-gallery-item-custom" id="imgContiner_${count}">
        <div class="card h-100">
            <div class="card-body p-2">
                <div class="imgContainer text-center">
                    <a href="${img_link}" target="_blank">
                        <img class="img-fluid" src="${img_link}" alt="" style="max-height: 120px; width: auto;">
                    </a>
                    <div class="mt-2">
                        <input class="form-control form-control-sm mb-1" id="media_gallery_url_${count}" readonly type="text" value="${img}">
                        <div class="img-actions">
                            <button class="btn btn-success btn-sm" onclick="Copy_image_url(${count})" type="button" title="Copy URL">
                                <i class="fa fa-copy"></i>
                            </button>
                            ${$('#textcopied').val() ? `
                            <button class="btn btn-primary btn-sm" type="button" onclick="Use_image_id(${count})" title="Use in form">
                                <i class="fa fa-hand-pointer-o"></i>
                            </button>
                            ` : ''}
                            <button class="btn btn-danger btn-sm" onclick="delete_file('${img}', '${count}')" type="button" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
}