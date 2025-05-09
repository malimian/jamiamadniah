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
                    filebrowserImageUploadUrl: "post/general/uploads.php?type=image"
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


$('#page_title').on('input', function() {
    if (document.getElementById('check_url').checked) {
        var result = process($('#page_title').val());
        $('#page_url').empty().val(result + ".html");
        $('#meta_title').val($('#page_title').val());
    }
});

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

var initialTemplateValues;

$(document).ready(function() { 

    // Store initial template values when page loads
      initialTemplateValues = {
        template_page: parseInt($('#template_page').val()),
        site_template: parseInt($('#site_template').val())
    };

});


validateform(function() {
    // Get current form values
var currentValues = {
    template_page: parseInt($('#template_page').val()),
    site_template: parseInt($('#site_template').val()),
    page_title: $('#page_title').val(),
    page_url: $('#page_url').val(),
    ctname: $('#ctname').val(),
    meta_title: $('#meta_title').val(),
    meta_keywords: $('#meta_keywords').val(),
    meta_desc: $('#meta_desc').val(),
    header: $('#header').val(),
    menu_content: $('#menu_content').val(),
    footer_content: $('#footer_content').val(),
    scripts_content: $('#scripts_content').val(),
    p_image: $('#p_image').val(),
    is_active: $('#is_active option:selected').val(),
    postVisibility: $('#postVisibility option:selected').val(),
    showInNavbar: $('#showInNavbar option:selected').val(),
    category_list: $('#category_list').children("option:selected").val(),
    useCKEditor: $('#editorToggle').is(':checked') ? 1 : 0,
    canonical_url: $('#canonical_url').val(),
    meta_index: $('#meta_index').is(':checked') ? 1 : 0,
    meta_follow: $('#meta_follow').is(':checked') ? 1 : 0,
    meta_archive: $('#meta_archive').is(':checked') ? 1 : 0,
    meta_imageindex: $('#meta_imageindex').is(':checked') ? 1 : 0,
    include_in_sitemap: $('#include_in_sitemap').is(':checked') ? 1 : 0,
    sitemap_priority: $('#sitemap_priority option:selected').val(),
    sitemap_changefreq: $('#sitemap_changefreq option:selected').val(),
    social_image: $('#social_image').val(),
    schema_markup: $('#schema_markup').val(),
    focus_keyword: $('#focus_keyword').val()
};

    console.log(currentValues);

    // Check if templates have changed
    var templatesChanged = 
        (currentValues.template_page !== initialTemplateValues.template_page) || 
        (currentValues.site_template !== initialTemplateValues.site_template);

    // Get editor content
    var editorContent = currentValues.useCKEditor ? 
        (CKEDITOR.instances.editor1 ? CKEDITOR.instances.editor1.getData() : $('#editor1').val()) : 
        $('#simpleEditor').val();
    
    // Get selected categories
    var selectedcategory_list = [];
    $("#category_list input:checked").each(function() {
        selectedcategory_list.push($(this).attr('datachck-id'));
    });

        var attributes = {};
        $('.attribute-set').each(function() {
            $(this).find('[name^="attribute["]').each(function() {
                var name = $(this).attr('name');
                var attrId = name.match(/\[(\d+)\]/)[1];
                var value;
                
                if ($(this).is(':checkbox')) {
                    value = $(this).is(':checked') ? '1' : '0';
                } 
                else if ($(this).hasClass('select2-multiple')) {
                    value = $(this).val() ? $(this).val().join(',') : '';
                }
                else {
                    value = $(this).val();
                }
                
                // Initialize array if not exists
                if (!attributes[attrId]) {
                    attributes[attrId] = [];
                }
                
                // Only push if value is not empty (or is checkbox which can be 0)
                if (value !== '' || ($(this).is(':checkbox') && value === '0')) {
                    attributes[attrId].push(value);
                }
            });
        });

    $(document).ready(function() {
    
    // Process the collected attributes
    var processedAttributes = {};
    for (var attrId in attributes) {
        if (dynamicAttributes[attrId]) {
            // For dynamic attributes, keep all values
            processedAttributes[attrId] = attributes[attrId];
        } else {
            // For non-dynamic, take only the first value
            processedAttributes[attrId] = attributes[attrId][0] || '';
        }
    }

    });

    // Create FormData object
    const formData = new FormData();
    for (var key in currentValues) {
        formData.append(key, currentValues[key]);
    }
    formData.append("editor1", editorContent);
    formData.append("selectedcategory_list", selectedcategory_list.join(','));
    formData.append("attributes", JSON.stringify(attributes));
    formData.append("page_id", page_id);
    formData.append("submit", true);

    // Send data to server
    senddata_file(
        'post/page/editpage.php',
        "POST",
        formData,
        function(result) {
            console.log('success', result);
            
            if (result > 0) {
                // Show success message
                $("#error_id").html(
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                    '<strong>Success!</strong> Page Updated ' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span></button></div>'
                ).fadeIn(300).delay(1500);
                
                // Reload only if templates changed
                if (templatesChanged) {
                    console.log('Templates changed - reloading page');
                    setTimeout(function() {
                        location.reload(true); // Force reload from server
                    }, 1000);
                } else {
                    // Update initial values if not reloading
                    initialTemplateValues = {
                        template_page: currentValues.template_page,
                        site_template: currentValues.site_template
                    };
                }
            } else {
                $("#error_id").html(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    '<strong>Error!</strong> Update failed ' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span></button></div>'
                ).fadeIn(300).delay(1500);
            }
        },
        function(error) {
            console.log('failure', error);
            $("#error_id").html(
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                '<strong>Error!</strong> Something went wrong ' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span></button></div>'
            ).fadeIn(300).delay(1500);
        }
    );
}, function() {
    // Validation failed
    $('#error_id').html(
        '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
        '<strong>Warning!</strong> Please fill all required fields ' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span></button></div>'
    ).fadeIn(50).delay(1500);
});

// Optional: Update initial values when templates change (without submitting)
$('#template_page, #site_template').change(function() {
    initialTemplateValues[this.id] = $(this).val();
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



  $(document).ready(function() {
    // Initialize all editor instances
    function initEditor($textarea) {
        const $container = $textarea.closest('.ib-textarea-wrapper, .ib-simple-editor-container');
        const target = $textarea.attr('id');
        const editorLabel = $textarea.closest('.tab-pane').find('.nav-link.active').text().trim() || 'Content';

        // Set up maximize button
        $container.find('.ib-maximize-btn').off('click').click(function(e) {
            e.preventDefault();
            
            if ($container.hasClass('ib-textarea-fullscreen')) {
                // Minimize
                $container.removeClass('ib-textarea-fullscreen');
                $(this).html('<i class="fas fa-expand"></i>');
                $(this).attr('title', 'Maximize');
                $('.ib-fullscreen-nav').remove();
            } else {
                // Maximize
                $container.addClass('ib-textarea-fullscreen');
                $(this).html('<i class="fas fa-compress"></i>');
                $(this).attr('title', 'Minimize');
                
                // Create navigation bar
                const navBar = $(`
                    <div class="ib-fullscreen-nav">
                        <span class="ib-fullscreen-title">Editing ${editorLabel}</span>
                        <div class="ib-fullscreen-actions">
                            <button type="button" class="ib-fullscreen-btn preview-btn ib-preview-fullscreen">
                                <i class="fas fa-eye"></i> Preview
                            </button>
                            <button type="button" class="ib-fullscreen-btn ib-save-btn">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button type="button" class="ib-fullscreen-btn ib-close-fullscreen">
                                <i class="fas fa-times"></i> Close
                            </button>
                        </div>
                    </div>
                `);
                
                $('body').append(navBar);
                
                // Close button handler
                navBar.find('.ib-close-fullscreen').click(function() {
                    $container.removeClass('ib-textarea-fullscreen');
                    navBar.remove();
                    $container.find('.ib-maximize-btn').html('<i class="fas fa-expand"></i>').attr('title', 'Maximize');
                });
                
                // Save button handler
                navBar.find('.ib-save-btn').click(function() {
                     $('#submit_btn').click();
                });
                
                // Preview button handler
                navBar.find('.ib-preview-fullscreen').click(function() {
                   $('#previewLink')[0].click();
                });
            }
        });
        
        // Indent functionality
        $container.find('.ib-indent-btn').off('click').click(function(e) {
            e.preventDefault();
            const textarea = $textarea[0];
            const startPos = textarea.selectionStart;
            const endPos = textarea.selectionEnd;
            const value = textarea.value;
            
            // Insert 4 spaces at cursor position
            textarea.value = value.substring(0, startPos) + '    ' + value.substring(endPos);
            
            // Restore cursor position
            textarea.selectionStart = textarea.selectionEnd = startPos + 4;
            textarea.focus();
        });
        
        // Outdent functionality
        $container.find('.ib-outdent-btn').off('click').click(function(e) {
            e.preventDefault();
            const textarea = $textarea[0];
            const startPos = textarea.selectionStart;
            const endPos = textarea.selectionEnd;
            const value = textarea.value;
            const selectedText = value.substring(startPos, endPos);
            
            // Remove 4 spaces if they exist
            if (selectedText.startsWith('    ')) {
                textarea.value = value.substring(0, startPos) + selectedText.substring(4) + value.substring(endPos);
                textarea.selectionStart = startPos;
                textarea.selectionEnd = endPos - 4;
                textarea.focus();
            }
        });
    }

    // Initialize all textareas with editor controls
    function initAllEditors() {
        $('.ib-textarea-wrapper textarea, .ib-simple-editor-container textarea').each(function() {
            initEditor($(this));
        });
    }

    // Initialize when page loads
    initAllEditors();

    // Handle CKEditor toggle
    $('#editorToggle').change(function() {
        if ($(this).is(':checked')) {
            $('#simpleEditor').hide();
        } else {
            $('#simpleEditor').show();
            initEditor($('#simpleEditor'));
        }
    });

    // Reinitialize editors when tabs are switched
    $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
        setTimeout(initAllEditors, 50);
    });
});