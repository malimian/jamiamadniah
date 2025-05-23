$(document).ready(function() {
        // Tab management functionality
        $('#tabModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            
            // If edit button was clicked
            if (button.hasClass('edit-tab')) {
                modal.find('.modal-title').text('Edit Tab');
                modal.find('#edit_tab_id').val(button.data('id'));
                modal.find('#tab_name_input').val(button.data('name'));
                modal.find('#tab_sort_order').val(button.data('order'));
            } else {
                // For add new tab
                modal.find('.modal-title').text('Add New Tab');
                modal.find('#edit_tab_id').val('');
                modal.find('#tab_name_input').val('');
                modal.find('#tab_sort_order').val('');
            }
        });

        // Delete tab confirmation
        $('.delete-tab').click(function() {
            var tabId = $(this).data('id');
            if (confirm('Are you sure you want to delete this tab? This action cannot be undone.')) {
                $.post('post/template_attributes/delete_tab.php', {
                    tab_id: tabId,
                    template_id: template_id
                }, function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                }, 'json').fail(function() {
                    alert('Error communicating with server');
                });
            }
        });

        // Tab form submission
        $('#tabForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            
            $.post($(this).attr('action'), formData, function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            }, 'json').fail(function() {
                alert('Error communicating with server');
            });
        });
    });