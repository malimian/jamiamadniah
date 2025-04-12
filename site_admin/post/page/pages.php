<?php
require_once('../../admin_connect.php');


$tbl = "pages";
$tbl_id = "pid";
$tbl_seq = "pages_sequence";
$uid = $_SESSION['user']['id'];


if(isset($_POST['change_status'])){

$id= $_POST['id'];

$sql ="UPDATE $tbl SET isactive = 1 - isactive  
Where  $tbl_id = $id";

echo Update($sql);

}


if (isset($_POST['delete'])) {

$id= $_POST['id'];

$sql ="UPDATE $tbl SET soft_delete = 1 , deletedby = '$uid' , deletedon = NOW()
Where $tbl_id = $id";

echo Update($sql);

}



if (isset($_POST['change_sequence'])) {
    $id = (int)$_POST['id'];
    $direction = $_POST['direction'];
    
    // Get current sequence and parent category
    $current = return_single_row("SELECT $tbl_seq FROM $tbl WHERE $tbl_id = $id");
    
    if (!$current) {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
        exit;
    } 
    
    $currentSeq = $current[$tbl_seq];
    
    if ($direction == 'up') {
        // Find the item immediately above this one with same parent
        $swapWith = return_single_row("SELECT $tbl_id, $tbl_seq FROM $tbl 
                                      Where $tbl_seq < $currentSeq 
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
                                      Where $tbl_seq > $currentSeq 
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



if(isset($_POST['update_notes'])) {
    $id = (int)$_POST['id'];
    $notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';
    
    $sql = "UPDATE $tbl SET notes = " . ($notes ? "'" . escape($notes) . "'" : "NULL") . " 
            WHERE $tbl_id = $id";
    
    echo Update($sql);
}



?>