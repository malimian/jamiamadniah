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
            break;
            
        case 'video':
            $tbl = 'videos';
            $tbl_id = 'v_id';
            $file_field = 'v_name';
            $thumbnail_field = 'v_thumbnail';
            $path_constant = 'ABSOLUTE_VIDEOPATH';
            break;
            
        case 'file':
            $tbl = 'page_files';
            $tbl_id = 'f_id';
            $file_field = 'f_name';
            $path_constant = 'ABSOLUTE_FILEPATH';
            break;
            
        default:
            $response['message'] = 'Invalid media type';
            echo json_encode($response);
            exit;
    }
    
    // Get media data from database
    $query = "SELECT $file_field" . ($media_type == 'video' ? ", $thumbnail_field" : "") . " FROM $tbl WHERE $tbl_id = $id";
    $media_data = return_single_row($query);
    
    if (!$media_data) {
        $response['message'] = ucfirst($media_type) . ' not found in database';
        echo json_encode($response);
        exit;
    }
    
    // Delete main file
    $file_path = '../../../' . constant($path_constant) . $media_data[$file_field];
    if (file_exists($file_path)) {
        if (!unlink($file_path)) {
            $response['message'] = 'Failed to delete file';
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
    
    // Delete database record
    $sql = "DELETE FROM $tbl WHERE $tbl_id = $id";
    if (Delete($sql)) {
        $response = ['success' => true, 'message' => ucfirst($media_type) . ' deleted successfully'];
    } else {
        $response['message'] = 'Failed to delete database record';
    }
}

echo json_encode($response);
?>