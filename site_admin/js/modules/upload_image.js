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
    
    if(path != ""){
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
    var sendData = currentMediaPath ? { path: currentMediaPath } : null;
    
    senddata('get/modules/upload_image.php', "GET", sendData,
        function(result) {
            try {
                html_gallery_ = '';
                html_list_ = '';
                image_count_ = 0;

                $.each(result, function(i, item) {

                    if(currentMediaPath && currentMediaPath != null && currentMediaPath !== '' ){
                        item.file_name = currentMediaPath+"/"+item.file_name;
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
                console.log('Raw response:', result);
            }
        },
        function(error) {
            console.error('Request failed:', error);
        }
    );
}

/* ==========================================
   IMAGE UPLOAD AND DISPLAY FUNCTIONS
   ========================================== */

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imageResult').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function() {
    $('#files').on('change', function() {
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
    var copyText = document.getElementById("media_gallery_url_"+copy_id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
}

function Copy_image_url_list(copy_id) {
    var copyText = document.getElementById("list_media_gallery_url_"+copy_id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
}

$('.btn-use').click(function(){
    var url = $(this).data('url');
    $('#'+$('#textcopied').val()).val(url);
    $('#MediaGalleryModal').modal('toggle');
});

function Use_image_url(url) {

    $('#'+$('#textcopied').val()).val(url);
    $('#MediaGalleryModal').modal('toggle');
}

function Use_image_id(id) {
    var url = $('#media_gallery_url_'+id).val();
    
    $('#'+$('#textcopied').val()).val(url);

    $('#MediaGalleryModal').modal('toggle');
}

/* ==========================================
   IMAGE UPLOAD HANDLER
   ========================================== */

$('.upload_image_module_btn').click(function() {
    var file_data = $('#files').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('upload_image', true);
    
    // Include the current path when uploading
    if (currentMediaPath) {
        form_data.append('path', currentMediaPath);
    }

    senddata_file('post/modules/media_upload.php', "POST", form_data,
        function(result) {
            $('#error_id_upload_module').empty();

            if (result == 0) {
                $('#error_id_upload_module').html('<div class="alert alert-danger" role="alert"><strong>Alert!</strong> Something went wrong Try again<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                return;
            }

            var obj = JSON.parse(result);               
            result = obj.file_name;               

            if (result != 0) {
                $('#error_id_upload_module').html('<div class="alert alert-success" role="alert">Image Uploaded<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                $('.image_url_group').empty();
                $('.image_url_group').append('<input class="form-control" id="media_image_url" name="media_image_url" readonly="readonly" type="text" value="'+result+'">');
                $('.image_url_group').append('<button class="btn btn-success" onclick="Copy_()" type="button"><i class="fa fa-copy"></i>&nbsp;Copy</button>');

                if ($('#textcopied').val() != "") {
                    $('.image_url_group').append('<button class="btn btn-primary btn-use" onclick="Use_image_url(\''+result+'\')" type="button"><i class="fa fa-hand-rock-o"></i>&nbsp;Use</button>');
                }
                
                $('.image_url_group').css('display', '');
                $('#media_image_url').val(result);
                image_count_ = image_count_ + 1;

                var html_gallery = show_images_gallery(obj.file_name, obj.file_path, (image_count_));
                var html_list = show_images_list(obj.file_name, obj.file_path, (image_count_));
                
                $('#get_images').append(html_gallery);
                $('#datatable_list_gallery_plugin').append(html_list);
            }
        },
        function(error) {
            console.error('Upload failed:', error);
            $("#error_id_upload_module").empty().html('<div class="alert alert-alert alert-dismissible fade show" role="alert"><strong>Alert!</strong> Something went wrong double check and try again<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').fadeIn(300).delay(1500);
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
        function(result) {
            if (result == 1) {
                $('#imgContiner_'+Continer_id).remove();
                $('#list_tr_'+Continer_id).remove();
            }
        },
        function(error) {
            console.error('Delete failed:', error);
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

$('#filter_list_images').keyup(function() {
    var rex = new RegExp($(this).val(), 'i');
    $('.searchable_table tr').hide();
    $('.searchable_table tr').filter(function() {
        return rex.test($(this).text());
    }).show();
});