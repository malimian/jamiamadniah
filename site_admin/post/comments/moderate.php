<?php 
include '../../admin_connect.php';

header('Content-Type: application/json');

// Validate request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$comment_id = isset($_POST['comment_id']) ? (int) $_POST['comment_id'] : 0;
$action     = isset($_POST['action']) ? clean($_POST['action']) : '';

if ($comment_id <= 0 || !$action) {
    echo json_encode(['success' => false, 'message' => 'Invalid comment ID or action']);
    exit;
}

// Check if comment exists
$exists = return_single_ans("SELECT COUNT(*) FROM pages_comments WHERE comment_id = $comment_id");
if (!$exists) {
    echo json_encode(['success' => false, 'message' => 'Comment not found']);
    exit;
}

$result = false;

switch ($action) {
    case 'approve':
        $result = Update("UPDATE pages_comments SET is_approved = 1 WHERE comment_id = $comment_id");
        break;

    case 'reject':
        $result = Update("UPDATE pages_comments SET is_approved = 0 WHERE comment_id = $comment_id");
        break;

    case 'flag_nsfw':
        $result = Update("UPDATE pages_comments SET is_nsfw = 1 WHERE comment_id = $comment_id");
        break;

    case 'unflag_nsfw':
        $result = Update("UPDATE pages_comments SET is_nsfw = 0 WHERE comment_id = $comment_id");
        break;

    case 'delete':
        $result = Delete("DELETE FROM pages_comments WHERE comment_id = $comment_id");
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Unknown action']);
        exit;
}

if ($result !== false) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database operation failed']);
}
