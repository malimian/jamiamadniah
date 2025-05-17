<?php
require_once('../../admin_connect.php');

$tbl = "documents";
$tbl_id = "docu_id";

// Change status of a single document
if(isset($_POST['change_status'])) {
    $id = intval($_POST['id']);
    
    $sql = "UPDATE $tbl SET isactive = 1 - isactive WHERE $tbl_id = $id";
    $affected = Update($sql);
    echo $affected;
    exit;
}

// Delete a single document (soft delete)
if(isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    
    $sql = "UPDATE $tbl SET soft_delete = 1, isactive = 0 WHERE $tbl_id = $id";
    $affected = Update($sql);
    echo $affected;
    exit;
}

// Bulk actions handler
if(isset($_POST['bulk_action'])) {
    $action = $_POST['action'];
    $ids = isset($_POST['ids']) ? $_POST['ids'] : [];
    
    if(empty($ids)) {
        echo json_encode(['success' => false, 'message' => 'No documents selected']);
        exit;
    }
    
    $ids = array_map('intval', $ids);
    $id_list = implode(',', $ids);
    
    switch($action) {
        case 'delete':
            $sql = "UPDATE $tbl SET soft_delete = 1, isactive = 0 WHERE $tbl_id IN ($id_list)";
            break;
            
        case 'activate':
            $sql = "UPDATE $tbl SET isactive = 1 WHERE $tbl_id IN ($id_list)";
            break;
            
        case 'deactivate':
            $sql = "UPDATE $tbl SET isactive = 0 WHERE $tbl_id IN ($id_list)";
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
            exit;
    }
    
    $affected_rows = Update($sql);
    
    if($affected_rows !== false) {
        echo json_encode([
            'success' => true,
            'message' => "Successfully performed $action on $affected_rows document(s)"
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error performing bulk action'
        ]);
    }
    exit;
}

// Duplicate document
if(isset($_POST['duplicate'])) {
    $id = intval($_POST['id']);
    
    $original = return_single_row("SELECT * FROM $tbl WHERE $tbl_id = $id");
    
    if(!$original) {
        echo json_encode(['success' => false, 'message' => 'Document not found']);
        exit;
    }
    
    unset($original[$tbl_id]);
    $original['document_Title'] .= ' (Copy)';
    
    $columns = implode(',', array_keys($original));
    $values = "'" . implode("','", array_map('escape', array_values($original))) . "'";
    
    $sql = "INSERT INTO $tbl ($columns) VALUES ($values)";
    $new_id = Insert($sql);
    
    if($new_id !== false) {
        echo json_encode([
            'success' => true,
            'message' => 'Document duplicated successfully',
            'new_id' => $new_id
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error duplicating document'
        ]);
    }
    exit;
}

// If no valid action found
echo json_encode(['success' => false, 'message' => 'Invalid request']);
