<?php
include '../../../admin_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mediaType = $_POST['media_type'] ?? '';
    $id = (int)$_POST['id'];
    $currentSequence = (int)$_POST['current_sequence'];
    $direction = $_POST['direction'];
    $page_id =  $_POST['pid']; // Assuming $page is available from your config
    
    // Validate media type
    $validTypes = ['image', 'video', 'file'];
    if (!in_array($mediaType, $validTypes)) {
        echo json_encode(['success' => false, 'message' => 'Invalid media type']);
        exit;
    }
    
    try {
        if ($direction === 'up') {
            // Move item up (decrease sequence)
            $newSequence = $currentSequence - 1;
            if ($newSequence < 1) $newSequence = 1;
            
            // Determine the table and columns based on media type
            switch ($mediaType) {
                case 'image':
                    // Swap with the item above
                    $swapSql = "UPDATE images SET i_sequence = i_sequence + 1 
                               WHERE i_sequence = $newSequence AND pid = $page_id AND i_id != $id";
                    Update($swapSql);
                    
                    $updateSql = "UPDATE images SET i_sequence = $newSequence WHERE i_id = $id";
                    break;
                    
                case 'video':
                    // Swap with the item above
                    $swapSql = "UPDATE videos SET v_sequence = v_sequence + 1 
                               WHERE v_sequence = $newSequence AND pid = $page_id AND v_id != $id";
                    Update($swapSql);
                    
                    $updateSql = "UPDATE videos SET v_sequence = $newSequence WHERE v_id = $id";
                    break;
                    
                case 'file':
                    // Swap with the item above
                    $swapSql = "UPDATE page_files SET f_sequence = f_sequence + 1 
                               WHERE f_sequence = $newSequence AND pid = $page_id AND f_id != $id";
                    Update($swapSql);
                    
                    $updateSql = "UPDATE page_files SET f_sequence = $newSequence WHERE f_id = $id";
                    break;
            }
            
            if (Update($updateSql)) {
                $response = ['success' => true, 'message' => 'Sequence updated'];
            } else {
                $response = ['success' => false, 'message' => 'Failed to update sequence'];
            }
            
        } else {
            // Move item down (increase sequence)
            $newSequence = $currentSequence + 1;
            
            // Get max sequence to prevent going beyond
            switch ($mediaType) {
                case 'image':
                    $maxSql = "SELECT MAX(i_sequence) as max_seq FROM images WHERE pid = $page_id";
                    break;
                case 'video':
                    $maxSql = "SELECT MAX(v_sequence) as max_seq FROM videos WHERE pid = $page_id";
                    break;
                case 'file':
                    $maxSql = "SELECT MAX(f_sequence) as max_seq FROM page_files WHERE pid = $page_id";
                    break;
            }
            
            $maxResult = return_single_row($maxSql);
            $maxSeq = $maxResult['max_seq'];
            
            if ($newSequence > $maxSeq) $newSequence = $maxSeq;
            
            // Determine the table and columns based on media type
            switch ($mediaType) {
                case 'image':
                    // Swap with the item below
                    $swapSql = "UPDATE images SET i_sequence = i_sequence - 1 
                               WHERE i_sequence = $newSequence AND pid = $page_id AND i_id != $id";
                    Update($swapSql);
                    
                    $updateSql = "UPDATE images SET i_sequence = $newSequence WHERE i_id = $id";
                    break;
                    
                case 'video':
                    // Swap with the item below
                    $swapSql = "UPDATE videos SET v_sequence = v_sequence - 1 
                               WHERE v_sequence = $newSequence AND pid = $page_id AND v_id != $id";
                    Update($swapSql);
                    
                    $updateSql = "UPDATE videos SET v_sequence = $newSequence WHERE v_id = $id";
                    break;
                    
                case 'file':
                    // Swap with the item below
                    $swapSql = "UPDATE page_files SET f_sequence = f_sequence - 1 
                               WHERE f_sequence = $newSequence AND pid = $page_id AND f_id != $id";
                    Update($swapSql);
                    
                    $updateSql = "UPDATE page_files SET f_sequence = $newSequence WHERE f_id = $id";
                    break;
            }
            
            if (Update($updateSql)) {
                $response = ['success' => true, 'message' => 'Sequence updated'];
            } else {
                $response = ['success' => false, 'message' => 'Failed to update sequence'];
            }
        }
        
        echo json_encode($response);
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>