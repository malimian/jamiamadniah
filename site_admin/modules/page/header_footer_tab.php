<style>
    .toolbar-btn {
        background: none;
        border: none;
        padding: 5px 8px;
        cursor: pointer;
        color: #6c757d;
        transition: all 0.3s;
    }
    .toolbar-btn:hover {
        color: #495057;
        background-color: #e9ecef;
    }
    .textarea-container {
        position: relative;
        margin-bottom: 20px; /* Added spacing between textareas */
    }
    .textarea-toolbar {
        background: #f8f9fa;
        padding: 5px;
        border: 1px solid #ddd;
        border-bottom: none;
        border-radius: 4px 4px 0 0;
    }
    .maximize-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        z-index: 10;
        background: rgba(255,255,255,0.7);
        border: 1px solid #ddd;
        border-radius: 3px;
        padding: 2px 5px;
        cursor: pointer;
    }
    .textarea-fullscreen {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100vh;
        z-index: 1050;
        background: white;
        padding: 20px;
    }
    .textarea-fullscreen textarea {
        height: calc(100vh - 100px) !important;
    }
    /* Added to prevent form submission */
    button[type="button"] {
        -webkit-appearance: none;
    }
</style>
<!-- HEADER Tab Content -->
<div class="textarea-container">
    <div class="textarea-toolbar">
        <button type="button" class="toolbar-btn indent-btn" data-target="header" title="Indent"><i class="fas fa-indent"></i></button>
        <button type="button" class="toolbar-btn outdent-btn" data-target="header" title="Outdent"><i class="fas fa-outdent"></i></button>
        <button type="button" class="maximize-btn" data-target="header" title="Maximize"><i class="fas fa-expand"></i></button>
    </div>
    <textarea class="form-control" rows="10" id="header" placeholder="Update Header Files" name="editor1"><?php echo $page[0]['header']; ?></textarea>
</div>

<!-- MENU Tab Content -->
<div class="textarea-container">
    <div class="textarea-toolbar">
        <button type="button" class="toolbar-btn indent-btn" data-target="menu_content" title="Indent"><i class="fas fa-indent"></i></button>
        <button type="button" class="toolbar-btn outdent-btn" data-target="menu_content" title="Outdent"><i class="fas fa-outdent"></i></button>
        <button type="button" class="maximize-btn" data-target="menu_content" title="Maximize"><i class="fas fa-expand"></i></button>
    </div>
    <textarea class="form-control" rows="10" id="menu_content" placeholder="Menu content" name="menu_content"><?php echo $page['menu_content'] ?? ''; ?></textarea>
</div>

<!-- FOOTER Tab Content -->
<div class="textarea-container">
    <div class="textarea-toolbar">
        <button type="button" class="toolbar-btn indent-btn" data-target="footer_content" title="Indent"><i class="fas fa-indent"></i></button>
        <button type="button" class="toolbar-btn outdent-btn" data-target="footer_content" title="Outdent"><i class="fas fa-outdent"></i></button>
        <button type="button" class="maximize-btn" data-target="footer_content" title="Maximize"><i class="fas fa-expand"></i></button>
    </div>
    <textarea class="form-control" rows="10" id="footer_content" placeholder="Footer content" name="footer_content"><?php echo $page['footer_content'] ?? ''; ?></textarea>
</div>

<!-- SCRIPTS Tab Content -->
<div class="textarea-container">
    <div class="textarea-toolbar">
        <button type="button" class="toolbar-btn indent-btn" data-target="scripts_content" title="Indent"><i class="fas fa-indent"></i></button>
        <button type="button" class="toolbar-btn outdent-btn" data-target="scripts_content" title="Outdent"><i class="fas fa-outdent"></i></button>
        <button type="button" class="maximize-btn" data-target="scripts_content" title="Maximize"><i class="fas fa-expand"></i></button>
    </div>
    <textarea class="form-control" rows="10" id="scripts_content" placeholder="Scripts content" name="scripts_content"><?php echo $page['scripts_content'] ?? ''; ?></textarea>
</div>

<script>
$(document).ready(function() {
    // Maximize/minimize functionality
    $('.maximize-btn').click(function(e) {
        e.preventDefault(); // Prevent form submission
        const target = $(this).data('target');
        const textarea = $('#' + target);
        const container = textarea.closest('.textarea-container');
        
        if (container.hasClass('textarea-fullscreen')) {
            container.removeClass('textarea-fullscreen');
            $(this).html('<i class="fas fa-expand"></i>');
            $(this).attr('title', 'Maximize');
        } else {
            container.addClass('textarea-fullscreen');
            $(this).html('<i class="fas fa-compress"></i>');
            $(this).attr('title', 'Minimize');
        }
    });
    
    // Indent/outdent functionality
    $('.indent-btn').click(function(e) {
        e.preventDefault(); // Prevent form submission
        const target = $(this).data('target');
        const textarea = $('#' + target);
        textarea.val(textarea.val() + '    '); // Add 4 spaces
    });
    
    $('.outdent-btn').click(function(e) {
        e.preventDefault(); // Prevent form submission
        const target = $(this).data('target');
        const textarea = $('#' + target);
        const currentValue = textarea.val();
        if (currentValue.length >= 4 && currentValue.substr(currentValue.length - 4) === '    ') {
            textarea.val(currentValue.substr(0, currentValue.length - 4));
        }
    });
});
</script>