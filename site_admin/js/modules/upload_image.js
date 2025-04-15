// Global variables
var datatable_id = 'datatable_list_gallery_plugin';
var image_count_ = 0;
var html_gallery_ = "";
var html_list_ = "";
var currentMediaPath = null; // Global variable to store the path

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
        $('.btn-use').show();
        $('#textcopied').val(textbox_id);
    } else {
        $('.btn-use').hide();
    }

    $('#MediaGalleryModal').modal('toggle');

    if ($('#textcopied').val() != "") {
        $('.btn-use').show();
    }

}

function load_images() {
    // Use the global path variable
    var sendData = currentMediaPath ? {
        path: currentMediaPath
    } : null;

    senddata('get/modules/upload_image.php', "GET", sendData,
        function (result) {
            try {
                var response = result;
                if (response.error) {
                    console.error('Error loading images:', response.error);
                    $('#get_images').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> ' + response.error + '</div>'); // Show Error
                    $('#datatable_list_gallery_plugin').html('');
                    return; // Stop processing if there's an error
                }

                html_gallery_ = '';
                html_list_ = '';
                image_count_ = 0;

                $.each(response, function (i, item) {

                    if (currentMediaPath && currentMediaPath != null && currentMediaPath !== '') {
                        item.file_name = currentMediaPath + "/" + item.file_name;
                    }

                    html_gallery_ += show_images_gallery(item.file_name, item.file_path, i);
                    html_list_ += show_images_list(item.file_name, item.file_path, item.file_info, i);
                    image_count_ = i;
                });

                $('#get_images').empty().html(html_gallery_);
                $('#datatable_list_gallery_plugin').empty().html(html_list_);
                $('.module_loadimg_btn').hide();

            } catch (e) {
                console.error('Error parsing JSON response:', e);
                $('#get_images').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> Error parsing server response.</div>'); // Show Error
                $('#datatable_list_gallery_plugin').html('');
            }
        },
        function (error) {
            console.error('Request failed:', error);
            $('#get_images').html('<div class="alert alert-danger" role="alert"><strong>Error!</strong> Failed to load images.</div>'); // Show Error
            $('#datatable_list_gallery_plugin').html('');
        }
    );
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

function Copy_() {
    var copyText = document.getElementById("media_image_url");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
}

function Copy_image_url(copy_id) {
    var copyText = document.getElementById("media_gallery_url_" + copy_id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
}

function Copy_image_url_list(copy_id) {
    var copyText = document.getElementById("list_media_gallery_url_" + copy_id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
}

$('.btn-use').click(function () {
    var url = $(this).data('url');
    $('#' + $('#textcopied').val()).val(url);
    $('#MediaGalleryModal').modal('toggle');
});

function Use_image_url(url) {

    $('#' + $('#textcopied').val()).val(url);
    $('#MediaGalleryModal').modal('toggle');
}

function Use_image_id(id) {
    var url = $('#media_gallery_url_' + id).val();

    $('#' + $('#textcopied').val()).val(url);

    $('#MediaGalleryModal').modal('toggle');
}

/* ==========================================
    IMAGE UPLOAD HANDLER
    ========================================== */

$('.upload_image_module_btn').click(function () {
    var file_data = $('#files').prop('files')[0];
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
                console.log(obj);
                var file_name = obj.file_name;
                console.log(file_name);

                if (file_name) {
                    $('#error_id_upload_module').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Image Uploaded Successfully<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');


                    $('.image_url_group').empty().append(
                        '<input class="form-control" id="media_image_url" name="media_image_url" readonly="readonly" type="text" value="' + file_name + '">' +
                        '<button class="btn btn-success" onclick="Copy_()" type="button"><i class="fa fa-copy"></i>&nbsp;Copy</button>' +
                        ($('#textcopied').val() != "" ? '<button class="btn btn-primary btn-use" onclick="Use_image_url(\'' + file_name + '\')" type="button"><i class="fa fa-hand-rock-o"></i>&nbsp;Use</button>' : '')
                    ).show();

                    $('#media_image_url').val(file_name);
                    image_count_++;

                    var html_gallery = show_images_gallery(obj.file_name, obj.file_path, (image_count_ - 1));
                    var html_list = show_images_list(obj.file_name, obj.file_path, '', (image_count_ - 1)); // Assuming no file_info for new uploads

                    $('#get_images').append(html_gallery);
                    $('#datatable_list_gallery_plugin').append(html_list);
                } else {
                    $('#error_id_upload_module').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert!</strong> Image upload failed.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }

            } catch (e) {
                console.error('Error parsing upload response:', e);
                $('#error_id_upload_module').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert!</strong> An unexpected error occurred during upload: ' + e.message + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
        },
        function (error) {
            console.error('Upload request failed:', error);
            let errorMessage = "Network error during upload. Please try again.";
            if (error && error.responseJSON && error.responseJSON.error) {
                errorMessage = error.responseJSON.error;
            } else if (error && error.responseText){
                try {
                  const errorResponse = JSON.parse(error.responseText);
                  if(errorResponse.error){
                    errorMessage = errorResponse.error;
                  }
                } catch(parseError){
                    errorMessage = "Network error during upload.  Invalid server response.";
                }

            }
            $("#error_id_upload_module").empty().html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Alert!</strong> ' + errorMessage + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    );
});

/* ==========================================
    IMAGE DELETE FUNCTION
    ========================================== */

function delete_file(file_name, Continer_id) {
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
                    $('#list_tr_' + Continer_id).remove();
                } else if (response.error) {
                    console.error('Delete failed:', response.error);
                    alert('Error deleting file: ' + response.error); // Basic error alert.  Consider a better UI here.
                } else {
                    console.error('Delete failed: Unknown error');
                    alert('Error deleting file: Unknown error');
                }
            } catch (e) {
                console.error('Error parsing delete response:', e);
                alert('Error processing delete response.');
            }
        },
        function (error) {
            console.error('Delete request failed:', error);
            alert('Network error during delete.');
        }
    );
}

/* ==========================================
    IMAGE DISPLAY TEMPLATES
    ========================================== */

function show_images_gallery(img, img_link, count) {
    return `
    <div class="col-md-3 col-sm-12 col-xs-12 mb-2" id="imgContiner_${count}">
        <div class="card">
            <div class="card-body">
                <div class="imgContainer text-center">
                    <a href="${img_link}" target="_blank">
                        <img class="img-fluid" src="${img_link}" alt="">
                    </a>
                    <div class="form-inline input-group">
                        <input class="form-control" id="media_gallery_url_${count}" readonly="readonly" type="text" value="${img}">
                        <button class="btn btn-success btn-sm btn-copy" onclick="Copy_image_url(${count})" type="button">
                            <i class="fa fa-copy"></i>&nbsp;
                        </button>
                        <button class="btn btn-primary btn-sm btn-use" type="button" onclick="Use_image_id(${count})" data-url="${img}">
                            <i class="fa fa-hand-rock-o"></i>&nbsp;
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="delete_file('${img}', '${count}')" type="button">
                            <i class="fa fa-trash"></i>&nbsp;
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
}

function show_images_list(img, img_link, img_size, count) {
    return `
    <tr id="list_tr_${count}">
        <td>
            <a href="${img_link}" target="_blank">
                <img class="img-fluid thumb-img-gallery" src="${img_link}" alt="">
            </a>
        </td>
        <td>${img}</td>
        <td>
            <div class="form-inline input-group">
                <input class="form-control" id="list_media_gallery_url_${count}" readonly="readonly" type="text" value="${img}">
                <button class="btn btn-success btn-sm btn-copy" onclick="Copy_image_url_list(${count})" type="button">
                    <i class="fa fa-copy"></i>&nbsp;
                </button>
                <button class="btn btn-primary btn-sm btn-use" type="button" onclick="Use_image_id(${count})" data-url="${img}">
                    <i class="fa fa-hand-rock-o"></i>&nbsp;
                </button>
                <button class="btn btn-danger btn-sm" onclick="delete_file('${img}', '${count}')" type="button">
                    <i class="fa fa-trash"></i>&nbsp;
                </button>
            </div>
        </td>
    </tr>`;
}

/* ==========================================
    SEARCH FUNCTIONALITY
    ========================================== */

$('#filter_list_images').keyup(function () {
    var rex = new RegExp($(this).val(), 'i');
    $('.searchable_table tr').hide();
    $('.searchable_table tr').filter(function () {
        return rex.test($(this).text());
    }).show();
});
