document.addEventListener("DOMContentLoaded", function() {
    // Create top nav save button
    const topNavSaveBtn = document.createElement('button');
    topNavSaveBtn.className = 'btn btn-info top-nav-save-btn';
    topNavSaveBtn.id = 'top-nav-save-btn';
    topNavSaveBtn.textContent = 'Save Template';
    topNavSaveBtn.type = 'button'; // Prevent form submission
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

    // Prevent toolbar buttons from submitting form
    document.querySelectorAll('.toolbar-buttons button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('data-target');
            const textarea = document.getElementById(target);
            
            if (this.classList.contains('indent-btn')) {
                // Get selected text or use full content
                let text = textarea.value.substring(textarea.selectionStart, textarea.selectionEnd) || textarea.value;
                // Indent each line
                text = text.split('\n').map(line => '    ' + line).join('\n');
                
                if (textarea.selectionStart !== textarea.selectionEnd) {
                    // Replace selected text
                    textarea.setRangeText(text, textarea.selectionStart, textarea.selectionEnd, 'end');
                } else {
                    // Replace entire content
                    textarea.value = text;
                }
            } 
            else if (this.classList.contains('outdent-btn')) {
                // Get selected text or use full content
                let text = textarea.value.substring(textarea.selectionStart, textarea.selectionEnd) || textarea.value;
                // Outdent each line (remove up to 4 spaces)
                text = text.split('\n').map(line => line.replace(/^ {1,4}/, '')).join('\n');
                
                if (textarea.selectionStart !== textarea.selectionEnd) {
                    // Replace selected text
                    textarea.setRangeText(text, textarea.selectionStart, textarea.selectionEnd, 'end');
                } else {
                    // Replace entire content
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

    // Form submission using your existing functions
    validateform(function(){
        const formData = {
            st_name: document.getElementById('st_name').value,
            st_header: document.getElementById('st_header').value,
            st_menu: document.getElementById('st_menu').value,
            st_footer: document.getElementById('st_footer').value,
            st_script: document.getElementById('st_script').value,
            is_active: document.getElementById('is_active').value,
            st_id : sitetemp_id,
            submit: true
        };

        senddata(
            'post/site_template/editsite_template.php',
            "POST",
            formData,
            function(result) {
                console.log('success', result);
                $("#error_id").fadeIn(300).delay(1500);

                if (result > 0) {
                    $('#error_id').empty().html(
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        '<strong>Success!</strong> Site Template Updated' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>'
                    );
                    $.notify('Template Updated', "success");
                } else if (result == 0) {
                    $.notify('Already Updated', "info");
                }
            },
            function(result) {
                console.log('failure', result);
                $("#error_id").empty().html(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    '<strong>Error!</strong> Something went wrong. Please try again.' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>'
                ).fadeIn(300).delay(1500);
            }
        );
    }, function() {
        $('#error_id').empty().html(
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
            '<strong>Warning!</strong> Please fill out all required fields.' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>'
        ).fadeIn(300).delay(1500);
    });

    // Initialize all textareas with HTML content
    document.querySelectorAll('.custom-editor').forEach(textarea => {
        // Beautify the HTML on load
        beautifyHTML(textarea.id);
    });
});