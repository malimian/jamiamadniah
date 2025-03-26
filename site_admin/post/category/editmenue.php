<?php
require_once('../../admin_connect.php');

if (isset($_POST['submit'])) {
    // Initialize response
    $response = ['status' => 'error', 'message' => 'Something went wrong'];
    
    try {
        // Validate and sanitize common inputs
        $page_title = escape($_POST['page_title']);
        $page_url = escape($_POST['page_url']);
        $menu_description = escape($_POST['menu_description'] ?? '');
        $showInNavBar = (int)$_POST['showInNavBar'];
        $CreateHierarchy = (int)$_POST['CreateHierarchy'];
        $is_active = (int)$_POST['is_active'];
        $ctname = (int)$_POST['ctname'];
        $uid = (int)$_SESSION['user']['id'];
        
        // Handle image upload/removal
        $image_path = '';
        $remove_image = isset($_POST['remove_image']) && $_POST['remove_image'] == '1';
        
        // For edit operation, get current image path
        if (isset($_POST['menue_id']) && $_POST['menue_id'] > 0) {
            $menue_id = (int)$_POST['menue_id'];
            $current_image = return_single_ans("SELECT catimage FROM category WHERE catid = $menue_id");
            
            if ($remove_image && !empty($current_image)) {
                // Delete the old image file
                $file_path = '../../../' . $current_image;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                $image_path = ''; // Set to empty to remove from database
            } else {
                $image_path = $current_image; // Keep current image if not removing
            }
        }
        
        // Handle new image upload
        if (!empty($_FILES['menu_image']['name'])) {
            $upload_dir = '../../../' . ABSOLUTE_IMAGEPATH;
            
            // Create directory if it doesn't exist
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            // Validate image
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $max_size = 2 * 1024 * 1024; // 2MB
            
            if (!in_array($_FILES['menu_image']['type'], $allowed_types)) {
                throw new Exception('Invalid image type. Only JPG, PNG, and GIF are allowed.');
            }
            
            if ($_FILES['menu_image']['size'] > $max_size) {
                throw new Exception('Image size exceeds maximum limit of 2MB.');
            }
            
            // Generate unique filename
            $file_ext = pathinfo($_FILES['menu_image']['name'], PATHINFO_EXTENSION);
            $filename = 'menu_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $file_ext;
            $target_path = $upload_dir . $filename;
            
            // Move uploaded file
            if (!move_uploaded_file($_FILES['menu_image']['tmp_name'], $target_path)) {
                throw new Exception('Failed to upload image.');
            }
            
            // If editing and had previous image, delete the old one
            if (isset($current_image) && !empty($current_image) && file_exists('../../../' . $current_image)) {
                unlink('../../../' . $current_image);
            }
            
            $image_path = ABSOLUTE_IMAGEPATH . $filename;
        }
        
        // Determine if this is an add or edit operation
        if (isset($_POST['menue_id']) && $_POST['menue_id'] > 0) {
            // Edit operation
            $menue_id = (int)$_POST['menue_id'];
            
            $sql = "UPDATE `category` SET 
                    `catname` = '$page_title', 
                    `cat_url` = '$page_url', 
                    `catdesc` = '$menu_description', 
                    `catimage` = '$image_path', 
                    `showInNavBar` = $showInNavBar, 
                    `CreateHierarchy` = $CreateHierarchy, 
                    `isactive` = $is_active, 
                    `ParentCategory` = $ctname 
                    WHERE `catid` = $menue_id";
            
            $result = Update($sql);
            
            if ($result > 0) {
                $response = [
                    'status' => 'success',
                    'message' => 'Menu item updated successfully',
                    'id' => $menue_id
                ];
            } else {
                throw new Exception('Already Updated');
            }
        } else {
            // Add operation
            $get_last_category_sequence = (int)return_single_ans("SELECT COUNT(catid) FROM category $where_gc");
            $next_sequence = $get_last_category_sequence + 1;
            
            $sql = "INSERT INTO `category` 
                    (`catname`, `cat_url`, `catdesc`, `catimage`, `showInNavBar`, `isactive`, 
                     `createdon`, `cat_sequence`, `CreateHierarchy`, `ParentCategory`, `createdby`) 
                    VALUES 
                    ('$page_title', '$page_url', '$menu_description', '$image_path', $showInNavBar, 
                     $is_active, CURRENT_TIMESTAMP, $next_sequence, $CreateHierarchy, $ctname, $uid)";
            
            $id = Insert($sql);
            
            if ($id > 0) {
                $response = [
                    'status' => 'success',
                    'message' => 'Menu item added successfully',
                    'id' => $id
                ];
            } else {
                throw new Exception('Already Updated');
            }
        }
        
    } catch (Exception $e) {
        // Clean up if image was uploaded but operation failed
        if (isset($target_path) && file_exists($target_path)) {
            unlink($target_path);
        }
        
        $response = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}