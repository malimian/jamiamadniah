<?php

// List of NSFW terms to block (can be expanded)
$nsfw_terms = [
    'profanity', 'obscenity', 'explicit', 'porn', 'xxx', 'adult', 'nsfw',
    'fuck', 'shit', 'asshole', 'bitch', 'cunt', 'dick', 'pussy', 'cock',
    'slut', 'whore', 'faggot', 'nigger', 'retard', 'rape', 'molest',
    'kill', 'murder', 'suicide', 'terrorist', 'bomb', 'drugs', 'heroin',
    'cocaine', 'meth', 'weed', 'hitler', 'nazi', 'kkk', 'pedo', 'childporn'
];


// Function to check for NSFW content
function contains_nsfw($text) {
    global $nsfw_terms;
    $text = strtolower($text);
    foreach ($nsfw_terms as $term) {
        if (strpos($text, $term) !== false) {
            return true;
        }
    }
    return false;
}

// Function to get user's profile picture if logged in
function get_user_profile_pic($user_id) {
    if ($user_id) {
        $user = return_single_row("SELECT profile_pic FROM loginuser WHERE id = $user_id");
        if ($user && !empty($user['profile_pic'])) {
            return ABSOLUTE_IMAGEPATH . $user['profile_pic'];
        }
    }
    return ABSOLUTE_IMAGEPATH . 'default-user.png'; // Default profile picture
}

// Function to save a new comment
function save_comment($pid, $user_id, $name, $email, $comment) {
    $is_nsfw = contains_nsfw($comment) ? 1 : 0;
    
    // For logged-in users, we don't store name/email separately
    if ($user_id) {
        $sql = "INSERT INTO pages_comments (pid, user_id, comment_text, is_nsfw) 
                VALUES ($pid, $user_id, '".escape($comment)."', $is_nsfw)";
    } else {
        $sql = "INSERT INTO pages_comments (pid, guest_name, guest_email, comment_text, is_nsfw) 
                VALUES ($pid, '".escape($name)."', '".escape($email)."', '".escape($comment)."', $is_nsfw)";
    }
    return Insert($sql);
}

// Function to get approved comments for a page
function get_page_comments($pid, $admin_mode = false) {
    $where = $admin_mode ? "pid = $pid" : "pid = $pid AND is_approved = 1 AND is_nsfw = 0";
    return return_multiple_rows("SELECT * FROM pages_comments WHERE $where ORDER BY created_at DESC");
}

// Function to approve/delete comments (admin only)
function moderate_comment($comment_id, $action, $notes = '') {
    if ($action === 'approve') {
        $sql = "UPDATE pages_comments SET is_approved = 1, admin_notes = '".escape($notes)."' WHERE comment_id = $comment_id";
    } elseif ($action === 'delete') {
        $sql = "DELETE FROM pages_comments WHERE comment_id = $comment_id";
    } elseif ($action === 'flag_nsfw') {
        $sql = "UPDATE pages_comments SET is_nsfw = 1, admin_notes = '".escape($notes)."' WHERE comment_id = $comment_id";
    }
    
    return Update($sql);
}


// Render a single comment
function render_comment($comment, $is_admin = false) {
    $user_info = '';
    $mod_actions = '';
    
    // User info section
    if ($comment['user_id']) {
        $user = return_single_row("SELECT username, fullname, profile_pic FROM loginuser WHERE id = ".$comment['user_id']);
        $name = $user['fullname'] ?? $user['username'];
        $avatar = get_user_profile_pic($comment['user_id']);
        $user_info = '<div class="d-flex align-items-center mb-2">
            <img src="'.$avatar.'" class="rounded-circle me-2" width="40" height="40" alt="'.$name.'">
            <div>
                <h6 class="mb-0">'.$name.'</h6>
                <small class="text-muted">'.date('M j, Y \a\t g:i a', strtotime($comment['created_at'])).'</small>
            </div>
        </div>';
    } else {
        $name = $comment['guest_name'];
        $email = $comment['guest_email'];
        $gravatar = 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($email))).'?d=mp';
        $user_info = '<div class="d-flex align-items-center mb-2">
            <img src="'.$gravatar.'" class="rounded-circle me-2" width="40" height="40" alt="'.$name.'">
            <div>
                <h6 class="mb-0">'.$name.'</h6>
                <small class="text-muted">'.date('M j, Y \a\t g:i a', strtotime($comment['created_at'])).'</small>
            </div>
        </div>';
    }
    
    // Moderation flags
    $flags = '';
    if ($comment['is_nsfw']) {
        $flags .= '<span class="badge bg-danger me-1">NSFW</span>';
    }
    if (!$comment['is_approved']) {
        $flags .= '<span class="badge bg-warning me-1">Pending Approval</span>';
    }
    
    // Admin actions
    if ($is_admin) {
        $mod_actions = '<div class="mt-2 border-top pt-2 small">
            <strong>Admin Actions:</strong>
            <a href="?comment_action=approve&comment_id='.$comment['comment_id'].'" class="btn btn-sm btn-success ms-2">Approve</a>
            <a href="?comment_action=flag_nsfw&comment_id='.$comment['comment_id'].'" class="btn btn-sm btn-danger ms-2">Flag NSFW</a>
            <a href="?comment_action=delete&comment_id='.$comment['comment_id'].'" class="btn btn-sm btn-dark ms-2">Delete</a>
        </div>';
    }
    
    return '<div class="mb-4 p-3 border rounded'.($comment['is_nsfw'] ? ' bg-light' : '').'">
        '.$user_info.'
        '.($flags ? '<div class="mb-2">'.$flags.'</div>' : '').'
            <div class="comment-text">'.nl2br(stripslashes(htmlspecialchars($comment['comment_text']))).'</div>
        '.$mod_actions.'
    </div>';
}


// Display comments section
function display_comments($pid, $is_admin = false) {
   
    $comments = get_page_comments($pid, $is_admin);
    $output = '';
    
    if (empty($comments)) {
        $output .= '<p class="text-muted">No comments yet. Be the first to comment!</p>';
    } else {
        foreach ($comments as $comment) {
            $output .= render_comment($comment, $is_admin);
        }
    }
    
    return $output;
}
