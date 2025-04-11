<?php
require_once('../../../admin_connect.php');

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Unknown error'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method';
    echo json_encode($response);
    exit;
}

if (isset($_POST['delete']) && isset($_POST['media_type']) && isset($_POST['id'])) {
    $id = clean($_POST['id']);
    $media_type = clean($_POST['media_type']);
    
    // Set table and field names based on media type
    switch ($media_type) {
        case 'image':
            $tbl = 'images';
            $tbl_id = 'i_id';
            $file_field = 'i_name';
            $path_constant = 'ABSOLUTE_IMAGEPATH';
            $page_id_field = 'pid';
            break;
            
        case 'video':
            $tbl = 'videos';
            $tbl_id = 'v_id';
            $file_field = 'v_name';
            $thumbnail_field = 'v_thumbnail';
            $path_constant = 'ABSOLUTE_VIDEOPATH';
            $page_id_field = 'pid';
            break;
            
        case 'file':
            $tbl = 'page_files';
            $tbl_id = 'f_id';
            $file_field = 'f_name';
            $path_constant = 'ABSOLUTE_FILEPATH';
            $page_id_field = 'pid';
            break;
            
        default:
            $response['message'] = 'Invalid media type';
            echo json_encode($response);
            exit;
    }
    
    // Get media data from database
    $query = "SELECT $file_field, $page_id_field" . ($media_type == 'video' ? ", $thumbnail_field" : "") . " FROM $tbl WHERE $tbl_id = $id";
    $media_data = return_single_row($query);
    
    if (!$media_data) {
        $response['message'] = ucfirst($media_type) . ' not found in database';
        echo json_encode($response);
        exit;
    }
    
    $filename = $media_data[$file_field];
    $page_id = $media_data[$page_id_field];
    
    // Check if any other active pages are using this media
    $usage_check = return_single_ans("
        SELECT COUNT(*) FROM $tbl 
        WHERE $file_field = '" . escape($filename) . "' 
        AND $page_id_field != $page_id
        AND $tbl_id IN (
            SELECT $tbl_id FROM $tbl t
            JOIN pages p ON t.$page_id_field = p.pid
            WHERE p.soft_delete = 0
        )
    ");
    
    // Delete database record first
    $sql = "DELETE FROM $tbl WHERE $tbl_id = $id";
    if (Delete($sql)) {
        // Only delete physical files if not used by other pages
        if ($usage_check == 0) {
            // Delete main file
            $file_path = '../../../' . constant($path_constant) . $filename;
            if (file_exists($file_path)) {
                if (!unlink($file_path)) {
                    $response['message'] = 'Record deleted but failed to delete file';
                    echo json_encode($response);
                    exit;
                }
            }
            
            // Delete thumbnail if video
            if ($media_type == 'video' && !empty($media_data[$thumbnail_field])) {
                $thumb_path = '../../../' . ABSOLUTE_IMAGEPATH . $media_data[$thumbnail_field];
                if (file_exists($thumb_path)) {
                    unlink($thumb_path);
                }
            }
            
            $response = ['success' => true, 'message' => ucfirst($media_type) . ' deleted (file removed)'];
        } else {
            $response = ['success' => true, 'message' => ucfirst($media_type) . ' record deleted (file kept as it\'s used by other pages)'];
        }
    } else {
        $response['message'] = 'Failed to delete database record';
    }
}

echo json_encode($response);
?>