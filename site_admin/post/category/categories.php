<?php
require_once('../../admin_connect.php');

$tbl = "category";
$tbl_id = "catid";
$tbl_seq = "cat_sequence";


// Add this at the top of your PHP file
header('Content-Type: application/json');



if(isset($_POST['change_status'])){

$id= $_POST['id'];

$sql ="UPDATE $tbl SET isactive = 1 - isactive  
Where  $tbl_id = $id";

echo Update($sql);

}


if(isset($_POST['change_status'])){

$id= $_POST['id'];

$sql ="UPDATE $tbl SET isactive = 1 - isactive  
Where  $tbl_id = $id";

echo Update($sql);

}


if (isset($_POST['delete'])) {

$id= $_POST['id'];

$sql ="UPDATE $tbl SET soft_delete = 1
Where $tbl_id = $id";

echo Update($sql);

}


// Modify your sequence change handler to return proper JSON
if (isset($_POST['change_sequence'])) {
    $id = (int)$_POST['id'];
    $direction = $_POST['direction'];
    
    // Get current sequence and parent category
    $current = return_single_row("SELECT $tbl_seq, ParentCategory FROM $tbl WHERE $tbl_id = $id");
    
    if (!$current) {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
        exit;
    } 
    
    $currentSeq = $current[$tbl_seq];
    $parentCategory = $current['ParentCategory'];
    
    if ($direction == 'up') {
        // Find the item immediately above this one with same parent
        $swapWith = return_single_row("SELECT $tbl_id, $tbl_seq FROM $tbl 
                                      WHERE ParentCategory = $parentCategory 
                                      AND $tbl_seq < $currentSeq 
                                      AND soft_delete = 0 
                                      ORDER BY $tbl_seq DESC LIMIT 1");
        
        if ($swapWith) {
            // Swap sequences
            Update("UPDATE $tbl SET $tbl_seq = {$swapWith[$tbl_seq]} WHERE $tbl_id = $id");
            Update("UPDATE $tbl SET $tbl_seq = $currentSeq WHERE $tbl_id = {$swapWith[$tbl_id]}");
            echo json_encode([
                'success' => true,
                'new_sequence' => $swapWith[$tbl_seq],
                'other_id' => $swapWith[$tbl_id],
                'other_new_sequence' => $currentSeq
            ]);
            exit;
        }
    } else if ($direction == 'down') {
        // Find the item immediately below this one with same parent
        $swapWith = return_single_row("SELECT $tbl_id, $tbl_seq FROM $tbl 
                                      WHERE ParentCategory = $parentCategory 
                                      AND $tbl_seq > $currentSeq 
                                      AND soft_delete = 0 
                                      ORDER BY $tbl_seq ASC LIMIT 1");
        
        if ($swapWith) {
            // Swap sequences
            Update("UPDATE $tbl SET $tbl_seq = {$swapWith[$tbl_seq]} WHERE $tbl_id = $id");
            Update("UPDATE $tbl SET $tbl_seq = $currentSeq WHERE $tbl_id = {$swapWith[$tbl_id]}");
            echo json_encode([
                'success' => true,
                'new_sequence' => $swapWith[$tbl_seq],
                'other_id' => $swapWith[$tbl_id],
                'other_new_sequence' => $currentSeq
            ]);
            exit;
        }
    }
    
    echo json_encode(['success' => false, 'message' => 'No adjacent item found']);
    exit;
}

// For filter responses
if (isset($_POST['filter_categories'])) {
    $parentCategory = isset($_POST['parent_category']) ? (int)$_POST['parent_category'] : null;
    $showInNavbar = isset($_POST['show_in_navbar']) ? (int)$_POST['show_in_navbar'] : null;
    
    $where = "WHERE soft_delete = 0";
    
    if ($parentCategory !== null) {
        $where .= " AND ParentCategory = $parentCategory";
    }
    
    if ($showInNavbar !== null) {
        $where .= " AND showInNavBar = $showInNavbar";
    }
    
    $sql = "SELECT c.*, 
                   (SELECT catname FROM category WHERE catid = c.ParentCategory) as parent_name 
            FROM category c 
            $where 
            ORDER BY cat_sequence ASC";
    
    $categories = return_multiple_rows($sql);
    echo json_encode($categories);
    exit;
}