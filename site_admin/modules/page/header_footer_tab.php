<style>
    /* Custom classes with ib- prefix */
    .ib-textarea-wrapper {
        position: relative;
        margin-bottom: 20px;
    }
    
    .ib-textarea-toolbar {
        background: #f5f5f5;
        padding: 8px 12px;
        border: 1px solid #e0e0e0;
        border-bottom: none;
        border-radius: 4px 4px 0 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .ib-textarea-label {
        font-weight: 600;
        color: #444;
        font-size: 14px;
        margin-right: 10px;
    }
    
    .ib-toolbar-buttons {
        display: flex;
        gap: 5px;
    }
    
    .ib-toolbar-btn {
        background: #fff;
        border: 1px solid #ddd;
        padding: 4px 8px;
        cursor: pointer;
        color: #555;
        border-radius: 3px;
        transition: all 0.2s;
        font-size: 12px;
    }
    
    .ib-toolbar-btn:hover {
        background: #f0f0f0;
        color: #333;
    }
    
    .ib-maximize-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 10;
        background: rgba(255,255,255,0.9);
        border: 1px solid #ddd;
        border-radius: 3px;
        padding: 3px 6px;
        cursor: pointer;
        font-size: 12px;
    }
    
    .ib-textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #e0e0e0;
        border-radius: 0 0 4px 4px;
        min-height: 200px;
        font-family: monospace;
        font-size: 13px;
        line-height: 1.5;
    }
    
    /* Fullscreen mode styles */
    .ib-textarea-fullscreen {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100vh;
        z-index: 2000;
        background: white;
        padding: 60px 20px 20px;
    }
    
    .ib-textarea-fullscreen .ib-textarea {
        height: calc(100vh - 100px);
        font-size: 15px;
    }
    
    /* Fullscreen top navigation bar */
    .ib-fullscreen-nav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 50px;
        background: #343a40;
        z-index: 2001;
        display: flex;
        align-items: center;
        padding: 0 20px;
        color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    .ib-fullscreen-title {
        font-weight: 600;
        font-size: 16px;
        margin-right: auto;
    }
    
    .ib-fullscreen-actions {
        display: flex;
        gap: 10px;
    }
    
    .ib-fullscreen-btn {
        background: rgba(255,255,255,0.1);
        border: none;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .ib-fullscreen-btn:hover {
        background: rgba(255,255,255,0.2);
    }
    
    /* Ensure publish card stays below fullscreen editor */
    .card {
        position: relative;
        z-index: 1;
    }
</style>


<!-- HEADER Tab Content -->
<div class="ib-textarea-wrapper">
    <div class="ib-textarea-toolbar">
        <span class="ib-textarea-label">Header Content</span>
        <div class="ib-toolbar-buttons">
            <button type="button" class="ib-toolbar-btn ib-indent-btn" data-target="header" title="Indent">
                <i class="fas fa-indent"></i> Indent
            </button>
            <button type="button" class="ib-toolbar-btn ib-outdent-btn" data-target="header" title="Outdent">
                <i class="fas fa-outdent"></i> Outdent
            </button>
        </div>
    </div>
    <button type="button" class="ib-maximize-btn" data-target="header" title="Maximize">
        <i class="fas fa-expand"></i>
    </button>
    <textarea class="ib-textarea" rows="10" id="header" placeholder="Enter header content here..." name="header"><?php echo htmlspecialchars($page[0]['header'] ?? ''); ?></textarea>
</div>

<!-- MENU Tab Content -->
<div class="ib-textarea-wrapper">
    <div class="ib-textarea-toolbar">
        <span class="ib-textarea-label">Menu Content</span>
        <div class="ib-toolbar-buttons">
            <button type="button" class="ib-toolbar-btn ib-indent-btn" data-target="menu_content" title="Indent">
                <i class="fas fa-indent"></i> Indent
            </button>
            <button type="button" class="ib-toolbar-btn ib-outdent-btn" data-target="menu_content" title="Outdent">
                <i class="fas fa-outdent"></i> Outdent
            </button>
        </div>
    </div>
    <button type="button" class="ib-maximize-btn" data-target="menu_content" title="Maximize">
        <i class="fas fa-expand"></i>
    </button>
    <textarea class="ib-textarea" rows="10" id="menu_content" placeholder="Enter menu content here..." name="menu"><?php echo htmlspecialchars($page[0]['menu'] ?? ''); ?></textarea>
</div>

<!-- FOOTER Tab Content -->
<div class="ib-textarea-wrapper">
    <div class="ib-textarea-toolbar">
        <span class="ib-textarea-label">Footer Content</span>
        <div class="ib-toolbar-buttons">
            <button type="button" class="ib-toolbar-btn ib-indent-btn" data-target="footer_content" title="Indent">
                <i class="fas fa-indent"></i> Indent
            </button>
            <button type="button" class="ib-toolbar-btn ib-outdent-btn" data-target="footer_content" title="Outdent">
                <i class="fas fa-outdent"></i> Outdent
            </button>
        </div>
    </div>
    <button type="button" class="ib-maximize-btn" data-target="footer_content" title="Maximize">
        <i class="fas fa-expand"></i>
    </button>
    <textarea class="ib-textarea" rows="10" id="footer_content" placeholder="Enter footer content here..." name="footer"><?php echo htmlspecialchars($page[0]['footer'] ?? ''); ?></textarea>
</div>

<!-- SCRIPTS Tab Content -->
<div class="ib-textarea-wrapper">
    <div class="ib-textarea-toolbar">
        <span class="ib-textarea-label">Scripts Content</span>
        <div class="ib-toolbar-buttons">
            <button type="button" class="ib-toolbar-btn ib-indent-btn" data-target="scripts_content" title="Indent">
                <i class="fas fa-indent"></i> Indent
            </button>
            <button type="button" class="ib-toolbar-btn ib-outdent-btn" data-target="scripts_content" title="Outdent">
                <i class="fas fa-outdent"></i> Outdent
            </button>
        </div>
    </div>
    <button type="button" class="ib-maximize-btn" data-target="scripts_content" title="Maximize">
        <i class="fas fa-expand"></i>
    </button>
    <textarea class="ib-textarea" rows="10" id="scripts_content" placeholder="Enter scripts content here..." name="scripts"><?php echo htmlspecialchars($page[0]['scripts'] ?? ''); ?></textarea>
</div>


<script>
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
</script>