<?php
require_once('../../admin_connect.php');

header('Content-Type: application/json');

if (!isset($_SESSION['user']) || !$has_edit) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    if (isset($_POST['bulk_action']) && isset($_POST['pages'])) {
        // Handle bulk actions
        $pageIds = is_array($_POST['pages']) ? array_map('intval', $_POST['pages']) : [intval($_POST['pages'])];
        $placeholders = implode(',', $pageIds);
        
        switch ($_POST['bulk_action']) {
            case 'delete':
                $sql = "UPDATE pages SET soft_delete = 1 WHERE pid IN ($placeholders)";
                $result = Update($sql);
                $message = 'Selected pages have been deleted';
                break;
                
            case 'publish':
                $userId = $_SESSION['user']['id'];
                $sql = "UPDATE pages SET isactive = 1, activatedby = $userId, activatedon = NOW() WHERE pid IN ($placeholders)";
                $result = Update($sql);
                $message = 'Selected pages have been published';
                break;
                
            case 'unpublish':
                $sql = "UPDATE pages SET isactive = 0 WHERE pid IN ($placeholders)";
                $result = Update($sql);
                $message = 'Selected pages have been unpublished';
                break;
                
            case 'feature':
                $sql = "UPDATE pages SET isFeatured = 1 WHERE pid IN ($placeholders)";
                $result = Update($sql);
                $message = 'Selected pages have been featured';
                break;
                
            case 'unfeature':
                $sql = "UPDATE pages SET isFeatured = 0 WHERE pid IN ($placeholders)";
                $result = Update($sql);
                $message = 'Selected pages have been unfeatured';
                break;
                
            default:
                echo json_encode(['success' => false, 'message' => 'Invalid action']);
                exit;
        }
        
        if ($result === false) {
            throw new Exception("Database operation failed");
        }
        
        echo json_encode(['success' => true, 'message' => $message]);
        
    } elseif (isset($_POST['assign_tag']) && isset($_POST['pages']) && isset($_POST['tag'])) {
        
        $pageIds = is_array($_POST['pages']) ? array_map('intval', $_POST['pages']) : [intval($_POST['pages'])];
        $placeholders = implode(',', $pageIds);
        $tag = escape($_POST['tag']);
        
        $sql = "UPDATE pages SET personal_tags = '$tag' WHERE pid IN ($placeholders)";
        $result = Update($sql);
        
        if ($result === false) {
            throw new Exception("Tag assignment failed");
        }
        
        echo json_encode(['success' => true, 'message' => 'Tag assigned']);
        
    } elseif (isset($_POST['change_status'])) {
        // Handle status change
        $id = intval($_POST['id']);
        $new_status = intval($_POST['new_status']);
        $userId = $_SESSION['user']['id'];
        
        if ($new_status) {
            $sql = "UPDATE pages SET isactive = 1, activatedby = $userId, activatedon = NOW() WHERE pid = $id";
        } else {
            $sql = "UPDATE pages SET isactive = 0 WHERE pid = $id";
        }

        $result = Update($sql);
        
        if ($result === false) {
            echo json_encode(['success' => false, 'message' => 'Status update failed']);
        } else {
            echo json_encode(['success' => true, 'message' => 'Status updated']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>