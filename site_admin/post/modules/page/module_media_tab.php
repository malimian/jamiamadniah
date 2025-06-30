<?php 
include '../../../admin_connect.php';

if(isset($_POST['submit_media'])) {
    $page_id = $_POST['page_id'];
    $media_type = $_POST['media_type'];
    $response = ['success' => false, 'message' => 'Invalid request'];
    
    try {
        switch($media_type) {
            case 'images':
                if (isset($_FILES['images']) && $_FILES['images']['error'][0] != UPLOAD_ERR_NO_FILE) {
                    $countfiles = count($_FILES['images']['name']);
                    $titles = clean($_POST['i_title']);
                    $captions = clean($_POST['i_caption']);
                    $alttexts = clean($_POST['i_alttext']);
                    $descriptions = clean($_POST['i_description']);
                    $section_name = !empty($_POST['section_name']) ? clean($_POST['section_name']) : null;

                    // Get last sequence number for images
                    $get_last_sequence = (int)return_single_ans("SELECT MAX(i_sequence) FROM images WHERE pid = '$page_id'");
                    $next_sequence = $get_last_sequence + 1;

                    for ($i = 0; $i < $countfiles; $i++) {
                        if ($_FILES['images']['error'][$i] == UPLOAD_ERR_OK) {
                            $filename = $_FILES['images']['name'][$i];
                            $temp = explode(".", $filename);
                            $temp1 = strtolower(end($temp));
                            $newfilename = $temp[0] . "_" . uniqid() . '.' . $temp1;
                            $newfilename = clean($newfilename);

                            if (move_uploaded_file($_FILES['images']['tmp_name'][$i], '../../../../' . ABSOLUTE_IMAGEPATH . $newfilename)) {
                                $sql = "INSERT INTO `images` 
                                        (`pid`, `section_name`, `i_name`, `i_title`, `i_caption`, `i_alttext`, `i_description`, `i_sequence`, `isactive`, `soft_delete`) 
                                        VALUES 
                                        ('$page_id', " . ($section_name ? "'$section_name'" : "NULL") . ", '$newfilename', '$titles', '$captions', '$alttexts', '$descriptions', '$next_sequence', '1', '0')";
                                
                                $id = Insert($sql);
                                $next_sequence++; // Increment sequence for next image
                            }
                        }
                    }
                    
                    $response = ['success' => true, 'message' => 'Images saved'];
                } else {
                    $response = ['success' => false, 'message' => 'No images selected'];
                }
                break;
                
            case 'videos':
                if (isset($_FILES['videos']) && $_FILES['videos']['error'][0] != UPLOAD_ERR_NO_FILE) {
                    $countfiles = count($_FILES['videos']['name']);
                    $titles = clean($_POST['v_title']);
                    $descriptions = clean($_POST['v_description']);
                    $thumbnail = 'NULL';
                    $section_name = !empty($_POST['section_name']) ? clean($_POST['section_name']) : null;

                    // Get last sequence number for videos
                    $get_last_sequence = (int)return_single_ans("SELECT MAX(v_sequence) FROM videos WHERE pid = '$page_id'");
                    $next_sequence = $get_last_sequence + 1;

                    // Handle thumbnail if uploaded
                    if (isset($_FILES['v_thumbnail']) && $_FILES['v_thumbnail']['error'] != UPLOAD_ERR_NO_FILE) {
                        $thumbFilename = $_FILES['v_thumbnail']['name'];
                        $temp = explode(".", $thumbFilename);
                        $temp1 = strtolower(end($temp));
                        $newThumbFilename = $temp[0] . "_" . uniqid() . '.' . $temp1;
                        $newThumbFilename = clean($newThumbFilename);

                        if (move_uploaded_file($_FILES['v_thumbnail']['tmp_name'], '../../../../' . ABSOLUTE_IMAGEPATH . $newThumbFilename)) {
                            $thumbnail = "'$newThumbFilename'";
                        }
                    }

                    for ($i = 0; $i < $countfiles; $i++) {
                        if ($_FILES['videos']['error'][$i] == UPLOAD_ERR_OK) {
                            $filename = $_FILES['videos']['name'][$i];
                            $temp = explode(".", $filename);
                            $temp1 = strtolower(end($temp));
                            $newfilename = $temp[0] . "_" . uniqid() . '.' . $temp1;
                            $newfilename = clean($newfilename);

                            if (move_uploaded_file($_FILES['videos']['tmp_name'][$i], '../../../../' . ABSOLUTE_VIDEOPATH . $newfilename)) {
                                $sql = "INSERT INTO `videos` 
                                        (`pid`, `section_name`, `v_name`, `v_title`, `v_thumbnail`, `v_description`, `v_sequence`, `isactive`, `soft_delete`) 
                                        VALUES 
                                        ('$page_id', " . ($section_name ? "'$section_name'" : "NULL") . ", '$newfilename', '$titles', $thumbnail, '$descriptions', '$next_sequence', '1', '0')";
                                
                                $id = Insert($sql);
                                $next_sequence++; // Increment sequence for next video
                            }
                        }
                    }
                    
                    $response = ['success' => true, 'message' => 'Videos saved'];
                } else {
                    $response = ['success' => false, 'message' => 'No videos selected'];
                }
                break;
                
            case 'files':
            if (isset($_FILES['page_files']) && $_FILES['page_files']['error'][0] != UPLOAD_ERR_NO_FILE) {
                $countfiles = count($_FILES['page_files']['name']);
                $titles = clean($_POST['f_title']);
                $download_links = clean($_POST['f_download_link']);
                $descriptions = clean($_POST['f_description']);
                $section_name = !empty($_POST['section_name']) ? clean($_POST['section_name']) : null;
                $thumbnail = 'NULL';

                // Get last sequence number for files
                $get_last_sequence = (int)return_single_ans("SELECT MAX(f_sequence) FROM page_files WHERE pid = '$page_id'");
                $next_sequence = $get_last_sequence + 1;

                // Handle thumbnail if uploaded
                if (isset($_FILES['f_thumbnail']) && $_FILES['f_thumbnail']['error'] != UPLOAD_ERR_NO_FILE) {
                    $thumbFilename = $_FILES['f_thumbnail']['name'];
                    $temp = explode(".", $thumbFilename);
                    $temp1 = strtolower(end($temp));
                    $newThumbFilename = $temp[0] . "_" . uniqid() . '.' . $temp1;
                    $newThumbFilename = clean($newThumbFilename);

                    if (move_uploaded_file($_FILES['f_thumbnail']['tmp_name'], '../../../../' . ABSOLUTE_IMAGEPATH . $newThumbFilename)) {
                        $thumbnail = "'$newThumbFilename'";
                    }
                }

                for ($i = 0; $i < $countfiles; $i++) {
                    if ($_FILES['page_files']['error'][$i] == UPLOAD_ERR_OK) {
                        $filename = $_FILES['page_files']['name'][$i];
                        $temp = explode(".", $filename);
                        $temp1 = strtolower(end($temp));
                        $newfilename = $temp[0] . "_" . uniqid() . '.' . $temp1;
                        $newfilename = clean($newfilename);

                        if (move_uploaded_file($_FILES['page_files']['tmp_name'][$i], '../../../../' . ABSOLUTE_FILEPATH . $newfilename)) {
                            $sql = "INSERT INTO `page_files` 
                                    (`pid`, `section_name`, `f_name`, `f_title`, `f_download_link`, `f_description`, `f_thumbnail`, `f_sequence`, `isactive`, `soft_delete`) 
                                    VALUES 
                                    ('$page_id', " . ($section_name ? "'$section_name'" : "NULL") . ", '$newfilename', '$titles', '$download_links', '$descriptions', $thumbnail, '$next_sequence', '1', '0')";
                            
                            $id = Insert($sql);
                            $next_sequence++; // Increment sequence for next file
                        }
                    }
                }
                
                $response = ['success' => true, 'message' => 'Files saved'];
            } else {
                $response = ['success' => false, 'message' => 'No files selected'];
            }
            break;
                
            default:
                $response = ['success' => false, 'message' => 'Invalid media type'];
                break;
        }
    } catch (Exception $e) {
        $response = ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}