<?php
require_once('../../admin_connect.php');

header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => 'Operation failed',
    'data' => null
];

if(isset($_POST['submit'])) {
    $st_id = $_POST['st_id'] ?? '';
    
    // Handle recycle bin action
    if(isset($_POST['action']) && $_POST['action'] === 'recycle' && is_numeric($st_id)) {
        try {
            $sql = "UPDATE `site_template` SET `soft_delete` = 0 WHERE `st_id` = $st_id";
            $result = Update($sql);
            
            if($result) {
                $response = [
                    'success' => true,
                    'message' => 'Template moved to Recycle bin',
                    'data' => ['id' => $st_id]
                ];
            }
        } catch(Exception $e) {
            $response['message'] = $e->getMessage();
        }
        echo json_encode($response);
        exit();
    }

    // Handle duplicate action
    if(isset($_GET['action']) && $_GET['action'] === 'duplicate' && is_numeric($st_id)) {
        try {
            $template = return_single_row("SELECT * FROM site_template WHERE st_id = ".escape($st_id)." $and_gc");
            if($template) {
                $sql = "INSERT INTO `site_template` 
                        (`st_name`, `st_header`, `st_menu`, `st_footer`, `st_script`, `isactive`) 
                        VALUES 
                        ('Copy of ".escape($template['st_name'])."', 
                        '".escape($template['st_header'])."', 
                        '".escape($template['st_menu'])."', 
                        '".escape($template['st_footer'])."', 
                        '".escape($template['st_script'])."', 
                        ".intval($template['isactive']).")";
                
                $new_id = Insert($sql);
                
                if($new_id > 0) {
                    header("Location: editsite_template.php?id=$new_id");
                    exit();
                }
            }
        } catch(Exception $e) {
            $response['message'] = $e->getMessage();
            echo json_encode($response);
            exit();
        }
    }

    // Original form submission handling remains the same
    $st_name = escape($_POST['st_name'] ?? '');
    $st_header = escape($_POST['st_header'] ?? '');
    $st_menu = escape($_POST['st_menu'] ?? '');
    $st_footer = escape($_POST['st_footer'] ?? '');
    $st_script = escape($_POST['st_script'] ?? '');
    $is_active = (int)($_POST['is_active'] ?? 0);

    if(empty($st_name)) {
        $response['message'] = 'Template name is required';
        echo json_encode($response);
        exit();
    }

    try {
        if($st_id === "new") {
            $sql = "INSERT INTO `site_template` 
                    (`st_name`, `st_header`, `st_menu`, `st_footer`, `st_script`, `isactive`) 
                    VALUES 
                    ('$st_name', '$st_header', '$st_menu', '$st_footer', '$st_script', '$is_active')";
            
            $id = Insert($sql);
            
            if($id > 0) {
                $response = [
                    'success' => true,
                    'message' => 'Template created',
                    'data' => ['id' => $id]
                ];
            }
        } 
        elseif(is_numeric($st_id) && $st_id > 0) {
            $sql = "UPDATE `site_template` SET 
                    `st_name` = '$st_name', 
                    `st_header` = '$st_header', 
                    `st_menu` = '$st_menu', 
                    `st_footer` = '$st_footer', 
                    `st_script` = '$st_script', 
                    `isactive` = '$is_active' 
                    WHERE `st_id` = $st_id";
            
            $result = Update($sql);
            
            $response = [
                'success' => true,
                'message' => $result ? 'Template updated' : 'No changes detected',
                'data' => ['id' => $st_id]
            ];
        } else {
            $response['message'] = 'Invalid template ID';
        }
    } catch(Exception $e) {
        $response['message'] = $e->getMessage();
    }
}

echo json_encode($response);
exit();