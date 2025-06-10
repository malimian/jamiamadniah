<?php
include '../../front_connect.php';

// Add this at the top of your PHP file to handle AJAX requests
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    header('Content-Type: application/json');
    
    $response = ['status' => 'error', 'message' => 'Invalid request'];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_comment') {
        $page_id = (int)$_POST['page_id'];
        $user_id = isset($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : 0;
        $name = isset($_POST['name']) ? clean($_POST['name']) : '';
        $email = isset($_POST['email']) ? clean($_POST['email']) : '';
        $comment = clean($_POST['comment']);
        
        if (!empty($comment)) {
            $comment_id = save_comment($page_id, $user_id, $name, $email, $comment);
            if ($comment_id) {
                $response = [
                    'status' => 'success',
                    'message' => 'Thank you for your comment! It will be visible after approval.',
                    'comment' => [
                        'comment_id' => $comment_id,
                        'is_approved' => 0, // New comments are not approved by default
                        'is_nsfw' => contains_nsfw($comment) ? 1 : 0
                    ]
                ];
            } else {
                $response = ['status' => 'error', 'message' => 'There was an error submitting your comment.'];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Please enter a comment.'];
        }
    }
    
    echo json_encode($response);
    exit;
}
?>