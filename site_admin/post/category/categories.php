<?php
require_once('../../admin_connect.php');

$tbl = "category";
$tbl_id = "catid";
$tbl_seq = "cat_sequence";

// Set JSON header for all responses
header('Content-Type: application/json');

// Function to standardize responses
function jsonResponse($success, $message = '', $data = []) {
    return json_encode(array_merge([
        'success' => $success,
        'message' => $message
    ], $data));
}

// Handle status change
if (isset($_POST['change_status'])) {
    try {
        $id = (int)$_POST['id'];
        $isActive = isset($_POST['is_active']) ? (int)$_POST['is_active'] : null;
        
        // If is_active is provided, use it directly, otherwise toggle
        if ($isActive !== null) {
            $newStatus = $isActive;
        } else {
            // Get current status
            $current = return_single_row("SELECT isactive FROM $tbl WHERE $tbl_id = $id");
            $newStatus = $current ? 1 - (int)$current['isactive'] : 0;
        }
        
        $sql = "UPDATE $tbl SET isactive = $newStatus WHERE $tbl_id = $id";
        $result = Update($sql);
        
        if ($result) {
            echo jsonResponse(true, 'Status updated successfully', [
                'new_status' => $newStatus,
                'status_text' => $newStatus ? 'Active' : 'Inactive'
            ]);
        } else {
            echo jsonResponse(false, 'Failed to update status');
        }
    } catch (Exception $e) {
        echo jsonResponse(false, 'Error: ' . $e->getMessage());
    }
    exit;
}

// Handle delete
if (isset($_POST['delete'])) {
    try {
        $id = (int)$_POST['id'];
        $sql = "UPDATE $tbl SET soft_delete = 1 WHERE $tbl_id = $id";
        $result = Update($sql);
        
        echo jsonResponse((bool)$result, $result ? 'Item deleted successfully' : 'Failed to delete item');
    } catch (Exception $e) {
        echo jsonResponse(false, 'Error: ' . $e->getMessage());
    }
    exit;
}

// Handle sequence change
if (isset($_POST['change_sequence'])) {
    try {
        $id = (int)$_POST['id'];
        $direction = $_POST['direction'];
        $parentId = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : 0;
        
        // Get current item info
        $current = return_single_row("SELECT $tbl_seq, ParentCategory FROM $tbl WHERE $tbl_id = $id");
        
        if (!$current) {
            echo jsonResponse(false, 'Item not found');
            exit;
        }
        
        $currentSeq = (int)$current[$tbl_seq];
        $currentParent = (int)$current['ParentCategory'];
        
        // If parent_id was provided in request, use that (for drag-and-drop)
        if (isset($_POST['parent_id'])) {
            $parentId = (int)$_POST['parent_id'];
            // Update parent if changed
            if ($parentId != $currentParent) {
                Update("UPDATE $tbl SET ParentCategory = $parentId WHERE $tbl_id = $id");
            }
        } else {
            $parentId = $currentParent;
        }
        
        if ($direction == 'up') {
            // Find item to swap with (previous sibling)
            $swapWith = return_single_row("SELECT $tbl_id, $tbl_seq FROM $tbl 
                                          WHERE ParentCategory = $parentId 
                                          AND $tbl_seq < $currentSeq 
                                          AND soft_delete = 0 
                                          ORDER BY $tbl_seq DESC LIMIT 1");
        } else if ($direction == 'down') {
            // Find item to swap with (next sibling)
            $swapWith = return_single_row("SELECT $tbl_id, $tbl_seq FROM $tbl 
                                          WHERE ParentCategory = $parentId 
                                          AND $tbl_seq > $currentSeq 
                                          AND soft_delete = 0 
                                          ORDER BY $tbl_seq ASC LIMIT 1");
        } else {
            // For drag-and-drop, set specific position
            $newPosition = (int)$_POST['position'];
            
            // First, update all sequences to make room
            $conn->query("UPDATE $tbl SET $tbl_seq = $tbl_seq + 1 
                          WHERE ParentCategory = $parentId 
                          AND $tbl_seq >= $newPosition 
                          AND $tbl_id != $id
                          AND soft_delete = 0");
            
            // Then update the dragged item
            $result = Update("UPDATE $tbl SET $tbl_seq = $newPosition WHERE $tbl_id = $id");
            
            echo jsonResponse((bool)$result, $result ? 'Order updated' : 'Failed to update order', [
                'new_sequence' => $newPosition
            ]);
            exit;
        }
        
        if ($swapWith) {
            // Swap sequences
            $swapId = (int)$swapWith[$tbl_id];
            $swapSeq = (int)$swapWith[$tbl_seq];
            
            // Start transaction
            $conn->begin_transaction();
            
            try {
                // Set current item to temporary value
                $conn->query("UPDATE $tbl SET $tbl_seq = 0 WHERE $tbl_id = $id");
                // Update the other item
                $conn->query("UPDATE $tbl SET $tbl_seq = $currentSeq WHERE $tbl_id = $swapId");
                // Update current item
                $conn->query("UPDATE $tbl SET $tbl_seq = $swapSeq WHERE $tbl_id = $id");
                
                $conn->commit();
                
                echo jsonResponse(true, 'Sequence updated', [
                    'new_sequence' => $swapSeq,
                    'other_id' => $swapId,
                    'other_new_sequence' => $currentSeq
                ]);
            } catch (Exception $e) {
                $conn->rollback();
                echo jsonResponse(false, 'Database error: ' . $e->getMessage());
            }
        } else {
            echo jsonResponse(false, 'No adjacent item found');
        }
    } catch (Exception $e) {
        echo jsonResponse(false, 'Error: ' . $e->getMessage());
    }
    exit;
}

// Handle menu order update (for drag-and-drop)
// Handle menu order update (for drag-and-drop)
if (isset($_POST['update_order'])) {
    try {
        $id = (int)$_POST['id'];
        $requestedPosition = (int)$_POST['position'];
        $newParentId = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : 0;
        
        // Get current item info with more details
        $current = return_single_row("SELECT $tbl_seq, ParentCategory FROM $tbl WHERE $tbl_id = $id");
        
        if (!$current) {
            echo jsonResponse(false, 'Item not found');
            exit;
        }
        
        $currentSeq = (int)$current[$tbl_seq];
        $currentParent = (int)$current['ParentCategory'];
        
        // Validate if change is actually needed
        if ($currentSeq == $requestedPosition && $currentParent == $newParentId) {
            echo jsonResponse(true, 'No change needed', [
                'new_sequence' => $currentSeq,
                'parent_id' => $currentParent
            ]);
            exit;
        }
        
        // Start transaction
        $conn->begin_transaction();
        
        try {
            // 1. If parent changed, handle the move between parents
            if ($newParentId != $currentParent) {
                // Remove from old parent's sequence
                $conn->query("UPDATE $tbl SET $tbl_seq = $tbl_seq - 1 
                            WHERE ParentCategory = $currentParent 
                            AND $tbl_seq > $currentSeq
                            AND soft_delete = 0");
                
                // Make room in new parent
                $conn->query("UPDATE $tbl SET $tbl_seq = $tbl_seq + 1 
                            WHERE ParentCategory = $newParentId 
                            AND $tbl_seq >= $requestedPosition
                            AND soft_delete = 0");
                
                // Update the item's parent and position
                $conn->query("UPDATE $tbl SET ParentCategory = $newParentId, $tbl_seq = $requestedPosition 
                            WHERE $tbl_id = $id");
            } 
            // 2. If same parent, handle position change
            else {
                if ($requestedPosition > $currentSeq) {
                    // Moving down - decrement items between old and new position
                    $conn->query("UPDATE $tbl SET $tbl_seq = $tbl_seq - 1 
                                WHERE ParentCategory = $currentParent 
                                AND $tbl_seq > $currentSeq 
                                AND $tbl_seq <= $requestedPosition
                                AND $tbl_id != $id
                                AND soft_delete = 0");
                } else {
                    // Moving up - increment items between new and old position
                    $conn->query("UPDATE $tbl SET $tbl_seq = $tbl_seq + 1 
                                WHERE ParentCategory = $currentParent 
                                AND $tbl_seq >= $requestedPosition 
                                AND $tbl_seq < $currentSeq
                                AND $tbl_id != $id
                                AND soft_delete = 0");
                }
                
                // Update the item's position
                $conn->query("UPDATE $tbl SET $tbl_seq = $requestedPosition 
                            WHERE $tbl_id = $id");
            }
            
            $conn->commit();
            
            // Verify the update
            $updated = return_single_row("SELECT $tbl_seq, ParentCategory FROM $tbl WHERE $tbl_id = $id");
            $actualNewSeq = (int)$updated[$tbl_seq];
            $actualParent = (int)$updated['ParentCategory'];
            
            if ($actualNewSeq != $requestedPosition || $actualParent != $newParentId) {
                throw new Exception("Verification failed - update not persisted");
            }
            
            echo jsonResponse(true, 'Order updated successfully', [
                'new_sequence' => $actualNewSeq,
                'parent_id' => $actualParent,
                'changed' => ($actualNewSeq != $currentSeq || $actualParent != $currentParent)
            ]);
            
        } catch (Exception $e) {
            $conn->rollback();
            echo jsonResponse(false, 'Database error: ' . $e->getMessage(), [
                'current_sequence' => $currentSeq,
                'requested_position' => $requestedPosition,
                'current_parent' => $currentParent,
                'new_parent' => $newParentId
            ]);
        }
    } catch (Exception $e) {
        echo jsonResponse(false, 'Error: ' . $e->getMessage());
    }
    exit;
}
// Handle filter requests
if (isset($_POST['filter_categories'])) {
    try {
        $parentCategory = isset($_POST['parent_category']) ? (int)$_POST['parent_category'] : null;
        $showInNavbar = isset($_POST['show_in_navbar']) ? (int)$_POST['show_in_navbar'] : null;
        $status = isset($_POST['status']) ? (int)$_POST['status'] : null;
        $search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : null;
        
        $where = "WHERE soft_delete = 0";
        
        if ($parentCategory !== null) {
            $where .= " AND ParentCategory = $parentCategory";
        }
        
        if ($showInNavbar !== null) {
            $where .= " AND showInNavBar = $showInNavbar";
        }
        
        if ($status !== null) {
            $where .= " AND isactive = $status";
        }
        
        if ($search !== null && $search !== '') {
            $where .= " AND catname LIKE '%$search%'";
        }
        
        $sql = "SELECT c.*, 
                       (SELECT catname FROM category WHERE catid = c.ParentCategory) as parent_name 
                FROM category c 
                $where 
                ORDER BY cat_sequence ASC";
        
        $categories = return_multiple_rows($sql);
        echo json_encode($categories);
    } catch (Exception $e) {
        echo jsonResponse(false, 'Error: ' . $e->getMessage());
    }
    exit;
}

// Default response if no action matched
echo jsonResponse(false, 'Invalid request');