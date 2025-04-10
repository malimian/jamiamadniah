<?php
include '../../../admin_connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$response = ['success' => false, 'message' => 'Unknown error'];
$page_id = isset($_POST['page_id']) ? clean($_POST['page_id']) : null;
$media_type = isset($_POST['media_type']) ? clean($_POST['media_type']) : null;
$media_id = isset($_POST['media_id']) ? clean($_POST['media_id']) : null;


// Handle status change request from js-switch
if (isset($_POST['change_status'])) {

    $response = ['success' => false, 'message' => 'Unknown error'];
    $id = isset($_POST['id']) ? clean($_POST['id']) : null;
    $media_type = isset($_POST['media_type']) ? clean($_POST['media_type']) : null;
    $is_active = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 0;
        
        if (!$id || !$media_type) {
            $response['message'] = 'Missing required parameters';
            echo json_encode($response);
            exit;
        }

        try {
            switch ($media_type) {
                case 'image':
                    $table = 'images';
                    $id_field = 'i_id';
                    break;
                case 'video':
                    $table = 'videos';
                    $id_field = 'v_id';
                    break;
                case 'file':
                    $table = 'page_files';
                    $id_field = 'f_id';
                    break;
                default:
                    throw new Exception('Invalid media type');
            }

            $sql = "UPDATE $table SET isactive = $is_active WHERE $id_field = '$id'";
            
            if (Update($sql)) {
                $response = ['success' => true, 'message' => 'Status updated'];
            } else {
                $response = ['success' => false, 'message' => 'Failed to update status'];
            }
        } catch (Exception $e) {
            $response = ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }

        echo json_encode($response);
    exit;
}



if (!$page_id || !$media_type || !$media_id) {
    $response['message'] = 'Missing required parameters';
    echo json_encode($response);
    exit;
}

try {
    switch ($media_type) {
        case 'image':
            $i_title = clean($_POST['i_title']);
            $i_caption = clean($_POST['i_caption']);
            $i_alttext = clean($_POST['i_alttext']);
            $i_description = clean($_POST['i_description']);
            
            // Get current image data
            $current_image = return_single_row("SELECT i_name FROM images WHERE i_id = '$media_id'");
            $old_filename = $current_image['i_name'];
            $new_filename = $old_filename;
            
            // Handle new image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                // Delete old file
                $old_path = '../../../../' . ABSOLUTE_IMAGEPATH . $old_filename;
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
                
                // Upload new file
                $temp = explode(".", $_FILES['image']['name']);
                $new_filename = $temp[0] . "_" . uniqid() . '.' . strtolower(end($temp));
                $new_filename = clean($new_filename);
                move_uploaded_file($_FILES['image']['tmp_name'], '../../../../' . ABSOLUTE_IMAGEPATH . $new_filename);
            }
            
            // Update database
            $sql = "UPDATE images SET 
                    i_name = '$new_filename',
                    i_title = '$i_title',
                    i_caption = '$i_caption',
                    i_alttext = '$i_alttext',
                    i_description = '$i_description'
                    WHERE i_id = '$media_id'";
            
            if (Update($sql)) {
                $response = ['success' => true, 'message' => 'Image updated'];
            } else {
                $response = ['success' => false, 'message' => 'Failed to update image'];
            }
            break;
            
        case 'video':
            $v_title = clean($_POST['v_title']);
            $v_description = clean($_POST['v_description']);
            
            // Get current video data
            $current_video = return_single_row("SELECT v_name, v_thumbnail FROM videos WHERE v_id = '$media_id'");
            $old_video = $current_video['v_name'];
            $old_thumbnail = $current_video['v_thumbnail'];
            $new_video = $old_video;
            $new_thumbnail = $old_thumbnail;
            
            // Handle new video upload
            if (isset($_FILES['video']) && $_FILES['video']['error'] == UPLOAD_ERR_OK) {
                // Delete old video
                $old_path = '../../../../' . ABSOLUTE_VIDEOPATH . $old_video;
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
                
                // Upload new video
                $temp = explode(".", $_FILES['video']['name']);
                $new_video = $temp[0] . "_" . uniqid() . '.' . strtolower(end($temp));
                $new_video = clean($new_video);
                move_uploaded_file($_FILES['video']['tmp_name'], '../../../../' . ABSOLUTE_VIDEOPATH . $new_video);
            }
            
            // Handle new thumbnail upload
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
                // Delete old thumbnail if exists
                if ($old_thumbnail) {
                    $old_thumb_path = '../../../../' . ABSOLUTE_IMAGEPATH . $old_thumbnail;
                    if (file_exists($old_thumb_path)) {
                        unlink($old_thumb_path);
                    }
                }
                
                // Upload new thumbnail
                $temp = explode(".", $_FILES['thumbnail']['name']);
                $new_thumbnail = $temp[0] . "_" . uniqid() . '.' . strtolower(end($temp));
                $new_thumbnail = clean($new_thumbnail);
                move_uploaded_file($_FILES['thumbnail']['tmp_name'], '../../../../' . ABSOLUTE_IMAGEPATH . $new_thumbnail);
            }
            
            // Update database
            $sql = "UPDATE videos SET 
                    v_name = '$new_video',
                    v_title = '$v_title',
                    v_thumbnail = '$new_thumbnail',
                    v_description = '$v_description'
                    WHERE v_id = '$media_id'";
            
            if (Update($sql)) {
                $response = ['success' => true, 'message' => 'Video updated'];
            } else {
                $response = ['success' => false, 'message' => 'Failed to update video'];
            }
            break;
            
        case 'file':
            $f_title = clean($_POST['f_title']);
            $f_download_link = clean($_POST['f_download_link']);
            $f_description = clean($_POST['f_description']);
            
            // Get current file data
            $current_file = return_single_row("SELECT f_name FROM page_files WHERE f_id = '$media_id'");
            $old_filename = $current_file['f_name'];
            $new_filename = $old_filename;
            
            // Handle new file upload
            if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
                // Delete old file
                $old_path = '../../../../' . ABSOLUTE_FILEPATH . $old_filename;
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
                
                // Upload new file
                $temp = explode(".", $_FILES['file']['name']);
                $new_filename = $temp[0] . "_" . uniqid() . '.' . strtolower(end($temp));
                $new_filename = clean($new_filename);
                move_uploaded_file($_FILES['file']['tmp_name'], '../../../../' . ABSOLUTE_FILEPATH . $new_filename);
            }
            
            // Update database
            $sql = "UPDATE page_files SET 
                    f_name = '$new_filename',
                    f_title = '$f_title',
                    f_download_link = '$f_download_link',
                    f_description = '$f_description'
                    WHERE f_id = '$media_id'";
            
            if (Update($sql)) {
                $response = ['success' => true, 'message' => 'File updated '];
            } else {
                $response = ['success' => false, 'message' => 'Failed to update file'];
            }
            break;
            
        default:
            $response = ['success' => false, 'message' => 'Invalid media type'];
            break;
    }
} catch (Exception $e) {
    $response = ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
}

echo json_encode($response);