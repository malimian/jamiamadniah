document.addEventListener("DOMContentLoaded", function() {
    // Create top nav save button
    const topNavSaveBtn = document.createElement('button');
    topNavSaveBtn.className = 'btn btn-info top-nav-save-btn';
    topNavSaveBtn.id = 'top-nav-save-btn';
    topNavSaveBtn.textContent = 'Save Template';
    topNavSaveBtn.type = 'button';
    document.body.appendChild(topNavSaveBtn);

    // Initialize all editors as expanded by default
    document.querySelectorAll('.editor-container').forEach(container => {
        container.classList.add('expanded');
    });

    // Toggle editor collapse/expand
    document.querySelectorAll('.editor-header').forEach(header => {
        header.addEventListener('click', function() {
            const container = this.closest('.editor-container');
            container.classList.toggle('collapsed');
            container.classList.toggle('expanded');
            
            const icon = this.querySelector('.toggle-collapse');
            if (container.classList.contains('collapsed')) {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            } else {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            }
        });
    });

    // Maximize button functionality
    document.querySelectorAll('.maximize-btn').forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            const editorContainer = this.closest('.editor-container');
            const editor = document.getElementById(target);
            const icon = this.querySelector('i');
            
            if (editorContainer.classList.contains('maximized-textarea')) {
                editorContainer.classList.remove('maximized-textarea');
                icon.classList.remove('fa-compress');
                icon.classList.add('fa-expand');
                this.setAttribute('title', 'Maximize');
                topNavSaveBtn.style.display = 'none';
            } else {
                editorContainer.classList.add('maximized-textarea');
                icon.classList.remove('fa-expand');
                icon.classList.add('fa-compress');
                this.setAttribute('title', 'Minimize');
                topNavSaveBtn.style.display = 'block';
            }
        });
    });

    // HTML Beautify function
    function beautifyHTML(textareaId) {
        const textarea = document.getElementById(textareaId);
        const ugly = textarea.value;
        const beautiful = html_beautify(ugly, {
            indent_size: 2,
            indent_char: ' ',
            max_preserve_newlines: 1,
            preserve_newlines: true,
            keep_array_indentation: false,
            break_chained_methods: false,
            indent_scripts: 'normal',
            brace_style: 'collapse',
            space_before_conditional: true,
            unescape_strings: false,
            jslint_happy: false,
            end_with_newline: false,
            wrap_line_length: 0,
            indent_inner_html: true,
            comma_first: false,
            e4x: false,
            indent_empty_lines: false
        });
        textarea.value = beautiful;
    }

    // Add event listeners for beautify buttons
    document.querySelectorAll('.beautify-btn').forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            beautifyHTML(target);
        });
    });

    // Indent/Outdent functionality
    document.querySelectorAll('.toolbar-buttons button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('data-target');
            const textarea = document.getElementById(target);
            
            if (this.classList.contains('indent-btn')) {
                let text = textarea.value.substring(textarea.selectionStart, textarea.selectionEnd) || textarea.value;
                text = text.split('\n').map(line => '    ' + line).join('\n');
                
                if (textarea.selectionStart !== textarea.selectionEnd) {
                    textarea.setRangeText(text, textarea.selectionStart, textarea.selectionEnd, 'end');
                } else {
                    textarea.value = text;
                }
            } 
            else if (this.classList.contains('outdent-btn')) {
                let text = textarea.value.substring(textarea.selectionStart, textarea.selectionEnd) || textarea.value;
                text = text.split('\n').map(line => line.replace(/^ {1,4}/, '')).join('\n');
                
                if (textarea.selectionStart !== textarea.selectionEnd) {
                    textarea.setRangeText(text, textarea.selectionStart, textarea.selectionEnd, 'end');
                } else {
                    textarea.value = text;
                }
            }
            
            textarea.focus();
        });
    });

    // Save button in top nav
    topNavSaveBtn.addEventListener('click', function() {
        document.getElementById('submit_btn').click();
    });

// Form submission handler
document.getElementById('submit_btn').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Validate form
            if (!document.getElementById('st_name').value) {
                showAlert('warning', 'Template name is required');
                return;
            }

            // Create regular form data object (not FormData)
            const formData = {
                st_name: document.getElementById('st_name').value,
                st_header: document.getElementById('st_header').value,
                st_menu: document.getElementById('st_menu').value,
                st_footer: document.getElementById('st_footer').value,
                st_script: document.getElementById('st_script').value,
                is_active: document.getElementById('is_active').value,
                st_id: sitetemp_id,
                submit: true
            };

            // Use jQuery AJAX directly to avoid the illegal invocation error
            $.ajax({
                url: 'post/site_template/editsite_template.php',
                type: 'POST',
                data: formData,
                dataType: 'json', // Expect JSON response
                success: function(result) {
                    console.log('success', result);
                    
                    if (result.success) {
                        showAlert('success', result.message);
                        $.notify(result.message, "success");
                        
                        // If new template, redirect to edit page
                        if (sitetemp_id === 'new' && result.data && result.data.id) {
                            window.location.href = 'editsite_template.php?id=' + result.data.id;
                        }
                    } else {
                        showAlert('danger', result.message || 'Operation failed');
                        $.notify(result.message || 'Operation failed', "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.log('failure', error);
                    showAlert('danger', 'Something went wrong. Please try again.');
                    $.notify('Error saving template', "error");
                }
            });
        });

        // Helper function to show alerts
        function showAlert(type, message) {
            const alertClass = {
                'success': 'alert-success',
                'danger': 'alert-danger',
                'warning': 'alert-warning',
                'info': 'alert-info'
            }[type] || 'alert-info';
            
            $('#error_id').empty().html(
                `<div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    <strong>${type.charAt(0).toUpperCase() + type.slice(1)}!</strong> ${message}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`
            ).fadeIn(300).delay(1500);
        }

    // Beautify all textareas on load
    document.querySelectorAll('.custom-editor').forEach(textarea => {
        beautifyHTML(textarea.id);
    });


});


// Recycle Bin Button Handler
document.getElementById('recycleBinBtn')?.addEventListener('click', function() {
    if (confirm('Are you sure you want to move this template to the recycle bin?')) {
        const formData = {
            st_id: sitetemp_id,
            action: 'recycle',
            submit: true
        };

        $.ajax({
            url: 'post/site_template/editsite_template.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    showAlert('success', result.message);
                    $.notify(result.message, "success");
                    setTimeout(() => {
                        window.location.href = 'site_template.php';
                    }, 1500);
                } else {
                    showAlert('danger', result.message || 'Operation failed');
                    $.notify(result.message || 'Operation failed', "error");
                }
            },
            error: function(xhr, status, error) {
                console.log('failure', error);
                showAlert('danger', 'Something went wrong. Please try again.');
                $.notify('Error moving to recycle bin', "error");
            }
        });
    }
});