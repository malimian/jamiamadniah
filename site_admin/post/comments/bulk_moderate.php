<?php 
include '../../admin_connect.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$action = isset($_POST['action']) ? clean($_POST['action']) : '';
$comment_ids = isset($_POST['comment_ids']) && is_array($_POST['comment_ids']) ? $_POST['comment_ids'] : [];

if (empty($action) || empty($comment_ids)) {
    echo json_encode(['success' => false, 'message' => 'Action or comment IDs missing']);
    exit;
}

// Sanitize and validate IDs
$ids = array_filter(array_map('intval', $comment_ids), function($id) {
    return $id > 0;
});

if (empty($ids)) {
    echo json_encode(['success' => false, 'message' => 'No valid comment IDs provided']);
    exit;
}

$id_list = implode(',', $ids);

// Validate IDs exist using your return_single_ans function
$total = return_single_ans("SELECT COUNT(*) FROM pages_comments WHERE comment_id IN ($id_list)");
if (!$total) {
    echo json_encode(['success' => false, 'message' => 'No matching comments found']);
    exit;
}

$msg = '';
$result = false;

// Handle bulk actions using your existing functions
switch ($action) {
    case 'approve':
        $result = Update("UPDATE pages_comments SET is_approved = 1 WHERE comment_id IN ($id_list)");
        $msg = "Approved $result comment(s)";
        break;

    case 'reject':
        $result = Update("UPDATE pages_comments SET is_approved = 0 WHERE comment_id IN ($id_list)");
        $msg = "Rejected $result comment(s)";
        break;

    case 'flag_nsfw':
        $result = Update("UPDATE pages_comments SET is_nsfw = 1 WHERE comment_id IN ($id_list)");
        $msg = "Flagged $result comment(s) as NSFW";
        break;

    case 'unflag_nsfw':
        $result = Update("UPDATE pages_comments SET is_nsfw = 0 WHERE comment_id IN ($id_list)");
        $msg = "Unflagged NSFW on $result comment(s)";
        break;

    case 'delete':
        $result = Delete("DELETE FROM pages_comments WHERE comment_id IN ($id_list)");
        $msg = "Deleted $result comment(s)";
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Unknown action']);
        exit;
}

if ($result !== false) {
    echo json_encode(['success' => true, 'message' => $msg]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database operation failed']);
}