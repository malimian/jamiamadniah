// Declare CodeMirror instances globally
var headerEditor, menuEditor, footerEditor, scriptEditor;

document.addEventListener("DOMContentLoaded", function() {
    // Initialize CodeMirror for Header
    headerEditor = CodeMirror.fromTextArea(document.getElementById('st_header'), {
        lineNumbers: true,
        mode: 'htmlmixed',
        matchBrackets: true,
        autoCloseBrackets: true,
        theme: 'default',
    });

    // Initialize CodeMirror for Menu
    menuEditor = CodeMirror.fromTextArea(document.getElementById('st_menue'), {
        lineNumbers: true,
        mode: 'htmlmixed',
        matchBrackets: true,
        autoCloseBrackets: true,
        theme: 'default',
    });

    // Initialize CodeMirror for Footer
    footerEditor = CodeMirror.fromTextArea(document.getElementById('st_footer'), {
        lineNumbers: true,
        mode: 'htmlmixed',
        matchBrackets: true,
        autoCloseBrackets: true,
        theme: 'default',
    });

    // Initialize CodeMirror for Scripts
    scriptEditor = CodeMirror.fromTextArea(document.getElementById('st_script'), {
        lineNumbers: true,
        mode: 'javascript',
        matchBrackets: true,
        autoCloseBrackets: true,
        theme: 'default',
    });

    // Map editor IDs to their CodeMirror instances
    var editors = {
        st_header: headerEditor,
        st_menue: menuEditor,
        st_footer: footerEditor,
        st_script: scriptEditor,
    };

    // Add maximize functionality
    document.querySelectorAll('.maximize-btn').forEach(function(button) {
        // Check if the button already has an event listener
        if (!button.hasEventListener) {
            button.hasEventListener = true; // Mark the button as having an event listener
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent form submission
                var target = button.getAttribute('data-target'); // Get the target editor ID
                var editor = editors[target]; // Get the CodeMirror instance
                var editorElement = editor.getWrapperElement(); // Get the editor's wrapper element

                // Toggle full-screen mode
                if (editorElement.classList.contains('fullscreen')) {
                    editorElement.classList.remove('fullscreen');
                    button.textContent = 'Maximize';
                } else {
                    editorElement.classList.add('fullscreen');
                    button.textContent = 'Minimize';
                }

                // Toggle maximize and minimize buttons
                toggleMaximizeMinimizeButtons(button);

                // Refresh the editor to adjust its size
                editor.refresh();
            });
        }
    });

    // Function to toggle maximize and minimize buttons
    function toggleMaximizeMinimizeButtons(button) {
        var maximizeButtons = document.querySelectorAll('.maximize-btn');
        var minimizeButtons = document.querySelectorAll('.minimize-btn');

        if (button.textContent === 'Minimize') {
            // Hide all maximize buttons
            maximizeButtons.forEach(function(btn) {
                btn.classList.add('hidden');
            });
            // Show all minimize buttons
            minimizeButtons.forEach(function(btn) {
                btn.classList.remove('hidden');
            });
        } else {
            // Show all maximize buttons
            maximizeButtons.forEach(function(btn) {
                btn.classList.remove('hidden');
            });
            // Hide all minimize buttons
            minimizeButtons.forEach(function(btn) {
                btn.classList.add('hidden');
            });
        }
    }
});

validateform(function(){
    // Get values from CodeMirror editors
    var st_name = $('#st_name').val();
    var st_header = headerEditor.getValue(); // Get value from CodeMirror editor
    var st_menue = menuEditor.getValue();   // Get value from CodeMirror editor
    var st_footer = footerEditor.getValue(); // Get value from CodeMirror editor
    var st_script = scriptEditor.getValue(); // Get value from CodeMirror editor
    var is_active = $('#is_active option:selected').val();

    // Send data via AJAX
    senddata(
        'post/site_template/editsite_template.php',
        "POST",
        {
            st_name: st_name,
            st_header: st_header,
            st_menue: st_menue,
            st_footer: st_footer,
            st_script: st_script,
            is_active: is_active,
            sitetemp_id: sitetemp_id,
            submit: true
        },
        function(result) {
            console.log('success');
            console.log(result);

            $("#error_id").fadeIn(300).delay(1500);

            if (result > 0) {
                $('#error_id').empty();
                $('#error_id').html(
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                    '<strong>Success!</strong> Site Template Updated Successfully' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>'
                );

                $.notify('Template Updated', "success");
            }

            if (result == 0) {
                $.notify('Already Updated', "info");
            }
        },
        function(result) {
            console.log('failure');
            console.log(result);
            $("#error_id").empty().html(
                '<div class="alert alert-alert alert-dismissible fade show" role="alert">' +
                '<strong>Alert!</strong> Something went wrong. Double-check and try again.' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>'
            ).fadeIn(300).delay(1500);
        }
    );
}, function() {
    // Validation failed
    $('#error_id').empty().fadeIn(50).delay(1500).html(
        '<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
        '<strong>Alert!</strong> Please fill out all required fields.' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button>' +
        '</div>'
    ).fadeOut(10);
});