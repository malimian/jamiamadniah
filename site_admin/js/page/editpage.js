// Add this code where you initialize your CKEditor or in your editpage.js

$(document).ready(function() {
    // Elements
    const editorToggle = $('#editorToggle');
    const simpleEditor = $('#simpleEditor');
    const ckeditorContainer = $('#ckeditorContainer');
    const ckeditorTextarea = $('#editor1');
    const shouldUseCKEditor = editorToggle.is(':checked');
    
    // Initialize the appropriate editor
    if (shouldUseCKEditor) {
        initializeCKEditor();
    } else {
        simpleEditor.show();
        ckeditorContainer.hide();
    }


    // Toggle handler
    editorToggle.on('change', function() {
        if ($(this).is(':checked')) {
            switchToCKEditor();
        } else {
            switchToSimpleEditor();
        }
    });
    
    // Initialize CKEditor with proper configuration
    function initializeCKEditor() {
        try {
            // Ensure CKEDITOR is loaded
            if (typeof CKEDITOR === 'undefined') {
                console.error('CKEditor is not loaded');
                editorToggle.prop('checked', false).trigger('change');
                return;
            }
            
            // Initialize only if not already initialized
            if (!CKEDITOR.instances.editor1) {
                CKEDITOR.replace('editor1', {
                    height: 300,
                    filebrowserUploadUrl: "post/general/uploads.php?type=file",
                    filebrowserImageUploadUrl: "post/general/uploads.php?type=image",
                    removeButtons: 'Source,Save,NewPage,Preview,Print,Templates',
                    removePlugins: 'elementspath',
                    resize_enabled: false,
                    extraPlugins: 'autogrow',
                    autoGrow_minHeight: 200,
                    autoGrow_maxHeight: 600,
                    autoGrow_bottomSpace: 50,
                    toolbarGroups: [
                        { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                        { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align'] },
                        { name: 'links' },
                        { name: 'insert' },
                        { name: 'styles' },
                        { name: 'colors' },
                        { name: 'tools' }
                    ]
                });
                
                // Handle CKEditor ready event
                CKEDITOR.instances.editor1.on('instanceReady', function() {
                    this.setData(simpleEditor.val());
                });
            }
        } catch (e) {
            console.error('CKEditor initialization failed:', e);
            fallbackToSimpleEditor();
        }
    }
    
    // Switch to CKEditor view
    function switchToCKEditor() {
        simpleEditor.hide();
        ckeditorContainer.show();
        
        // Initialize CKEditor if needed
        if (!CKEDITOR.instances.editor1) {
            initializeCKEditor();
        } else {
            // Update content if already initialized
            CKEDITOR.instances.editor1.setData(simpleEditor.val());
        }
    }
    
    // Switch to simple textarea view
    function switchToSimpleEditor() {
        // Save CKEditor content if it exists
        if (CKEDITOR.instances.editor1) {
            simpleEditor.val(CKEDITOR.instances.editor1.getData());
            try {
                CKEDITOR.instances.editor1.destroy();
            } catch (e) {
                console.error('Error destroying CKEditor instance:', e);
            }
        }
        
        ckeditorContainer.hide();
        simpleEditor.show();
    }
    
    // Fallback to simple editor if CKEditor fails
    function fallbackToSimpleEditor() {
        editorToggle.prop('checked', false);
        simpleEditor.show();
        ckeditorContainer.hide();
        showAlert('Rich text editor failed to load. Using basic editor instead.' , 'danger');
    }
    
    // Handle form submission to ensure we get the right content
    $(document).on('submit', 'form', function() {
        // Get content from active editor
        const isCKEditorActive = editorToggle.is(':checked') && CKEDITOR.instances.editor1;
        const content = isCKEditorActive ? CKEDITOR.instances.editor1.getData() : simpleEditor.val();
        
        // Update the appropriate textarea
        if (isCKEditorActive) {
            ckeditorTextarea.val(content);
        } else {
            simpleEditor.val(content);
        }
    });
});


$('input[name="meta_keywords"]').amsifySuggestags({
    type: 'amsify'
});

function process(value) {
    return value == undefined ? '' : value.replace(/[^a-z0-9_]+/gi, '-').replace(/^-|-$/g, '').toLowerCase();
}

// $('#check_url').click(function() {
//     if (document.getElementById('check_url').checked) $("#page_url").attr("readonly", false);
//     else $("#page_url").attr("readonly", true);
// });


$(document).ready(function() {
    // Initialize lock state
    $('#page_url').prop('readonly', true);
    
    $('#check_url').change(function() {
        const isUnlocked = this.checked;
        
        // Toggle readonly and styling
        $('#page_url')
            .prop('readonly', !isUnlocked)
            .toggleClass('bg-light', isUnlocked);
        
        // Update icon
        $('#urlLockIcon')
            .toggleClass('fa-lock', !isUnlocked)
            .toggleClass('fa-lock-open text-success', isUnlocked);
        
        // Focus field when unlocked
        if (isUnlocked) {
            $('#page_url').focus().select();
        }
    }).trigger('change'); // Initialize state
});
$('#page_title').on('input', function() {
    if (document.getElementById('check_url').checked) {
        var result = process($('#page_title').val());
        $('#page_url').empty().val(result + ".html");
        $('#meta_title').val($('#page_title').val());
    }
});

validateform(function() {
    // Existing fields
    var page_title = $('#page_title').val();
    var page_url = $('#page_url').val();
    var ctname = $('#ctname').val();
    var template_page = $('#template_page').val();
    var site_template = $('#site_template').val();
    var meta_title = $('#meta_title').val();
    var meta_keywords = $('#meta_keywords').val();
    var meta_desc = $('#meta_desc').val();
    var header = $('#header').val();
    var menu_content = $('#menu_content').val();
    var footer_content = $('#footer_content').val();
    var scripts_content = $('#scripts_content').val();
    var p_image = $('#p_image').val();
    var is_active = $('#is_active option:selected').val();
    var postVisibility = $('#postVisibility option:selected').val();
    var showInNavbar = $('#showInNavbar option:selected').val();
    var category_list = $('#category_list').children("option:selected").val();
    const useCKEditor = $('#editorToggle').is(':checked')? 1 : 0;

    var editorContent = $('#editorToggle').is(':checked') ? 
          (CKEDITOR.instances.editor1 ? CKEDITOR.instances.editor1.getData() : $('#editor1').val()) : 
          $('#simpleEditor').val();
    
    var selectedcategory_list = [];
    $("#category_list input:checked").each(function() {
        selectedcategory_list.push($(this).attr('datachck-id'));
    });

    // Collect dynamic attributes with proper multiselect handling
    var attributes = {};
    $('[name^="attribute["]').each(function() {
        var name = $(this).attr('name');
        var attrId = name.match(/\[(\d+)\]/)[1];
        var value;
        
        if ($(this).is(':checkbox')) {
            value = $(this).is(':checked') ? '1' : '0';
        } 
        else if ($(this).hasClass('select2-multiple')) {
            // Handle multiselect values
            value = $(this).val() ? $(this).val().join(',') : '';
        }
        else {
            value = $(this).val();
        }
        
        // Only add if value exists (or is 0 for checkboxes)
        if (value !== '' || ($(this).is(':checkbox') && value === '0')) {
            attributes[attrId] = value;
        }
    });

    // Create FormData object
    const formData = new FormData();

    // Append existing fields
    formData.append("page_title", page_title);
    formData.append("page_url", page_url);
    formData.append("ctname", ctname);
    formData.append("menu_content", menu_content);
    formData.append("footer_content", footer_content);
    formData.append("scripts_content", scripts_content);
    formData.append("header", header);
    formData.append("template_page", template_page);
    formData.append("site_template", site_template);
    formData.append("is_active", is_active);
    formData.append("postVisibility", postVisibility);
    formData.append("showInNavbar", showInNavbar);
    formData.append("editor1", editorContent);
    formData.append("p_image", p_image);
    formData.append("meta_title", meta_title);
    formData.append("meta_keywords", meta_keywords);
    formData.append("meta_desc", meta_desc);
    formData.append("useCKEditor", useCKEditor);
    formData.append("selectedcategory_list", selectedcategory_list.join(','));
    formData.append("attributes", JSON.stringify(attributes));
    formData.append("page_id", page_id);
    formData.append("submit", true);

    console.log([...formData]); // For debugging

    // Send data to server
    senddata_file(
        'post/page/editpage.php',
        "POST",
        formData,
        function(result) {
            console.log('success');
            console.log(result);
            $("#error_id").fadeIn(300).delay(1500);

            if (result > 0) {
                $('#error_id').empty();
                $('#error_id').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success !</strong> Page Updated <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
            }
        },
        function(result) {
            console.log('failure');
            console.log(result);
            $("#error_id").empty().html('<div class="alert alert-alert alert-dismissible fade show" role="alert"> <strong>Alert !</strong> Something went wrong double check and try again <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>').fadeIn(300).delay(1500);
        }
    );
}, function() {
    // Validation failed
    $('#error_id').empty().fadeIn(50).delay(1500).html('<div class="alert alert-warning alert-dismissible fade show" role="alert"> <strong>Alert !</strong> Please fill out all required field <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>').fadeOut(10);
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('previewLink').addEventListener('click', function(event) {
        event.preventDefault();
        const previewWindow = window.open(this.href, 'previewWindow');
        if (previewWindow) {
            previewWindow.focus();
        }
    });
});