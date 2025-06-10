$(document).ready(function() {
    $('#comment-form').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var formData = form.serialize();
        var messageContainer = $('#comment-message');
        
        // Clear previous messages
        messageContainer.hide().removeClass('alert-success alert-danger').html('');
        
        // Use your senddata function
        senddata(
                'post/comments/comments.php', // Current URL (the PHP script handles both regular and AJAX requests)
            'POST',
            formData,
            function(response) {
                try {
                    var result = typeof response === 'string' ? JSON.parse(response) : response;
                    
                    if (result.status === 'success') {
                        // Show success message
                        messageContainer.addClass('alert alert-success').html(result.message).show();
                        
                        // Clear the form
                        form.find('textarea[name="comment"]').val('');
                        
                        // If guest, clear name/email too
                        if (!form.find('input[name="name"]').length === 0) {
                            form.find('input[name="name"], input[name="email"]').val('');
                        }
                        
                        // Optionally prepend the new comment (if approved immediately)
                        if (result.comment && result.comment.is_approved) {
                            prependNewComment(result.comment);
                        }
                    } else {
                        // Show error message
                        messageContainer.addClass('alert alert-danger').html(result.message).show();
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    messageContainer.addClass('alert alert-danger').html('An unexpected error occurred.').show();
                }
            },
            function(xhr, status, error) {
                console.error('AJAX error:', status, error);
                messageContainer.addClass('alert alert-danger').html('Failed to submit comment. Please try again.').show();
            }
        );
    });
    
    // Function to prepend a new comment (if approved immediately)
    function prependNewComment(commentData) {
        // This would need to match your comment rendering structure
        var commentHtml = '<div class="mb-4 p-3 border rounded">' +
            '<div class="d-flex align-items-center mb-2">' +
            '<img src="' + (commentData.user_id ? '<?php echo ABSOLUTE_IMAGEPATH; ?>' + commentData.profile_pic : 
                'https://www.gravatar.com/avatar/' + md5(commentData.guest_email.toLowerCase().trim()) + '?d=mp') + '" ' +
                'class="rounded-circle me-2" width="40" height="40" alt="' + (commentData.user_id ? commentData.username : commentData.guest_name) + '">' +
            '<div>' +
                '<h6 class="mb-0">' + (commentData.user_id ? commentData.username : commentData.guest_name) + '</h6>' +
                '<small class="text-muted">Just now</small>' +
            '</div>' +
            '</div>' +
            '<div class="comment-text">' + nl2br(htmlspecialchars(commentData.comment_text)) + '</div>' +
        '</div>';
        
        $('#comments-container').prepend(commentHtml);
    }
    
    // Helper functions
    function nl2br(str) {
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br>$2');
    }
    
    function htmlspecialchars(str) {
        return $('<div>').text(str).html();
    }
});