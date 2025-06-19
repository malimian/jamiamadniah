<?php
include '../../admin_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $optionId = intval(clean($_POST['id']));
    $sql = "DELETE FROM attribute_options WHERE id = $optionId";
    
    if (Delete($sql)) {
        echo json_encode(['success' => true, 'message' => 'Option deleted']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete option']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}