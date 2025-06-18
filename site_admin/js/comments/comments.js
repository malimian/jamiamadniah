 function refreshComments() {
        window.location.reload();
    }
    
    function toggleSelectAll(source) {
        const checkboxes = document.querySelectorAll('.comment-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
        updateSelectedCount();
    }
    
    function updateSelectedCount() {
        const selected = document.querySelectorAll('.comment-checkbox:checked').length;
        document.getElementById('selectedCount').textContent = selected;
    }
    
    // Add event listeners to all checkboxes
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.comment-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    });
    
    function approveComment(commentId) {
        moderateComment(commentId, 'approve');
    }
    
    function rejectComment(commentId) {
        moderateComment(commentId, 'reject');
    }
    
    function flagNsfw(commentId, flag) {
        moderateComment(commentId, flag ? 'flag_nsfw' : 'unflag_nsfw');
    }
    
    function deleteComment(commentId) {
        if (confirm('Are you sure you want to delete this comment? This cannot be undone.')) {
            moderateComment(commentId, 'delete');
        }
    }
    
    function moderateComment(commentId, action) {
        senddata(
            'post/comments/moderate.php',
            'POST',
            { comment_id: commentId, action: action },
            function(response) {
                const result = response;
                if (result.success) {
                    if (action === 'delete') {
                        // Remove the row from the table
                        $('#comment_' + commentId).remove();
                        showAlert('Comment deleted', 'success');
                    } else {
                        // Refresh the page to show updated status
                        showAlert('Comment updated', 'success');
                        setTimeout(() => location.reload(), 1000);
                    }
                } else {
                    showAlert(result.message, 'danger');
                }
            },
            function(error) {
                showAlert('An error occurred while processing your request', 'danger');
                console.error("Moderation Error:", error);
            }
        );
    }
    
    function bulkAction(action) {
        const selected = [];
        document.querySelectorAll('.comment-checkbox:checked').forEach(checkbox => {
            selected.push(checkbox.value);
        });

        if (selected.length === 0) {
            showAlert('Please select at least one comment', 'warning');
            return;
        }

        if (confirm(`Are you sure you want to ${action} ${selected.length} comment(s)?`)) {
            senddata(
                'post/comments/bulk_moderate.php',
                'POST',
                { action: action, comment_ids: selected },
                function(response) {
                    const result = response;
                    if (result.success) {
                        showAlert(result.message, 'success');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showAlert(result.message, 'danger');
                    }
                },
                function(error) {
                    showAlert('An error occurred while processing your request', 'danger');
                    console.error("Bulk Action Error:", error);
                }
            );
        }
    }